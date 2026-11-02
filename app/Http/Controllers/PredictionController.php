<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Patient;
use App\Models\Prediction;

class PredictionController extends Controller
{
    // =========================
    // SHOW UPLOAD PAGE
    // =========================
    public function uploadPage()
    {
        $patients = Patient::where('user_id', auth()->id())->get();

        return view('predictions.upload', compact('patients'));
    }

    // =========================
    // RUN PREDICTION
    // =========================
    public function predict(Request $request)
    {
        // STEP 1: Validate
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'ic_last4' => 'required|digits:4',
            ], [
            'image.required' => 'Please select an ultrasound image.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Only JPG, JPEG, and PNG images are allowed.',
            'image.max' => 'The image size must not exceed 5 MB.',
            'ic_last4.required' => 'Please enter the patient IC number.',
            'ic_last4.digits' => 'The IC number must contain exactly last 4 digits.',
        ]);

        // STEP 2: Find patient
        $patient = Patient::where('user_id', auth()->id())
            ->whereRaw("RIGHT(REPLACE(ic_number,'-',''),4)=?", [$request->ic_last4])
            ->first();

        if (!$patient) {
            return back()
            ->with('error', 'Patient IC number not found. Please add the patient first.')
            ->withInput();
        }

        // STEP 3: Upload image
        $image = $request->file('image');
        $imagePath = $image->store('uploads', 'public');

        // STEP 4: Call AI API
        $response = Http::attach(
            'image',
            file_get_contents($image),
            $image->getClientOriginalName()
        )->post('http://127.0.0.1:5000/predict');

        if (!$response->successful()) {
            return back()->with('error', 'AI server error');
        }

        $data = $response->json();

        if (!$data) {
            return back()->with('error', 'Invalid AI response');
        }

        // STEP 5: Normalize confidence
        $confidence = $data['confidence'] ?? 0;

        if ($confidence <= 1) {
            $confidence *= 100;
        }

        // STEP 6: BI-RADS
        $birads = $this->getBiradsFromConfidence(
            $data['prediction'] ?? 'Unknown',
            $confidence
        );

        // STEP 7: LESION FEATURES (IMPORTANT FIX)
        $features = $this->generateClinicalInterpretation($birads);

        // STEP 8: SAVE REPORT
        $report = Prediction::create([
            'user_id' => auth()->id(),
            'patient_id' => $patient->id,
            'image_path' => $imagePath,
            'prediction' => $data['prediction'] ?? 'Unknown',
            'confidence' => $confidence,
            'birads_score' => $birads,
            'shape' => $features['shape'],
            'margin' => $features['margin'],
            'size' => $features['size'],
            'risk_level' => $features['risk_level'],
            'recommendation' => $data['explanation'] ?? $features['recommendation']
        ]);

        // STEP 9: RETURN VIEW
        return view('predictions.result', compact('report'));
    }

    // =========================
// BI-RADS LOGIC
// =========================
private function getBiradsFromConfidence($prediction, $confidence)
{
    // NORMAL
    if ($prediction == 'Normal') {

        if ($confidence >= 80)
            return 'BI-RADS 1 (Negative)';

        return 'BI-RADS 0 (Incomplete - Needs Additional Imaging)';
    }

    // BENIGN
    if ($prediction == 'Benign') {

        if ($confidence >= 90)
            return 'BI-RADS 2 (Benign Finding)';

        if ($confidence >= 75)
            return 'BI-RADS 3 (Probably Benign)';

        return 'BI-RADS 0 (Incomplete - Needs Additional Imaging)';
    }

    // MALIGNANT
    if ($prediction == 'Malignant') {

        if ($confidence >= 95)
            return 'BI-RADS 5 (Highly Suggestive of Malignancy)';

        if ($confidence >= 85)
            return 'BI-RADS 4C (High Suspicion for Malignancy)';

        if ($confidence >= 70)
            return 'BI-RADS 4B (Moderate Suspicion for Malignancy)';

        return 'BI-RADS 4A (Low Suspicion for Malignancy)';
    }

    return 'BI-RADS 0 (Unknown Result)';
}

    // =========================
    // LESION FEATURE MAPPING (FIXED)
    // =========================
    private function generateClinicalInterpretation($birads)
    {
        if (str_contains($birads, '1')) {
            return [
                'shape' => 'No lesion detected',
                'margin' => 'No abnormal structure observed',
                'size' => 'N/A',
                'risk_level' => 'Negative',
                'recommendation' => 'Continue routine breast screening'
            ];
        }

        if (str_contains($birads, '2')) {
            return [
                'shape' => 'Round / Oval',
                'margin' => 'Well-circumscribed',
                'size' => '< 1 cm',
                'risk_level' => 'Benign',
                'recommendation' => 'Routine screening only'
            ];
        }

        if (str_contains($birads, '3')) {
            return [
                'shape' => 'Oval',
                'margin' => 'Circumscribed',
                'size' => '1–2 cm',
                'risk_level' => 'Probably Benign',
                'recommendation' => 'Follow-up in 6 months'
            ];
        }

        if (str_contains($birads, '4')) {
            return [
                'shape' => 'Irregular',
                'margin' => 'Indistinct / Spiculated',
                'size' => '2–3 cm',
                'risk_level' => 'Suspicious',
                'recommendation' => 'Biopsy recommended'
            ];
        }

        if (str_contains($birads, '5')) {
            return [
                'shape' => 'Highly irregular',
                'margin' => 'Spiculated',
                'size' => '> 3 cm',
                'risk_level' => 'High Risk',
                'recommendation' => 'Immediate biopsy & specialist referral'
            ];
        }

        return [
            'shape' => 'Unknown',
            'margin' => 'Unknown',
            'size' => 'Unknown',
            'risk_level' => 'Unknown',
            'recommendation' => 'Consult doctor'
        ];
    }
}
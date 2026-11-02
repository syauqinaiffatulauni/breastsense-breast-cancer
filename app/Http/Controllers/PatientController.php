<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::where('user_id', auth()->id());

        // FILTER BY IC LAST 4 DIGITS
        if ($request->filled('ic_last4')) {
            $query->whereRaw("RIGHT(REPLACE(ic_number,'-',''),4)=?", [
                $request->ic_last4
            ]);
        }

        $patients = $query->get();

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'full_name' => 'required',
        'ic_number' => 'required',
        'age' => 'required',
        'phone' => 'required',
    ]);

    Patient::create([
        'user_id' => auth()->id(),   
        'full_name' => $request->full_name,
        'ic_number' => $request->ic_number,
        'age' => $request->age,
        'phone' => $request->phone,
    ]);

    return redirect()->route('patients.index')
        ->with('success', 'Patient added successfully');
}

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
{
    // security check (VERY IMPORTANT)
    if ($patient->user_id !== auth()->id()) {
        abort(403);
    }

    $patient->update($request->all());

    return redirect()->route('patients.index');
}

    public function destroy(Patient $patient)
{
    if ($patient->user_id !== auth()->id()) {
        abort(403);
    }

    $patient->delete();

    return redirect()->route('patients.index');
}

    public function search(Request $request)
{
    $request->validate([
        'ic_number' => 'required'
    ]);

    $patient = Patient::where('ic_number', $request->ic_number)->first();

    if (!$patient) {
        return redirect()->route('patients.create')
            ->with('error', 'Patient not found. Please register first.');
    }

    return redirect()->route('patients.show', $patient->id);
}

    public function show($id)
{
    $patient = Patient::with('predictions')->findOrFail($id);

    return view('patients.show', compact('patient'));
}
}
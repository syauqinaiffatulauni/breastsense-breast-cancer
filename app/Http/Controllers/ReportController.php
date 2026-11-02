<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use Barryvdh\DomPDF\Facade\Pdf;
class ReportController extends Controller
{
    public function show($id)
    {
        $report = Prediction::with('patient')->findOrFail($id);

        return view('predictions.report', compact('report'));
    }

//     public function downloadPdf($id)
// {
//     $report = Prediction::with('patient')->findOrFail($id);

//     $pdf = Pdf::loadView('predictions.report_pdf', compact('report'));

//     return $pdf->download('breast_cancer_report_' . $report->id . '.pdf');
// }

public function downloadPdf($id)
{
    $report = Prediction::with('patient')->findOrFail($id);

    $pdf = Pdf::loadView('predictions.report_pdf', compact('report'));

    return $pdf->stream('BreastSense_Report_'.$report->id.'.pdf');
}
}
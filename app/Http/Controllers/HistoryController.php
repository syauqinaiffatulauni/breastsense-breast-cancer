<?php

namespace App\Http\Controllers;

use App\Models\Prediction;

class HistoryController extends Controller
{
    public function index()
    {
        $predictions = Prediction::where('user_id', auth()->id())
            ->latest()
            // ->get();
            ->paginate(10);
        return view('history', compact('predictions'));
    }

    public function report($id)
    {
        $report = Prediction::with('patient')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('predictions.report', compact('report'));
    }
}
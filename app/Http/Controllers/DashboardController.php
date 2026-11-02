<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $userId = auth()->id();

    // TOTAL
    $total = Prediction::where('user_id', $userId)->count();

    // BENIGN
    $benign = Prediction::where('user_id', $userId)
        ->where('prediction', 'Benign')
        ->count();

    // MALIGNANT
    $malignant = Prediction::where('user_id', $userId)
        ->where('prediction', 'Malignant')
        ->count();

    // Normal
    $normal = Prediction::where('user_id', $userId)
        ->where('prediction', 'Normal')
        ->count();

    // RECENT
    $recent = Prediction::where('user_id', $userId)
        ->latest()
        ->take(10)
        ->get();

    // CONFIDENCE DISTRIBUTION (NEW GRAPH DATA)
    $confidenceRanges = [
        '0-50' => Prediction::where('user_id', $userId)
            ->whereBetween('confidence', [0, 50])
            ->count(),

        '51-70' => Prediction::where('user_id', $userId)
            ->whereBetween('confidence', [51, 70])
            ->count(),

        '71-85' => Prediction::where('user_id', $userId)
            ->whereBetween('confidence', [71, 85])
            ->count(),

        '86-100' => Prediction::where('user_id', $userId)
            ->whereBetween('confidence', [86, 100])
            ->count(),
    ];

    return view('dashboard', compact(
        'total',
        'benign',
        'malignant',
        'normal',
        'recent',
        'confidenceRanges'
    ));
}
}
@extends('layout')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    @if(!isset($report))

        <div class="bg-red-50 border border-red-200 text-red-600 p-6 rounded-2xl shadow">
            No classification data found.
        </div>

    @else

        @php
            $pred = $report->prediction;
            $conf = $report->confidence;

            // Prediction color
            $colorClass = match($pred) {
                'Normal' => 'text-green-600',
                'Benign' => 'text-yellow-500',
                'Malignant' => 'text-red-500',
                default => 'text-gray-600'
            };

            // Confidence bar color
            $barColor = match(true) {
                $conf >= 80 => 'bg-green-500',
                $conf >= 60 => 'bg-yellow-400',
                default => 'bg-red-400'
            };

            // Status badge
            $badge = match($pred) {
                'Normal' => '🟢 Normal',
                'Benign' => '🟡 Benign',
                'Malignant' => '🔴 Malignant',
                default => '⚪ Unknown'
            };

            // Lesion features
            $features = $report->lesion_features ?? null;
        @endphp

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-pink-100 to-pink-200 p-6 rounded-2xl shadow border-l-8 border-pink-300">

            <h2 class="text-3xl font-bold text-gray-800">
                Breast Ultrasound Analysis Report
            </h2>

            <p class="text-gray-600 text-sm mt-1">
                AI-assisted breast ultrasound screening result
            </p>

        </div>

        <!-- RESULT CARD -->
        <div class="bg-white p-6 rounded-2xl shadow border border-pink-100">

            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-5">

                <!-- Prediction -->
                <div>

                    <p class="text-gray-500 text-sm mb-1">
                        Classification Result
                    </p>

                    <p class="text-3xl font-bold {{ $colorClass }}">
                        {{ $pred }}
                    </p>

                    <p class="mt-2 text-sm font-medium text-gray-600">
                        {{ $badge }}
                    </p>

                </div>

                <!-- Confidence -->
                <div class="text-left md:text-right">

                    <p class="text-gray-500 text-sm mb-1">
                        Confidence Score
                    </p>

                    <p class="text-2xl font-bold text-gray-800">
                        {{ number_format($conf, 2) }}%
                    </p>

                </div>

            </div>

            <!-- Confidence Bar -->
            <div class="mt-6">

                <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">

                    <div class="h-4 rounded-full {{ $barColor }}"
                         style="width: {{ $conf }}%">
                    </div>

                </div>

            </div>

            <!-- BI-RADS -->
            <div class="mt-6 p-5 rounded-xl bg-pink-50 border border-pink-100">

                <p class="text-sm text-gray-500 mb-1">
                    BI-RADS Assessment
                </p>

                <p class="text-xl font-semibold text-pink-700">
                    {{ $report->birads_score }}
                </p>

            </div>

        </div>

        <!-- LESION FEATURES -->
        @if($features)

        <div class="bg-white p-6 rounded-2xl shadow border border-gray-200">

            <h3 class="text-xl font-semibold text-gray-800 mb-5">
                Lesion Features
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="bg-gray-50 p-4 rounded-xl border">
                    <p class="text-sm text-gray-500">Shape</p>
                    <p class="font-semibold text-gray-800 mt-1">
                        {{ $features['shape'] }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl border">
                    <p class="text-sm text-gray-500">Margin</p>
                    <p class="font-semibold text-gray-800 mt-1">
                        {{ $features['margin'] }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl border">
                    <p class="text-sm text-gray-500">Size</p>
                    <p class="font-semibold text-gray-800 mt-1">
                        {{ $features['size'] }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl border">
                    <p class="text-sm text-gray-500">Risk Level</p>
                    <p class="font-semibold text-gray-800 mt-1">
                        {{ $features['risk_level'] }}
                    </p>
                </div>

            </div>

        </div>

        @endif

        <!-- RECOMMENDATION -->
        @if(isset($report->recommendation))

        <div class="bg-pink-50 p-6 rounded-2xl border border-pink-200 shadow">

            <h3 class="text-xl font-semibold text-pink-700 mb-3">
                Clinical Recommendation
            </h3>

            <p class="text-gray-700 leading-relaxed">
                {{ $report->recommendation }}
            </p>

        </div>

        @endif

        <!-- DISCLAIMER -->
        <div class="bg-yellow-50 border border-yellow-200 p-5 rounded-2xl shadow">

            <h3 class="text-lg font-semibold text-yellow-700 mb-2">
                Disclaimer
            </h3>

            <p class="text-sm text-gray-700 leading-relaxed">
                This system provides AI-assisted breast ultrasound analysis for
                educational and decision-support purposes only. The generated
                classification and BI-RADS assessment are not intended to replace
                professional medical diagnosis or radiologist evaluation.
            </p>

        </div>

        <!-- BUTTONS -->
        <div class="flex flex-col md:flex-row justify-center gap-4 pb-10">

            <a href="/upload"
               class="bg-pink-500 text-white px-6 py-3 rounded-xl shadow hover:bg-pink-600 text-center font-medium">

                Run New Classification

            </a>

            <a href="{{ url('/report/' . $report->id) }}"
               class="bg-white border border-pink-500 text-pink-500 px-6 py-3 rounded-xl shadow hover:bg-pink-50 text-center font-medium">

                View Full Report

            </a>

        </div>

    @endif

</div>

@endsection
@extends('layout')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg border border-pink-100 p-8">

    <!-- HEADER -->
    <div class="text-center border-b pb-4 mb-6">
        <h1 class="text-2xl font-bold text-pink-600">
            Breast Cancer Classification Report
        </h1>
        <p class="text-gray-500 text-sm">
            Diagnostic summary
        </p>
    </div>

    <!-- IMAGE SECTION -->
    <div class="mb-6 text-center">

    <p class="text-sm font-semibold text-gray-600 mb-2">
        Uploaded Image
    </p>

    @if($report->image_path)

    <img src="{{ asset('storage/' . $report->image_path) }}"
         class="mx-auto w-64 rounded-xl border shadow">

    @else

    <div class="bg-red-100 text-red-600 p-4 rounded-xl inline-block">
        Image not available
    </div>

    @endif

</div>
    <!-- PATIENT INFO -->
    <div class="grid grid-cols-2 gap-4 mb-6">

    <div class="bg-gray-50 rounded-lg p-4 text-center">
        <p class="text-gray-500 text-sm">Patient ID</p>
        <p class="font-semibold">P{{ $report->id }}</p>
    </div>

    <div class="bg-gray-50 rounded-lg p-4 text-center">
        <p class="text-gray-500 text-sm">Patient Name</p>
        <p class="font-semibold">{{ $report->patient->full_name ?? '-' }}</p>
    </div>

    <div class="bg-gray-50 rounded-lg p-4 text-center">
    <p class="text-gray-500 text-sm">IC Number</p>
    <p class="font-semibold">{{ $report->patient->ic_number ?? '-' }}</p>
    </div>

    <div class="bg-gray-50 rounded-lg p-4 text-center">
        <p class="text-gray-500 text-sm">Age</p>
        <p class="font-semibold">{{ $report->patient->age ?? '-' }}</p>
    </div>

    <div class="bg-gray-50 rounded-lg p-4 text-center">
    <p class="text-gray-500 text-sm">Phone Number</p>
    <p class="font-semibold">{{ $report->patient->phone ?? '-' }}</p>
    </div>  

    <div class="bg-gray-50 rounded-lg p-4 text-center">
        <p class="text-gray-500 text-sm">Date</p>
        <p class="font-semibold">{{ $report->formatted_date }}</p>
    </div>

</div>

    <!-- RESULT SECTION -->
    <div class="bg-pink-50 rounded-xl p-5 mb-6">

        <h2 class="font-semibold text-gray-700 mb-3">
            Classification Result
        </h2>

        <div class="space-y-2 text-sm">

            <p>
                <span class="text-gray-500">Classification:</span>
                <span class="font-semibold">{{ $report->prediction }}</span>
            </p>

            <p>
                <span class="text-gray-500">Confidence:</span>
                <span class="font-semibold">{{ number_format($report->confidence, 2) }}%</span>
            </p>

            <p>
                <span class="text-gray-500">BI-RADS Score:</span>
                <span class="font-semibold">{{ $report->birads_score }}</span>
            </p>

            <p>
                <span class="text-gray-500">Risk Level:</span>
                <span class="font-semibold">{{ $report->risk_level ?? '-' }}</span>
            </p>

        </div>

    </div>

    <!-- LESION FEATURES -->
    <div class="mb-6">

        <h2 class="font-semibold text-gray-700 mb-3">
            Clinical Interpretation
        </h2>

        <div class="grid grid-cols-3 gap-3 text-sm">

            <div class="bg-white border rounded-lg p-3">
                <p class="text-gray-500">Shape</p>
                <p class="font-semibold">{{ $report->shape ?? '-' }}</p>
            </div>

            <div class="bg-white border rounded-lg p-3">
                <p class="text-gray-500">Margin</p>
                <p class="font-semibold">{{ $report->margin ?? '-' }}</p>
            </div>

            <div class="bg-white border rounded-lg p-3">
                <p class="text-gray-500">Size</p>
                <p class="font-semibold">{{ $report->size ?? '-' }}</p>
            </div>

        </div>
    <p class="mt-4 text-xs text-gray-500 italic">
    The clinical interpretation shown above is generated using predefined BI-RADS-based rules derived from the classification result and confidence score. It is intended to assist interpretation and is not directly predicted by the ResNet18 model.
    </p>
    </div>

    <!-- RECOMMENDATION -->
    <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-6">

        <h2 class="font-semibold text-green-700 mb-2">
            Recommendation
        </h2>

        <p class="text-sm text-gray-700">
            {{ $report->recommendation ?? '-' }}
        </p>

    </div>

        <!-- ACTION BUTTONS -->
    <div class="flex justify-center gap-4 mt-6">

        <a href="{{ url('/report/' . $report->id . '/download') }}"
        target="_blank"
        rel="noopener"
        class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-xl shadow">
            Download PDF
        </a>

        <a href="{{ url('/history') }}"
           class="bg-white border border-pink-500 text-pink-500 px-6 py-2 rounded-xl shadow hover:bg-pink-50">
            Back to History
        </a>

    </div>

    <!-- FOOTER -->
    <div class="text-center text-xs text-gray-400 mt-8">
         Breast Cancer Classification System
    </div>

</div>

@endsection
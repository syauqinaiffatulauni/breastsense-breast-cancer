@extends('layout')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold text-pink-600 mb-4">
        Patient History
    </h2>

    <!-- PATIENT INFO -->
    <div class="mb-6 p-4 bg-pink-50 rounded-xl">
        <p><b>Name:</b> {{ $patient->full_name }}</p>
        <p><b>IC Number:</b> {{ $patient->ic_number }}</p>
    </div>

    <!-- PREDICTIONS LIST -->
    <h3 class="text-lg font-semibold mb-3">Classification History</h3>

    @forelse($patient->predictions as $report)

        <div class="border rounded-xl p-4 mb-4 shadow-sm">

            <div class="flex justify-between">

                <div>
                    <p><b>Classification:</b> {{ $report->prediction }}</p>
                    <p><b>Confidence:</b> {{ number_format($report->confidence, 2) }}%</p>
                    <p><b>BI-RADS:</b> {{ $report->birads_score }}</p>
                </div>

                <div class="text-right">
                    <a href="{{ url('/report/'.$report->id) }}"
                       class="bg-pink-500 text-white px-3 py-1 rounded-lg text-sm">
                        View Report
                    </a>
                </div>

            </div>

        </div>

    @empty

        <p class="text-gray-500">No classification history found.</p>

    @endforelse

</div>

@endsection
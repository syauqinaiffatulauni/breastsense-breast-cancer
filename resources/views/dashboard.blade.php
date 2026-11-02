@extends('layout')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="bg-white rounded-2xl shadow p-6 border-l-8 border-pink-300 flex justify-between items-center">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Dashboard
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Breast Ultrasound Screening Analytics Overview
            </p>
        </div>

    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- TOTAL -->
        <div class="bg-gradient-to-r from-pink-100 to-pink-200 p-6 rounded-2xl shadow">

            <h2 class="text-gray-600 font-semibold">
                Total Predictions
            </h2>

            <p class="text-3xl font-bold text-gray-800 mt-2">
                {{ $total }}
            </p>

        </div>

        <!-- NORMAL -->
        <div class="bg-gradient-to-r from-green-100 to-green-200 p-6 rounded-2xl shadow">

            <h2 class="text-gray-600 font-semibold">
                Normal Cases
            </h2>

            <p class="text-3xl font-bold text-green-700 mt-2">
                {{ $normal }}
            </p>

        </div>

        <!-- BENIGN -->
        <div class="bg-gradient-to-r from-yellow-100 to-yellow-200 p-6 rounded-2xl shadow">

            <h2 class="text-gray-600 font-semibold">
                Benign Cases
            </h2>

            <p class="text-3xl font-bold text-yellow-700 mt-2">
                {{ $benign }}
            </p>

        </div>

        <!-- MALIGNANT -->
        <div class="bg-gradient-to-r from-red-100 to-red-200 p-6 rounded-2xl shadow">

            <h2 class="text-gray-600 font-semibold">
                Malignant Cases
            </h2>

            <p class="text-3xl font-bold text-red-700 mt-2">
                {{ $malignant }}
            </p>

        </div>

    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- PIE CHART -->
        <div class="bg-white p-6 rounded-2xl shadow border border-pink-100">

            <h2 class="text-lg font-semibold text-gray-700 mb-4">
                Classification Distribution
            </h2>

        <div class="w-full max-w-sm h-80 mx-auto">
        <canvas id="pieChart"></canvas>
        </div>

        </div>

        <!-- CONFIDENCE CHART -->
        <div class="bg-white p-6 rounded-2xl shadow border border-pink-100">

            <h2 class="text-lg font-semibold text-gray-700 mb-4">
                Confidence Distribution
            </h2>

            <canvas id="confidenceChart"></canvas>

        </div>

    </div>

    <!-- RECENT TABLE -->
    <div class="bg-white p-6 rounded-2xl shadow border border-pink-100">

        <h2 class="text-xl font-semibold text-gray-700 mb-5">
            Recent Classifications
        </h2>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-pink-50 text-left">

                        <th class="p-3">Classification</th>
                        <th class="p-3">BI-RADS</th>
                        <th class="p-3">Confidence</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Action</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($recent as $item)

                    @php

                        $predictionColor = match($item->prediction) {
                            'Normal' => 'text-green-600',
                            'Benign' => 'text-yellow-600',
                            'Malignant' => 'text-red-600',
                            default => 'text-gray-600'
                        };

                    @endphp

                    <tr class="border-b hover:bg-pink-50 transition">

                        <!-- Prediction -->
                        <td class="p-3 font-semibold {{ $predictionColor }}">

                            {{ $item->prediction }}

                        </td>

                        <!-- BI-RADS -->
                        <td class="p-3 text-gray-700">

                            {{ $item->birads_score ?? 'N/A' }}

                        </td>

                        <!-- Confidence -->
                        <td class="p-3">

                            {{ number_format($item->confidence, 2) }}%

                        </td>

                        <!-- Date -->
                        <td class="p-3 text-gray-600">

                            {{ $item->created_at->format('Y-m-d H:i') }}

                        </td>

                        <!-- Action -->
                        <td class="p-3">

                            <a href="{{ url('/report/' . $item->id) }}"
                               class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded-lg shadow">

                                View

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const normal = {{ $normal }};
const benign = {{ $benign }};
const malignant = {{ $malignant }};

const confidenceData = @json($confidenceRanges);

// =========================
// PIE CHART
// =========================
new Chart(document.getElementById('pieChart'), {

    type: 'pie',

    data: {

        labels: ['Normal', 'Benign', 'Malignant'],

        datasets: [{

            data: [normal, benign, malignant],

            backgroundColor: [
                '#4ade80',
                '#facc15',
                '#f87171'
            ]

        }]

    }

});

// =========================
// CONFIDENCE BAR CHART
// =========================
new Chart(document.getElementById('confidenceChart'), {

    type: 'bar',

    data: {

        labels: Object.keys(confidenceData),

        datasets: [{

            label: 'Predictions',

            data: Object.values(confidenceData),

            backgroundColor: [
                '#fbcfe8',
                '#f9a8d4',
                '#f472b6',
                '#ec4899'
            ],

            borderRadius: 10

        }]

    },

    options: {

        responsive: true,

        scales: {

            x: {
                title: {
                    display: true,
                    text: 'Confidence Range (%)'
                }
            },

            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Predictions'
                }
            }

        },

        plugins: {

            legend: {
                display: false
            }

        }

    }

});

</script>

@endsection
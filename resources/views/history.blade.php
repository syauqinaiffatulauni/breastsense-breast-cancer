@extends('layout')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="bg-white p-6 rounded-2xl shadow border-l-8 border-pink-300">

        <h2 class="text-3xl font-bold text-pink-600">
            Classification History
        </h2>

        <p class="text-gray-500 text-sm mt-1">
            Complete breast ultrasound screening records
        </p>

    </div>

    <!-- TABLE CARD -->
    <div class="bg-white p-6 rounded-2xl shadow-lg border border-pink-100 overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-pink-50 text-gray-700">
                <tr>

                    <th class="p-4 text-left">Image</th>
                    <th class="p-4 text-left">Classification</th>
                    <th class="p-4 text-left">BI-RADS</th>
                    <th class="p-4 text-left">Confidence</th>
                    <th class="p-4 text-left">Date</th>
                    <th class="p-4 text-left">Action</th>

                </tr>
            </thead>

            <tbody>

                @foreach($predictions as $item)

                @php

                    $badgeClass = match($item->prediction) {

                        'Normal' =>
                            'bg-green-100 text-green-700',

                        'Benign' =>
                            'bg-yellow-100 text-yellow-700',

                        'Malignant' =>
                            'bg-red-100 text-red-700',

                        default =>
                            'bg-gray-100 text-gray-700'
                    };

                @endphp

                <tr class="border-b hover:bg-pink-50 transition">

                    <!-- IMAGE -->
                    <td class="p-4">

                        <img src="{{ asset('storage/' . $item->image_path) }}"
                             class="w-16 h-16 object-cover rounded-xl border shadow-sm">

                    </td>

                    <!-- PREDICTION -->
                    <td class="p-4">

                        <span class="px-4 py-2 rounded-full text-xs font-semibold {{ $badgeClass }}">

                            {{ $item->prediction }}

                        </span>

                    </td>

                    <!-- BI-RADS -->
                    <td class="p-4 text-gray-700 font-medium">

                        {{ $item->birads_score ?? 'N/A' }}

                    </td>

                    <!-- CONFIDENCE -->
                    <td class="p-4 font-semibold text-gray-800">

                        {{ number_format($item->confidence, 2) }}%

                    </td>

                    <!-- DATE -->
                    <td class="p-4 text-gray-600">

                        {{ $item->created_at->format('Y-m-d H:i') }}

                    </td>

                    <!-- ACTION -->
                    <td class="p-4">

                        <a href="{{ url('/report/' . $item->id) }}"
                           class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow transition">

                            View Report

                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <!-- Paging -->
        <div class="flex items-center justify-between mt-6">

            <p class="text-sm text-gray-500">
                Showing
                <span class="font-semibold">{{ $predictions->firstItem() }}</span>
                -
                <span class="font-semibold">{{ $predictions->lastItem() }}</span>
                of
                <span class="font-semibold">{{ $predictions->total() }}</span>
                classification records
            </p>

            {{ $predictions->links() }}

        </div>

        <!-- EMPTY STATE -->
        @if($predictions->count() == 0)

        <div class="text-center py-10">

            <p class="text-gray-500">
                No classification records available.
            </p>

        </div>

        @endif

    </div>

</div>

@endsection
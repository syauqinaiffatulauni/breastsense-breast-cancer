@extends('layout')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold">
        {{ $patient->full_name }}
    </h1>

    <p>IC: {{ $patient->ic_number }}</p>
    <p>Age: {{ $patient->age }}</p>
    <p>Gender: {{ $patient->gender }}</p>

</div>

<!-- UPLOAD NEW TEST -->
<div class="mt-6 bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-semibold">Upload New Ultrasound Test</h2>

    <form action="{{ route('patients.predict', $patient->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <input type="file" name="image" required>

        <button class="bg-blue-600 text-white px-4 py-2 mt-3 rounded">
            Run AI Prediction
        </button>
    </form>

</div>

<!-- HISTORY -->
<div class="mt-6 bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-semibold">Test History</h2>

    <table class="w-full mt-3 border">
        <tr>
            <th>Date</th>
            <th>Result</th>
            <th>Confidence</th>
        </tr>

        @foreach($patient->predictions as $test)
        <tr>
            <td>{{ $test->created_at }}</td>
            <td>{{ $test->prediction }}</td>
            <td>{{ $test->confidence }}</td>
        </tr>
        @endforeach

    </table>

</div>

@endsection
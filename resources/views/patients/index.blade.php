@extends('layout')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-white rounded-2xl shadow p-6 border-l-8 border-pink-300 flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold text-pink-600">
                Patient List
            </h1>
            <p class="text-gray-500 text-sm">
                Manage registered patient records
            </p>
        </div>

        <a href="{{ route('patients.create') }}"
           class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-xl shadow">
            + Add Patient
        </a>

    </div>

    <form method="GET" action="{{ url('/patients') }}" class="mb-4 flex gap-2">

    <input type="text"
           name="ic_last4"
           placeholder="Search IC last 4 digits"
           maxlength="4"
           class="border rounded-xl p-2 w-64">

    <button class="bg-pink-500 text-white px-4 py-2 rounded-xl">
        Filter
    </button>

    <a href="{{ url('/patients') }}"
       class="bg-gray-200 px-4 py-2 rounded-xl">
        Reset
    </a>

    </form>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-pink-100">

        <table class="w-full text-sm">

            <thead class="bg-pink-50 text-gray-700">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Full Name</th>
                    <th class="p-4 text-left">IC Number</th>
                    <th class="p-4 text-left">Phone Number</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($patients as $patient)
                <tr class="border-b hover:bg-pink-50 transition">

                    <td class="p-4">{{ $patient->id }}</td>

                    <td class="p-4 font-semibold text-gray-800">
                        {{ $patient->full_name }}
                    </td>

                    <td class="p-4 text-gray-600">
                        {{ $patient->ic_number }}
                    </td>

                    <td class="p-4 text-gray-600">
                        {{ $patient->phone }}
                    </td>

                    <td class="p-4 flex gap-3">

                        <!-- Edit -->
                        <a href="{{ route('patients.edit', $patient->id) }}"
                           class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded-lg">
                            Edit
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('patients.destroy', $patient->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this patient?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-400 hover:bg-red-500 text-white px-3 py-1 rounded-lg">
                                Delete
                            </button>
                        </form>

                        <a href="{{ url('/patients/'.$patient->id) }}"
                        class="bg-blue-500 text-white px-3 py-1 rounded-lg text-sm">
                            View
                        </a>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection
@extends('layout')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8 border-t-8 border-pink-300">

        <h1 class="text-2xl font-bold text-pink-600 mb-2">
            Add New Patient
        </h1>

        <p class="text-gray-500 mb-6">
            Register a new patient record into the system
        </p>

        <form action="{{ route('patients.store') }}"
              method="POST"
              class="space-y-5"
              onsubmit="showLoader()">

            @csrf

            <!-- Full Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name
                </label>
                <input type="text"
                       name="full_name"
                       placeholder="Enter patient full name"
                       class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-pink-300"
                       required>
            </div>

            <!-- IC Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    IC Number
                </label>
                <input type="text"
                       name="ic_number"
                       placeholder="Enter IC number"
                       class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-pink-300"
                       required>
            </div>

            <!-- Age -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Age
                </label>
                <input type="number"
                       name="age"
                       placeholder="Enter age"
                       class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-pink-300"
                       required>
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Phone Number
                </label>
                <input type="text"
                       name="phone"
                       placeholder="Enter phone number"
                       class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-pink-300"
                       required>
            </div>

            <!-- Save Button -->
            <button id="saveBtn"
                    type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl font-semibold flex justify-center items-center gap-2">

                <span id="btnText">Save Patient</span>

                <!-- Spinner -->
                <svg id="spinner"
                     class="hidden animate-spin h-5 w-5 text-white"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24">

                    <circle class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"></circle>

                    <path class="opacity-75"
                          fill="currentColor"
                          d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>

            </button>

        </form>

    </div>

</div>

<!-- Loader Script -->
<script>
function showLoader() {
    document.getElementById("spinner").classList.remove("hidden");
    document.getElementById("btnText").innerText = "Saving...";
}
</script>

@endsection
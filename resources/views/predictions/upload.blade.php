@extends('layout')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="bg-white rounded-2xl shadow-lg p-8 border-t-8 border-pink-300">

        <h2 class="text-2xl font-bold text-pink-600 mb-2">
            Upload Image
        </h2>

        <!-- <p class="text-gray-500 mb-6">
            Enter IC last 4 digits and upload image prediction
        </p> -->

        <!-- FORM -->
        <form action="{{ route('predict') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6"
              onsubmit="showLoader()">

            @csrf

            <!-- IC INPUT -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Enter IC Number (Last 4 Digits)
                </label>

                <input type="text"
                name="ic_last4"
                value="{{ old('ic_last4') }}"
                maxlength="4"
                required
                class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-pink-300"
                placeholder="e.g. 1234">
            </div>

            <!-- ADD PATIENT (RESTORED) -->
            <div>
                <a href="/patients/create"
                   class="text-pink-600 font-semibold hover:underline">
                    + Add New Patient
                </a>
            </div>

            <!-- IMAGE INPUT -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Upload Image
                </label>

                <input type="file"
                       name="image"
                       required
                       class="w-full border rounded-xl p-3 file:bg-pink-500 file:text-white file:border-0 file:px-4 file:py-2 file:rounded-lg">
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl font-semibold">

                Run Classification

            </button>

        </form>

    </div>

</div>

<script>
function showLoader() {
    console.log("Predicting...");
}
</script>

    @if(session('error'))
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Patient Not Found',
            text: "{{ session('error') }}",
            confirmButtonColor: '#ec4899',
            confirmButtonText: 'OK'
        });
    });
    </script>
    @endif

    @if ($errors->any())
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Upload Failed',
                text: "{{ $errors->first() }}",
                confirmButtonColor: '#ec4899'
            });
        });
        </script>
    @endif
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breast Cancer Classification System</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-pink-50 min-h-screen">

<!-- NAVBAR -->
<nav class="bg-white shadow-md border-b-4 border-pink-200 px-6 py-4 flex justify-between items-center">

    <!-- Logo / Title -->
    <a href="{{ url('/dashboard') }}" class="flex items-center gap-3">
        <img src="{{ asset('images/logo.png') }}"
            alt="BreastSense Logo"
            class="h-20 w-auto transition-transform duration-200">
    </a>

    <!-- MENU -->
    <div class="flex items-center space-x-6 text-sm font-medium">

        <a href="/dashboard"
           class="text-gray-600 hover:text-pink-500 transition">
            Dashboard
        </a>

        <a href="/upload"
           class="text-gray-600 hover:text-pink-500 transition">
            Upload
        </a>

        <a href="/patients"
           class="text-gray-600 hover:text-pink-500 transition">
            Patients
        </a>

        <a href="/history"
           class="text-gray-600 hover:text-pink-500 transition">
            History
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow">
                Logout
            </button>
        </form>

    </div>

</nav>

<!-- CONTENT AREA -->
<div class="p-6">
    @yield('content')
</div>

</body>
</html>
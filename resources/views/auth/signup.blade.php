<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | Breast Cancer Classification System</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Fade + Slide animation */
        .fade-slide {
            animation: fadeSlide 0.8s ease-out;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<script>
function togglePassword() {
    const pw = document.getElementById("password");
    pw.type = pw.type === "password" ? "text" : "password";
}

function toggleConfirmPassword() {
    const confirmPassword = document.getElementById("password_confirmation");
    confirmPassword.type = confirmPassword.type === "password" ? "text" : "password";
}
</script>

<body class="bg-pink-50 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 border-t-8 border-pink-400 fade-slide">

    <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">
        Create Account
    </h2>

    <p class="text-center text-gray-500 mb-6">
        Register to access web-based classification system
    </p>

    @if ($errors->any())
        <div class="text-red-500 text-sm mb-3 text-center">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/signup" class="space-y-4" onsubmit="showLoader()">
        @csrf

        <input type="text" name="name"
               placeholder="Full Name"
               class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-pink-300">

        <input type="email" name="email"
               placeholder="Email"
               class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-pink-300">

        <!-- Password -->
        <div class="relative">
            <input id="password"
                type="password"
                name="password"
                placeholder="Password"
                class="w-full border rounded-lg p-3 pr-10 focus:ring-2 focus:ring-pink-300">

            <!-- Eye Icon -->
            <button type="button"
                    onclick="togglePassword()"
                    class="absolute right-3 top-3 text-gray-500">
                👁
            </button>
        </div>

        <!-- Confirm Password -->
        <div class="relative">
            <input id="password_confirmation"
                type="password"
                name="password_confirmation"
                placeholder="Confirm Password"
                class="w-full border rounded-lg p-3 pr-10 focus:ring-2 focus:ring-pink-300">
        <button type="button"
            onclick="toggleConfirmPassword()"
            class="absolute right-3 top-3 text-gray-500">
        👁
        </button>
        </div>

        <!-- Sign Up Button -->
        <button id="signupBtn"
                type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg font-semibold flex justify-center items-center gap-2">

            <span id="btnText">Sign Up</span>

            <!-- Spinner -->
            <svg id="spinner"
                 class="hidden animate-spin h-5 w-5 text-white"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24">

                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>

                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>

        </button>
    </form>

    <p class="text-center text-sm mt-4">
        Already have an account?
        <a href="/login" class="text-pink-600 font-semibold">Login</a>
    </p>

</div>

<!-- Loader Script -->
<script>
function showLoader() {
    document.getElementById("spinner").classList.remove("hidden");
    document.getElementById("btnText").innerText = "Creating account...";
}
</script>

</body>
</html>
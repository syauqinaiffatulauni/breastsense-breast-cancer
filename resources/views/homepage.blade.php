<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Breast Cancer Classification System</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
html {
    scroll-behavior: smooth;
}
</style>
</head>

<body class="bg-pink-50 min-h-screen">

<!-- NAVBAR -->
<nav class="bg-white shadow-md border-b-4 border-pink-200 px-6 py-4 flex justify-between items-center">

    <a href="#" class="flex items-center gap-3">
        <img src="{{ asset('images/logo.png') }}" class="h-20 w-auto">
    </a>

    <div class="flex items-center space-x-6 text-sm font-medium">

        <a href="#" onclick="showSection('home')" class="text-gray-600 hover:text-pink-500">Home</a>
        <a href="#" onclick="showSection('about')" class="text-gray-600 hover:text-pink-500">About</a>
        <a href="#" onclick="showSection('how')" class="text-gray-600 hover:text-pink-500">How It Works</a>
        <a href="#" onclick="showSection('contact')" class="text-gray-600 hover:text-pink-500">Contact</a>

        <form method="POST" action="{{ route('login') }}" class="inline">
        <a href="/login"
   class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow">
    Login
</a>
</form>

    </div>
</nav>

<!-- ================= HOME ================= -->
<section id="home" class="page-section min-h-screen flex flex-col md:flex-row items-start justify-between px-10 pt-6 bg-gradient-to-b from-pink-50 to-white">

    <div class="max-w-xl">

        <div class="mb-4">
            <div class="inline-flex items-center gap-2 bg-pink-100 text-pink-600 px-4 py-1 rounded-full text-sm font-medium">
                <span>🛡️ AI-Powered</span>
                <span>•</span>
                <span>Accurate</span>
                <span>•</span>
                <span>Reliable</span>
            </div>
        </div>

        <h1 class="text-5xl font-bold leading-tight">
            Smarter Insights, <span class="text-pink-500">Stronger Care</span>
        </h1>

        <p class="mt-4 text-gray-600">
            BreastSense uses advanced AI to classify breast ultrasound images and assist healthcare professionals in early and accurate diagnosis
        </p>

        <div class="mt-6">
        <button type="button" onclick="openVideo()"
            class="flex items-center gap-2 bg-pink-500 text-white px-6 py-3 rounded-xl shadow hover:scale-105 transition w-fit">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M8 5v14l11-7z"/>
            </svg>

            <span>Demo</span>

        </button>
    </div>

        <div class="mt-3">
            <div class="inline-flex items-center gap-2 text-blue-700 px-4 py-1 rounded-full text-sm font-medium">
                <span>✔ Secure • Private • Built for Healthcare Professionals</span>
            </div>
        </div>

    </div>

    <div class="hidden md:flex flex-col items-center gap-6">

        <img src="{{ asset('images/BreastSense.png') }}" class="w-[450px] drop-shadow-xl animate-pulse">

        <div class="grid grid-cols-3 gap-4 w-[800px]">

            <div class="p-4 border rounded-xl bg-white shadow-sm">
                <h3 class="font-bold text-blue-500">AI-Powered Analysis</h3>
                <p class="text-gray-600 text-sm mt-1">Deep learning models for accurate classification</p>
            </div>

            <div class="p-4 border rounded-xl bg-white shadow-sm">
                <h3 class="font-bold text-blue-500">Clinical Decision Support</h3>
                <p class="text-gray-600 text-sm mt-1">Clinical decision support via classification and reporting</p>
            </div>

            <div class="p-4 border rounded-xl bg-white shadow-sm">
                <h3 class="font-bold text-blue-500">Automated Reports</h3>
                <p class="text-gray-600 text-sm mt-1">Generate detailed diagnostic reports instantly</p>
            </div>

        </div>

    </div>

</section>

<!-- ================= ABOUT ================= -->
<section id="about" class="page-section hidden py-24 px-10 bg-gradient-to-b from-white to-pink-50">

    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">

        <!-- LEFT: TEXT CONTENT -->
        <div>

            <div class="inline-flex items-center gap-2 bg-pink-100 text-pink-600 px-4 py-1 rounded-full text-sm font-medium mb-4">
                <span>📊 About the System</span>
            </div>

            <h2 class="text-4xl font-bold leading-tight text-gray-800">
                AI-Powered <span class="text-pink-500">Breast</span> Cancer Classification System
            </h2>

            <p class="mt-4 text-gray-600 leading-relaxed">
                BreastSense is a deep learning-based clinical support system designed to assist healthcare professionals in classifying breast ultrasound images.
                It leverages a trained <span class="font-semibold text-pink-500">ResNet18 model</span> to classify medical images and generate structured diagnostic insights.
            </p>

            <p class="mt-4 text-gray-600 leading-relaxed">
                The system aims to improve early detection accuracy, reduce diagnostic workload and support data-driven clinical decision-making.
            </p>

            <!-- KEY POINTS -->
            <div class="mt-6 space-y-3">

                <div class="flex items-start gap-2 text-gray-700">
                    <span class="text-pink-500">✔</span>
                    <span>AI-based image classification using deep learning</span>
                </div>

                <div class="flex items-start gap-2 text-gray-700">
                    <span class="text-pink-500">✔</span>
                    <span>BI-RADS-based structured report generation</span>
                </div>

                <div class="flex items-start gap-2 text-gray-700">
                    <span class="text-pink-500">✔</span>
                    <span>Designed for clinical decision support systems</span>
                </div>

            </div>

        </div>

        <!-- RIGHT: VISUAL CARD STACK -->
        <div class="grid gap-6">

            <!-- CARD 1 -->
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition">
                <h3 class="text-lg font-bold text-pink-500">Deep Learning Model</h3>
                <p class="text-gray-600 mt-2 text-sm">
                    Utilizes ResNet18 architecture trained on medical imaging data for classification tasks.
                </p>
            </div>

            <!-- CARD 2 -->
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition">
                <h3 class="text-lg font-bold text-pink-500">Clinical Integration</h3>
                <p class="text-gray-600 mt-2 text-sm">
                    Designed to support doctors with structured diagnostic outputs and BI-RADS classification.
                </p>
            </div>

            <!-- CARD 3 -->
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition">
                <h3 class="text-lg font-bold text-pink-500">High Accuracy Focus</h3>
                <p class="text-gray-600 mt-2 text-sm">
                    Optimized for improving early detection performance in breast cancer screening.
                </p>
            </div>

        </div>

    </div>

</section>

<!-- ================= HOW ================= -->
<section id="how" class="page-section hidden py-24 px-10 bg-gradient-to-b from-pink-50 to-white">

    <div class="text-center mb-16">
        <h2 class="text-4xl font-bold">How It <span class="text-pink-500">Works</span></h2>
        <div class="inline-flex items-center gap-2 bg-pink-100 text-pink-600 px-4 py-1 rounded-full text-sm font-medium mb-4">
            <span>⚙️ System Workflow</span>
        </div>
    </div>

    <div class="relative max-w-4xl mx-auto">

        <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-pink-200"></div>

        <!-- STEP 1 -->
        <div class="step opacity-0 translate-y-10 transition flex justify-between mb-16">
            <div class="w-5/12 text-right">
                <h3 class="text-pink-500 font-bold">Login</h3>
                <p class="text-gray-600">User needs to login/signup for an account</p>
            </div>
            <div class="w-10 h-10 bg-pink-500 text-white rounded-full flex items-center justify-center z-10">1</div>
            <div class="w-5/12"></div>
        </div>

        <!-- STEP 2 -->
        <div class="step opacity-0 translate-y-10 transition flex justify-between mb-16">
            <div class="w-5/12"></div>
            <div class="w-10 h-10 bg-pink-500 text-white rounded-full flex items-center justify-center z-10">2</div>
            <div class="w-5/12 text-left">
                <h3 class="text-pink-500 font-bold">Upload Image</h3>
                <p class="text-gray-600">User uploads images in "Upload" page.</p>
            </div>
        </div>

        <!-- STEP 3 -->
        <div class="step opacity-0 translate-y-10 transition flex justify-between mb-16">
            <div class="w-5/12 text-right">
                <h3 class="text-pink-500 font-bold">Run Classification</h3>
                <p class="text-gray-600">Classification result and recommendation displayed </p>
            </div>
            <div class="w-10 h-10 bg-pink-500 texxt-white rounded-full flex items-center justify-center z-10">3</div>
            <div class="w-5/12"></div>
        </div>

        <!-- STEP 4 -->
        <div class="step opacity-0 translate-y-10 transition flex justify-between">
            <div class="w-5/12"></div>
            <div class="w-10 h-10 bg-pink-500 text-white rounded-full flex items-center justify-center z-10">4</div>
            <div class="w-5/12 text-left">
                <h3 class="text-pink-500 font-bold">Report Generation</h3>
                <p class="text-gray-600">User can review result and download as PDF (medical format report)</p>
            </div>
        </div>

    </div>
</section>

<!-- ================= CONTACT ================= -->
<section id="contact" class="page-section hidden py-24 px-10 bg-gradient-to-b from-white to-pink-50">

    <div class="max-w-5xl mx-auto text-center">

        <!-- TITLE -->
        <div class="inline-flex items-center gap-2 bg-pink-100 text-pink-600 px-4 py-1 rounded-full text-sm font-medium mb-4">
            <span>📩 Contact</span>
        </div>

        <h2 class="text-4xl font-bold text-gray-800">
            Get in <span class="text-pink-500">Touch</span>
        </h2>

        <p class="mt-3 text-gray-600 max-w-2xl mx-auto">
            For technical support, research collaboration or system inquiries regarding BreastSense.
        </p>

    </div>

    <!-- CONTACT CARDS -->
    <div class="mt-12 grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-md transition">
            <div class="text-pink-500 text-2xl mb-2">📧</div>
            <h3 class="font-bold text-gray-800">Email Support</h3>
            <p class="text-gray-600 mt-2">breatsense.help@gmail.com</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-md transition">
            <div class="text-pink-500 text-2xl mb-2">🏥</div>
            <h3 class="font-bold text-gray-800">Medical Collaboration</h3>
            <p class="text-gray-600 mt-2">For hospitals & research partnerships</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-md transition">
            <div class="text-pink-500 text-2xl mb-2">⏱</div>
            <h3 class="font-bold text-gray-800">Response Time</h3>
            <p class="text-gray-600 mt-2">Within 24–48 hours</p>
        </div>

    </div>

</section>
<!-- ================= SCRIPT ================= -->
<script>

let observer;

function showSection(id) {

    document.querySelectorAll('.page-section').forEach(section => {
        section.classList.add('hidden');
    });

    const active = document.getElementById(id);
    active.classList.remove('hidden');

    resetSteps();

    observeSteps(active);
}

function resetSteps() {
    document.querySelectorAll('.step').forEach(step => {
        step.classList.add('opacity-0', 'translate-y-10');
        step.classList.remove('opacity-100', 'translate-y-0');
    });
}

function observeSteps(container) {

    if (observer) observer.disconnect();

    const steps = container.querySelectorAll(".step");

    observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove("opacity-0", "translate-y-10");
                entry.target.classList.add("opacity-100", "translate-y-0");
            }
        });
    }, { threshold: 0.3 });

    steps.forEach(step => observer.observe(step));
}

// default load
document.addEventListener("DOMContentLoaded", () => {
    observeSteps(document.getElementById("home"));
});

function openVideo() {
    document.getElementById("videoModal").classList.remove("hidden");
    document.getElementById("videoModal").classList.add("flex");

    document.getElementById("demoVideo").src =
        "https://www.youtube.com/embed/vzj35JVf2yE?autoplay=1";
}

function closeVideo() {
    document.getElementById("videoModal").classList.add("hidden");
    document.getElementById("videoModal").classList.remove("flex");

    document.getElementById("demoVideo").src = "";
}

</script>


<div id="videoModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">

    <div class="bg-white rounded-xl overflow-hidden w-[90%] md:w-[800px]">

        <div class="flex justify-between items-center px-4 py-2 border-b">
            <h2 class="font-bold">System Demo</h2>
            <button type="button" onclick="closeVideo()" class="text-gray-600">✖</button>
        </div>
        <iframe
            id="demoVideo"
            class="w-full h-[450px]"
            src="https://www.youtube.com/embed/vzj35JVf2yE"
            allow="autoplay; encrypted-media"
            allowfullscreen>
        </iframe>   

    </div>

</div>
</body>
</html>
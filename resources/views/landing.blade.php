<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogiVision - Optimize Your Warehouse with AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        indigo: {
                            600: '#4f46e5',
                            700: '#4338ca',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="antialiased bg-white text-slate-900 font-sans selection:bg-indigo-100 selection:text-indigo-700">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-nav border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer" onclick="window.scrollTo(0,0)">
                    <div class="bg-indigo-600 p-2 rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                    </div>
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-indigo-600">LogiVision AI</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">How it Works</a>
                    <a href="{{ route('app') }}" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-semibold rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                        Try Demo Now
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <a href="{{ route('app') }}" class="text-indigo-600 font-semibold text-sm mr-4">Try Demo</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-50/50 via-white to-white"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="mx-auto max-w-4xl text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-8 leading-tight">
                Optimize Your Warehouse Space with <span class="text-indigo-600">AI Intelligence</span>
            </h1>
            
            <p class="mx-auto max-w-2xl text-xl text-slate-600 mb-10 leading-relaxed">
                Stop guessing where to put inventory. LogiVision uses Gemini 3 to analyze safety, maximize capacity, and organize your storage in seconds.
            </p>
            
            <div class="flex justify-center gap-4 mb-16">
                <a href="{{ route('app') }}" class="group relative inline-flex h-14 items-center justify-center overflow-hidden rounded-full bg-indigo-600 px-8 font-semibold text-white transition-all duration-300 hover:bg-indigo-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 shadow-xl shadow-indigo-200">
                    <span class="mr-2">Start Optimizing</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>

            <!-- Hero Image -->
            <div class="relative mx-auto max-w-5xl rounded-2xl shadow-2xl border border-slate-200/60 bg-white p-2">
                <div class="absolute inset-0 bg-gradient-to-t from-white/20 to-transparent pointer-events-none rounded-2xl"></div>
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2400&q=80" alt="Warehouse Analytics Dashboard" class="w-full h-auto rounded-xl object-cover aspect-[2/1]">
                
                <!-- Floating Badge Example -->
                <div class="absolute -top-6 -right-6 md:top-10 md:-right-10 bg-white p-4 rounded-xl shadow-xl border border-slate-100 hidden md:block animate-bounce" style="animation-duration: 3s;">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase">Efficiency</p>
                            <p class="text-lg font-bold text-slate-900">+35% Space</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Core Capabilities</h2>
                <p class="mt-2 text-3xl font-extrabold text-slate-900 sm:text-4xl">Everything you need to organize</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300 border border-slate-100">
                    <div class="w-14 h-14 bg-indigo-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Smart Spatial Layout</h3>
                    <p class="text-slate-600 leading-relaxed">
                        AI suggests the perfect bounding box for every item based on size, fragility, and access frequency optimization.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300 border border-slate-100">
                    <div class="w-14 h-14 bg-red-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Safety First Audit</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Automatically detects hazards like liquids near electronics, blocked exits, or heavy items on top shelves.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300 border border-slate-100">
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Utilization Score</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Know exactly how much space you have left with real-time capacity estimation and density visualization.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900">How It Works</h2>
                <p class="mt-4 text-lg text-slate-600">Three simple steps to a better warehouse</p>
            </div>

            <div class="relative">
                <!-- Connecting Line (Desktop) -->
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-slate-100 -z-10"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                    <!-- Step 1 -->
                    <div class="relative bg-white p-4">
                        <div class="w-24 h-24 mx-auto bg-indigo-600 rounded-full flex items-center justify-center shadow-xl shadow-indigo-200 mb-6 text-white text-3xl font-bold">1</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Upload Data</h3>
                        <p class="text-slate-500">Take a photo of your storage space and input your inventory list text.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative bg-white p-4">
                        <div class="w-24 h-24 mx-auto bg-indigo-600 rounded-full flex items-center justify-center shadow-xl shadow-indigo-200 mb-6 text-white text-3xl font-bold">2</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">AI Analysis</h3>
                        <p class="text-slate-500">Gemini 3 Vision maps the 3D space, identifies hazards, and calculates fit.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative bg-white p-4">
                        <div class="w-24 h-24 mx-auto bg-indigo-600 rounded-full flex items-center justify-center shadow-xl shadow-indigo-200 mb-6 text-white text-3xl font-bold">3</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Visual Result</h3>
                        <p class="text-slate-500">Get a clear overlay guide and PDF report on exactly where to place items.</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-20 text-center">
                <a href="{{ route('app') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-full text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition-all border-indigo-200">
                    Start Your First Scan
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="bg-indigo-600 p-1.5 rounded">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                </div>
                <span class="text-xl font-bold">LogiVision AI</span>
            </div>
            <p class="text-slate-400 text-sm">
                &copy; {{ date('Y') }} LogiVision. Created for the Hackathon.
            </p>
        </div>
    </footer>

</body>
</html>
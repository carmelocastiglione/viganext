<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookBox - Monthly Book Subscription</title>
    <meta name="description" content="BookBox is a curated monthly book subscription that tailors books to your taste. Discover new authors, get surprises in every box, and join a vibrant reader community.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        rose: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be123c',
                        },
                        stone: {
                            50: '#fafaf9',
                            100: '#f5f5f4',
                            200: '#e7e5e4',
                            300: '#d6d3d1',
                        },
                        pink: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            500: '#ec4899',
                            600: '#db2777',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in': 'fadeIn 0.8s ease-in-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'ping-slow': 'ping 2.8s cubic-bezier(0, 0, 0.2, 1) infinite'
                    },
                    keyframes: {
                        float: {'0%, 100%': { transform: 'translateY(0px)' }, '50%': { transform: 'translateY(-20px)' }},
                        fadeIn: {'0%': { opacity: '0' }, '100%': { opacity: '1' }},
                        slideUp: {'0%': { transform: 'translateY(30px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' }},
                    }
                }
            }
        }
    </script>
    <style>
        .book-shadow { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(0, 0, 0, 0.05); }
        .gradient-text {
            background: linear-gradient(135deg, #f43f5e 0%, #ec4899 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .glass {
            backdrop-filter: blur(10px);
            background: linear-gradient(135deg, rgba(255,255,255,0.85), rgba(255,255,255,0.65));
        }
    </style>
</head>
<body class="bg-stone-50 font-sans">
    <!-- Navigation -->
    <nav x-data="{ open:false, scrolled:false }" @scroll.window="scrolled = window.scrollY > 10" :class="scrolled ? 'bg-white/90 shadow-sm' : 'bg-white/95'" class="sticky top-0 z-50 backdrop-blur-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="#" class="flex items-center">
                    <span class="text-rose-600 font-bold text-2xl flex items-center">
                        <i class="fas fa-book-open mr-2"></i>
                        BookBox
                    </span>
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#how-it-works" class="text-gray-600 hover:text-rose-600 transition-all duration-300 hover:scale-105">How It Works</a>
                    <a href="#gift" class="text-gray-600 hover:text-rose-600 transition-all duration-300 hover:scale-105">Gift</a>
                    <a href="#faq" class="text-gray-600 hover:text-rose-600 transition-all duration-300 hover:scale-105">FAQ</a>
                    <a href="#pricing" class="text-gray-600 hover:text-rose-600 transition-all duration-300 hover:scale-105">Pricing</a>
                    <button class="bg-rose-500 text-white px-6 py-2 rounded-full hover:bg-rose-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Sign In
                    </button>
                </div>
                <div class="md:hidden">
                    <button @click="open = !open" :aria-expanded="open" aria-controls="mobile-menu" class="text-gray-700 p-2 rounded-lg hover:bg-stone-100 focus:outline-none focus:ring-2 focus:ring-rose-500">
                        <span class="sr-only">Open menu</span>
                        <i :class="open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'" class="text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" x-cloak x-show="open" x-transition.origin.top class="md:hidden bg-white border-t border-stone-200">
            <div class="px-4 py-3 space-y-2">
                <a @click="open=false" href="#how-it-works" class="block px-3 py-2 rounded-lg hover:bg-stone-100 text-gray-700">How It Works</a>
                <a @click="open=false" href="#gift" class="block px-3 py-2 rounded-lg hover:bg-stone-100 text-gray-700">Gift</a>
                <a @click="open=false" href="#faq" class="block px-3 py-2 rounded-lg hover:bg-stone-100 text-gray-700">FAQ</a>
                <a @click="open=false" href="#pricing" class="block px-3 py-2 rounded-lg hover:bg-stone-100 text-gray-700">Pricing</a>
                <button class="w-full bg-rose-500 text-white px-4 py-2 rounded-lg hover:bg-rose-600 transition">Sign In</button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-rose-50 via-white to-pink-50 py-20 overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48Y2lyY2xlIGN4PSIzMCIgY3k9IjMwIiByPSIyIi8+PC9nPjwvZz48L3N2Zz4=')] opacity-20"></div>
        <div class="pointer-events-none absolute -left-20 -top-20 w-60 h-60 bg-rose-200/40 rounded-full blur-3xl"></div>
        <div class="pointer-events-none absolute -right-16 bottom-0 w-72 h-72 bg-pink-200/40 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-up" x-data="{ demoOpen:false }">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Discover Your Next <span class="gradient-text">Favorite Book</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Curated monthly book deliveries tailored to your reading preferences. Expand your library and your mind with hand-picked literary treasures.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#pricing" class="bg-rose-500 text-white px-8 py-4 rounded-full font-semibold hover:bg-rose-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center">
                            <i class="fas fa-gift mr-2"></i>
                            Start Your Journey
                        </a>
                        <button @click="demoOpen = true" class="border-2 border-rose-500 text-rose-600 px-8 py-4 rounded-full font-semibold hover:bg-rose-50 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-play-circle mr-2"></i>
                            Watch Demo
                        </button>
                    </div>
                    <!-- Demo Modal -->
                    <div x-cloak x-show="demoOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60">
                        <div @click.away="demoOpen=false" class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full overflow-hidden">
                            <div class="flex items-center justify-between px-6 py-4 border-b">
                                <h3 class="font-semibold text-gray-900">BookBox in 60 seconds</h3>
                                <button @click="demoOpen=false" class="text-gray-500 hover:text-gray-700">
                                    <i class="fa-solid fa-xmark text-xl"></i>
                                </button>
                            </div>
                            <div class="relative w-full aspect-video bg-stone-100">
                                <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0" title="BookBox Demo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="px-6 py-4 bg-stone-50 flex items-center justify-between">
                                <span class="text-sm text-gray-600">Curated reads. Delivered monthly.</span>
                                <a href="#pricing" class="text-rose-600 font-medium hover:underline">See plans</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative animate-float">
                    <div class="bg-white rounded-3xl book-shadow p-8 transform rotate-2 relative z-10">
                        <img src="https://images.unsplash.com/photo-1520257207991-683891eb00ca?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w4MDcxMzN8MHwxfHNlYXJjaHwxfHxib29rJTIwc3Vic2NyaXB0aW9uJTIwYm94JTIwZmxhdGxheXxlbnwwfDB8fHwxNzU4OTAwODQ5fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=TailFlux&photo_id=8zKp07X39Ko" 
                             alt="Curated book subscription box flatlay" 
                             class="w-full h-64 object-cover rounded-xl">
                    </div>
                    <div class="absolute -top-4 -right-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white px-6 py-3 rounded-full font-bold shadow-lg z-20">
                        <i class="fas fa-shipping-fast mr-2"></i>
                        Monthly Delivery
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-white text-rose-600 px-4 py-2 rounded-full font-semibold shadow-lg z-20">
                        <i class="fas fa-star mr-2 text-yellow-400"></i>
                        4.9/5 Rating
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white relative">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-stone-50/50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-4 animate-fade-in">Why BookBox Stands Out</h2>
            <p class="text-xl text-center text-gray-600 mb-16 max-w-3xl mx-auto animate-fade-in">
                Experience the joy of reading with our carefully crafted subscription service
            </p>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                    <div class="bg-gradient-to-br from-rose-100 to-pink-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-book-open text-3xl text-rose-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Curated Selection</h3>
                    <p class="text-gray-600 leading-relaxed">Our expert librarians hand-pick books based on your unique reading preferences and interests, ensuring every delivery is a perfect match.</p>
                </div>
                <div class="text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                    <div class="bg-gradient-to-br from-pink-100 to-rose-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-gift text-3xl text-pink-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Surprise Elements</h3>
                    <p class="text-gray-600 leading-relaxed">Each box includes delightful book-related surprises like artisanal bookmarks, author notes, and exclusive reading companions.</p>
                </div>
                <div class="text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                    <div class="bg-gradient-to-br from-stone-100 to-rose-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-3xl text-stone-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Community Access</h3>
                    <p class="text-gray-600 leading-relaxed">Join our exclusive reader community for vibrant discussions, live author Q&As, and exciting monthly reading challenges.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-20 bg-gradient-to-br from-rose-50 to-pink-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-lg text-gray-600">Three simple steps to your perfect monthly read</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold mb-4">1</div>
                    <h3 class="font-bold text-xl mb-2">Tell Us Your Taste</h3>
                    <p class="text-gray-600">Choose your genres, favorite themes, and reading pace in a quick onboarding quiz.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center font-bold mb-4">2</div>
                    <h3 class="font-bold text-xl mb-2">We Curate & Prepare</h3>
                    <p class="text-gray-600">Our experts match titles to your profile. Expect thoughtful extras in each box.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 rounded-full bg-stone-100 text-stone-700 flex items-center justify-center font-bold mb-4">3</div>
                    <h3 class="font-bold text-xl mb-2">Delivered, Then Discuss</h3>
                    <p class="text-gray-600">Unbox monthly, read, and join community chats and author events.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Reading Experience -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-up">
                    <img src="https://images.unsplash.com/photo-1558636815-1978d0419bff?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w4MDcxMzN8MHwxfHNlYXJjaHwxfHxjb3p5JTIwcmVhZGluZyUyMGNvcm5lciUyMHBlcnNvbiUyMHJlYWRpbmclMjBib29rJTIwd2FybSUyMGxpZ2h0fGVufDB8MHx8fDE3NTg5MDA4NTB8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=TailFlux&photo_id=c4LpYfizLvw" 
                         alt="Cozy reading corner with warm light" 
                         class="rounded-3xl shadow-2xl w-full h-96 object-cover">
                </div>
                <div class="animate-fade-in">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Transform Your Reading Experience</h2>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Imagine curling up with a book that feels like it was written just for you. Our personalized approach ensures every story resonates with your unique taste.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white rounded-full p-3 shadow-lg">
                                <i class="fas fa-heart text-rose-500 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Personalized Matching</h4>
                                <p class="text-gray-600">Advanced algorithm + human touch</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-white rounded-full p-3 shadow-lg">
                                <i class="fas fa-clock text-pink-500 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Flexible Schedule</h4>
                                <p class="text-gray-600">Pause or modify anytime</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-white rounded-full p-3 shadow-lg">
                                <i class="fas fa-award text-amber-500 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Quality Guarantee</h4>
                                <p class="text-gray-600">Premium editions only</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-white" x-data="{ selectedPlan: 'monthly' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-4">Choose Your Reading Adventure</h2>
            <p class="text-xl text-center text-gray-600 mb-12">Flexible plans to match your reading pace</p>
            
            <!-- Plan Toggle -->
            <div class="flex justify-center mb-12">
                <div class="bg-white rounded-full p-1 shadow-lg border border-stone-200">
                    <button 
                        @click="selectedPlan = 'monthly'" 
                        :class="selectedPlan === 'monthly' ? 'bg-gradient-to-r from-rose-500 to-pink-500 text-white shadow-lg' : 'text-gray-600 hover:text-rose-600'"
                        class="px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105"
                    >
                        Monthly Plan
                    </button>
                    <button 
                        @click="selectedPlan = 'yearly'" 
                        :class="selectedPlan === 'yearly' ? 'bg-gradient-to-r from-rose-500 to-pink-500 text-white shadow-lg' : 'text-gray-600 hover:text-rose-600'"
                        class="px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105"
                    >
                        Yearly Plan <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full ml-2">Save 20%</span>
                    </button>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Basic Plan -->
                <div class="bg-white rounded-3xl shadow-xl border border-stone-100 p-8 transform hover:scale-105 transition-all duration-300 group hover:shadow-2xl">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-seedling text-green-500 mr-3"></i>
                        Starter Reader
                    </h3>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-rose-600" x-text="selectedPlan === 'monthly' ? '$24.99' : '$239.90'"></span>
                        <span class="text-gray-600" x-text="selectedPlan === 'monthly' ? '/month' : '/yr billed upfront'"></span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-rose-500 mr-3 text-lg"></i>
                            1 curated book per month
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-rose-500 mr-3 text-lg"></i>
                            Digital reading guide
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-rose-500 mr-3 text-lg"></i>
                            Basic community access
                        </li>
                    </ul>
                    <button class="w-full bg-stone-100 text-gray-900 py-4 rounded-xl font-semibold hover:bg-stone-200 transition-all duration-300 group-hover:shadow-lg">
                        Get Started
                    </button>
                </div>

                <!-- Popular Plan -->
                <div class="bg-gradient-to-br from-rose-500 to-pink-500 rounded-3xl shadow-2xl p-8 transform hover:scale-105 transition-all duration-300 relative group">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-white text-rose-600 px-6 py-2 rounded-full text-sm font-bold shadow-lg">
                            <i class="fas fa-crown mr-2"></i>MOST POPULAR
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-star text-yellow-300 mr-3"></i>
                        Avid Reader
                    </h3>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-white" x-text="selectedPlan === 'monthly' ? '$39.99' : '$383.90'"></span>
                        <span class="text-rose-100" x-text="selectedPlan === 'monthly' ? '/month' : '/yr billed upfront'"></span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-white">
                            <i class="fas fa-check-circle text-white mr-3 text-lg"></i>
                            2 curated books per month
                        </li>
                        <li class="flex items-center text-white">
                            <i class="fas fa-check-circle text-white mr-3 text-lg"></i>
                            Premium reading guide
                        </li>
                        <li class="flex items-center text-white">
                            <i class="fas fa-check-circle text-white mr-3 text-lg"></i>
                            Full community access
                        </li>
                        <li class="flex items-center text-white">
                            <i class="fas fa-check-circle text-white mr-3 text-lg"></i>
                            Exclusive author content
                        </li>
                    </ul>
                    <button class="w-full bg-white text-rose-600 py-4 rounded-xl font-semibold hover:bg-rose-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Get Started
                    </button>
                </div>

                <!-- Premium Plan -->
                <div class="bg-white rounded-3xl shadow-xl border border-stone-100 p-8 transform hover:scale-105 transition-all duration-300 group hover:shadow-2xl">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-gem text-purple-500 mr-3"></i>
                        Book Collector
                    </h3>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-rose-600" x-text="selectedPlan === 'monthly' ? '$59.99' : '$575.90'"></span>
                        <span class="text-gray-600" x-text="selectedPlan === 'monthly' ? '/month' : '/yr billed upfront'"></span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-rose-500 mr-3 text-lg"></i>
                            3 curated books per month
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-rose-500 mr-3 text-lg"></i>
                            Deluxe reading experience
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-rose-500 mr-3 text-lg"></i>
                            VIP community access
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check-circle text-rose-500 mr-3 text-lg"></i>
                            Signed editions available
                        </li>
                    </ul>
                    <button class="w-full bg-stone-100 text-gray-900 py-4 rounded-xl font-semibold hover:bg-stone-200 transition-all duration-300 group-hover:shadow-lg">
                        Get Started
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-gradient-to-br from-stone-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-4">What Our Readers Say</h2>
            <p class="text-xl text-center text-gray-600 mb-16">Join thousands of satisfied book lovers</p>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1752499229086-e619ad69aa92?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w4MDcxMzN8MHwxfHNlYXJjaHwxfHxwb3J0cmFpdCUyMHdvbWFuJTIwcmVhZGVyJTIwc21pbGluZ3xlbnwwfDB8fHwxNzU4OTAwODUxfDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=TailFlux&photo_id=CjBEZl7AaEc" alt="Portrait of a happy woman reader" class="w-16 h-16 rounded-full object-cover mr-4 ring-4 ring-rose-100 shadow">
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Jamie Smith</h4>
                            <p class="text-rose-600 flex items-center space-x-1">
                                <span class="flex">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                </span>
                                <span class="ml-2">Subscriber for 8 months</span>
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed italic relative pl-6">
                        <i class="fas fa-quote-left text-rose-200 text-2xl absolute left-0 top-0"></i>
                        "BookBox has completely transformed my reading habits. The curated selections are always spot-on, and I've discovered authors I never would have found on my own. The surprise elements make each delivery feel like Christmas morning!"
                    </p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1561999289-78da190f6c14?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w4MDcxMzN8MHwxfHNlYXJjaHwxfHxwb3J0cmFpdCUyMG1hbiUyMHJlYWRlciUyMHNtaWxpbmd8ZW58MHwwfHx8MTc1ODkwMDg1Mnww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=TailFlux&photo_id=AtIP8Pcu6JU" alt="Portrait of a smiling man reader" class="w-16 h-16 rounded-full object-cover mr-4 ring-4 ring-pink-100 shadow">
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Alex Johnson</h4>
                            <p class="text-rose-600 flex items-center space-x-1">
                                <span class="flex">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                </span>
                                <span class="ml-2">Subscriber for 14 months</span>
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed italic relative pl-6">
                        <i class="fas fa-quote-left text-pink-200 text-2xl absolute left-0 top-0"></i>
                        "The community aspect is incredible! I've made friends with fellow book lovers and the author Q&As are a dream come true for any literature enthusiast. BookBox isn't just a subscription - it's a reading lifestyle."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Library Showcase -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Curated Collection</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">From timeless classics to contemporary masterpieces, our library spans every genre to satisfy every reader's taste</p>
            </div>
            <div class="relative">
                <img loading="lazy" src="https://images.unsplash.com/photo-1613483556724-13beb93b5d91?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w4MDcxMzN8MHwxfHNlYXJjaHwxfHxiZWF1dGlmdWwlMjBsaWJyYXJ5JTIwYm9va3NoZWx2ZXMlMjBhZXN0aGV0aWN8ZW58MHwwfHx8MTc1ODkwMDg1MHww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=TailFlux&photo_id=MKGu9ihH46k" 
                     alt="Aesthetic library bookshelves" 
                     class="rounded-3xl shadow-2xl w-full h-96 object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent rounded-3xl flex items-center">
                    <div class="text-white p-12 max-w-md">
                        <h3 class="text-3xl font-bold mb-4">Thousands of Titles</h3>
                        <p class="text-lg opacity-90">Carefully selected from publishers worldwide to bring you the best reading experience</p>
                        <a href="#pricing" class="inline-flex items-center mt-6 bg-white/90 text-rose-600 px-5 py-2 rounded-full hover:bg-white transition">
                            Browse Plans <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gift Section -->
    <section id="gift" class="py-20 bg-gradient-to-br from-pink-50 to-rose-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="glass rounded-3xl p-8 shadow-xl">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Gift a BookBox</h2>
                    <p class="text-gray-600 text-lg mb-6">Treat someone special to months of curated reading joy. Perfect for birthdays, holidays, or just because.</p>
                    <ul class="space-y-3 mb-8 text-gray-700">
                        <li class="flex items-center"><i class="fa-solid fa-check text-rose-500 mr-3"></i>Choose 1, 3, 6, or 12 months</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-rose-500 mr-3"></i>Personal message included</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-rose-500 mr-3"></i>Instant email delivery</li>
                    </ul>
                    <a href="#pricing" class="inline-flex items-center bg-rose-500 text-white px-6 py-3 rounded-full hover:bg-rose-600 transition shadow-lg">
                        Send a Gift <i class="fa-solid fa-gift ml-2"></i>
                    </a>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-rose-200/50 to-pink-200/50 rounded-3xl blur-2xl"></div>
                    <img loading="lazy" src="https://images.unsplash.com/photo-1520257207991-683891eb00ca?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w4MDcxMzN8MHwxfHNlYXJjaHwxfHxib29rJTIwc3Vic2NyaXB0aW9uJTIwYm94JTIwZmxhdGxheXxlbnwwfDB8fHwxNzU4OTAwODQ5fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=TailFlux&photo_id=8zKp07X39Ko" alt="Gift-ready BookBox flatlay" class="relative rounded-3xl shadow-2xl w-full h-80 object-cover">
                    <div class="absolute top-4 left-4 bg-white/90 text-rose-600 px-4 py-2 rounded-full shadow">
                        <i class="fa-solid fa-tag mr-2"></i> Gift Cards Available
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-rose-500 via-pink-500 to-rose-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48Y2lyY2xlIGN4PSIzMCIgY3k9IjMwIiByPSIyIi8+PC9nPjwvZz48L3N2Zz4=')] opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10" x-data="{ r1:0, r2:0, r3:0 }" x-init="
            let i1=0,i2=0,i3=0;
            const t1=setInterval(()=>{ if(i1<10000){ i1+=157; r1=i1 } else clearInterval(t1)},25);
            const t2=setInterval(()=>{ if(i2<49){ i2+=1; r2=i2 } else clearInterval(t2)},50);
            const t3=setInterval(()=>{ if(i3<50){ i3+=1; r3=i3 } else clearInterval(t3)},50);
        ">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Ready to Start Your Reading Journey?</h2>
            <p class="text-xl text-rose-100 mb-8 max-w-3xl mx-auto leading-relaxed">
                Join thousands of readers who have discovered their next favorite book through our curated monthly subscription service. Your literary adventure awaits!
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="#pricing" class="bg-white text-rose-600 px-8 py-4 rounded-full font-semibold hover:bg-rose-50 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl flex items-center justify-center">
                    <i class="fas fa-rocket mr-3"></i>
                    Start Your Subscription Today
                </a>
                <a href="#faq" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white/10 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-question-circle mr-3"></i>
                    Have Questions?
                </a>
            </div>
            <div class="mt-8 flex justify-center space-x-6 text-rose-100">
                <div class="text-center">
                    <div class="text-2xl font-bold"><span x-text="r1"></span>+</div>
                    <div class="text-sm">Happy Readers</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold">4.9★</div>
                    <div class="text-sm">Average Rating</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold"><span x-text="r3"></span>+</div>
                    <div class="text-sm">Countries</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-4">Frequently Asked Questions</h2>
            <p class="text-lg text-center text-gray-600 mb-12">Everything you need to know about BookBox</p>
            <div class="space-y-4">
                <div x-data="{ open:true }" class="bg-stone-50 rounded-2xl p-6 shadow-sm">
                    <button @click="open=!open" class="w-full flex items-center justify-between text-left">
                        <span class="font-semibold text-gray-900">How do you choose the books for me?</span>
                        <i :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'" class="text-gray-500"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-3 text-gray-600">
                        We combine your onboarding preferences with expert curation. Every pick is reviewed by our team to ensure quality and variety.
                    </div>
                </div>
                <div x-data="{ open:false }" class="bg-stone-50 rounded-2xl p-6 shadow-sm">
                    <button @click="open=!open" class="w-full flex items-center justify-between text-left">
                        <span class="font-semibold text-gray-900">Can I pause or cancel anytime?</span>
                        <i :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'" class="text-gray-500"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-3 text-gray-600">
                        Yes. Manage your subscription from your account dashboard. Pause, skip a month, or cancel without fees.
                    </div>
                </div>
                <div x-data="{ open:false }" class="bg-stone-50 rounded-2xl p-6 shadow-sm">
                    <button @click="open=!open" class="w-full flex items-center justify-between text-left">
                        <span class="font-semibold text-gray-900">Do you ship internationally?</span>
                        <i :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'" class="text-gray-500"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-3 text-gray-600">
                        We ship to over 50 countries worldwide. Shipping times and fees vary by region.
                    </div>
                </div>
                <div x-data="{ open:false }" class="bg-stone-50 rounded-2xl p-6 shadow-sm">
                    <button @click="open=!open" class="w-full flex items-center justify-between text-left">
                        <span class="font-semibold text-gray-900">What if I don’t like a book?</span>
                        <i :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'" class="text-gray-500"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-3 text-gray-600">
                        No worries—use our “swap” option before shipping or gift it to a friend with a bonus credit from us.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter CTA and Footer -->
    <footer class="bg-gray-900 text-white pt-16">
        <!-- Newsletter -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-10" x-data="{ email:'', sent:false }">
            <div class="bg-gradient-to-br from-rose-600 to-pink-600 rounded-3xl p-8 md:p-10 shadow-2xl flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-6 md:mb-0">
                    <h3 class="text-2xl md:text-3xl font-bold">Join our newsletter</h3>
                    <p class="text-rose-100">Get reading tips, new arrivals, and exclusive offers in your inbox.</p>
                </div>
                <form @submit.prevent="sent=true" class="w-full md:w-auto flex">
                    <label for="newsletter-email" class="sr-only">Email</label>
                    <input id="newsletter-email" type="email" x-model="email" required placeholder="Your email" class="bg-white/15 placeholder-white/70 text-white px-4 py-3 rounded-l-xl w-full md:w-80 focus:outline-none focus:ring-2 focus:ring-white/70">
                    <button type="submit" class="bg-white text-rose-600 px-5 py-3 rounded-r-xl hover:bg-rose-50 transition-all duration-300 font-semibold">
                        <span x-show="!sent"><i class="fas fa-paper-plane mr-1"></i>Subscribe</span>
                        <span x-cloak x-show="sent" class="flex items-center"><i class="fa-solid fa-check mr-2"></i>Thanks!</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-rose-400 mb-4 flex items-center">
                        <i class="fas fa-book-open mr-2"></i>
                        BookBox
                    </h3>
                    <p class="text-gray-400 mb-4 leading-relaxed">Curated book subscriptions for every type of reader. Discover, read, and connect with fellow book lovers.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-rose-400 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-rose-400 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-rose-400 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-rose-400 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-goodreads text-xl"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-4 text-lg">Quick Links</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#how-it-works" class="hover:text-white transition-all duration-300 hover:pl-2 block">How It Works</a></li>
                        <li><a href="#pricing" class="hover:text-white transition-all duration-300 hover:pl-2 block">Pricing</a></li>
                        <li><a href="#gift" class="hover:text-white transition-all duration-300 hover:pl-2 block">Gift</a></li>
                        <li><a href="#faq" class="hover:text-white transition-all duration-300 hover:pl-2 block">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 text-lg">Support</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-all duration-300 hover:pl-2 block">Shipping</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300 hover:pl-2 block">Returns</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300 hover:pl-2 block">Contact Support</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300 hover:pl-2 block">Accessibility</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 text-lg">Company</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-all duration-300 hover:pl-2 block">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300 hover:pl-2 block">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300 hover:pl-2 block">Press</a></li>
                        <li><a href="#" class="hover:text-white transition-all duration-300 hover:pl-2 block">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 BookBox. All rights reserved. | <a href="#" class="hover:text-white transition">Privacy Policy</a> | <a href="#" class="hover:text-white transition">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <!-- Floating Action Button -->
    <div class="fixed bottom-6 right-6 z-50 group">
        <div class="absolute -top-3 -right-3 w-6 h-6 bg-rose-400/40 rounded-full animate-ping-slow"></div>
        <button aria-label="Chat with us" class="relative bg-rose-500 text-white w-14 h-14 rounded-full shadow-2xl hover:bg-rose-600 transition-all duration-300 transform hover:scale-110 flex items-center justify-center">
            <i class="fas fa-comments text-xl"></i>
            <span class="absolute -top-9 right-1 bg-gray-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Chat with us</span>
        </button>
    </div>
</body>
</html>
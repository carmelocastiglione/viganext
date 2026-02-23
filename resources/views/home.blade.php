<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>VigaNext</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Tailwind CSS Configuration -->
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
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans">
        <!-- Navigation -->
        <nav x-data="{ open:false, scrolled:false }" @scroll.window="scrolled = window.scrollY > 10" :class="scrolled ? 'bg-white/90 shadow-sm' : 'bg-white/95'" class="sticky top-0 z-50 backdrop-blur-sm transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <a href="#" class="flex items-center">
                        <span class="text-rose-600 font-bold text-2xl flex items-center">
                            <i class="fa-solid fa-angles-right mr-2"></i>
                            VigaNext
                        </span>
                    </a>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#" class="text-gray-600 hover:text-rose-600 transition-all duration-300 hover:scale-105">Mercatino</a>
                        <a href="#" class="text-gray-600 hover:text-rose-600 transition-all duration-300 hover:scale-105">CicLab</a>
                        <a href="#" class="text-gray-600 hover:text-rose-600 transition-all duration-300 hover:scale-105">VigaSpecialWeek</a>
                        <button class="bg-rose-500 text-white px-6 py-2 rounded-full hover:bg-rose-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Accedi
                        </button>
                    </div>
                    <div class="md:hidden">
                        <button @click="open = !open" :aria-expanded="open" aria-controls="mobile-menu" class="text-gray-700 p-2 rounded-lg hover:bg-stone-100 focus:outline-none focus:ring-2 focus:ring-rose-500">
                            <span class="sr-only">Apri il menù</span>
                            <i :class="open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'" class="text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu" x-cloak x-show="open" x-transition.origin.top class="md:hidden bg-white border-t border-stone-200">
                <div class="px-4 py-3 space-y-2">
                    <a @click="open=false" href="#" class="block px-3 py-2 rounded-lg hover:bg-stone-100 text-gray-700">Mercatino</a>
                    <a @click="open=false" href="#" class="block px-3 py-2 rounded-lg hover:bg-stone-100 text-gray-700">CicLab</a>
                    <a @click="open=false" href="#" class="block px-3 py-2 rounded-lg hover:bg-stone-100 text-gray-700">VigaSpecialWeek</a>
                    <button class="w-full bg-rose-500 text-white px-4 py-2 rounded-lg hover:bg-rose-600 transition">Accedi</button>
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
                            Porta la tua esperienza al Viganò al livello successivo con <span class="gradient-text">VigaNext</span>
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Un unico punto di accesso ai servizi dedicati agli studenti: mercatino libri usati, attività di potenziamento disciplinare, di recupero e progetti pomeridiani che valorizzano competenze, passioni e spirito di iniziativa.
                        </p>
                        <div class="flex justify-center sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="#pricing" class="bg-rose-500 text-white px-8 py-4 rounded-full font-semibold hover:bg-rose-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center">
                                <i class="fa-solid fa-right-to-bracket mr-2"></i>
                                Accedi a VigaNext
                            </a>
                        </div>
                    </div>
                    <div class="relative animate-float">
                        <div class="bg-white rounded-3xl book-shadow p-8 transform rotate-2 relative z-10">
                            <img src="{{ asset('img/hero.jpeg') }}" 
                                alt="Studenti durante la VigaSpecialWeek" 
                                class="w-full h-64 object-cover rounded-xl">
                        </div>
                        <div class="absolute -bottom-4 -left-4 bg-rose-600 text-white px-4 py-2 rounded-full font-semibold shadow-lg z-20">               
                            <i class="fa-solid fa-graduation-cap mr-2"></i>
                            studenti durante la VigaSpecialWeek
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Progetti -->
        <section class="py-20 bg-white" id="services">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Mercatino libri usati -->
                <div class="relative mb-12">
                    <img loading="lazy" src="{{ asset('img/mercatino.jpg') }}" 
                        alt="Mercatino libri usati" 
                        class="rounded-3xl shadow-2xl w-full h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent rounded-3xl flex items-center">
                        <div class="text-white p-8 sm:p-12 max-w-md bg-black/30 rounded-2xl backdrop-blur-sm">
                            <h3 class="text-3xl sm:text-4xl font-bold mb-4 drop-shadow-lg">Mercatino libri usati</h3>
                            <p class="text-base sm:text-lg leading-relaxed drop-shadow-md">Vendi, prenota e acquista libri usati a prezzi convenienti.</p>
                            <a href="#pricing" class="inline-flex items-center mt-6 bg-white/95 text-rose-600 px-6 py-2 sm:py-3 rounded-full font-semibold hover:bg-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                Entra <i class="fa-solid fa-angle-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Ciclab -->
                <div class="relative mb-12">
                    <img loading="lazy" src="{{ asset('img/ciclab.jpg') }}" 
                        alt="Ciclab" 
                        class="rounded-3xl shadow-2xl w-full h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent rounded-3xl flex items-center">
                        <div class="text-white p-8 sm:p-12 max-w-md bg-black/30 rounded-2xl backdrop-blur-sm">
                            <h3 class="text-3xl sm:text-4xl font-bold mb-4 drop-shadow-lg">Ciclab</h3>
                            <p class="text-base sm:text-lg leading-relaxed drop-shadow-md">Attività integrative pomeridiane per consolidare le competenze degli studenti e stimolare la creatività e l'espressività.</p>
                            <a href="#pricing" class="inline-flex items-center mt-6 bg-white/95 text-rose-600 px-6 py-2 sm:py-3 rounded-full font-semibold hover:bg-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                Entra <i class="fa-solid fa-angle-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- VigaSpecialWeek -->
                <div class="relative mb-12">
                    <img loading="lazy" src="{{ asset('img/vigaspecialweek.jpeg') }}" 
                        alt="VigaSpecialWeek" 
                        class="rounded-3xl shadow-2xl w-full h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent rounded-3xl flex items-center">
                        <div class="text-white p-8 sm:p-12 max-w-md bg-black/30 rounded-2xl backdrop-blur-sm">
                            <h3 class="text-3xl sm:text-4xl font-bold mb-4 drop-shadow-lg">VigaSpecialWeek</h3>
                            <p class="text-base sm:text-lg leading-relaxed drop-shadow-md">Settimana speciale con eventi e attività uniche per gli studenti.</p>
                            <a href="#pricing" class="inline-flex items-center mt-6 bg-white/95 text-rose-600 px-6 py-2 sm:py-3 rounded-full font-semibold hover:bg-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                Entra <i class="fa-solid fa-angle-right ml-2"></i>
                            </a>
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
                const t1=setInterval(()=>{ if(i1<150){ i1+=10; r1=i1 } else clearInterval(t1)},50);
                const t2=setInterval(()=>{ if(i2<400){ i2+=30; r2=i2 } else clearInterval(t2)},50);
                const t3=setInterval(()=>{ if(i3<10){ i3+=1; r3=i3 } else clearInterval(t3)},50);
            ">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Sei pronto ad iniziare?</h2>
                <p class="text-xl text-rose-100 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Unisciti a migliaia di studenti che hanno già trasformato la loro esperienza al Viganò con VigaNext. Non perdere l'opportunità di accedere a servizi esclusivi e vivere al massimo la tua vita scolastica!
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <a href="#pricing" class="bg-white text-rose-600 px-8 py-4 rounded-full font-semibold hover:bg-rose-50 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl flex items-center justify-center">
                        <i class="fa-solid fa-right-to-bracket mr-2"></i>
                        Accedi a VigaNext
                    </a>
                    <a href="#faq" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white/10 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-question-circle mr-3"></i>
                        Hai domande?
                    </a>
                </div>
                <div class="mt-8 flex justify-center space-x-6 text-rose-100">
                    <div class="text-center">
                        <div class="text-2xl font-bold"><span x-text="r1"></span></div>
                        <div class="text-sm">Attività di potenziamento</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold"><span x-text="r2"></span></div>
                        <div class="text-sm">Libri disponibili</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold"><span x-text="r3"></span></div>
                        <div class="text-sm">Corsi pomeridiani</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-20 bg-gradient-to-br from-rose-50 to-pink-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-bold text-center text-gray-900 mb-4">Dicono di noi</h2>
                <p class="text-xl text-center text-gray-600 mb-16">Le nostre proposte sulla stampa locale</p>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="flex items-center mb-6">
                            <img loading="lazy" src="{{ asset('img/merate-online.png') }}" alt="Merate Online" class="w-16 h-16 rounded-full object-cover mr-4 ring-4 ring-rose-100 shadow">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">Merate Online</h4>
                                <p class="text-rose-600 flex items-center space-x-1">
                                    <a href="https://www.merateonline.it/notizie/140927/merate-i-pomeriggi-creativi-all-istituto-vigan-o">Leggi l'articolo</a>
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed italic relative pl-6">
                            <i class="fas fa-quote-left text-rose-200 text-2xl absolute left-0 top-0"></i>
                            Insomma, ce n'è per tutti i gusti per trascorrere piacevolmente i pomeriggi in maniera costruttiva e divertendosi con coetanei e altri studenti del Viganò.
                            <i class="fas fa-quote-right text-rose-200 text-2xl absolute right-0 bottom-0"></i>
                        </p>
                    </div>
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="flex items-center mb-6">
                            <img loading="lazy" src="{{ asset('img/lecco-notizie.jpg') }}" alt="Lecco Notizie" class="w-16 h-16 rounded-full object-cover mr-4 ring-4 ring-rose-100 shadow">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">Lecco Notizie</h4>
                                <p class="text-rose-600 flex items-center space-x-1">
                                    <a href="https://lecconotizie.com/societa/viga-special-week-buona-la-prima-innovazione-e-sperimentazione-al-vigano-di-merate/">Leggi l'articolo</a>
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed italic relative pl-6">
                            <i class="fas fa-quote-left text-pink-200 text-2xl absolute left-0 top-0"></i>
                            L'istituto Viganò ha lanciato la Viga Special Week cambiando impostazione alla settimana di recupero e approfondimento. Dalla creatività allo sport, passando per filosofia, attualità e laboratori per poter dare spazio ai talenti degli studenti.
                            <i class="fas fa-quote-right text-rose-200 text-2xl absolute right-0 bottom-0"></i>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section id="faq" class="py-20 bg-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-bold text-center text-gray-900 mb-4">Domande Frequenti</h2>
                <p class="text-lg text-center text-gray-600 mb-12">Tutto quello che devi sapere su VigaNext</p>
                <div class="space-y-4">
                    <div x-data="{ open:false }" class="bg-stone-50 rounded-2xl p-6 shadow-sm">
                        <button @click="open=!open" class="w-full flex items-center justify-between text-left">
                            <span class="font-semibold text-gray-900">Quando è possibile vendere e comprare i libri usati?</span>
                            <i :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'" class="text-gray-500"></i>
                        </button>
                        <div x-show="open" x-transition class="mt-3 text-gray-600">
                            È possibile vendere e comprare i libri usati in due sessioni, a Giugno e a Settembre, seguendo le indicazioni fornite dall'istituto.
                        </div>
                    </div>
                    <div x-data="{ open:false }" class="bg-stone-50 rounded-2xl p-6 shadow-sm">
                        <button @click="open=!open" class="w-full flex items-center justify-between text-left">
                            <span class="font-semibold text-gray-900">Quando è possibile iscriversi ai corsi del Ciclab?</span>
                            <i :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'" class="text-gray-500"></i>
                        </button>
                        <div x-show="open" x-transition class="mt-3 text-gray-600">
                            È possibile iscriversi ai corsi del Ciclab all'inizio di ogni anno scolastico, seguendo le indicazioni fornite dall'istituto.
                        </div>
                    </div>
                    <div x-data="{ open:false }" class="bg-stone-50 rounded-2xl p-6 shadow-sm">
                        <button @click="open=!open" class="w-full flex items-center justify-between text-left">
                            <span class="font-semibold text-gray-900">Quando inizia la VigaSpecialWeek?</span>
                            <i :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'" class="text-gray-500"></i>
                        </button>
                        <div x-show="open" x-transition class="mt-3 text-gray-600">
                            La VigaSpecialWeek si svolge a Gennaio, con eventi e attività speciali per gli studenti. Le date esatte vengono comunicate dall'istituto con anticipo.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white mx-auto px-2 sm:px-3 lg:px-4 py-8 text-center">
            Made with <i class="fa-solid fa-heart text-rose-500 mx-1"></i> by VigaNext Team &copy; {{ date('Y') }}. All rights reserved.
        </footer>
    </body>
</html>

<nav id="main-navbar" 
     class="{{ request()->routeIs('home') ? 'absolute top-0 left-0 right-0 bg-transparent text-white border-b border-white/10' : 'sticky top-0 bg-white/90 dark:bg-gray-900/60 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 text-gray-850 dark:text-gray-200' }} 
            z-50 transition-colors duration-300 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Left Side: Logo (Tire Icon + FAIR WIND + Divider + Car Repair) -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center hover:opacity-90 transition">
                    <!-- Tire/Wheel SVG Icon -->
                    <svg class="w-8 h-8 mr-2 text-white fill-current" viewBox="0 0 512 512">
                        <path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.3-208-208S141.3 48 256 48s208 93.3 208 208S370.7 464 256 464zM256 128c-70.6 0-128 57.4-128 128s57.4 128 128 128s128-57.4 128-128S326.6 128 256 128zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80s80 35.9 80 80S300.1 336 256 336zM256 224c-17.7 0-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32S273.7 224 256 224z"/>
                    </svg>
                    <span class="font-black text-xl tracking-wider text-white">FAIR WIND</span>
                </a>
                
                <!-- Vertical Divider -->
                <div class="h-6 border-l border-white/20 mx-4 hidden sm:block"></div>
                
                <!-- Subtitle -->
                <span class="text-xs text-white/70 hidden sm:inline font-medium uppercase tracking-widest">Car Repair</span>
            </div>

            <!-- Middle Navigation Links (Desktop) -->
            <div class="hidden lg:flex items-center gap-6">
                @if(request()->routeIs('home'))
                    <a href="#hero-section" class="text-xs uppercase font-bold tracking-widest text-white border-b-2 border-white pb-1 transition duration-200">
                        Home
                    </a>
                    <a href="#services-section" class="text-xs uppercase font-bold tracking-widest text-white/80 hover:text-white hover:border-b-2 hover:border-white/50 pb-1 transition duration-200">
                        Services
                    </a>
                    <a href="#about-section" class="text-xs uppercase font-bold tracking-widest text-white/80 hover:text-white hover:border-b-2 hover:border-white/50 pb-1 transition duration-200">
                        About Us
                    </a>
                    <a href="#testimonials-section" class="text-xs uppercase font-bold tracking-widest text-white/80 hover:text-white hover:border-b-2 hover:border-white/50 pb-1 transition duration-200">
                        Testimonials
                    </a>
                    <a href="#contact-section" class="text-xs uppercase font-bold tracking-widest text-white/80 hover:text-white hover:border-b-2 hover:border-white/50 pb-1 transition duration-200">
                        Contact Us
                    </a>
                    <a href="#blog-section" class="text-xs uppercase font-bold tracking-widest text-white/80 hover:text-white hover:border-b-2 hover:border-white/50 pb-1 transition duration-200">
                        Blog
                    </a>
                @else
                    <a href="{{ url('/') }}" class="text-xs uppercase font-bold tracking-widest {{ request()->routeIs('home') ? 'text-white' : 'text-gray-700 dark:text-gray-300' }} hover:text-orange-450 transition duration-200">
                        Home
                    </a>
                    <a href="{{ route('sale.index') }}" class="text-xs uppercase font-bold tracking-widest {{ request()->routeIs('sale.index') ? 'text-white' : 'text-gray-700 dark:text-gray-300' }} hover:text-orange-450 transition duration-200">
                        🚗 المعرض للبيع
                    </a>
                @endif

                <!-- Search Icon -->
                <button class="text-white/80 hover:text-orange-400 transition ml-2">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 512 512">
                        <path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/>
                    </svg>
                </button>
            </div>

            <!-- Right Side: Social Media Icons & Auth States -->
            <div class="flex items-center gap-6">
                
                <!-- Social Icons (Desktop only) -->
                <div class="hidden md:flex items-center gap-4 text-white/80">
                    <!-- Facebook -->
                    <a href="#" class="hover:text-orange-400 transition">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 320 512">
                            <path d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z"/>
                        </svg>
                    </a>
                    <!-- Twitter -->
                    <a href="#" class="hover:text-orange-400 transition">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 512 512">
                            <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.43 13.319-28.264-18.843-46.781-51.005-46.781-87.39 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/>
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" class="hover:text-orange-400 transition">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 448 512">
                            <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.9c-41.4 0-75-33.6-75-75s33.6-75 75-75 75 33.6 75 75-33.6 75-75 75zm143.5-200.5c-11.9 0-21.5-9.6-21.5-21.5s9.6-21.5 21.5-21.5 21.5 9.6 21.5 21.5-9.6 21.5-21.5 21.5zm80.4 39.2c-1.7-36.4-9.9-68.8-36.6-95.5s-59.2-34.9-95.6-36.6C279.2 6.1 176.7 6.1 141 7.7c-36.4 1.7-68.8 9.9-95.5 36.6S10.7 103.5 9 139.9C7.3 175.7 7.3 278.2 9 313.9c1.7 36.4 9.9 68.8 36.6 95.5s59.2 34.9 95.6 36.6c35.7 1.6 138.2 1.6 173.9 0 36.4-1.7 68.8-9.9 95.5-36.6s34.9-59.2 36.6-95.6c1.6-35.7 1.6-138.2 0-173.9zm-46.4 225.9c-7.8 24.5-26.8 43.5-51.3 51.3-28.5 11.3-96 8.7-126.3 8.7s-97.8 2.6-126.3-8.7c-24.5-7.8-43.5-26.8-51.3-51.3-11.3-28.5-8.7-96-8.7-126.3s-2.6-97.8 8.7-126.3c7.8-24.5 26.8-43.5 51.3-51.3 28.5-11.3 96-8.7 126.3-8.7s97.8-2.6 126.3 8.7c24.5 7.8 43.5 26.8 51.3 51.3 11.3 28.5 8.7 96 8.7 126.3s2.6 97.8-8.7 126.3z"/>
                        </svg>
                    </a>
                </div>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" 
                           class="px-4 py-2 bg-blue-600/20 hover:bg-blue-600/30 text-blue-400 border border-blue-500/20 rounded-xl text-xs font-bold transition duration-300">
                            📊 لوحة التحكم
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" 
                           class="px-4 py-2 bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-400 border border-indigo-500/20 rounded-xl text-xs font-bold transition duration-300">
                            📊 لوحة التحكم
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="inline m-0">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 border rounded-xl text-xs font-bold transition duration-300 bg-rose-600/20 text-rose-350 border-rose-500/20 hover:bg-rose-600/40">
                            تسجيل الخروج
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-4 py-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-xl text-xs font-bold transition duration-300">
                        Sign In
                    </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-toggle" type="button" 
                        class="lg:hidden p-2 rounded-xl text-white hover:bg-white/10 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path id="menu-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div id="mobile-drawer" class="hidden lg:hidden border-t border-white/10 bg-gray-950/95 backdrop-blur-md transition-all duration-300">
        <div class="px-4 pt-2 pb-4 space-y-2">
            <a href="{{ url('/') }}" class="block px-3 py-2 rounded-xl text-base font-semibold hover:bg-white/10 text-white">Home</a>
            <a href="{{ route('sale.index') }}" class="block px-3 py-2 rounded-xl text-base font-semibold hover:bg-white/10 text-white">🚗 المعرض للبيع</a>
            
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-xl text-base font-semibold bg-blue-600/20 text-blue-300 border border-blue-500/20">📊 لوحة التحكم (مدير)</a>
                @else
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-xl text-base font-semibold bg-indigo-600/20 text-indigo-300 border border-indigo-500/20">📊 لوحة التحكم</a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}" class="m-0 pt-2 border-t border-white/10">
                    @csrf
                    <button type="submit" class="w-full text-right block px-3 py-2 rounded-xl text-base font-semibold bg-rose-600/20 text-rose-350 border-rose-500/20">
                        تسجيل الخروج
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-xl text-base font-semibold bg-white/10 text-white border border-white/20 text-center">
                    Sign In
                </a>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Mobile Drawer toggle logic
    const drawer = document.getElementById('mobile-drawer');
    const drawerToggleBtn = document.getElementById('mobile-menu-toggle');
    const iconPath = document.getElementById('menu-icon-path');

    if (drawerToggleBtn) {
        drawerToggleBtn.addEventListener('click', () => {
            drawer.classList.toggle('hidden');
            if (drawer.classList.contains('hidden')) {
                iconPath.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            } else {
                iconPath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            }
        });
    }

    // Smooth scroll for anchors
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                if (drawer && !drawer.classList.contains('hidden')) {
                    drawer.classList.add('hidden');
                    iconPath.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
                }
            }
        });
    });
</script>
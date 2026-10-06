<x-app-layout>
    <!-- HERO SECTION -->
    <section id="hero-section" class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="https://images.unsplash.com/photo-1515922079442-0d8a23b7c6c8" alt="Garage Background" class="w-full h-full object-cover object-center" />
            <!-- Gradient Overlay (Dark in dark mode, light in light mode) -->
            <div class="absolute inset-0 bg-gradient-to-b from-white/90 via-white/80 to-gray-100 dark:from-black/80 dark:via-black/70 dark:to-gray-950"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-16 sm:mt-0">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-gray-900 dark:text-white mb-6 drop-shadow-2xl tracking-tight leading-tight">
                احترافية وعناية <br/>
                <span class="text-rose-500">بسيارتك</span> في كل خطوة
            </h1>
            <p class="text-lg md:text-2xl text-gray-700 dark:text-gray-300 mb-10 max-w-3xl mx-auto font-medium drop-shadow-md">
                نقدم خدمات صيانة متكاملة، ونوفر لك منصة آمنة لبيع وشراء السيارات بكل سهولة وشفافية.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
                <!-- Button 1: Browse Gallery -->
                <a href="{{ route('sale.index') }}" 
                   class="w-full sm:w-auto px-8 py-4 bg-rose-500 hover:bg-rose-600 text-white rounded-full font-bold text-lg transition-all duration-300 shadow-[0_0_20px_rgba(244,63,94,0.4)] hover:shadow-[0_0_30px_rgba(244,63,94,0.6)] hover:-translate-y-1 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    تصفح المعرض
                </a>

                @auth
                    @if(auth()->user()->role !== 'admin')
                        <!-- Button 2: Request Repair (Logged in) -->
                        <a href="{{ route('user.repairs.create') }}" 
                           class="w-full sm:w-auto px-8 py-4 bg-gray-900/10 hover:bg-gray-900/20 dark:bg-white/10 dark:hover:bg-white/20 backdrop-blur-md border border-gray-900/30 dark:border-white/30 text-gray-900 dark:text-white rounded-full font-bold text-lg transition-all duration-300 hover:-translate-y-1 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            طلب صيانة
                        </a>

                        <!-- Button 3: Sell Car (Logged in) -->
                        <a href="{{ route('user.vehicles.create') }}" 
                           class="w-full sm:w-auto px-8 py-4 bg-gray-900/10 hover:bg-gray-900/20 dark:bg-white/10 dark:hover:bg-white/20 backdrop-blur-md border border-gray-900/30 dark:border-white/30 text-gray-900 dark:text-white rounded-full font-bold text-lg transition-all duration-300 hover:-translate-y-1 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            بيع سيارة
                        </a>
                    @endif
                @else
                    <!-- Button 2 & 3: Redirect to login if not authenticated -->
                    <a href="{{ route('login') }}" 
                       class="w-full sm:w-auto px-8 py-4 bg-gray-900/10 hover:bg-gray-900/20 dark:bg-white/10 dark:hover:bg-white/20 backdrop-blur-md border border-gray-900/30 dark:border-white/30 text-gray-900 dark:text-white rounded-full font-bold text-lg transition-all duration-300 hover:-translate-y-1 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        سجل دخولك للخدمات
                    </a>
                @endauth
            </div>
        </div>
        
        <!-- Bottom Wave / Gradient Transition -->
        <div class="absolute bottom-0 w-full h-32 bg-gradient-to-t from-gray-100 dark:from-gray-950 to-transparent"></div>
    </section>

    <!-- SHOWCASE FACILITY SECTION -->
    <section id="services-section" class="py-20 bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-5xl font-black mb-6">مرافقنا <span class="text-rose-500">الاحترافية</span></h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-12 text-lg">
                نحن نمتلك أحدث الأجهزة والمعدات لضمان تشخيص أعطال سيارتك وإصلاحها بأعلى المعايير العالمية.
            </p>
            
            <div class="relative rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(244,63,94,0.15)] group">
                <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&q=80&w=1200" alt="Professional Garage Facility" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end">
                    <div class="p-8 text-right w-full">
                        <h3 class="text-2xl font-bold text-white mb-2">ورشة العمل الرئيسية</h3>
                        <p class="text-gray-300">مجهزة بالكامل للتعامل مع كافة أنواع السيارات وصيانتها.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about-section" class="py-24 relative overflow-hidden bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <div class="absolute -inset-4 bg-rose-500/20 blur-3xl rounded-full"></div>
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800" alt="About Us" class="relative rounded-3xl shadow-2xl">
                </div>
                <div>
                    <h2 class="text-sm font-bold text-rose-500 tracking-widest uppercase mb-2">عن غاراجنا</h2>
                    <h3 class="text-4xl md:text-5xl font-black mb-6 leading-tight">خبراء في صيانة وإدارة السيارات منذ سنوات</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg mb-6 leading-relaxed">
                        نحن لا نقدم مجرد خدمة صيانة، بل نقدم تجربة متكاملة تبدأ من لحظة دخولك الغاراج وحتى خروجك بسيارتك كأنها جديدة. فريقنا المكون من أمهر الفنيين والمهندسين يضمن لك راحة البال.
                    </p>
                    <p class="text-gray-600 dark:text-gray-400 text-lg mb-8 leading-relaxed">
                        إلى جانب الصيانة، أطلقنا منصة إلكترونية رائدة لبيع وشراء السيارات لتكون واجهتك الأولى لكل ما يخص عالم السيارات.
                    </p>
                    <div class="flex gap-6">
                        <div class="border-l-4 border-rose-500 pl-4 py-1">
                            <h4 class="text-3xl font-black text-gray-900 dark:text-white">10K+</h4>
                            <p class="text-sm text-gray-500">عميل سعيد</p>
                        </div>
                        <div class="border-l-4 border-rose-500 pl-4 py-1">
                            <h4 class="text-3xl font-black text-gray-900 dark:text-white">15</h4>
                            <p class="text-sm text-gray-500">سنة خبرة</p>
                        </div>
                        <div class="border-l-4 border-rose-500 pl-4 py-1">
                            <h4 class="text-3xl font-black text-gray-900 dark:text-white">100%</h4>
                            <p class="text-sm text-gray-500">ضمان جودة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact-section" class="py-24 bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-sm font-bold text-rose-500 tracking-widest uppercase mb-2">تواصل معنا</h2>
            <h3 class="text-3xl md:text-5xl font-black mb-8">هل لديك استفسار؟ نحن هنا للمساعدة</h3>
            
            <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 md:p-12 shadow-xl border border-gray-200 dark:border-gray-800">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ url('/contact') }}" method="POST" class="space-y-6 text-right" dir="rtl">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">الاسم الكامل</label>
                            <input type="text" name="name" required placeholder="اكتب اسمك..." class="w-full bg-gray-50 dark:bg-gray-950 border border-gray-300 dark:border-gray-800 rounded-xl px-4 py-3 focus:ring-rose-500 focus:border-rose-500 text-gray-900 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">رقم الهاتف (أو البريد)</label>
                            <input type="text" name="phone" required placeholder="اكتب رقمك أو بريدك..." class="w-full bg-gray-50 dark:bg-gray-950 border border-gray-300 dark:border-gray-800 rounded-xl px-4 py-3 focus:ring-rose-500 focus:border-rose-500 text-gray-900 dark:text-white">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">رسالتك</label>
                        <textarea name="message" required rows="4" placeholder="كيف يمكننا مساعدتك؟" class="w-full bg-gray-50 dark:bg-gray-950 border border-gray-300 dark:border-gray-800 rounded-xl px-4 py-3 focus:ring-rose-500 focus:border-rose-500 text-gray-900 dark:text-white"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white font-bold text-lg py-4 rounded-xl transition-colors shadow-lg">
                        إرسال الرسالة
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white dark:bg-gray-900 py-12 border-t border-gray-200 dark:border-gray-800 text-center text-gray-600 dark:text-gray-400">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <svg class="w-8 h-8 text-rose-500" fill="currentColor" viewBox="0 0 512 512">
                    <path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.3-208-208S141.3 48 256 48s208 93.3 208 208S370.7 464 256 464zM256 128c-70.6 0-128 57.4-128 128s57.4 128 128 128s128-57.4 128-128S326.6 128 256 128zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80s80 35.9 80 80S300.1 336 256 336zM256 224c-17.7 0-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32S273.7 224 256 224z"/>
                </svg>
                <span class="font-black text-xl tracking-wider text-gray-900 dark:text-white">FAIR WIND</span>
            </div>
            <p>&copy; {{ date('Y') }} Fair Wind Garage. All Rights Reserved.</p>
        </div>
    </footer>
</x-app-layout>
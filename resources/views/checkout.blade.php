<x-app-layout>
    <div class="py-12 min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-black text-gray-100">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800 rounded-3xl p-6 flex items-center justify-between shadow-2xl">
                <div>
                    <h1 class="text-2xl font-black bg-gradient-to-r from-blue-400 to-indigo-300 bg-clip-text text-transparent">
                        🛒 تأكيد طلب شراء سيارة
                    </h1>
                    <p class="text-gray-400 text-xs mt-1">يرجى مراجعة تفاصيل المركبة وملء معلومات الاتصال والتسليم لإتمام الطلب.</p>
                </div>
                <a href="{{ route('sale.index') }}" class="text-xs text-gray-400 hover:text-white transition">
                    ← إلغاء والعودة للمعرض
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                
                <!-- Vehicle Details Summary (2 cols) -->
                <div class="md:col-span-2 bg-gray-900/30 backdrop-blur-md border border-gray-800/60 rounded-3xl p-6 shadow-xl space-y-6">
                    <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider border-b border-gray-800 pb-3">📄 تفاصيل المركبة</h2>
                    
                    <div class="space-y-4">
                        <!-- Car Image -->
                        <div class="relative aspect-video w-full rounded-2xl overflow-hidden border border-gray-800 shadow-md">
                            @if(is_array($vehicle->images) && count($vehicle->images) > 0)
                                <img src="{{ $vehicle->images[0] }}" class="w-full h-full object-cover">
                            @elseif($vehicle->image)
                                <img src="{{ $vehicle->image }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-950 flex items-center justify-center text-gray-650 text-3xl">🚗</div>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $vehicle->brand }} - {{ $vehicle->model }}</h3>
                            <p class="text-gray-400 text-xs mt-1">النوع: {{ $vehicle->type }} | سنة الصنع: {{ $vehicle->year }}</p>
                        </div>

                        <!-- Technical Specs if user listing -->
                        @if($vehicle->mileage || $vehicle->fuel_type || $vehicle->color)
                            <div class="p-3 bg-gray-950/40 rounded-xl border border-gray-850 text-xs space-y-2">
                                @if($vehicle->mileage)
                                    <div class="flex justify-between"><span class="text-gray-500">المسافة المقطوعة:</span> <span class="font-semibold text-white">{{ number_format($vehicle->mileage) }} كم</span></div>
                                @endif
                                @if($vehicle->fuel_type)
                                    <div class="flex justify-between"><span class="text-gray-500">نوع الوقود:</span> <span class="font-semibold text-white">{{ $vehicle->fuel_type }}</span></div>
                                @endif
                                @if($vehicle->color)
                                    <div class="flex justify-between"><span class="text-gray-500">اللون:</span> <span class="font-semibold text-white">{{ $vehicle->color }}</span></div>
                                @endif
                            </div>
                        @endif

                        <div class="border-t border-gray-800/80 pt-4 flex justify-between items-center">
                            <span class="text-xs text-gray-500">السعر المحدد:</span>
                            <span class="text-xl font-black text-emerald-450">{{ number_format($vehicle->price) }} $</span>
                        </div>
                    </div>
                </div>

                <!-- Checkout Form (3 cols) -->
                <div class="md:col-span-3 bg-gray-900/30 backdrop-blur-md border border-gray-800/60 rounded-3xl p-8 shadow-xl space-y-6">
                    <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider border-b border-gray-800 pb-3">👤 معلومات المشتري</h2>
                    
                    <form action="{{ route('checkout.store', $vehicle->id) }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Phone -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">📞 رقم الهاتف للاتصال</label>
                            <input type="text" 
                                   name="phone" 
                                   placeholder="مثال: +966 50 123 4567" 
                                   class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5 px-4" 
                                   required>
                            @error('phone')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">📍 عنوان التوصيل / الإقامة</label>
                            <input type="text" 
                                   name="address" 
                                   placeholder="المدينة، الحي، اسم الشارع" 
                                   class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5 px-4" 
                                   required>
                            @error('address')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">📝 ملاحظات إضافية (اختياري)</label>
                            <textarea name="notes" 
                                      rows="4" 
                                      placeholder="مثال: أفضل أوقات الاتصال، أو طريقة الاستلام المفضلة..." 
                                      class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5 px-4"></textarea>
                            @error('notes')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notice -->
                        <div class="p-3.5 bg-blue-500/10 border border-blue-500/20 text-[11px] text-blue-400 rounded-xl leading-relaxed">
                            💡 عند تقديم طلب الشراء، سيتم تحويل حالة السيارة مؤقتاً لتفادي الشراء المزدوج، وسيتسنى لك بدء محادثة تفاوض مباشرة مع البائع في حال كانت سيارة خاصة.
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-4 border-t border-gray-800/60 flex items-center justify-end">
                            <button type="submit" 
                                    class="px-8 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition shadow-lg shadow-blue-500/20 w-full md:w-auto">
                                ✅ إرسال وتأكيد الطلب
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

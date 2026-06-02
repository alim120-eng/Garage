<x-app-layout>
    <div class="py-12 min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-black text-gray-100">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Card Container -->
            <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800 rounded-3xl p-8 shadow-2xl space-y-8 relative overflow-hidden group">
                
                <!-- Background Glow -->
                <div class="absolute -top-24 -left-24 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl group-hover:bg-blue-500/15 transition duration-500"></div>
                <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition duration-500"></div>

                <!-- Header -->
                <div class="border-b border-gray-800 pb-4 flex justify-between items-center">
                    <h2 class="text-2xl font-black text-white flex items-center gap-2">
                        <span>🚗</span> تفاصيل مركبتي
                    </h2>
                    <span class="px-3.5 py-1 bg-gray-800 border border-gray-700 text-gray-400 text-xs font-semibold rounded-lg">
                        معرف النظام: #{{ $vehicle->id }}
                    </span>
                </div>

                <!-- Vehicle details grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Specifications -->
                    <div class="space-y-4">
                        <h3 class="text-xs text-gray-500 font-bold uppercase tracking-wider">مواصفات المركبة</h3>
                        
                        <div class="space-y-3">
                            <p class="text-sm text-gray-300">
                                <strong class="text-gray-400 ml-2">الشركة المصنعة:</strong> {{ $vehicle->brand }}
                            </p>
                            <p class="text-sm text-gray-300">
                                <strong class="text-gray-400 ml-2">الموديل:</strong> {{ $vehicle->model }}
                            </p>
                            <p class="text-sm text-gray-300">
                                <strong class="text-gray-400 ml-2">سنة الصنع:</strong> {{ $vehicle->year }}
                            </p>
                            <p class="text-sm text-gray-300">
                                <strong class="text-gray-400 ml-2">النوع:</strong> {{ $vehicle->type }}
                            </p>
                            <p class="text-sm text-gray-300">
                                <strong class="text-gray-400 ml-2">سعر الشراء:</strong> 
                                <span class="text-emerald-450 font-extrabold text-base">{{ number_format($vehicle->price) }} $</span>
                            </p>
                        </div>
                    </div>

                    <!-- Order status -->
                    <div class="space-y-4 bg-gray-950/40 p-6 rounded-2xl border border-gray-850">
                        <h3 class="text-xs text-gray-500 font-bold uppercase tracking-wider">حالة طلب الشراء</h3>
                        
                        <div class="space-y-3 mt-2">
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-400">حالة المعاملة:</span>
                                @if($order->status === 'pending')
                                    <span class="px-3 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold rounded-full">⏳ قيد الانتظار</span>
                                @elseif($order->status === 'approved')
                                    <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold rounded-full">✅ تمت الموافقة والبيع</span>
                                @else
                                    <span class="px-3 py-1 bg-rose-500/10 text-rose-400 border border-rose-500/20 text-xs font-bold rounded-full">❌ تم الرفض</span>
                                @endif
                            </div>

                            <p class="text-xs text-gray-400">
                                <strong class="text-gray-500 ml-2">تاريخ الطلب:</strong> {{ $order->created_at->format('Y-m-d H:i') }}
                            </p>
                            <p class="text-xs text-gray-500 leading-relaxed mt-4">
                                * عند الموافقة على طلب الشراء من طرف الإدارة، سيتم الاتصال بك لتسليم المستندات وتأكيد الشحن.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Footer navigation -->
                <div class="pt-6 border-t border-gray-800/60 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="{{ route('dashboard') }}"
                       class="px-5 py-2.5 bg-gray-800 hover:bg-gray-750 text-gray-300 border border-gray-700 text-sm font-bold rounded-xl transition duration-300 w-full sm:w-auto text-center">
                        📋 الرجوع إلى طلباتي
                    </a>
                    
                    <a href="{{ route('sale.index') }}"
                       class="text-blue-400 hover:text-blue-300 text-sm font-semibold transition duration-300 hover:underline">
                        ← تصفح سيارات أخرى في المعرض
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-12 min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-black text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-emerald-550/15 border border-emerald-500/30 text-emerald-400 p-4 rounded-2xl font-bold text-center shadow-lg backdrop-blur-md animate-pulse">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-rose-550/15 border border-rose-500/30 text-rose-400 p-4 rounded-2xl font-bold text-center shadow-lg backdrop-blur-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Welcome Header -->
            <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800/80 rounded-3xl p-8 flex flex-col md:flex-row justify-between items-center gap-6 shadow-2xl">
                <div>
                    <h1 class="text-3xl font-extrabold bg-gradient-to-r from-blue-400 via-indigo-300 to-purple-400 bg-clip-text text-transparent">
                        أهلاً بك، {{ auth()->user()->name }} 👋
                    </h1>
                    <p class="text-gray-400 mt-2 text-sm md:text-base">
                        هنا يمكنك متابعة مشترياتك من السيارات وجدولة طلبات صيانة مركباتك بكل سهولة.
                    </p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('sale.index') }}" 
                       class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-bold transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5">
                        🚗 تصفح المعرض
                    </a>
                    <a href="{{ route('user.repairs.create') }}" 
                       class="px-6 py-3 bg-gray-850 hover:bg-gray-800 text-gray-300 border border-gray-700 rounded-2xl font-bold transition-all duration-300 hover:-translate-y-0.5">
                        🛠️ طلب صيانة جديد
                    </a>
                </div>
            </div>

            <!-- Stacking: Orders & Repairs -->
            <div class="space-y-8">
                
                <!-- Section 1: Purchased Cars (Orders) -->
                <div class="bg-gray-900/30 backdrop-blur-md border border-gray-800/60 rounded-3xl p-6 shadow-xl space-y-6">
                    <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <span>🚗</span> سياراتي المشتراة
                        </h2>
                        <span class="px-3 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-semibold rounded-full">
                            {{ $orders->count() }} طلبات
                        </span>
                    </div>

                    <div class="space-y-4 max-h-[500px] overflow-y-auto pr-1">
                        @forelse($orders as $order)
                            @if($order->vehicle)
                                <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-5 hover:border-blue-500/40 transition-all duration-300 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 group">
                                    <div class="flex items-center gap-4">
                                        <!-- Thumbnail -->
                                        @if(is_array($order->vehicle->images) && count($order->vehicle->images) > 0)
                                            <div class="relative w-16 h-16 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                 onclick="openLightbox({{ json_encode($order->vehicle->images) }}, 0)">
                                                <img src="{{ $order->vehicle->images[0] }}" class="w-full h-full object-cover">
                                                @if(count($order->vehicle->images) > 1)
                                                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-[10px] font-bold">
                                                        +{{ count($order->vehicle->images) - 1 }}
                                                    </div>
                                                @endif
                                            </div>
                                        @elseif($order->vehicle->image)
                                            <div class="relative w-16 h-16 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                 onclick="openLightbox({{ json_encode([$order->vehicle->image]) }}, 0)">
                                                <img src="{{ $order->vehicle->image }}" class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-16 h-16 rounded-xl bg-gray-950 border border-gray-850 flex items-center justify-center text-gray-600 text-xl shrink-0">
                                                🚗
                                            </div>
                                        @endif

                                        <div>
                                            <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors">
                                                {{ $order->vehicle->brand }} {{ $order->vehicle->model }}
                                            </h3>
                                            <p class="text-gray-400 text-xs mt-1">
                                                سنة الصنع: {{ $order->vehicle->year }} | السعر: <span class="text-emerald-400 font-bold">{{ number_format($order->vehicle->price) }} $</span>
                                            </p>
                                            <div class="mt-3 flex items-center gap-2">
                                                <span class="text-xs text-gray-500">حالة الطلب:</span>
                                                @if($order->status === 'pending')
                                                    <span class="px-2.5 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold rounded-full">قيد الانتظار</span>
                                                @elseif($order->status === 'approved')
                                                    <span class="px-2.5 py-0.5 bg-emerald-500/10 text-emerald-405 border border-emerald-500/20 text-xs font-bold rounded-full">تمت الموافقة</span>
                                                @else
                                                    <span class="px-2.5 py-0.5 bg-rose-500/10 text-rose-450 border border-rose-500/20 text-xs font-bold rounded-full">مرفوض</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex sm:flex-col gap-2 w-full sm:w-auto">
                                        <!-- C2C Chat with Seller -->
                                        @if($order->vehicle && $order->vehicle->user_id !== null)
                                            <a href="{{ route('chat.show', $order->id) }}" 
                                               class="text-center px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-xl flex-1 sm:flex-initial transition duration-300">
                                                💬 محادثة البائع
                                            </a>
                                        @endif

                                        <a href="{{ route('my.cars.show', $order->vehicle_id) }}" 
                                           class="text-center px-4 py-2 bg-gray-800 hover:bg-gray-750 text-gray-200 border border-gray-700 text-xs font-bold rounded-xl flex-1 sm:flex-initial transition-all duration-300">
                                            🔍 تفاصيل السيارة
                                        </a>
                                        
                                        <!-- Cancel Order (Only if pending) -->
                                        @if($order->status === 'pending')
                                            <form action="{{ route('user.orders.destroy', $order->id) }}" method="POST" class="m-0 flex-1 sm:flex-initial">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('هل أنت متأكد من إلغاء طلب شراء هذه السيارة؟ سيتم إرجاعها للمعرض.')"
                                                        class="w-full text-center px-4 py-2 bg-rose-600/10 hover:bg-rose-600/30 text-rose-400 border border-rose-500/20 text-xs font-bold rounded-xl transition-all duration-300">
                                                    ❌ إلغاء الطلب
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-12 bg-gray-900/20 rounded-2xl border border-gray-800/40 text-gray-500">
                                <span class="text-3xl block mb-2">🚗</span>
                                لم تقم بشراء أي سيارات بعد.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section 2: Repair Requests (Repairs) -->
                <div class="bg-gray-900/30 backdrop-blur-md border border-gray-800/60 rounded-3xl p-6 shadow-xl space-y-6">
                    <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <span>🛠️</span> طلبات صيانة مركباتي
                        </h2>
                        <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs font-semibold rounded-full">
                            {{ $repairs->count() }} طلبات
                        </span>
                    </div>

                    <div class="space-y-4 max-h-[500px] overflow-y-auto pr-1">
                        @forelse($repairs as $repair)
                            <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-5 hover:border-indigo-500/40 transition-all duration-300 space-y-4 group">
                                <div class="flex justify-between items-start gap-4">
                                    <div class="flex items-center gap-4">
                                        <!-- Thumbnail -->
                                        @if(is_array($repair->images) && count($repair->images) > 0)
                                            <div class="relative w-16 h-16 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                 onclick="openLightbox({{ json_encode($repair->images) }}, 0)">
                                                <img src="{{ $repair->images[0] }}" class="w-full h-full object-cover">
                                                @if(count($repair->images) > 1)
                                                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-[10px] font-bold">
                                                        +{{ count($repair->images) - 1 }}
                                                    </div>
                                                @endif
                                            </div>
                                        @elseif($repair->image)
                                            <div class="relative w-16 h-16 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                 onclick="openLightbox({{ json_encode([$repair->image]) }}, 0)">
                                                <img src="{{ $repair->image }}" class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-16 h-16 rounded-xl bg-gray-950 border border-gray-850 flex items-center justify-center text-gray-600 text-xl shrink-0">
                                                🔧
                                            </div>
                                        @endif

                                        <div>
                                            <h3 class="text-lg font-bold text-white group-hover:text-indigo-400 transition-colors">
                                                {{ $repair->brand }} {{ $repair->model }} ({{ $repair->year }})
                                            </h3>
                                            <p class="text-gray-400 text-xs mt-1 line-clamp-2">
                                                <strong>المشكلة:</strong> {{ $repair->issue }}
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        @if($repair->status === 'pending')
                                            <span class="px-2.5 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold rounded-full">معلق</span>
                                        @elseif($repair->status === 'in_progress')
                                            <span class="px-2.5 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-bold rounded-full animate-pulse">قيد الصيانة</span>
                                        @elseif($repair->status === 'completed')
                                            <span class="px-2.5 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold rounded-full">مكتمل</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Financial and Duration Details (only shown if set) -->
                                <div class="grid grid-cols-2 gap-4 bg-gray-950/40 p-3 rounded-xl text-xs border border-gray-850">
                                    <div>
                                        <span class="text-gray-500 block">تكلفة الصيانة:</span>
                                        <span class="font-bold text-white">
                                            {{ $repair->cost ? number_format($repair->cost) . ' $' : 'قيد التقييم ⏳' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 block">المدة المقدرة:</span>
                                        <span class="font-bold text-white">
                                            {{ $repair->duration ? $repair->duration : 'قيد التحديد ⏳' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Cancel Option (Only if pending) -->
                                @if($repair->status === 'pending')
                                    <div class="flex justify-end pt-2">
                                        <form action="{{ route('user.repairs.destroy', $repair->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('هل أنت متأكد من إلغاء طلب صيانة هذه السيارة؟')"
                                                    class="px-4 py-2 bg-rose-600/10 hover:bg-rose-600/30 text-rose-450 border border-rose-500/20 text-xs font-bold rounded-xl transition-all duration-300">
                                                ❌ إلغاء طلب الصيانة
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-12 bg-gray-900/20 rounded-2xl border border-gray-800/40 text-gray-500">
                                <span class="text-3xl block mb-2">🛠️</span>
                                لا توجد لديك أي طلبات صيانة حالياً.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section 3: Sales Orders on My Vehicles (My Sales Orders) -->
                <div class="bg-gray-900/30 backdrop-blur-md border border-gray-800/60 rounded-3xl p-6 shadow-xl space-y-6">
                    <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <span>💰</span> طلبات شراء سياراتي الخاصة (المبيعات)
                        </h2>
                        <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-semibold rounded-full">
                            {{ $salesOrders->count() }} طلبات واردة
                        </span>
                    </div>

                    <div class="space-y-4 max-h-[500px] overflow-y-auto pr-1">
                        @forelse($salesOrders as $saleOrder)
                            <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-5 hover:border-emerald-500/40 transition-all duration-300 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 group">
                                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 flex-1">
                                    <!-- Thumbnail -->
                                    @if(is_array($saleOrder->vehicle->images) && count($saleOrder->vehicle->images) > 0)
                                        <div class="relative w-16 h-16 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                             onclick="openLightbox({{ json_encode($saleOrder->vehicle->images) }}, 0)">
                                            <img src="{{ $saleOrder->vehicle->images[0] }}" class="w-full h-full object-cover">
                                        </div>
                                    @elseif($saleOrder->vehicle->image)
                                        <div class="relative w-16 h-16 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                             onclick="openLightbox({{ json_encode([$saleOrder->vehicle->image]) }}, 0)">
                                            <img src="{{ $saleOrder->vehicle->image }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-16 h-16 rounded-xl bg-gray-950 border border-gray-850 flex items-center justify-center text-gray-600 text-xl shrink-0">
                                            🚗
                                        </div>
                                    @endif

                                    <div class="space-y-1 flex-1">
                                        <h3 class="text-lg font-bold text-white group-hover:text-emerald-400 transition-colors">
                                            {{ $saleOrder->vehicle->brand }} {{ $saleOrder->vehicle->model }}
                                        </h3>
                                        <p class="text-xs text-gray-400">
                                            المشتري: <span class="text-white font-semibold">{{ $saleOrder->user->name }}</span> | 
                                            الهاتف: <span class="text-white font-semibold">{{ $saleOrder->phone }}</span> | 
                                            العنوان: <span class="text-white font-semibold">{{ $saleOrder->address }}</span>
                                        </p>
                                        @if($saleOrder->notes)
                                            <p class="text-[11px] text-gray-500 italic bg-gray-950/20 p-2 rounded-lg border border-gray-850">
                                                * ملاحظة المشتري: {{ $saleOrder->notes }}
                                            </p>
                                        @endif
                                        <div class="flex items-center gap-2 pt-1">
                                            <span class="text-xs text-gray-500">حالة الطلب:</span>
                                            @if($saleOrder->status === 'pending')
                                                <span class="px-2.5 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold rounded-full">قيد الانتظار</span>
                                            @elseif($saleOrder->status === 'approved')
                                                <span class="px-2.5 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold rounded-full">تم قبول البيع</span>
                                            @else
                                                <span class="px-2.5 py-0.5 bg-rose-500/10 text-rose-400 border border-rose-500/20 text-xs font-bold rounded-full">مرفوض</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row md:flex-col gap-2 w-full md:w-auto">
                                    <!-- Chat Button -->
                                    <a href="{{ route('chat.show', $saleOrder->id) }}" 
                                       class="text-center px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-xl transition duration-300">
                                        💬 محادثة المشتري
                                    </a>

                                    @if($saleOrder->status === 'pending')
                                        <div class="flex gap-2">
                                            <!-- Approve Form -->
                                            <form action="{{ route('seller.orders.update', $saleOrder->id) }}" method="POST" class="m-0 flex-1">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="w-full text-center px-3 py-2 bg-emerald-600/10 hover:bg-emerald-600/30 text-emerald-400 border border-emerald-500/20 text-xs font-bold rounded-xl transition">
                                                    Accept
                                                </button>
                                            </form>
                                            <!-- Reject Form -->
                                            <form action="{{ route('seller.orders.update', $saleOrder->id) }}" method="POST" class="m-0 flex-1">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="w-full text-center px-3 py-2 bg-rose-600/10 hover:bg-rose-600/30 text-rose-400 border border-rose-500/20 text-xs font-bold rounded-xl transition">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <!-- Delete request -->
                                        <form action="{{ route('seller.orders.destroy', $saleOrder->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('هل أنت متأكد من حذف هذا الطلب؟')" class="w-full text-center px-4 py-2 bg-rose-600/10 hover:bg-rose-600/30 text-rose-450 border border-rose-500/20 text-xs font-bold rounded-xl transition">
                                                🗑️ حذف الطلب
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 bg-gray-900/20 rounded-2xl border border-gray-800/40 text-gray-500">
                                <span class="text-3xl block mb-2">💰</span>
                                لم يتلقَ أي من سياراتك طلبات شراء بعد.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section 4: My Listed Vehicles for Sale (My Listings) -->
                <div class="bg-gray-900/30 backdrop-blur-md border border-gray-800/60 rounded-3xl p-6 shadow-xl space-y-6">
                    <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <span>🚘</span> سياراتي المعروضة للبيع
                        </h2>
                        <div class="flex items-center gap-4">
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-semibold rounded-full">
                                {{ $myListedVehicles->count() }} معلنة
                            </span>
                            <a href="{{ route('user.vehicles.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-xs font-bold transition">
                                ➕ إعلان سيارة جديدة
                            </a>
                        </div>
                    </div>

                    <div class="space-y-4 max-h-[500px] overflow-y-auto pr-1">
                        @forelse($myListedVehicles as $vehicle)
                            <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 group">
                                <div class="flex items-center gap-4">
                                    <!-- Thumbnail -->
                                    @if(is_array($vehicle->images) && count($vehicle->images) > 0)
                                        <div class="relative w-16 h-16 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                             onclick="openLightbox({{ json_encode($vehicle->images) }}, 0)">
                                            <img src="{{ $vehicle->images[0] }}" class="w-full h-full object-cover">
                                            @if(count($vehicle->images) > 1)
                                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-[10px] font-bold">
                                                    +{{ count($vehicle->images) - 1 }}
                                                </div>
                                            @endif
                                        </div>
                                    @elseif($vehicle->image)
                                        <div class="relative w-16 h-16 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                             onclick="openLightbox({{ json_encode([$vehicle->image]) }}, 0)">
                                            <img src="{{ $vehicle->image }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-16 h-16 rounded-xl bg-gray-950 border border-gray-850 flex items-center justify-center text-gray-650 text-xl shrink-0">
                                            🚗
                                        </div>
                                    @endif

                                    <div>
                                        <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors">
                                            {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->year }})
                                        </h3>
                                        <p class="text-xs text-gray-400 mt-1">
                                            السعر: <span class="text-emerald-400 font-bold">{{ number_format($vehicle->price) }} $</span>
                                            @if($vehicle->mileage) | المسافة: {{ number_format($vehicle->mileage) }} كم @endif
                                            @if($vehicle->color) | اللون: {{ $vehicle->color }} @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div>
                                    @if($vehicle->status === 'available')
                                        <span class="px-2.5 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold rounded-full">متاحة للبيع</span>
                                    @elseif($vehicle->status === 'repairing')
                                        <span class="px-2.5 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold rounded-full">تحت الصيانة</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-gray-500/10 text-gray-400 border border-gray-500/20 text-xs font-bold rounded-full">تم بيعها</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 bg-gray-900/20 rounded-2xl border border-gray-800/40 text-gray-500">
                                <span class="text-3xl block mb-2">🚘</span>
                                لم تقم بعرض أي سيارات للبيع بعد.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            </div>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="py-12 min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-950 dark:via-gray-900 dark:to-black text-gray-800 dark:text-gray-100 transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-2xl font-bold text-center shadow-lg backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 p-4 rounded-2xl font-bold text-center shadow-lg backdrop-blur-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Admin Header -->
            <div class="bg-white/70 dark:bg-gray-900/40 backdrop-blur-md border border-gray-200 dark:border-gray-800/80 rounded-3xl p-8 flex flex-col md:flex-row justify-between items-center gap-4 shadow-2xl">
                <div>
                    <h1 class="text-3xl font-extrabold bg-gradient-to-r from-red-600 to-purple-600 dark:from-red-400 dark:via-pink-400 dark:to-purple-400 bg-clip-text text-transparent">
                        لوحة الإشراف والمتابعة الشاملة ⚙️
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm mt-1">
                        مرحباً بك يا مشرف النظام. هنا يمكنك التحكم بكافة مبيعات السيارات، صيانات الزبائن، والاطلاع على أداء الكراج.
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.vehicles.index') }}" 
                       class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl shadow-lg shadow-blue-500/25 transition">
                        🚘 إدارة السيارات
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Stat 1: Available Cars -->
                <div class="bg-white dark:bg-gray-900/30 border border-gray-200 dark:border-gray-800/60 rounded-3xl p-6 shadow-xl hover:scale-102 hover:shadow-emerald-500/10 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-gray-500 dark:text-gray-450 text-sm font-semibold">السيارات المتاحة للبيع</span>
                            <h3 class="text-3xl font-black mt-2 text-gray-900 dark:text-white">
                                {{ $availableVehiclesCount }}
                            </h3>
                        </div>
                        <span class="p-3 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-2xl text-xl">🚗</span>
                    </div>
                </div>

                <!-- Stat 2: Total Orders -->
                <div class="bg-white dark:bg-gray-900/30 border border-gray-200 dark:border-gray-800/60 rounded-3xl p-6 shadow-xl hover:scale-102 hover:shadow-blue-500/10 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-gray-500 dark:text-gray-450 text-sm font-semibold">إجمالي طلبات الشراء</span>
                            <h3 class="text-3xl font-black mt-2 text-gray-900 dark:text-white">
                                {{ $totalOrdersCount }}
                            </h3>
                        </div>
                        <span class="p-3 bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-2xl text-xl">📦</span>
                    </div>
                </div>

                <!-- Stat 3: Active Repairs -->
                <div class="bg-white dark:bg-gray-900/30 border border-gray-200 dark:border-gray-800/60 rounded-3xl p-6 shadow-xl hover:scale-102 hover:shadow-amber-500/10 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-gray-500 dark:text-gray-450 text-sm font-semibold">طلبات صيانة نشطة</span>
                            <h3 class="text-3xl font-black mt-2 text-gray-900 dark:text-white">
                                {{ $activeRepairsCount }}
                            </h3>
                        </div>
                        <span class="p-3 bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-2xl text-xl">🛠️</span>
                    </div>
                </div>

                <!-- Stat 4: Revenue -->
                <div class="bg-white dark:bg-gray-900/30 border border-gray-200 dark:border-gray-800/60 rounded-3xl p-6 shadow-xl hover:scale-102 hover:shadow-purple-500/10 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-gray-500 dark:text-gray-450 text-sm font-semibold">إجمالي الإيرادات</span>
                            <h3 class="text-3xl font-black mt-2 text-emerald-600 dark:text-emerald-450">
                                {{ number_format($totalRevenue) }} $
                            </h3>
                        </div>
                        <span class="p-3 bg-purple-500/10 text-purple-600 dark:text-purple-400 rounded-2xl text-xl">💰</span>
                    </div>
                </div>

            </div>

            <!-- Visual Charts Grid (Count, Charts) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Chart 1: Vehicles Status Chart -->
                <div class="bg-white dark:bg-gray-900/30 border border-gray-200 dark:border-gray-800/60 rounded-3xl p-6 shadow-xl space-y-4">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">📊 مخطط حالة أسطول السيارات</h2>
                    <p class="text-xs text-gray-500">توزيع السيارات الإجمالي بالعدد والحالة الحالية.</p>
                    
                    <div class="space-y-4 pt-2">
                        <!-- Available -->
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>متاحة للبيع (Available)</span>
                                <span>{{ $vehiclesAvailable }} سيارة</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-3.5 overflow-hidden">
                                @php
                                    $totalVehicles = max(($vehiclesAvailable + $vehiclesRepairing + $vehiclesSold), 1);
                                    $availablePct = ($vehiclesAvailable / $totalVehicles) * 100;
                                    $repairingPct = ($vehiclesRepairing / $totalVehicles) * 100;
                                    $soldPct = ($vehiclesSold / $totalVehicles) * 100;
                                @endphp
                                <div class="bg-emerald-500 h-full rounded-full transition-all duration-500" style="width: {{ $availablePct }}%"></div>
                            </div>
                        </div>

                        <!-- Repairing -->
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>تحت الصيانة (Repairing)</span>
                                <span>{{ $vehiclesRepairing }} سيارة</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-3.5 overflow-hidden">
                                <div class="bg-amber-500 h-full rounded-full transition-all duration-500" style="width: {{ $repairingPct }}%"></div>
                            </div>
                        </div>

                        <!-- Sold -->
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>تم بيعها (Sold)</span>
                                <span>{{ $vehiclesSold }} سيارة</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-3.5 overflow-hidden">
                                <div class="bg-blue-500 h-full rounded-full transition-all duration-500" style="width: {{ $soldPct }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart 2: Repair Orders Status Chart -->
                <div class="bg-white dark:bg-gray-900/30 border border-gray-200 dark:border-gray-800/60 rounded-3xl p-6 shadow-xl space-y-4">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">📊 مخطط طلبات صيانة الكراج</h2>
                    <p class="text-xs text-gray-500">توزيع طلبات الصيانة بالعدد وحالة الإنجاز.</p>
                    
                    <div class="space-y-4 pt-2">
                        <!-- Pending -->
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>قيد الانتظار (Pending)</span>
                                <span>{{ $repairsPending }} طلبات</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-3.5 overflow-hidden">
                                @php
                                    $totalRepairsAgg = max(($repairsPending + $repairsInProgress + $repairsCompleted), 1);
                                    $pendingRepPct = ($repairsPending / $totalRepairsAgg) * 100;
                                    $progressRepPct = ($repairsInProgress / $totalRepairsAgg) * 100;
                                    $completedRepPct = ($repairsCompleted / $totalRepairsAgg) * 100;
                                @endphp
                                <div class="bg-amber-500 h-full rounded-full transition-all duration-500" style="width: {{ $pendingRepPct }}%"></div>
                            </div>
                        </div>

                        <!-- In Progress -->
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>تحت الصيانة (In Progress)</span>
                                <span>{{ $repairsInProgress }} طلبات</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-3.5 overflow-hidden">
                                <div class="bg-indigo-500 h-full rounded-full transition-all duration-500" style="width: {{ $progressRepPct }}%"></div>
                            </div>
                        </div>

                        <!-- Completed -->
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>مكتملة الصيانة (Completed)</span>
                                <span>{{ $repairsCompleted }} طلبات</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-3.5 overflow-hidden">
                                <div class="bg-emerald-500 h-full rounded-full transition-all duration-500" style="width: {{ $completedRepPct }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Repairs Management Section -->
            <div class="bg-white dark:bg-gray-900/30 border border-gray-200 dark:border-gray-800/60 rounded-3xl p-6 shadow-2xl space-y-6">
                <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 pb-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span>🛠️</span> إدارة طلبات الصيانة وتحديث تفاصيلها
                    </h2>
                    <span class="px-3 py-1 bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 text-xs font-semibold rounded-full">
                        {{ $repairs->count() }} طلبات إجمالية
                    </span>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/10">
                    <table class="w-full text-right text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-950/60 text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase">
                            <tr>
                                <th class="p-4">الزبون</th>
                                <th class="p-4">المركبة (السنة)</th>
                                <th class="p-4">العطل / المشكلة</th>
                                <th class="p-4">تعديل التكلفة والمدة والحالة</th>
                                <th class="p-4">العمليات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800/80">
                            @forelse($repairs as $repair)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition duration-200">
                                    <!-- User info -->
                                    <td class="p-4">
                                        <div class="font-bold text-gray-900 dark:text-white">{{ $repair->user->name ?? 'غير معروف' }}</div>
                                        <div class="text-xs text-gray-500">{{ $repair->user->email ?? '' }}</div>
                                    </td>
                                    
                                    <!-- Vehicle info -->
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            @if(is_array($repair->images) && count($repair->images) > 0)
                                                <div class="relative w-12 h-12 rounded-lg overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                     onclick="openLightbox({{ json_encode($repair->images) }}, 0)">
                                                    <img src="{{ $repair->images[0] }}" class="w-full h-full object-cover">
                                                    @if(count($repair->images) > 1)
                                                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-[9px] font-bold">
                                                            +{{ count($repair->images) - 1 }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @elseif($repair->image)
                                                <div class="relative w-12 h-12 rounded-lg overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                     onclick="openLightbox({{ json_encode([$repair->image]) }}, 0)">
                                                    <img src="{{ $repair->image }}" class="w-full h-full object-cover">
                                                </div>
                                            @else
                                                <div class="w-12 h-12 rounded-lg bg-gray-950 border border-gray-850 flex items-center justify-center text-gray-650 text-base shrink-0">
                                                    🔧
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $repair->brand }} - {{ $repair->model }}</div>
                                                <span class="text-xs px-2 py-0.5 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-lg">{{ $repair->type }} | {{ $repair->year }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Issue -->
                                    <td class="p-4 max-w-xs">
                                        <p class="text-xs text-gray-500 dark:text-gray-450 line-clamp-3 leading-relaxed">{{ $repair->issue }}</p>
                                    </td>
                                    
                                    <!-- Update inputs -->
                                    <td class="p-4">
                                        <form id="update-repair-{{ $repair->id }}" action="{{ route('admin.repairs.update', $repair->id) }}" method="POST" class="m-0 flex flex-wrap items-center gap-3">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <!-- Cost -->
                                            <div class="flex flex-col">
                                                <input type="number" 
                                                       name="cost" 
                                                       value="{{ $repair->cost }}" 
                                                       placeholder="التكلفة ($)" 
                                                       class="w-24 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 rounded-lg text-xs text-gray-900 dark:text-white focus:ring-amber-500 py-1"
                                                       min="0">
                                            </div>

                                            <!-- Duration -->
                                            <div class="flex flex-col">
                                                <input type="text" 
                                                       name="duration" 
                                                       value="{{ $repair->duration }}" 
                                                       placeholder="المدة (يوم/ساعة)" 
                                                       class="w-28 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 rounded-lg text-xs text-gray-900 dark:text-white focus:ring-amber-500 py-1">
                                            </div>

                                            <!-- Status -->
                                            <div class="flex flex-col">
                                                <select name="status" 
                                                        class="bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 rounded-lg text-xs text-gray-900 dark:text-white focus:ring-amber-500 py-1">
                                                    <option value="pending" {{ $repair->status === 'pending' ? 'selected' : '' }}>⏳ معلق</option>
                                                    <option value="in_progress" {{ $repair->status === 'in_progress' ? 'selected' : '' }}>🔧 قيد العمل</option>
                                                    <option value="completed" {{ $repair->status === 'completed' ? 'selected' : '' }}>✅ مكتمل</option>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                    
                                    <!-- Actions (Save & Delete) -->
                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            <button type="submit" form="update-repair-{{ $repair->id }}"
                                                    class="px-3.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-gray-950 font-bold text-xs rounded-xl transition duration-200">
                                                💾 حفظ
                                            </button>
                                            
                                            <form action="{{ route('admin.repairs.destroy', $repair->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('هل أنت متأكد من حذف طلب الصيانة هذا نهائياً؟')"
                                                        class="px-3.5 py-1.5 bg-rose-600/10 hover:bg-rose-600/30 text-rose-500 border border-rose-500/20 text-xs font-bold rounded-xl transition">
                                                    🗑️ حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10 text-gray-500">
                                        لا توجد أي طلبات صيانة حالياً.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Vehicle Purchase Orders Management -->
            <div class="bg-white dark:bg-gray-900/30 border border-gray-200 dark:border-gray-800/60 rounded-3xl p-6 shadow-2xl space-y-6">
                <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 pb-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span>📦</span> إدارة وتحديث طلبات شراء السيارات
                    </h2>
                    <span class="px-3 py-1 bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 text-xs font-semibold rounded-full">
                        {{ $orders->count() }} طلبات شراء
                    </span>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/10">
                    <table class="w-full text-right text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-955/60 text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase">
                            <tr>
                                <th class="p-4">الزبون</th>
                                <th class="p-4">السيارة المطلوبة</th>
                                <th class="p-4">السعر</th>
                                <th class="p-4">تحديث حالة الطلب</th>
                                <th class="p-4">العمليات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800/80">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition duration-200">
                                    <!-- User info -->
                                    <td class="p-4">
                                        <div class="font-bold text-gray-900 dark:text-white">{{ $order->user->name ?? 'غير معروف' }}</div>
                                        <div class="text-xs text-gray-500 mb-2">{{ $order->user->email ?? '' }}</div>
                                        @if($order->phone || $order->address || $order->notes)
                                            <div class="mt-2 text-xs border-t border-gray-200 dark:border-gray-800 pt-2 space-y-1">
                                                @if($order->phone)
                                                    <div><span class="text-gray-400 font-semibold">📞 الهاتف:</span> <span class="font-mono text-gray-700 dark:text-gray-300">{{ $order->phone }}</span></div>
                                                @endif
                                                @if($order->address)
                                                    <div><span class="text-gray-400 font-semibold">📍 العنوان:</span> <span class="text-gray-700 dark:text-gray-300">{{ $order->address }}</span></div>
                                                @endif
                                                @if($order->notes)
                                                    <div class="bg-gray-100 dark:bg-gray-950/40 p-2 rounded border border-gray-205 dark:border-gray-800 text-[11px] text-gray-600 dark:text-gray-400 italic mt-1">
                                                        * ملاحظة: "{{ $order->notes }}"
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Vehicle -->
                                    <td class="p-4">
                                        @if($order->vehicle)
                                            <div class="flex items-center gap-3">
                                                @if(is_array($order->vehicle->images) && count($order->vehicle->images) > 0)
                                                    <div class="relative w-12 h-12 rounded-lg overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                         onclick="openLightbox({{ json_encode($order->vehicle->images) }}, 0)">
                                                        <img src="{{ $order->vehicle->images[0] }}" class="w-full h-full object-cover">
                                                        @if(count($order->vehicle->images) > 1)
                                                            <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-[9px] font-bold">
                                                                +{{ count($order->vehicle->images) - 1 }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                @elseif($order->vehicle->image)
                                                    <div class="relative w-12 h-12 rounded-lg overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                         onclick="openLightbox({{ json_encode([$order->vehicle->image]) }}, 0)">
                                                        <img src="{{ $order->vehicle->image }}" class="w-full h-full object-cover">
                                                    </div>
                                                @else
                                                    <div class="w-12 h-12 rounded-lg bg-gray-950 border border-gray-850 flex items-center justify-center text-gray-650 text-base shrink-0">
                                                        🚗
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-semibold text-gray-800 dark:text-gray-205">{{ $order->vehicle->brand }} - {{ $order->vehicle->model }}</div>
                                                    <span class="text-xs px-2 py-0.5 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-lg">رقم: #{{ $order->vehicle->id }} | {{ $order->vehicle->year }}</span>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400">مركبة محذوفة</span>
                                        @endif
                                    </td>

                                    <!-- Price -->
                                    <td class="p-4 font-bold text-emerald-600 dark:text-emerald-450">
                                        {{ $order->vehicle ? number_format($order->vehicle->price) . ' $' : '-' }}
                                    </td>

                                    <!-- Update Status -->
                                    <td class="p-4">
                                        <form id="update-order-{{ $order->id }}" action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="m-0 flex items-center gap-3">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <select name="status" 
                                                    class="bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 rounded-lg text-xs text-gray-900 dark:text-white focus:ring-blue-500 py-1">
                                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>⏳ قيد الانتظار</option>
                                                <option value="approved" {{ $order->status === 'approved' ? 'selected' : '' }}>✅ موافقة وإتمام البيع</option>
                                                <option value="rejected" {{ $order->status === 'rejected' ? 'selected' : '' }}>❌ رفض الطلب</option>
                                            </select>
                                        </form>
                                    </td>

                                    <!-- Save / Delete Actions -->
                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            <button type="submit" form="update-order-{{ $order->id }}"
                                                    class="px-3.5 py-1.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl transition duration-200">
                                                💾 حفظ
                                            </button>
                                            
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('هل أنت متأكد من حذف طلب الشراء نهائياً؟')"
                                                        class="px-3.5 py-1.5 bg-rose-600/10 hover:bg-rose-600/30 text-rose-500 border border-rose-500/20 text-xs font-bold rounded-xl transition">
                                                    🗑️ حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10 text-gray-500">
                                        لا توجد أي طلبات مبيعات مسجلة حالياً.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

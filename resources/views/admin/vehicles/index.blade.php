<x-app-layout>
    <div class="py-12 min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-black text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-emerald-550/15 border border-emerald-500/30 text-emerald-400 p-4 rounded-2xl font-bold text-center shadow-lg backdrop-blur-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header -->
            <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800 rounded-3xl p-8 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-2xl">
                <div>
                    <h1 class="text-3xl font-extrabold bg-gradient-to-r from-blue-400 to-indigo-300 bg-clip-text text-transparent">
                        إدارة أسطول السيارات 🚘
                    </h1>
                    <p class="text-gray-400 text-xs mt-1">عرض وإضافة وتعديل وحذف المركبات المعروضة في الكراج.</p>
                </div>
                <div>
                    <a href="{{ route('admin.vehicles.create') }}" 
                       class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl shadow-lg shadow-blue-500/20 transition-all hover:scale-102 flex items-center gap-2">
                        <span>➕</span> إضافة سيارة جديدة
                    </a>
                </div>
            </div>

            <!-- Vehicles Table -->
            <div class="bg-gray-900/30 backdrop-blur-md border border-gray-800/60 rounded-3xl p-6 shadow-xl">
                <div class="overflow-x-auto rounded-2xl border border-gray-800 bg-gray-900/10">
                    <table class="w-full text-right text-gray-300">
                        <thead class="bg-gray-955/60 text-gray-400 text-xs font-semibold uppercase">
                            <tr>
                                <th class="p-4">المركبة (العلامة والموديل)</th>
                                <th class="p-4">النوع</th>
                                <th class="p-4">سنة الصنع</th>
                                <th class="p-4">سعر البيع</th>
                                <th class="p-4">الحالة الحالية</th>
                                <th class="p-4">العمليات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/80">
                            @forelse($vehicles as $vehicle)
                                <tr class="hover:bg-gray-900/40 transition duration-200">
                                    
                                    <!-- Brand & Model -->
                                    <td class="p-4 font-bold text-white">
                                        <div class="flex items-center gap-3">
                                            @if(is_array($vehicle->images) && count($vehicle->images) > 0)
                                                <div class="relative w-12 h-12 rounded-lg overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                     onclick="openLightbox({{ json_encode($vehicle->images) }}, 0)">
                                                    <img src="{{ $vehicle->images[0] }}" class="w-full h-full object-cover">
                                                    @if(count($vehicle->images) > 1)
                                                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-white text-[9px] font-bold">
                                                            +{{ count($vehicle->images) - 1 }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @elseif($vehicle->image)
                                                <div class="relative w-12 h-12 rounded-lg overflow-hidden cursor-pointer border border-gray-700/60 shadow hover:scale-105 transition duration-200 shrink-0"
                                                     onclick="openLightbox({{ json_encode([$vehicle->image]) }}, 0)">
                                                    <img src="{{ $vehicle->image }}" class="w-full h-full object-cover">
                                                </div>
                                            @else
                                                <div class="w-12 h-12 rounded-lg bg-gray-950 border border-gray-850 flex items-center justify-center text-gray-600 text-base shrink-0">
                                                    🚗
                                                </div>
                                            @endif
                                            <span>{{ $vehicle->brand }} {{ $vehicle->model }}</span>
                                        </div>
                                    </td>
                                    
                                    <!-- Type -->
                                    <td class="p-4 text-sm text-gray-300">
                                        {{ $vehicle->type }}
                                    </td>
                                    
                                    <!-- Year -->
                                    <td class="p-4 text-sm text-gray-400">
                                        {{ $vehicle->year }}
                                    </td>

                                    <!-- Price -->
                                    <td class="p-4 font-extrabold text-emerald-450">
                                        {{ number_format($vehicle->price) }} $
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="p-4">
                                        @if($vehicle->status === 'available')
                                            <span class="px-2.5 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold rounded-full">متاحة للبيع</span>
                                        @elseif($vehicle->status === 'repairing')
                                            <span class="px-2.5 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold rounded-full">تحت الصيانة</span>
                                        @else
                                            <span class="px-2.5 py-0.5 bg-gray-500/10 text-gray-400 border border-gray-500/20 text-xs font-bold rounded-full">تم البيع</span>
                                        @endif
                                    </td>

                                    <!-- Action Buttons -->
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" 
                                               class="px-3 py-1.5 bg-indigo-600/20 hover:bg-indigo-650/40 text-indigo-400 border border-indigo-500/20 rounded-xl text-xs font-bold transition">
                                                ✏️ تعديل
                                            </a>
                                            
                                            <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('هل أنت متأكد من حذف هذه السيارة نهائياً من النظام؟')"
                                                        class="px-3 py-1.5 bg-rose-600/20 hover:bg-rose-650/40 text-rose-400 border border-rose-500/20 rounded-xl text-xs font-bold transition">
                                                    🗑️ حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12 text-gray-500">
                                        🚘 لا توجد أي سيارات مسجلة في قاعدة البيانات حالياً.
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

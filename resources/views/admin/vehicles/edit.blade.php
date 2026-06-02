<x-app-layout>
    <div class="py-12 min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-black text-gray-100">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Card Container -->
            <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800 rounded-3xl p-8 shadow-2xl space-y-6">
                
                <!-- Header -->
                <div class="border-b border-gray-800 pb-4">
                    <h2 class="text-2xl font-black text-white flex items-center gap-2">
                        <span>📝</span> تعديل بيانات السيارة
                    </h2>
                    <p class="text-gray-400 text-xs mt-1">تعديل مواصفات وحالة السيارة المعرف رقم: #{{ $vehicle->id }}.</p>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Type -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">🚗 نوع المركبة</label>
                            <select name="type" 
                                    class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" 
                                    required>
                                <option value="سيارة" {{ $vehicle->type === 'سيارة' ? 'selected' : '' }}>سيارة</option>
                                <option value="دراجة نارية" {{ $vehicle->type === 'دراجة نارية' ? 'selected' : '' }}>دراجة نارية</option>
                                <option value="شاحنة" {{ $vehicle->type === 'شاحنة' ? 'selected' : '' }}>شاحنة</option>
                            </select>
                        </div>

                        <!-- Brand -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">🏷️ الشركة المصنعة</label>
                            <input type="text" 
                                   name="brand" 
                                   value="{{ $vehicle->brand }}" 
                                   class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" 
                                   required>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Model -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">📌 الموديل</label>
                            <input type="text" 
                                   name="model" 
                                   value="{{ $vehicle->model }}" 
                                   class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" 
                                   required>
                        </div>

                        <!-- Year -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">📅 سنة الصنع</label>
                            <select name="year" 
                                    class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" 
                                    required>
                                @for ($year = date('Y') + 1; $year >= 1990; $year--)
                                    <option value="{{ $year }}" {{ $vehicle->year == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Price -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">💰 السعر المحدد ($)</label>
                            <input type="number" 
                                   name="price" 
                                   value="{{ $vehicle->price }}" 
                                   class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" 
                                   min="0" 
                                   step="0.01" 
                                   required>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">🚦 حالة المركبة</label>
                            <select name="status" 
                                    class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" 
                                    required>
                                <option value="available" {{ $vehicle->status === 'available' ? 'selected' : '' }}>متاحة للبيع</option>
                                <option value="repairing" {{ $vehicle->status === 'repairing' ? 'selected' : '' }}>تحت الصيانة</option>
                                <option value="sold" {{ $vehicle->status === 'sold' ? 'selected' : '' }}>تم بيعها</option>
                            </select>
                        </div>

                    </div>

                    <!-- Image URL -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">🖼️ رابط صورة رئيسية بديل (اختياري)</label>
                        <input type="text" 
                               name="image" 
                               value="{{ $vehicle->image }}" 
                               class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5">
                    </div>

                    <!-- Current Images -->
                    @if(is_array($vehicle->images) && count($vehicle->images) > 0)
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">📸 الصور الحالية المرفوعة</label>
                            <div class="grid grid-cols-5 gap-3 bg-gray-900/50 p-4 rounded-xl border border-gray-800">
                                @foreach($vehicle->images as $img)
                                    <div class="relative group aspect-square bg-gray-950 rounded-lg overflow-hidden border border-gray-800">
                                        <img src="{{ $img }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Upload Multiple Images (Max 10) -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">📸 رفع صور جديدة للسيارة (الحد الأقصى 10 صور - سيستبدل الصور القديمة)</label>
                        <input type="file" 
                               name="images[]" 
                               accept="image/*" 
                               multiple 
                               class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2 px-3">
                        <p class="text-xs text-gray-500 mt-1">تحديد صور متعددة لاستبدال صور المعرض الحالية.</p>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="pt-4 border-t border-gray-800/60 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <a href="{{ route('admin.vehicles.index') }}" 
                           class="px-5 py-2.5 bg-gray-850 hover:bg-gray-800 text-gray-300 border border-gray-700 text-sm font-bold rounded-xl w-full sm:w-auto text-center">
                            ← إلغاء والرجوع للقائمة
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition shadow-lg shadow-blue-500/20 w-full sm:w-auto">
                            💾 تحديث التغييرات
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>

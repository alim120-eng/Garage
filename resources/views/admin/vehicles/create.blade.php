<x-app-layout>
    <div class="py-12 min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-black text-gray-100">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Card Container -->
            <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800 rounded-3xl p-8 shadow-2xl space-y-6">
                
                <!-- Header -->
                <div class="border-b border-gray-800 pb-4">
                    <h2 class="text-2xl font-black text-white flex items-center gap-2">
                        <span>🚘</span> إضافة سيارة جديدة للأسطول
                    </h2>
                    <p class="text-gray-400 text-xs mt-1">يرجى ملء تفاصيل السيارة بدقة لتظهر في معرض بيع السيارات للزبائن.</p>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Type -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">🚗 نوع المركبة</label>
                            <select name="type" 
                                    class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" 
                                    required>
                                <option value="">اختر النوع</option>
                                <option value="سيارة">سيارة</option>
                                <option value="دراجة نارية">دراجة نارية</option>
                                <option value="شاحنة">شاحنة</option>
                            </select>
                        </div>

                        <!-- Brand -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">🏷️ الشركة المصنعة</label>
                            <input type="text" 
                                   name="brand" 
                                   placeholder="مثال: Toyota / Mercedes" 
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
                                   placeholder="مثال: Corolla / C200" 
                                   class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" 
                                   required>
                        </div>

                        <!-- Year -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">📅 سنة الصنع</label>
                            <select name="year" 
                                    class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" 
                                    required>
                                <option value="">اختر السنة</option>
                                @for ($year = date('Y') + 1; $year >= 1990; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
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
                                   placeholder="مثال: 45000" 
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
                                <option value="available">متاحة للبيع</option>
                                <option value="repairing">تحت الصيانة</option>
                                <option value="sold">تم بيعها</option>
                            </select>
                        </div>

                    </div>

                    <!-- Image URL -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">🖼️ رابط صورة رئيسية بديل (اختياري)</label>
                        <input type="text" 
                               name="image" 
                               placeholder="مثال: /images/car1.jpg" 
                               class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5">
                    </div>

                    <!-- Upload Multiple Images (Max 10) -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">📸 رفع صور متعددة للسيارة (الحد الأقصى 10 صور)</label>
                        <input type="file" 
                               name="images[]" 
                               accept="image/*" 
                               multiple 
                               class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2 px-3">
                        <p class="text-xs text-gray-500 mt-1">تحديد صور متعددة لعرضها في معرض السيارة.</p>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="pt-4 border-t border-gray-800/60 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <a href="{{ route('admin.vehicles.index') }}" 
                           class="px-5 py-2.5 bg-gray-850 hover:bg-gray-800 text-gray-300 border border-gray-700 text-sm font-bold rounded-xl w-full sm:w-auto text-center">
                            ← إلغاء والرجوع للقائمة
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition shadow-lg shadow-blue-500/20 w-full sm:w-auto">
                            💾 حفظ وإضافة السيارة
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>

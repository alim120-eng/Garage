<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            🛠️ طلب إصلاح مركبة
        </h2>
    </x-slot>

    <div class="py-12 text-gray-200 min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900/80 backdrop-blur border border-gray-700 shadow-xl rounded-2xl p-8">

                <form action="{{ route('user.repairs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- نوع المركبة -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold mb-2">🚗 نوع المركبة</label>
                        <select name="type" class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500" required>
                            <option value="">اختر النوع</option>
                            <option value="car">سيارة</option>
                            <option value="motorcycle">دراجة نارية</option>
                        </select>
                    </div>

                    <!-- الشركة والموديل -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                        <div>
                            <label class="block text-sm font-semibold mb-2">🏷️ الشركة المصنعة</label>
                            <select name="brand" class="w-full bg-gray-800 border-gray-700 rounded-xl text-white" required>
                                <option value="">اختر الشركة</option>
                                <option>Mercedes-Benz</option>
                                <option>BMW</option>
                                <option>Audi</option>
                                <option>Toyota</option>
                                <option>Volkswagen</option>
                                <option>Hyundai</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">📌 الموديل</label>
                            <input 
                                type="text" 
                                name="model" 
                                placeholder="مثال: C200 / E-Class / Corolla"
                                class="w-full bg-gray-800 border-gray-700 rounded-xl text-white"
                                required
                            >
                        </div>

                    </div>

                    <!-- سنة الصنع -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold mb-2">📅 سنة الصنع</label>
                        <select name="year" class="w-full bg-gray-800 border-gray-700 rounded-xl text-white" required>
                            <option value="">اختر السنة</option>
                            @for ($year = date('Y'); $year >= 1990; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- وصف العطل -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold mb-2">🧰 وصف العطل</label>
                        <textarea 
                            name="issue" 
                            rows="4"
                            placeholder="مثال: صوت غريب عند التشغيل، ضوء المحرك شغال..."
                            class="w-full bg-gray-800 border-gray-700 rounded-xl text-white"
                            required
                        ></textarea>
                    </div>

                    <!-- صور العطل (الحد الأقصى 10 صور) -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold mb-2">📸 صور المشكلة (الحد الأقصى 10 صور)</label>
                        <input 
                            type="file" 
                            name="images[]" 
                            accept="image/*" 
                            multiple 
                            class="w-full bg-gray-800 border-gray-700 rounded-xl text-white py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <p class="text-xs text-gray-500 mt-1">يمكنك تحديد ما يصل إلى 10 صور لتوضيح المشكلة.</p>
                    </div>

                    <!-- زر الإرسال -->
                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-lg"
                    >
                        🚀 إرسال الطلب إلى الورشة
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            <svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> طلب إصلاح مركبة
        </h2>
    </x-slot>

    <div class="py-12 text-gray-200 min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900/80 backdrop-blur border border-gray-700 shadow-xl rounded-2xl p-8">

                <form action="{{ route('user.repairs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- نوع المركبة -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold mb-2"><svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8M8 11h8m-8 4h8m-4-10v14"></path></svg> نوع المركبة</label>
                        <select name="type" class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500" required>
                            <option value="">اختر النوع</option>
                            <option value="car">سيارة</option>
                            <option value="motorcycle">دراجة نارية</option>
                        </select>
                    </div>

                    <!-- الشركة والموديل -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                        <div>
                            <label class="block text-sm font-semibold mb-2"><svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg> الشركة المصنعة</label>
                            <select id="brand-select" name="brand" onchange="updateModels()" class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" required>
                                <option value="">اختر الشركة</option><option value="Mercedes-Benz">Mercedes-Benz</option><option value="BMW">BMW</option><option value="Audi">Audi</option><option value="Toyota">Toyota</option><option value="Volkswagen">Volkswagen</option><option value="Hyundai">Hyundai</option><option value="Kia">Kia</option><option value="Ford">Ford</option><option value="Chevrolet">Chevrolet</option><option value="Nissan">Nissan</option><option value="Honda">Honda</option><option value="Peugeot">Peugeot</option><option value="Renault">Renault</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2"><svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> الموديل</label>
                            
            <select id="model-select" name="model" onchange="checkCustomModel()" class="w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5" required>
                <option value="">اختر الموديل</option>
            </select>
            <input type="text" id="custom-model-input" placeholder="اكتب اسم الموديل هنا..." class="mt-3 hidden w-full bg-gray-800 border-gray-700 rounded-xl text-white focus:ring-blue-500 py-2.5">
        
                        </div>

                    </div>

                    <!-- سنة الصنع -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold mb-2"><svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> سنة الصنع</label>
                        <select name="year" class="w-full bg-gray-800 border-gray-700 rounded-xl text-white" required>
                            <option value="">اختر السنة</option>
                            @for ($year = date('Y'); $year >= 1990; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- وصف العطل -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold mb-2"><svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> وصف العطل</label>
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
                        <label class="block text-sm font-semibold mb-2"><svg class="w-4 h-4 mr-1.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> صور المشكلة (الحد الأقصى 10 صور)</label>
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
                        <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> إرسال الطلب إلى الورشة
                    </button>

                </form>

            </div>
        </div>
    </div>


<script>
    const carData = {
        'Mercedes-Benz': ['C-Class', 'E-Class', 'S-Class', 'A-Class', 'GLC', 'GLE', 'G-Class'],
        'BMW': ['3 Series', '5 Series', '7 Series', 'X1', 'X3', 'X5', 'X6', 'M4'],
        'Audi': ['A3', 'A4', 'A6', 'Q3', 'Q5', 'Q7', 'Q8', 'e-tron'],
        'Toyota': ['Corolla', 'Camry', 'Yaris', 'Hilux', 'Land Cruiser', 'RAV4', 'Prado'],
        'Volkswagen': ['Golf', 'Polo', 'Passat', 'Tiguan', 'Touareg', 'Arteon'],
        'Hyundai': ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Accent', 'Kona'],
        'Kia': ['Sportage', 'Sorento', 'Cerato', 'Optima', 'Rio', 'Telluride'],
        'Ford': ['Mustang', 'F-150', 'Focus', 'Fiesta', 'Explorer', 'Escape'],
        'Chevrolet': ['Camaro', 'Corvette', 'Silverado', 'Tahoe', 'Malibu', 'Cruze'],
        'Nissan': ['Altima', 'Maxima', 'Sunny', 'Patrol', 'X-Trail', 'Qashqai'],
        'Honda': ['Civic', 'Accord', 'CR-V', 'HR-V', 'Pilot', 'City'],
        'Peugeot': ['208', '308', '2008', '3008', '5008', '508'],
        'Renault': ['Clio', 'Megane', 'Captur', 'Kadjar', 'Symbol', 'Duster']
    };

    function updateModels() {
        const brandSelect = document.getElementById('brand-select');
        const modelSelect = document.getElementById('model-select');
        const selectedBrand = brandSelect.value;
        
        modelSelect.innerHTML = '<option value="">اختر الموديل</option>';
        if (selectedBrand && carData[selectedBrand]) {
            carData[selectedBrand].forEach(function(model) {
                const option = document.createElement('option');
                option.value = model;
                option.textContent = model;
                modelSelect.appendChild(option);
            });
        }
        
        const otherOption = document.createElement('option');
        otherOption.value = 'other';
        otherOption.textContent = 'أخرى (كتابة يدوية)';
        modelSelect.appendChild(otherOption);
        
        checkCustomModel();
    }

    function checkCustomModel() {
        const modelSelect = document.getElementById('model-select');
        const customModelInput = document.getElementById('custom-model-input');
        if (modelSelect.value === 'other') {
            customModelInput.classList.remove('hidden');
            customModelInput.setAttribute('required', 'required');
            customModelInput.setAttribute('name', 'model');
            modelSelect.removeAttribute('name');
        } else {
            customModelInput.classList.add('hidden');
            customModelInput.removeAttribute('required');
            customModelInput.removeAttribute('name');
            modelSelect.setAttribute('name', 'model');
        }
    }
</script>

</x-app-layout>
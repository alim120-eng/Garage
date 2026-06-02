<x-app-layout>
    <div class="py-12 text-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-600 text-white p-4 mb-6 rounded-lg font-bold text-center">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-xl font-bold mb-6">🚗 السيارات المتاحة في المعرض</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($vehicles as $vehicle)
                    <div class="bg-gray-800 p-6 rounded-xl border border-gray-750 flex flex-col justify-between">
                        <div>
                            <!-- Image Container -->
                            <div class="mb-4">
                                @if(is_array($vehicle->images) && count($vehicle->images) > 0)
                                    <div class="relative w-full h-44 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow-lg hover:brightness-110 transition duration-300"
                                         onclick="openLightbox({{ json_encode($vehicle->images) }}, 0)">
                                        <img src="{{ $vehicle->images[0] }}" class="w-full h-full object-cover">
                                        <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur px-2.5 py-1 rounded-lg text-white text-xs font-bold flex items-center gap-1.5 border border-white/10">
                                            📷 {{ count($vehicle->images) }} صور
                                        </div>
                                    </div>
                                @elseif($vehicle->image)
                                    <div class="relative w-full h-44 rounded-xl overflow-hidden cursor-pointer border border-gray-700/60 shadow-lg hover:brightness-110 transition duration-300"
                                         onclick="openLightbox({{ json_encode([$vehicle->image]) }}, 0)">
                                        <img src="{{ $vehicle->image }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-full h-44 rounded-xl bg-gray-900 border border-gray-850 flex flex-col items-center justify-center text-gray-500 gap-1.5">
                                        <span class="text-3xl">📷</span>
                                        <span class="text-xs">لا توجد صور متوفرة</span>
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-lg font-bold text-white">{{ $vehicle->brand }} - {{ $vehicle->model }}</h3>
                            <p class="text-gray-400 text-xs mt-1">النوع: {{ $vehicle->type }} | سنة: {{ $vehicle->year }}</p>
                            <p class="text-emerald-400 font-extrabold text-lg mt-2">{{ number_format($vehicle->price) }} $</p>
                        </div>
                        
                        <form action="{{ route('sale.buy', $vehicle->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2.5 rounded-xl font-bold w-full transition shadow-lg shadow-blue-500/20">
                                شراء الآن
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-3 text-center p-6 bg-gray-800 rounded-lg text-gray-450">
                        لا توجد أي سيارات متاحة للبيع في قاعدة البيانات حالياً! 
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
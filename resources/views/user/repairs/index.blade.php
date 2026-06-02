<x-app-layout>
    <div class="py-12 text-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-600 text-white p-4 mb-6 rounded-lg font-bold text-center">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-xl font-bold mb-6">🚗 السيارات المتاحة في المعرض</h2>
            
            
            </div>

        </div>
    </div>
</x-app-layout>
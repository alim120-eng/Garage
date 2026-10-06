<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            رسائل التواصل من العملاء
        </h2>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if($messages->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-right border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="p-3 border-b dark:border-gray-600">التاريخ</th>
                                        <th class="p-3 border-b dark:border-gray-600">الاسم</th>
                                        <th class="p-3 border-b dark:border-gray-600">رقم الهاتف / البريد</th>
                                        <th class="p-3 border-b dark:border-gray-600">الرسالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $msg)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-750">
                                        <td class="p-3">{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="p-3 font-semibold">{{ $msg->name }}</td>
                                        <td class="p-3">{{ $msg->phone }}</td>
                                        <td class="p-3 whitespace-pre-line">{{ $msg->message }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-8">لا توجد رسائل تواصل حالياً.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

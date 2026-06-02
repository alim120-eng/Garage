<x-app-layout>
    <div class="py-6 min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-black text-gray-100 flex flex-col justify-between">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full flex-1 flex flex-col space-y-4">
            
            <!-- Chat Info Header Card -->
            <div class="bg-gray-900/40 backdrop-blur-md border border-gray-800 rounded-3xl p-5 shadow-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-3.5">
                    <span class="p-3 bg-blue-600/10 text-blue-400 border border-blue-500/20 rounded-2xl text-xl">💬</span>
                    <div>
                        <h1 class="text-lg font-black text-white">
                            محادثة تفاوض: {{ $order->vehicle->brand }} {{ $order->vehicle->model }}
                        </h1>
                        <p class="text-xs text-gray-400 mt-1">
                            المشتري: <span class="font-semibold text-gray-200">{{ $order->user->name }}</span> | 
                            البائع: <span class="font-semibold text-gray-200">{{ $order->vehicle->seller->name ?? 'الكراج' }}</span>
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <span class="text-xs text-gray-400">حالة الطلب:</span>
                    @if($order->status === 'pending')
                        <span class="px-2.5 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold rounded-full">قيد الانتظار</span>
                    @elseif($order->status === 'approved')
                        <span class="px-2.5 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold rounded-full">مكتمل ومقبول</span>
                    @else
                        <span class="px-2.5 py-0.5 bg-rose-500/10 text-rose-450 border border-rose-500/20 text-xs font-bold rounded-full">مرفوض</span>
                    @endif
                    <a href="{{ route('dashboard') }}" class="text-xs bg-gray-800 hover:bg-gray-750 px-3 py-1.5 rounded-xl border border-gray-700 transition mr-auto">
                        ← رجوع للوحة التحكم
                    </a>
                </div>
            </div>

            <!-- Chat Message Area -->
            <div class="flex-1 bg-gray-900/20 border border-gray-800 rounded-3xl p-6 shadow-2xl flex flex-col justify-between min-h-[50vh] max-h-[60vh] overflow-hidden">
                
                <!-- Scrollable Messages Container -->
                <div id="messages-container" class="flex-1 overflow-y-auto space-y-4 pr-1 scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-transparent">
                    @forelse($messages as $msg)
                        @php
                            $isMe = ($msg->sender_id === auth()->id());
                        @endphp
                        
                        <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-[10px] font-bold text-gray-400">{{ $msg->sender->name }}</span>
                                <span class="text-[8px] text-gray-500">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <div class="max-w-[70%] p-3.5 rounded-2xl text-sm leading-relaxed {{ $isMe ? 'bg-blue-600 text-white rounded-tr-none' : 'bg-gray-850 text-gray-200 rounded-tl-none border border-gray-800' }}">
                                {!! nl2br(e($msg->message)) !!}
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex flex-col items-center justify-center text-gray-500 space-y-2">
                            <span class="text-4xl">👋</span>
                            <p class="text-xs font-bold">لا توجد أي رسائل في هذه المحادثة بعد.</p>
                            <p class="text-[10px] text-gray-650">ابدأ المحادثة الآن واتفق على السعر وموعد المعاينة والتسليم.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Input Message Form -->
                <div class="pt-4 border-t border-gray-800/80 mt-4">
                    <form action="{{ route('chat.store', $order->id) }}" method="POST" class="flex gap-3">
                        @csrf
                        <input type="text" 
                               name="message" 
                               placeholder="اكتب رسالتك هنا للتفاوض مع الطرف الآخر..." 
                               class="flex-1 bg-gray-800 border-gray-700 rounded-2xl text-white py-3 px-4 focus:ring-blue-500 focus:outline-none placeholder-gray-500 text-sm"
                               required
                               autocomplete="off">
                        
                        <button type="submit" 
                                class="px-6 bg-blue-650 hover:bg-blue-600 text-white font-bold rounded-2xl transition shadow-lg shadow-blue-500/20 flex items-center justify-center">
                            <span>إرسال</span>
                            <span class="mr-1.5">🚀</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Scroll down logic -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const container = document.getElementById("messages-container");
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        });
    </script>
</x-app-layout>

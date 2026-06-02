<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Message;

class ChatController extends Controller
{
    public function show($order_id)
    {
        $order = Order::with(['vehicle.seller', 'user'])->findOrFail($order_id);

        $buyerId = $order->user_id;
        $sellerId = $order->vehicle->user_id;

        // تأمين المحادثة: المشتري أو البائع فقط
        if (auth()->id() !== $buyerId && auth()->id() !== $sellerId) {
            abort(403, 'غير مصرح لك بالدخول لهذه المحادثة الخاصة.');
        }

        $messages = Message::with('sender')
            ->where('order_id', $order->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.show', compact('order', 'messages'));
    }

    public function store(Request $request, $order_id)
    {
        $order = Order::with('vehicle')->findOrFail($order_id);

        $buyerId = $order->user_id;
        $sellerId = $order->vehicle->user_id;

        if (auth()->id() !== $buyerId && auth()->id() !== $sellerId) {
            abort(403, 'غير مصرح لك بإرسال رسائل في هذه المحادثة.');
        }

        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        Message::create([
            'order_id' => $order->id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح.');
    }
}

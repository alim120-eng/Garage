<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index($vehicle_id)
    {
        $vehicle = Vehicle::findOrFail($vehicle_id);

        if ($vehicle->status !== 'available') {
            return redirect()->route('sale.index')->with('error', '⚠️ هذه السيارة لم تعد متاحة للشراء!');
        }

        if ($vehicle->user_id === auth()->id()) {
            return redirect()->route('sale.index')->with('error', '⚠️ لا يمكنك شراء سيارتك الخاصة!');
        }

        return view('checkout', compact('vehicle'));
    }

    public function store(Request $request, $vehicle_id)
    {
        $vehicle = Vehicle::findOrFail($vehicle_id);

        if ($vehicle->status !== 'available') {
            return redirect()->route('sale.index')->with('error', '⚠️ هذه السيارة لم تعد متاحة للشراء!');
        }

        if ($vehicle->user_id === auth()->id()) {
            return redirect()->route('sale.index')->with('error', '⚠️ لا يمكنك شراء سيارتك الخاصة!');
        }

        $request->validate([
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        Order::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $vehicle->id,
            'status' => 'pending',
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,
        ]);

        $vehicle->update(['status' => 'sold']);

        return redirect()->route('dashboard')->with('success', '🎉 تم إرسال طلب الشراء بنجاح! يمكنك تتبع الطلب وبدء المحادثة من لوحة التحكم.');
    }
}

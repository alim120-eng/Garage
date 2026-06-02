<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Vehicle;

class AdminOrderController extends Controller
{
    /**
     * Update the status of a vehicle purchase order.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        // Sync associated vehicle status
        $vehicle = Vehicle::find($order->vehicle_id);
        if ($vehicle) {
            if ($request->status === 'approved') {
                $vehicle->update(['status' => 'sold']);
            } else {
                $vehicle->update(['status' => 'available']);
            }
        }

        return redirect()->back()->with('success', '🎉 تم تحديث حالة طلب الشراء بنجاح وتزامن حالة السيارة!');
    }

    /**
     * Delete/Cancel a purchase order.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Reset vehicle status if order is deleted
        $vehicle = Vehicle::find($order->vehicle_id);
        if ($vehicle) {
            $vehicle->update(['status' => 'available']);
        }

        $order->delete();

        return redirect()->back()->with('success', '🎉 تم حذف طلب الشراء بنجاح وإعادة السيارة للمعرض!');
    }
}

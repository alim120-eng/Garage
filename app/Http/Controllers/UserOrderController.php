<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\RepairOrder;
use App\Models\Vehicle;

class UserOrderController extends Controller
{
    /**
     * Display the client's unified dashboard (Orders + Repairs)
     */
    public function index()
    {
        $user = auth()->user();
        
        // Fetch orders where the user is the BUYER
        $orders = Order::with(['vehicle.seller'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();
            
        // Fetch repairs requested by this user
        $repairs = RepairOrder::where('user_id', $user->id)
            ->latest()
            ->get();

        // Fetch sales orders where the user is the SELLER (C2C sales)
        $salesOrders = Order::with(['vehicle', 'user'])
            ->whereHas('vehicle', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->get();

        // Fetch vehicles listed for sale by this user
        $myListedVehicles = Vehicle::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('user.dashboard', compact('orders', 'repairs', 'salesOrders', 'myListedVehicles'));
    }

    /**
     * Delete/Cancel a vehicle purchase order
     */
    public function destroy($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // When order is cancelled/deleted, reset vehicle status to available
        $vehicle = Vehicle::find($order->vehicle_id);
        if ($vehicle) {
            $vehicle->update(['status' => 'available']);
        }

        $order->delete();

        return redirect()->route('dashboard')->with('success', '🎉 تم إلغاء طلب شراء السيارة بنجاح، وإرجاع السيارة إلى المعرض!');
    }

    /**
     * Cancel/Delete a repair order (only if pending)
     */
    public function destroyRepair($id)
    {
        $repair = RepairOrder::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($repair->status !== 'pending') {
            return redirect()->route('dashboard')->with('error', '⚠️ لا يمكن إلغاء طلب صيانة بدأ العمل عليه أو تم إنجازه!');
        }

        $repair->delete();

        return redirect()->route('dashboard')->with('success', '🎉 تم إلغاء طلب الصيانة بنجاح!');
    }

    /**
     * Show details of a purchased/ordered car dynamically
     */
    public function showCar($id)
    {
        // Check if user has an order for this vehicle
        $order = Order::where('vehicle_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$order) {
            abort(403, 'Unauthorized access to this vehicle details.');
        }

        $vehicle = Vehicle::findOrFail($id);

        return view('my-cars.show', compact('vehicle', 'order'));
    }

    /**
     * Seller approves or rejects a C2C order on their car
     */
    public function sellerUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $order = Order::with('vehicle')->findOrFail($id);

        if ($order->vehicle->user_id !== auth()->id()) {
            abort(403, 'غير مصرح لك بإدارة هذا الطلب.');
        }

        $order->update([
            'status' => $request->status,
        ]);

        if ($request->status === 'approved') {
            $order->vehicle->update(['status' => 'sold']);
            $msg = '🎉 تم قبول طلب الشراء بنجاح وإتمام عملية البيع!';
        } else {
            $order->vehicle->update(['status' => 'available']);
            $msg = '❌ تم رفض طلب الشراء، وإعادة السيارة لمعرض البيع.';
        }

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Seller cancels/deletes a C2C order on their car
     */
    public function sellerDestroyOrder($id)
    {
        $order = Order::with('vehicle')->findOrFail($id);

        if ($order->vehicle->user_id !== auth()->id()) {
            abort(403, 'غير مصرح لك بحذف هذا الطلب.');
        }

        $order->vehicle->update(['status' => 'available']);
        $order->delete();

        return redirect()->back()->with('success', '🎉 تم إلغاء وحذف طلب الشراء بنجاح، وإرجاع السيارة للمعرض.');
    }
}


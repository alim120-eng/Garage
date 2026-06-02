<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairOrder;

class AdminRepairController extends Controller
{
    /**
     * Update the status, cost, and duration of a repair order
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
            'cost' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:100',
        ]);

        $repair = RepairOrder::findOrFail($id);
        
        $repair->update([
            'status' => $request->status,
            'cost' => $request->cost,
            'duration' => $request->duration,
        ]);

        return redirect()->back()->with('success', '🎉 تم تحديث حالة طلب الصيانة والتفاصيل بنجاح!');
    }

    /**
     * Remove the specified repair order.
     */
    public function destroy($id)
    {
        $repair = RepairOrder::findOrFail($id);
        $repair->delete();

        return redirect()->back()->with('success', '🎉 تم حذف طلب الصيانة بنجاح!');
    }
}


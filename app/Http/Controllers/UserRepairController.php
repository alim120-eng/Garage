<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairOrder;

class UserRepairController extends Controller
{
    public function create() {
        return view('user.repairs.create');
    }

    public function store(Request $request) {
        $request->validate([
            'type' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'issue' => 'required',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            // Ensure public/uploads/repairs directory exists
            if (!file_exists(public_path('uploads/repairs'))) {
                mkdir(public_path('uploads/repairs'), 0777, true);
            }

            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/repairs'), $filename);
                $imagePaths[] = '/uploads/repairs/' . $filename;
            }
        }

        RepairOrder::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'issue' => $request->issue,
            'status' => 'pending',
            'image' => $imagePaths[0] ?? null,
            'images' => $imagePaths,
        ]);

        return redirect()->route('dashboard')->with('success', 'تم إرسال طلب الإصلاح بنجاح، ننتظر مراجعة الأدمن!');
    }

    public function index() {
        $repairs = auth()->user()->repairOrders;
        return view('user.repairs.index', compact('repairs'));
    }
}
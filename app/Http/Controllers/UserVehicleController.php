<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class UserVehicleController extends Controller
{
    public function create()
    {
        return view('user.vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:100',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'mileage' => 'nullable|integer|min:0',
            'fuel_type' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:2000',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            if (!file_exists(public_path('uploads/vehicles'))) {
                mkdir(public_path('uploads/vehicles'), 0777, true);
            }
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/vehicles'), $filename);
                $imagePaths[] = '/uploads/vehicles/' . $filename;
            }
        }

        Vehicle::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'price' => $request->price,
            'mileage' => $request->mileage,
            'fuel_type' => $request->fuel_type,
            'color' => $request->color,
            'description' => $request->description,
            'status' => 'available',
            'image' => $imagePaths[0] ?? null,
            'images' => $imagePaths,
        ]);

        return redirect()->route('dashboard')->with('success', '🎉 تم عرض سيارتك للبيع في معرض السيارات بنجاح!');
    }
}

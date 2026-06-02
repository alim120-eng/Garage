<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class AdminVehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::latest()->get();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:100',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,repairing,sold',
            'image' => 'nullable|string|max:255',
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

        $data = $request->except(['images']);
        $data['images'] = $imagePaths;
        if (empty($data['image']) && !empty($imagePaths)) {
            $data['image'] = $imagePaths[0];
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicles.index')->with('success', '🎉 تم إضافة السيارة بنجاح لمعرض البيع!');
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:100',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,repairing,sold',
            'image' => 'nullable|string|max:255',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $data = $request->except(['images']);

        if ($request->hasFile('images')) {
            // Delete old uploaded images if any
            if (is_array($vehicle->images)) {
                foreach ($vehicle->images as $oldImage) {
                    if (str_starts_with($oldImage, '/uploads/vehicles/')) {
                        $oldPath = public_path($oldImage);
                        if (file_exists($oldPath)) {
                            @unlink($oldPath);
                        }
                    }
                }
            }

            if (!file_exists(public_path('uploads/vehicles'))) {
                mkdir(public_path('uploads/vehicles'), 0777, true);
            }
            $imagePaths = [];
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/vehicles'), $filename);
                $imagePaths[] = '/uploads/vehicles/' . $filename;
            }
            $data['images'] = $imagePaths;
            if (empty($data['image']) && !empty($imagePaths)) {
                $data['image'] = $imagePaths[0];
            }
        }

        $vehicle->update($data);

        return redirect()->route('admin.vehicles.index')->with('success', '🎉 تم تحديث بيانات السيارة بنجاح!');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', '🎉 تم حذف السيارة من قاعدة البيانات بنجاح!');
    }
}

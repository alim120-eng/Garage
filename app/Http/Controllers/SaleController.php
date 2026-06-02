<?php
namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Order;

class SaleController extends Controller {
    
    public function index() {
        // جلب السيارات المتاحة للبيع فقط من قاعدة البيانات
        $vehicles = Vehicle::where('status', 'available')->get();
        return view('sale.index', compact('vehicles'));
    }

    public function buy($id) {
        return redirect()->route('checkout.index', $id);
    }
}
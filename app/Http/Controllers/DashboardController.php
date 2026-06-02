<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Order;
use App\Models\RepairOrder;

class DashboardController extends Controller
{
    /**
     * Display the Admin Consolidated Dashboard (Stats + Repair Orders + Purchase Orders)
     */
    public function index()
    {
        // 1. Core Statistics Counts
        $availableVehiclesCount = Vehicle::where('status', 'available')->count();
        $totalOrdersCount = Order::count();
        $activeRepairsCount = RepairOrder::whereIn('status', ['pending', 'in_progress'])->count();
        
        // Calculate Revenue: Approved purchases + completed repairs
        $vehicleRevenue = Order::where('orders.status', 'approved')
            ->join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
            ->sum('vehicles.price');
            
        $repairRevenue = RepairOrder::where('status', 'completed')->sum('cost');
        $totalRevenue = $vehicleRevenue + $repairRevenue;

        // 2. Chart Datasets (Aggregates)
        // Vehicles by Status
        $vehiclesAvailable = Vehicle::where('status', 'available')->count();
        $vehiclesRepairing = Vehicle::where('status', 'repairing')->count();
        $vehiclesSold = Vehicle::where('status', 'sold')->count();

        // Repair Orders by Status
        $repairsPending = RepairOrder::where('status', 'pending')->count();
        $repairsInProgress = RepairOrder::where('status', 'in_progress')->count();
        $repairsCompleted = RepairOrder::where('status', 'completed')->count();

        // 3. Lists
        $repairs = RepairOrder::with('user')->latest()->get();
        $orders = Order::with(['user', 'vehicle'])->latest()->get();

        return view('admin.dashboard', compact(
            'availableVehiclesCount',
            'totalOrdersCount',
            'activeRepairsCount',
            'totalRevenue',
            'vehiclesAvailable',
            'vehiclesRepairing',
            'vehiclesSold',
            'repairsPending',
            'repairsInProgress',
            'repairsCompleted',
            'repairs',
            'orders'
        ));
    }
}


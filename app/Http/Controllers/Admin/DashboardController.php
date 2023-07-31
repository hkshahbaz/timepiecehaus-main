<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole(['vendor'])) {
                return redirect('/');
            }
        }

        $totalUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'vendor');
        })->count();

        $orders = Order::all();
        $totalOrders = $orders->count();
        $totalPendingOrders = $orders->where('status_id', '!=', 17)->count();
        $totalCompletedOrders = $orders->where('status_id', '=', 17)->count();
        $totalEarning = Product::whereIsDraft(0)->sum('listing_fee');
        $totalPayable = Product::whereIsDraft(0)->sum('price');
        $totalActiveProducts = Product::whereIsDraft(0)->count();
        $totalDraftedProducts = Product::whereIsDraft(1)->count();


        return view('admin.dashboard', compact('totalUsers',
            'totalPendingOrders', 'totalCompletedOrders', 'totalOrders','totalEarning','totalActiveProducts','totalDraftedProducts','totalPayable'));
    }
}

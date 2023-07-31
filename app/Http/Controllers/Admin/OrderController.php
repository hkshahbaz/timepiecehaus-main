<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use DataTables;

class OrderController extends Controller
{
    private $view;
    private $baseRoute;
    private $imagePath;

    public function __construct()
    {
        $this->view = 'admin.orders.index';
        $this->baseRoute = 'orders.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $orders = Order::withTrashed()->with('status', 'user', 'product');
            return DataTables::eloquent($orders)
                ->addIndexColumn()
                ->editColumn('user', function (Order $order) {
                    return $order->user->getFullName();
                })
                ->editColumn('vendor', function (Order $order) {
                    return $order->vendor->getFullName();
                })
                ->editColumn('price', function (Order $order) {
                    return '$' . $order->price;
                })
                ->editColumn('shipping_cost', function (Order $order) {
                    return '$' . $order->shipping_cost;
                })
                ->editColumn('total_cost', function (Order $order) {
                    return '$' . ($order->shipping_cost + $order->price);
                })
                ->editColumn('name', function (Order $order) {
                    return '<a href="' . route('products.show', [$order->product_id]) . '" target="_blank">' . $order->product->name . '</a>';
                })
                ->editColumn('approved_or_rejected_at', function (Order $order) {
                    if (!is_null($order->approved_or_rejected_at))
                        return date('Y-m-d', strtotime($order->approved_or_rejected_at));
                    return '-';
                })
                ->editColumn('payment_done_at', function (Order $order) {
                    if (!is_null($order->payment_done_at))
                        return date('Y-m-d', strtotime($order->payment_done_at));
                    return '-';
                })
                ->editColumn('deliver_at', function (Order $order) {
                    if (!is_null($order->deliver_at))
                        return date('Y-m-d', strtotime($order->deliver_at));
                    return '-';
                })
                ->editColumn('received_at', function (Order $order) {
                    if (!is_null($order->received_at))
                        return date('Y-m-d', strtotime($order->received_at));
                    return '-';
                })
                ->editColumn('completed_at', function (Order $order) {
                    if (!is_null($order->completed_at))
                        return date('Y-m-d', strtotime($order->completed_at));
                    return '-';
                })
                ->editColumn('status', function (Order $order) {
                    return view('admin.orders.status', compact('order'))->render();
                })
                ->rawColumns(['user', 'vendor', 'name', 'price', 'shipping_cost', 'total_cost', 'status'])
                ->toJson();
        }

        return view($this->view);
    }
}

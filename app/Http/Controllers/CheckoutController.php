<?php

namespace App\Http\Controllers;

use App\Country;
use App\Notifications\OrderStatusUpdate;
use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index(Product $product)
    {
        if (auth()->user()->id == $product->user_id) {
            return redirect()->route('shop.product.detail', [$product->id]);
        }
        $user = auth()->user();
        $countries = Country::whereStatusId(1)->pluck('name', 'id');
        return view('checkout', compact('countries', 'user', 'product'));
    }

    public function submitOrder(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token', 'message', 'checkoutTermsAccepted', 'checkoutCustomsHintConfirmed');
            auth()->user()->update($data);
            $data = [
                'user_id' => auth()->id(),
                'vendor_id' => $product->user_id,
                'product_id' => $product->id,
                'price' => $product->price,
                'shipping_cost' => $product->shipping_cost,
                'status_id' => 11,
                'message' => $request->message,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ];
            $order = Order::create($data);
            $user = User::whereId($order->user_id)->first();
            $description = "Congratulations! " . auth()->user()->getFullName() . " Your order request is pending against Order No. TP#$order->id!";
            $action = url('/my-account#order-requests');
            $user->notify(new OrderStatusUpdate($description, $action));

            $vendor = User::whereId($order->vendor_id)->first();
            $description = "Congratulations! " . $vendor->getFullName() . " Your have one request against Order No. TP#$order->id!";
            $action = url('/my-account#order-requests');
            $vendor->notify(new OrderStatusUpdate($description, $action));
            DB::commit();
            session()->flash('message', 'Order # TP#' . $order->id . ' Created Successfully!');
            return redirect()->route('my-account');
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error('Error: ' . $ex->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function updateStatus(Request $request, Order $order)
    {
        try {
            $description = '';
            $status_id = $request->status_id;
            if ($status_id > $order->status_id) {
                $data = ['status_id' => $request->status_id];
                if ($status_id == 12 || $status_id == 13) {
                    $data['approved_or_rejected_at'] = Carbon::now()->format('Y-m-d H:i:s');
                    if ($status_id == 12) {
                        $description = "Congratulations! Your Order No. TP#$order->id has approved by Vendor!";
                    }
                    if ($status_id == 13) {
                        $description = "Sorry! Your Order No. TP#$order->id has rejected by Vendor!";
                    }
                    $user = User::whereId($order->user_id)->first();
                } else if ($status_id == 14) {
                    $user = User::whereId($order->vendor_id)->first();
                    $description = "Congratulations! " . auth()->user()->getFullName() . " Paid Payment against Order No. TP#$order->id!";
                    $action = url('/my-account#order-requests');
                    $data['payment_done_at'] = Carbon::now()->format('Y-m-d H:i:s');
                } else if ($status_id == 15) {
                    $user = User::whereId($order->user_id)->first();
                    $description = "Congratulations! " . auth()->user()->getFullName() . " Delivered against Order No. TP#$order->id!";
                    $action = url('/my-account#order-requests');
                    $data['deliver_at'] = Carbon::now()->format('Y-m-d H:i:s');

                } else if ($status_id == 16) {
                    $user = User::whereId($order->vendor->id)->first();
                    $description = "Congratulations! " . auth()->user()->getFullName() . " Received against Order No. TP#$order->id!";
                    $action = url('/my-account#order-requests');
                    $data['received_at'] = Carbon::now()->format('Y-m-d H:i:s');

                } else if ($status_id == 17) {
                    $user = User::whereId($order->vendor_id)->first();
                    $description = "Congratulations! " . auth()->user()->getFullName() . " Complete against Order No. TP#$order->id!";
                    $action = url('/my-account#order-requests');
                    $data['completed_at'] = Carbon::now()->format('Y-m-d H:i:s');
                }
                $order->update($data);
                $user->notify(new OrderStatusUpdate($description, $action));
                session()->flash('success', true);
                session()->flash('msg', 'Order status updated successfully!');
                return response()->json(['success' => true, 'message' => 'Order Status updated Successfully!']);
            }
        } catch (\Exception $ex) {
            Log::error('Error: ' . $ex->getMessage());
            session()->flash('error', true);
            session()->flash('msg', 'Something went wrong!');
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }
    }

    public function getOrderDetail($id)
    {
        if ($id) {
            $order = Order::whereId($id)->with(['product', 'vendor', 'user', 'status'])->first();
            if ($order) {
                return response()->json(['order' => $order, 'success' => true]);
            }
        }
        return response()->json(['order' => $order, 'success' => false]);
    }
}

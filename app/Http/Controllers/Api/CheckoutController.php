<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Notifications\OrderStatusUpdate;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Carbon\Carbon;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public $successStatus = 200;
    public $createStatus = 201;
    public $badRequest = 400;
    public $accessForbidden = 403;
    public $serverErrorStatus = 500;
    public $notFoundStatus = 404;
    public $tokenString = 'm';

     public function getProductForCheckout($id){
          $productCheckout = DB::table('products')->select('products.id', 'products.shipping_cost','products.name', 'products.price', 'product_pictures.picture')
             ->leftjoin('product_pictures', 'products.id', '=', 'product_pictures.product_id')
             ->where('products.id', '=', $id)
             ->where('products.is_draft', '=', 0)
             ->first();
         $currentUser = User::select('id', 'first_name', 'last_name', 'email', 'phone_no','country_id','street','street_line_2','zip_code','city','state')->where('id', '=', auth()->user()->id)->first();
         return response()->json(['CurrentUser' =>$currentUser,'getProductForCheckout'=>$productCheckout], $this->successStatus);
     }
    public function getAllCountries()
    {
        $countries = Country::select('id', 'name')->get();
        return response()->json(['getAllCountries'=>$countries], $this->successStatus);
    }
    
    
    public function submitOrder(Request $request, Product $product){
         $date=\Carbon\Carbon::now();
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
            'updated_by' => auth()->id(),
            'paypal_payer_id'=>$request->paypal_payer_id,
            'paypal_order_id'=>$request->paypal_order_id,
            'payment_done_at'=>$date
        ];
        if ($product->user_id==auth()->id()){
           return response()->json(['Message'=>"You cannot buy your own products"]);
        }
        else{
            
            $order = Order::create($data);
            $user = User::whereId($order->user_id)->first();
            $description = "Congratulations! " . auth()->user()->getFullName() . " Your order request is pending against Order No. TP#$order->id!";
            $action = url('/my-account#order-requests');
            $user->notify(new OrderStatusUpdate($description, $action));

            $vendor = User::whereId($order->vendor_id)->first();
            $description = "Congratulations! " . $vendor->getFullName() . " Your have one request against Order No. TP#$order->id!";
            $action = url('/my-account#order-requests');
            $vendor->notify(new OrderStatusUpdate($description, $action));
            return response()->json($order,$this->createStatus);
        }
}
    
       public function updatePaypal(Request $request,$id){
       $data= $request->only('paypal_order_id','paypal_payer_id');
       $date=\Carbon\Carbon::now();
       $data['completed_at']=date('Y-m-d',strtotime($date));
       Product::where('id','=',$id)->update($data);
       return response()->json(['message'=>'Successfully received payment']);
    }
}

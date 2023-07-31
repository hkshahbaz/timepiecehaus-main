<?php

namespace App\Http\Controllers;

use App\Product;
use Cart;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Product $product
     * @return void
     */
    public function store(Product $product)
    {
        Cart::remove($product->id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'currency' => $product->currency->symbol,
                'picture' => $product->productPictures()->first()->picture
            ]
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        try {
            Cart::remove($id);
            return response()->json(['success' => true, 'count' => Cart::getContent()->count(), 'subtotal' => Cart::getSubTotal(), 'total' => Cart::getTotal(), 'message' => 'Successfully deleted!']);
        } catch (\Exception $ex) {
            Log::error($ex);
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }
    }
}

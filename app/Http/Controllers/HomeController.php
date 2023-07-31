<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        if(auth()->check()){
            if(auth()->user()->hasRole(['admin'])){
                return redirect('/dashboard');
            }
        }

        $products = Product::whereIsDraft(0)->whereStatusId(3)->get();
        $productsAsc= Product::whereIsDraft(0)->whereStatusId(3)->latest()->get();
        return view('home', compact('products','productsAsc'));
    }
}

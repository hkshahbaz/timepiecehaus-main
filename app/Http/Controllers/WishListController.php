<?php

namespace App\Http\Controllers;

use App\Product;
use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = auth()->user()->wishListProducts()->get();
//        $wishLists = WishList::with(['user', 'product'])->whereUserId(auth()->user())->get();
        return view('wishlist', compact('products'));
    }
    
     public function getAllWishLists()
    {
        // $wishLists = DB::table('wish_lists')
        //     ->leftjoin('products', 'wish_lists.product_id', '=', 'products.id')
        //     ->rightjoin('users', 'products.user_id', '=', 'users.id')
        //     ->leftjoin('product_pictures', 'products.id', '=', 'product_pictures.product_id')
        //     ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
        //     ->leftJoin('countries', 'products.user_id', '=', 'countries.id')
        //     ->where('wish_lists.user_id', '=',auth()->id())
        //     ->whereNull('product_pictures.deleted_at')
        //     ->select('wish_lists.id as wishList_id','users.first_name','users.last_name','countries.flag', 'products.id as product_id', 'products.name','products.user_id',
        //         'products.price', 'product_pictures.picture',DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('products.id')
        //     ->groupBy('wish_lists.product_id')
        //     ->get();
        $wishLists = auth()->user()->wishListProducts()->get();
        return response()->json(['getAllWishLists'=>$wishLists], $this->successStatus);
    }

    public function delete(Product $product)
    {
        try {
            $product->wishLists()->whereUserId(auth()->id())->delete();
            return response()->json(['success' => true, 'total' => auth()->user()->wishLists()->count(), 'message' => 'Successfully deleted!']);
        } catch (\Exception $ex) {
            Log::error($ex);
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }
    }

    public function updateWishList(Request $request, Product $product)
    {
        if ($request->has('is_added')) {
            if ($request->is_added == 0) {
                $data = [
                    'user_id' => auth()->id(),
                    'product_id' => $product->id
                ];
                WishList::updateOrCreate($data, $data);
                return response()->json([
                    'success' => true,
                    'is_added' => 1,
                    'total' => auth()->user()->wishLists()->count(),
                    'message' => 'Successfully added!'
                ]);
            } else {
                $product->wishLists()->whereUserId(auth()->id())->delete();
                return response()->json([
                    'success' => true,
                    'is_added' => 0,
                    'total' => auth()->user()->wishLists()->count(),
                    'message' => 'Successfully deleted!'
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'total' => auth()->user()->wishLists()->count(),
            'message' => 'Something went wrong!'
        ]);
    }
}

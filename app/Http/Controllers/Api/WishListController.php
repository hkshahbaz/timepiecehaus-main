<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductRating;
use App\WishList;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WishListController extends Controller
{
    public $successStatus = 200;
    public $createStatus = 201;
    public $badRequest = 400;
    public $accessForbidden = 403;
    public $serverErrorStatus = 500;
    public $notFoundStatus = 404;
    public $tokenString = 'm';

    public function getAllWishLists()
    {
         $wishLists = DB::table('wish_lists')
            ->leftjoin('products', 'wish_lists.product_id', '=', 'products.id')
            ->leftJoin('users', 'wish_lists.user_id', '=', 'users.id')
            ->leftjoin('product_pictures', 'products.id', '=', 'product_pictures.product_id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->leftJoin('countries', 'products.user_id', '=', 'countries.id')
            ->where('wish_lists.user_id', '=', auth()->id())
            ->whereNull('product_pictures.deleted_at')
            ->select('wish_lists.id as wishList_id','users.first_name','users.last_name','countries.flag','wish_lists.user_id', 'products.id as product_id', 'products.name',
                'products.price', 'product_pictures.picture',DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('products.id')
            ->groupBy('wish_lists.product_id')
            ->get();
        return response()->json(['getAllWishLists'=>$wishLists], $this->successStatus);
    }
      public function addWishList(Request $request){
        $validator=Validator::make($request->all(),[
            'product_id' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json($validator->messages()->all(),$this->successStatus);
        }
        $data=$request->only('product_id');
        $numWishList=WishList::where('product_id',$request->product_id)->where('user_id',auth()->id())->get();
        if ($numWishList->count()>0){
            return response()->json(['message'=>'You have already created a wishList']);
        }
        else{
            $data['user_id']=auth()->user()->id;
            WishList::create($data);
            return response()->json(['messages' =>'Product add successfully to the wishList'],$this->successStatus);
        }
    }
    
    public function wishListDelete(Product $product)
    {
            $product->wishLists()->where('user_id' ,'=',auth()->user()->id)->delete();
            return response()->json(['message' => 'Successfully deleted!']);
    }
    public function wishListSearchByProductName(Request $request){
        $wishLists = DB::table('wish_lists')
            ->leftjoin('products', 'wish_lists.product_id', '=', 'products.id')
            ->leftjoin('product_pictures', 'products.id', '=', 'product_pictures.product_id')
            ->where('wish_lists.user_id', '=', auth()->id())
            ->whereNull('product_pictures.deleted_at')
            ->select('wish_lists.id as wishlist_id','wish_lists.user_id', 'products.id as product_id', 'products.name', 'products.price', 'product_pictures.picture')
            ->groupBy('wish_lists.product_id')
               ->where('products.name', 'like', "%{$request->get('name')}%")
               ->get();
          
               return response()->json(['getAllWishLists'=>$wishLists],$this->successStatus);
          
    }
}

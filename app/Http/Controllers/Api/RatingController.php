<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public $successStatus = 200;
    public $createStatus = 201;
    public $badRequest = 400;
    public $accessForbidden = 403;
    public $serverErrorStatus = 500;
    public $notFoundStatus = 404;
    public $tokenString = 'm';

    public function addProductRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required',
            'rating' => 'required|min:1|max:5',
            'product_id' => 'required|unique:product_ratings,product_id'
        ]);
        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()->all()], $this->badRequest);
        }
        $data = $request->only('review', 'rating', 'product_id');
        $data['user_id'] = auth()->user()->id;
        ProductRating::create($data);
        return response()->json($data, $this->successStatus);
    }
    
    public function getSingleProductWithAllRating($id){
        $productRating=ProductRating::select('id','rating','review')->where('product_id','=',$id)->get();
        return response()->json($productRating,$this->successStatus);
    }
}

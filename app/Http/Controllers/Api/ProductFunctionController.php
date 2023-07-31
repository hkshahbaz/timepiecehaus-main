<?php

namespace App\Http\Controllers\Api;

use App\ProductFunction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductFunctionController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $notFoundStatus=404;
    public $serverErrorStatus=500;
    public $tokenString='m';

    public function getAllProductFunction(){
        $productFunctions=ProductFunction::select('id','name')->get();
        return response()->json(['getAllProductFunction'=>$productFunctions],$this->successStatus);
    }
}

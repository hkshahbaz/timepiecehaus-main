<?php

namespace App\Http\Controllers\Api;

use App\BraceletColor;
use App\BraceletMaterial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BraceletMaterialController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $notFoundStatus=404;
    public $serverErrorStatus=500;
    public $tokenString='m';

    public function getAllBraceletMaterial(){
        $braceletMaterial=BraceletMaterial::select('id','name')->get();
        return response()->json(['getAllBraceletMaterial'=>$braceletMaterial],$this->successStatus);
    }
    public function getAllBraceletColor(){
        $braceletColor=BraceletColor::select('id','name')->get();
        return response()->json(['getAllBraceletColor'=>$braceletColor],$this->successStatus);
    }
}

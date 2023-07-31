<?php

namespace App\Http\Controllers\Api;

use App\WaterResistance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WaterResistanceController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $notFoundStatus=404;
    public $serverErrorStatus=500;
    public $tokenString='m';

    public function getAllWaterResistance(){
        $waterResistances=WaterResistance::select('id','name')->get();
        return response()->json(['getAllWaterResistance'=>$waterResistances],$this->successStatus);
    }
}

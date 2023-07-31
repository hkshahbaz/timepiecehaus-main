<?php

namespace App\Http\Controllers\Api;

use App\Dial;
use App\DialFeature;
use App\DialNumeral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DialController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $notFoundStatus=404;
    public $serverErrorStatus=500;
    public $tokenString='m';

    public function getAllDial(){
        $dials=Dial::select('id','name')->get();
        return response()->json(['getAllDial'=>$dials],$this->successStatus);
    }
    public function getAllDialNumeral(){
        $dialNumerals=DialNumeral::select('id','name')->get();
        return response()->json(['getAllDialNumeral'=>$dialNumerals],$this->successStatus);
    }
    public function getAllDialFeature(){
        $dialFeatures=DialFeature::select('id','name')->get();
        return response()->json(['getAllDialFeature'=>$dialFeatures],$this->successStatus);
    }
}

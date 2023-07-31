<?php

namespace App\Http\Controllers\Api;

use App\ClaspMaterial;
use App\ClaspType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeOfClaspController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $notFoundStatus=404;
    public $serverErrorStatus=500;
    public $tokenString='m';

    public function getAllClaspType(){
          $claspType=ClaspType::select('id','name')->get();
          return response()->json(['getAllClaspType'=>$claspType],$this->successStatus);
    }

    public function getAllClaspMaterial(){
        $claspMaterial=ClaspMaterial::select('id','name')->get();
        return response()->json(['getAllClaspMaterial'=>$claspMaterial],$this->successStatus);
    }

}

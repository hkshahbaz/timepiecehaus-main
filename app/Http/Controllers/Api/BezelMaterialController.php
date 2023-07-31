<?php

namespace App\Http\Controllers\Api;

use App\BezelMaterial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BezelMaterialController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $serverErrorStatus=500;
    public $notFountStatus=404;
    public $tokenString = 'm';

    public function getAllBezelMaterial(){
        $bezelMaterial=BezelMaterial::select('id','name')->get();
        return response()->json(['getAllBezelMaterial'=>$bezelMaterial],$this->successStatus);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\GlassType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GlassController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $serverErrorStatus=500;
    public $notFountStatus=404;
    public $tokenString = 'm';

    public  function getAllGlassType(){
        $glasses=GlassType::select('id','name')->get();
        return response()->json(['getAllGlassType'=>$glasses],$this->successStatus);
    }
}

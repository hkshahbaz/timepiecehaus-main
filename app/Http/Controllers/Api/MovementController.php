<?php

namespace App\Http\Controllers\Api;

use App\Movement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovementController extends Controller
{
    public  $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $notFoundStatus=403;
    public $accessForbidden=404;
    public $serverErrorStatus=500;

    public function getAllMovement(){
        $movements=Movement::select('id','name')->get();
        return response()->json(['getAllMovement'=>$movements],$this->successStatus);
    }
}

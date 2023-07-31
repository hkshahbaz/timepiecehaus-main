<?php

namespace App\Http\Controllers\Api;

use App\Condition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConditionController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $serverErrorStatus=500;
    public $notFountStatus=404;
    public $tokenString = 'm';

    public function getAllCondition(){
        $conditions=Condition::select('id','name')->get();
        return response()->json(['getAllCondition'=>$conditions],$this->successStatus);
    }

    //
}

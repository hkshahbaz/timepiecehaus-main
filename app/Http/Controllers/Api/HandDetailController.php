<?php

namespace App\Http\Controllers\Api;

use App\HandDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HandDetailController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $notFoundStatus=404;
    public $serverErrorStatus=500;
    public $tokenString='m';

    public function getAllHandDetail(){
        $handDetails=HandDetail::select('id','name')->get();
        return response()->json(['getAllHandDetail'=>$handDetails],$this->successStatus);

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\DeliveryScope;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryScopeController extends Controller
{
    public $successStatus=200;
    public $createStatus=201;
    public $badRequest=400;
    public $accessForbidden=403;
    public $serverErrorStatus=500;
    public $notFoundStatus=404;

    public function getAllDeliveryOfScope(){
        $deliveryScope=DeliveryScope::select('id','name')->get();
        return response()->json(['getAllDeliveryOfScope' =>$deliveryScope],$this->successStatus);

    }

}

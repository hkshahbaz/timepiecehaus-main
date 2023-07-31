<?php

namespace App\Http\Controllers\Api;

use App\DeliveryScope;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
   public $successStatus=200;
   public $createStatus=201;
   public $badRequest=400;
   public $accessForbidden=403;
   public $serverErrorStatus=500;
   public $notFountStatus=404;

   public function getAllCaliberAndCaseMoreSetting(){
       $caliberMoreSettings=DB::table('more_settings')->select('id','name')->get();
       return response()->json(['getAllCaliberAndCaseMoreSetting'=>$caliberMoreSettings],$this->successStatus);
   }

}

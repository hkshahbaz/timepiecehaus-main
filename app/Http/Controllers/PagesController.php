<?php

namespace App\Http\Controllers;

use App\Notifications\ContactNotification;
use App\Notifications\OrderStatusUpdate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    //about-us
    public function aboutUs()
    {
        return view('about-us');
    }

    //contact-us
    public function contactUs()
    {
        return view('contact-us');
    }

    //privacy-policy
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    //faq
    public function faq()
    {
        return view('faq');
    }

    public function sendEmail(Request $request)
    {

       $rules = [
            'captcha' => ['required', 'captcha']
        ];

        $messages = [
            'captcha.captcha' => 'CAPTCHA MISMATCH! Please re-enter captcha',
        ];

        $validator = Validator::make($request->all(), $rules, $messages );

        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
       }
       else{
            $data = $request->except('_token');
            $subject = $data['subject'];
            $description = "Feedback! You have got new email from ".$data['name']." having Email: ".$data['email']." and phone no: ".$data['phone']."with message: ".$data['message'];
            $admin = User::whereId(1)->first();
            $admin->notify(new ContactNotification($subject, $description));
            Session::flash('message', 'Email Sent Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
       }
        
    }
}

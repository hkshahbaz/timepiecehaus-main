<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use Illuminate\Foundation\Auth\VerifiesEmails;

class UserController extends Controller
{
    use VerifiesEmails;

    public $successStatus = 200;
    public $createStatus = 201;
    public $badRequest = 400;
    public $accessForbidden = 403;
    public $notFoundStatus = 404;
    public $serverErrorStatus = 500;
    public $tokenString = 'm';

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->hasRole('vendor')) {
                $user = Auth::user();
                $success['token'] = $user->createToken($this->tokenString)->accessToken;
                $success['user'] = $user;
                return response()->json($success, $this->successStatus);
            }
            elseif(Auth::user()->hasRole('admin')){
                auth()->user()->logout;
                return response()->json('Admin cannot login access');
            }
        } else {
            return response()->json(['message'=>'User not fount!'], $this->notFoundStatus);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return \response()->json(['message'=>'You have been logout successfully'], $this->successStatus);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'email' => 'required|unique:users,email|email|min:5|max:191',
            'password' => 'required|min:8|max:191'
        ]);
        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()->all()], $this->badRequest);
        }

        $user = new User;
        $data = $request->only('first_name', 'last_name', 'email');
        $data['password'] = Hash::make($request->password);
        $user = $user->create($data);
        $success['token'] = $user->createToken($this->tokenString)->accessToken;
        $success['user'] = $user;
        $user->sendApiEmailVerificationNotification();
        $success['message'] = 'Please confirm yourself by clicking on verify user button sent to you on your email';
        return response()->json($success, $this->createStatus);
    }

   public function userPictureUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()->all()], $this->badRequest);
        }
        $user = User::find(Auth::User()->id);
            $user_image = $request->file('image');
            $extension = $user_image->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
         $user_image->move('admin/images/users', $fileName);
            $request['picture'] = $fileName;
        $user->update($request->all());
        return response()->json($user, $this->successStatus);
    }

    public function getCurrentUser()
    {
        $currentUser = User::select('id', 'first_name', 'last_name', 'email', 'phone_no','country_id','street','street_line_2','zip_code','city','picture','state')->where('id', '=', auth()->user()->id)->first();
        return response()->json($currentUser, $this->successStatus);
    }

    public function userUpdate(Request $request)
    {
        $user = User::find(\auth()->user()->id);
        if($user){
            $data = $request->only('first_name', 'last_name','email','phone_no','country_id','street','street_line_2','zip_code','city','state','company_name');
            $user->update($data);
            return \response()->json($user, $this->successStatus);
        }
        else{
            return response()->json('User not found');
        }

    }

}

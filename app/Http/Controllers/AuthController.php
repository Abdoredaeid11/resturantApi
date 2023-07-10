<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\Admin;
use App\Models\User;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{    use GeneralTrait;

    //
    public function login(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('admin-api')->attempt($credentials);
            
            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $admin = Auth::guard('admin-api')->user();
            $admin->api_token = $token;
            //return token
            return $this->returnData('admin', $admin);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }
    public function logout(Request $request){
$token=$request->header('auth-token');
if($token){JWTAuth::setToken($token)->invalidate();
  return  $this->returnSuccessMessage('0011','logged out successfuly!');
}
else 
return $this->returnError('0011','some thing went wrong');

    }
///////////     User Login ************************************************************
public function userlogin(Request $request)
{
    try {
        $rules = [
            "email" => "required",
            "password" => "required"

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        

        //login

        $credentials = $request->only(['email', 'password']);

        $token = Auth::guard('user-api')->attempt($credentials);
        
        if (!$token)
            return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

        $user = Auth::guard('user-api')->user();
        $user->api_token = $token;
        //return token
        return $this->returnData('user', $user  ,'login successfully!');

    } catch (\Exception $ex) {
        return $this->returnError($ex->getCode(), $ex->getMessage());
    }
}
public function register(Request $request){
        $validator=Validator::make($request->all(),[ 
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',]);
            if ($validator->fails()) {
            return $validator->errors()->all();}

            $user=new User([
                'name'=>$request->name,
               'email'=>$request->email,
                'password'=>Hash::make($request->password)
                ]);
                

                $user->save();
                return $this->returnSuccessMessage('User has been registered','200');
            
    }
    public function userlogout(Request $request){

        $token=$request->header('auth-token');
        if($token){JWTAuth::setToken($token)->invalidate();
          return  $this->returnSuccessMessage('0011','logged out successfuly!');
        }
        else 
        return $this->returnError('0011','some thing went wrong');
        
            }
    
}





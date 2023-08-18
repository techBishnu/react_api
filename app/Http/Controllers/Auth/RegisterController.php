<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function Register(Request $request){
        $data=$request->all();

        $validatedData=Validator::make($data,[
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|min:6|confirmed',
            
        ]);
        if($validatedData->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validatedData->errors()
            ]);
        }
        $data['password'] = bcrypt($request->password);
        $user=User::create($data);
        $token=$user->createToken('API Token')->accessToken;
        return response()->json([
            'user'=>$user,
            'token'=>$token
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    public function Login(Request $request){
        // dd($request->all());
        $data=$request->all();
        $validatedData=Validator::make($data,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validatedData->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validatedData->errors()
            ]);
        }
        $user=User::where('email',$data['email'])->first();
        if($user!=null){
            if(!auth()->attempt($data)){
                return response()->json([
                    'status'=>false,
                    'message'=>'Credential does not match!'
                ]);
            }
            
            $token=auth()->user()->createToken('Api Token')->accessToken;
            return response()->json([
                'status'=>true,
                'message'=>'Login successfully!',
                'token'=>$token
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'message'=>'User not found'
            ]);
        }

    }
}

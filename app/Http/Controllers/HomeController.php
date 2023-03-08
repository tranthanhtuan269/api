<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(!Auth::attempt($credentials)){
            return response()->json([
                'code' => '200',
                'message' => 'User login fail'
            ]);
        }else{
            $user = Auth::user();
            $token = $user->createToken('token-'.$user->id, ['none']);
            return response()->json([
                'code' => '200',
                'message' => 'User login success',
                'user' => Auth::User(),
                'token' => $token->plainTextToken
            ]);
        }
    }

    public function Register(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(!Auth::attempt($credentials)){
            $user = new \App\Models\User();
            $user->name = 'Admin';
            $user->email = $credentials['email'];
            $user->password = Hash::make($credentials['password']);
            $user->save();

            $token = $user->createToken('token-'.$user->id, ['none']);
            return ['token' => $token->plainTextToken];
        }else{
            $user = Auth::user();
            $token = $user->createToken('token-'.$user->id, ['none']);
            return ['token' => $token->plainTextToken];
        }
    }
}

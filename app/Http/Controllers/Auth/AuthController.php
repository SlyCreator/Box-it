<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $user = User::create($input);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['user' => $user,'accessToken'=>$accessToken]);
    }

    public function login(Request $request)
    {
        $input = $request->all();
        if(!auth()->attempt($input)){
            return response()->json(['message'=>'Email or password wrong']);
        }
        $accessToken    =   auth()->user()->createToken('accessToken')->accessToken;
        return response()->json(['user'=>auth()->user(),'accessToken'=>$accessToken]);
    }
}

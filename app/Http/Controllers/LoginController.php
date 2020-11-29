<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 400, 'message' => 'Bad Request']);
        }
        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials)){
            return response()->json(['status_code' => 500, 'message' => 'Unauthorized']);
        }

        $user = User::where('email',$request->email)->first();
        $tokenResult = $user->createToken('authtoken')->plainTextToken;
        return response()->json(['status_code' => 200, 'token' => $tokenResult]);

    }
}

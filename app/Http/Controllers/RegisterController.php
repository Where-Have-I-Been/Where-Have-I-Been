<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){
    $validator = Validator::make($request->all(),[
        'email'=>'required',
        'password'=>'required',
    ]);
    if($validator->fails()){
        return response()->json(['status_code'=>400,'message'=>'Bad Request']);
    }
    $user = new User();
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();
        return response()->json(['status_code'=>200,'mesage'=>'Registration Successfully']);

    }
}

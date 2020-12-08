<?php


namespace App\Http\Services\AuthenticationServices;



use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class AppAuthenticationService
{

    public function login(Request $request) : string
    {
        if($this->isNotValidated($request))
            throw new HttpResponseException(response()->json(
                ["message" => "Email and password are required"],  Response::HTTP_BAD_REQUEST));

        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials))
            throw new HttpResponseException(response()->json(
                ["message" => "Wrong email or password"], Response::HTTP_UNAUTHORIZED));

        return $this->generateToken($request->email);
    }

    public function register(Request $request)
    {
        if($this->isNotValidated($request))
            throw new HttpResponseException(response()->json(
                ["message" => "Email and password are required"],  Response::HTTP_BAD_REQUEST));

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
    }

    private function isNotValidated(Request $request) : bool
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        return $validator->fails();
    }

    private function generateToken($email) : string
    {
        $user = User::query()->where('email',$email)->first();
        return $user->createToken('authtoken')->plainTextToken;
    }
}

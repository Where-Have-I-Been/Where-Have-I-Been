<?php


namespace App\Http\Services\AuthenticationServices;



use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class AppLoginService extends BaseAuthService
{
    private array $validationRules = [
        "email" => "required",
        "password" => "required",
    ];

    public function login(Request $request) : string
    {
        $this->checkOutValidation($request, $this->validationRules);
        $this->checkOutCredentials();
        return $this->generateToken($request->email);
    }

    private function checkOutCredentials()
    {
        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials))
            throw new HttpResponseException(response()->json(
                ["message" => "Wrong email or password"], Response::HTTP_UNAUTHORIZED));
    }

    private function generateToken($email) : string
    {
        $user = User::query()->where("email",$email)->first();
        return $user->createToken("token")->plainTextToken;
    }
}

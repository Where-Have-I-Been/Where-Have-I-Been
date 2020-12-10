<?php


namespace App\Http\Services\AuthenticationServices;



use App\Http\Services\Interfaces\AppLoginServiceInterface;
use App\Http\Services\Interfaces\ValidationHelperInterface;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AppLoginService extends ValidationHelper implements AppLoginServiceInterface
{

    private ValidationHelperInterface $validationHelper;


    public function __construct(ValidationHelperInterface $validationHelper)
    {
        $this->validationHelper = $validationHelper;

    }

    public function login(Request $request) : string
    {
        $this->checkOutValidation($request, ValidationRules::Login);
        $this->checkOutCredentials();
        return $this->generateToken($request->email);
    }

    private function checkOutCredentials()
    {
        $credentials = request(["email","password"]);

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

<?php


namespace App\Http\Services\AuthenticationServices;

use App\Models\User;
use Illuminate\Http\Request;

class AppRegisterService extends BaseAuthService
{
    private array $validationRules = [
        "email" => [
            "required",
            "unique:users",
        ],
        "password" => [
            "required",
            "string",
            "min:6",
            "confirmed",
        ]];

    public function register(Request $request) : void
    {
        $this->checkOutValidation($request, $this->validationRules);
        $this->createUser($request);
    }

    private function createUser(Request $request) : void
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
    }
}

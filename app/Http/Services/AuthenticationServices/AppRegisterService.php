<?php


namespace App\Http\Services\AuthenticationServices;

use App\Http\Services\Interfaces\AppRegisterServiceInterface;
use App\Http\Services\Interfaces\ValidationHelperInterface;
use App\Models\User;
use Illuminate\Http\Request;

class AppRegisterService implements AppRegisterServiceInterface
{
    private ValidationHelperInterface $validationHelper;


    public function __construct(ValidationHelperInterface $validationHelper)
    {
        $this->validationHelper = $validationHelper;
    }

    public function register(Request $request)
    {
        $this->validationHelper->checkOutValidation($request, ValidationRules::Register);
        $this->createUser($request);
    }

    private function createUser(Request $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
    }
}

<?php


namespace App\Http\Services\AuthenticationServices;


use App\Http\Services\Interfaces\ValidationHelperInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidationHelper implements ValidationHelperInterface
{

    public function checkOutValidation(Request $request, array $validationRules)
    {
        $validator = Validator::make($request->all(), $validationRules);
        if( $validator->fails())
            throw new HttpResponseException(response()->json(
                ["message" => $validator->errors()],  Response::HTTP_BAD_REQUEST));
    }
}

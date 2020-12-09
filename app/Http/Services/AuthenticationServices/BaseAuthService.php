<?php


namespace App\Http\Services\AuthenticationServices;


use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseAuthService
{
    protected function checkOutValidation(Request $request, array $validationRules)
    {
        $validator = Validator::make($request->all(), $validationRules);
        if( $validator->fails())
            throw new HttpResponseException(response()->json(
                ["message" => $validator->errors()],  Response::HTTP_BAD_REQUEST));
    }
}

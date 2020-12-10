<?php


namespace App\Http\Services\Interfaces;


use Illuminate\Http\Request;

interface ValidationHelperInterface
{
    public function checkOutValidation(Request $request, array $validationRules);

}

<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {

        throw new ValidationException($validator->errors()->toArray(), __("validation.failed"));
    }
}

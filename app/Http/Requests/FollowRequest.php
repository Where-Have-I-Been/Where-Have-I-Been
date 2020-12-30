<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowRequest extends FormRequest
{

    public function rules()
    {
        return [
            "user_id" => [
                "exists:users,id",
            ],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $photo = $this->userProfile->photo;

        return [
            "id" => $this->id,
            "email" => $this->email,
            "name" => $this->userProfile->name,
            "avatar" =>$this->when($photo !== null, new PhotoResource($photo), null)
        ];
    }
}

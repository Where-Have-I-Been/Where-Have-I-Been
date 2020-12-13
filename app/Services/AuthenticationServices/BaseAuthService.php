<?php


namespace App\Services\AuthenticationServices;


use Illuminate\Contracts\Hashing\Hasher;

abstract class BaseAuthService
{
    protected Hasher $hashes;

    public function __construct(Hasher $hashes)
    {
        $this->hashes = $hashes;
    }
}

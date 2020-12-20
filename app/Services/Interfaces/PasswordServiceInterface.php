<?php


namespace App\Services\Interfaces;


use App\Models\User;

interface PasswordServiceInterface
{
    public function changePassword(array $data,User $user): void;
}

<?php


namespace App\Http\Services\Interfaces;


use Illuminate\Http\Request;

interface AppLoginServiceInterface
{
    public function login(Request $request) : string;
}

<?php


namespace App\Http\Services\Interfaces;


use Illuminate\Http\Request;

interface AppRegisterServiceInterface
{
    function register(Request $request);
}

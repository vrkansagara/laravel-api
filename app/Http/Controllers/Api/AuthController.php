<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Request;

class AuthController extends ApiController
{

    public function login(Request $request)
    {
        $postData = $request->all();
    }
}

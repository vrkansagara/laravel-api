<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;

class TmpController extends ApiController
{
    public function index()
    {
        return $response = [
            "statusCode" => 200,
            "errorCode" => 0,
            'message' => 'API INFO.',
            'data' => [
                "AUTH_FLOW" => true,
                "LOGIN" => "https://api.vrkansagara.in/api/auth/login",
                "REGISTER" => "https://api.vrkansagara.in/api/auth/register",
                "FORGET" => "https://api.vrkansagara.in/api/auth/logout"
            ],
        ];

    }
}


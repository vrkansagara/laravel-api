<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;

class TmpController extends ApiController
{
    public function index()
    {
        /**
         * {
         * "statusCode": 200,
         * "errorCode": 0,
         * "message": "Login successfully !!!",
         * "size": 1,
         * "data":[
         * {
         * "AUTH_FLOW" : true,
         * "API_ENDPOINT": "https://api.vrkansagara.in/",
         * "VERSION" : "api/v1/",
         * "LOGIN": "aut/user/login",
         * "REGISTER": "auth/register",
         * "FORGET": "auth/user/forget"
         * }
         * ]
         * }
         */
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


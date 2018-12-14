<?php

namespace App\Http\Controllers;

use App\Repositories\interfaces\ApiInterface;
use App\Traits\ApiTraits;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends BaseController implements ApiInterface
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ApiTraits;

    public function __construct()
    {

    }

    public function response($data)
    {
        $responseFormat = [
            'statusCode' => 200,
            'message' => 'default message',
            'errorCode' => 100,
            'data' => [],
            'size' => 0

        ];

        if (!isset($data['statusCode'])) {
            unset($responseFormat['errorCode']);
        }
        $responseFormat['data'] = $data['data'];
        $responseFormat['message'] = $data['message'];
        return response()->json($responseFormat);

    }
}

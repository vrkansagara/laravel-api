<?php
/**
 * Created by PhpStorm.
 * User: vallabh
 * Date: 16/12/18
 * Time: 1:05 PM
 */

namespace App\Utilities;


class ApiResponse
{


    public static function response($data)
    {
        // Set default status code.



        $responseFormat = [
            'statusCode' => 200,
            'message' => 'OK',
            'errorCode' => 0,
            'size' => 0,
            'data' => [],
        ];


        if(isset($data['statusCode']) && is_int($data['statusCode'])){
            $responseFormat['statusCode'] = $data['statusCode'];
        }

        $headers = [];


        if(isset($data['no-cache']) && $data['no-cache'] == 1){
            $noCacheHeaders = [
                'Cache-Control'  => 'no-cache,no-store, must-revalidate',
                'Pragma' => 'no-cache'
            ];

            $headers = array_merge($headers,$noCacheHeaders);
        }

        if(isset($data['headers']) && is_array($data['headers']) && count($data['headers']) >=  1){
            $headers = array_merge($headers,$data['headers']);
        }


        $responseFormat['data'] = isset($data['data']) ? $data['data'] : [];
        $responseFormat['message'] = isset($data['message']) ? $data['message'] : [];
        $responseFormat['count'] = is_countable($data['data']) ? count($data['data']) : 0;

        return response()->json($responseFormat, $responseFormat['statusCode'],$headers);

    }

}

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
            'errorCode' => 0,
            'message' => 'OK',
            'size' => self::getSize($data),
            'data' => [],
        ];

//        $responseFormat['ip'] = get_ip_address();

        if (isset($data['statusCode']) && is_int($data['statusCode'])) {
            $responseFormat['statusCode'] = $data['statusCode'];
        }

        $headers = [];


        if (isset($data['no-cache']) && $data['no-cache'] == 1) {
            $noCacheHeaders = [
                'Cache-Control' => 'no-cache,no-store, must-revalidate',
                'Pragma' => 'no-cache'
            ];

            $headers = array_merge($headers, $noCacheHeaders);
        }

        if (isset($data['headers']) && is_array($data['headers']) && count($data['headers']) >= 1) {
            $headers = array_merge($headers, $data['headers']);
        }


        $responseFormat['data'] = isset($data['data']) ? $data['data'] : [];
        $responseFormat['message'] = isset($data['message']) ? $data['message'] : [];


        return response()->json($responseFormat, $responseFormat['statusCode'], $headers);

    }


    /**
     * errorCode
     * This would be used for mobile application.
     * Custom error code for mobile and web.
     *
     * 100 - 199
     * 200 - 299
     * 300 - 399
     * 400 - 499
     * 500 - 599
     * @param int $code
     * @return mixed
     */
    public static function errorCode(int $code)
    {
        $statusCode = [
            401 => 'Unauthenticated'
        ];

        return $statusCode[$code];
    }

    public static function getSize($payLoad, $sizeType = 'kb', $options = [])
    {
        if (isset($payLoad['data']) && !is_bool($payLoad['data'])){
            return sizeof($payLoad['data']);
        }

        return 0;

    }
}

<?php

if (!function_exists('getIpAddress')) {

    /**
     * Retrieves the best guess of the client's actual IP address.
     * Takes into account numerous HTTP proxy headers due to variations
     * in how different ISPs handle IP addresses in headers between hops.
     */
    function getIpAddress()
    {
        // check for shared internet/ISP IP
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        // check for IPs passing through proxies
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check if multiple ips exist in var
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($iplist as $ip) {
                    if (validate_ip($ip))
                        return $ip;
                }
            } else {
                if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];
        // return unreliable ip since all else failed
        return $_SERVER['REMOTE_ADDR'];
    }
}

if (!function_exists('isValidIp')) {

    /**
     * Ensures an ip address is both a valid IP and does not fall within
     * a private network range.
     */
    function isValidIp($ip)
    {
        if (strtolower($ip) === 'unknown') {
            return false;
        }
        // generate ipv4 network address
        $ip = ip2long($ip);
        // if the ip is set and not equivalent to 255.255.255.255
        if ($ip !== false && $ip !== -1) {
            // make sure to get unsigned long representation of ip
            // due to discrepancies between 32 and 64 bit OSes and
            // signed numbers (ints default to signed in PHP)
            $ip = sprintf('%u', $ip);
            // do private network range checking
            if ($ip >= 0 && $ip <= 50331647) return false;
            if ($ip >= 167772160 && $ip <= 184549375) return false;
            if ($ip >= 2130706432 && $ip <= 2147483647) return false;
            if ($ip >= 2851995648 && $ip <= 2852061183) return false;
            if ($ip >= 2886729728 && $ip <= 2887778303) return false;
            if ($ip >= 3221225984 && $ip <= 3221226239) return false;
            if ($ip >= 3232235520 && $ip <= 3232301055) return false;
            if ($ip >= 4294967040) return false;
        }
        return true;
    }

}

if (!function_exists('httpStatusMessage')) {
    /**
     * @param int $code
     * @return string
     */
    function httpStatusMessage($code)
    {
        /**
         * 1×× Informational
         * 2×× Success
         * 3×× Redirection
         * 4×× Client Error
         * 5×× Server Error
         */
        $statusCodes = [
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            208 => 'Already Reported',
            226 => 'IM Used',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            307 => 'Temporary Redirect',
            308 => 'Permanent Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Payload Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            418 => 'I\'m a teapot',
            421 => 'Misdirected Request',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            426 => 'Upgrade Required',
            428 => 'Precondition Required',
            429 => 'Too Many Requests',
            431 => 'Request Header Fields Too Large',
            444 => 'Connection Closed Without Response',
            451 => 'Unavailable For Legal Reasons',
            499 => 'Client Closed Request',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            508 => 'Loop Detected',
            510 => 'Not Extended',
            511 => 'Network Authentication Required',
            599 => 'Network Connect Timeout Error',
        ];
        if (!in_array($code, $statusCodes, true)) {
            return $statusCodes[$code];
        } else {
            return 'Something went wrong.';
        }
    }
}
if (!function_exists('isValidJson')) {
    /**
     * @param string $string
     * @return boolean
     */
    function isValidJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}


if (!function_exists('generateRandomString')) {

    /**
     * Generate random string.
     * @param int $length
     * @return string
     */
    function generateRandomString($length = 32)
    {
        // Alphabets (Capitals & Smalls), numeric values and special characters should be there
        $capital = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 1);
        $small = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1);
        $number = substr(str_shuffle('0123456789'), 0, 1);
        $specialCharacters = substr(str_shuffle("!#$%&*-@_"), 0, 1);
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&*-@_';
        $string = substr(str_shuffle(str_repeat($pool, 5)), 0, $length - 2) . $capital . $small . $number . $specialCharacters;
        return $string;
    }
}

if (!function_exists('generateRsaEncryption')) {

    /**
     * @param $string
     * @param $publicKeyPath
     * @return string
     */
    function generateRsaEncryption($string, $publicKeyPath)
    {
        $fp = fopen($publicKeyPath, 'r');
        $pub_key = fread($fp, 8192);
        fclose($fp);
        openssl_public_encrypt($string, $crypttext, $pub_key);
        return base64_encode($crypttext);
    }
}

if (!function_exists('generateAesEncryption')) {

    /**
     * @param $string
     * @param $keyString
     * @param int $isDecrypt
     * @return string
     */
    function generateAesEncryption($string, $keyString, $isDecrypt = 0)
    {
        /**
         * CBC has an IV and thus needs randomness every time a message is encrypted
         * openssl_get_cipher_methods($method)
         * // Most secure key
         * $key = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
         *
         */
        $method = 'aes-256-ecb';
        $ivlen = openssl_cipher_iv_length($method);
        // Most secure iv Never ever use iv=0 in real live. Better use this:
        $iv = openssl_random_pseudo_bytes($ivlen);
        $string = base64_encode(openssl_encrypt($string, $method, $keyString, OPENSSL_RAW_DATA, $iv));
        if ($isDecrypt) {
            $string = openssl_decrypt(base64_decode($string), $method, $keyString, OPENSSL_RAW_DATA, $iv);
        }
        return $string;
    }
}

if (!function_exists('connect')) {

    /**
     * @param $url
     * @param string $method
     * @param array $payload
     * @param array $headers
     * @param int $isDebug
     * @return array
     */
    function connect($url, $method = 'get', array $payload, $headers = [], $isDebug = 0)
    {
        $timeout = 30;
        $redirect = 3;
        $verboseLog = '';
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return [
                'status' => 0,
                'response' => null,
                'verbose' => $verboseLog
            ];
        }
        $curl = curl_init();
        $userAgent = 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31';
        $options = [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_USERAGENT => $userAgent,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CONNECTTIMEOUT => $timeout,
            CURLOPT_MAXREDIRS => $redirect,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        ];

        if (strtolower($method) == 'post') {
            $options[CURLOPT_POST] = 1;
            $options[CURLOPT_POSTFIELDS] = json_encode($payload);
        }

        if (!is_null($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        if ($isDebug) {
            curl_setopt($curl, CURLOPT_VERBOSE, true);
            $verbose = fopen('php://temp', 'w+');
            $options[CURLOPT_VERBOSE] = true;
            $options[CURLOPT_STDERR] = $verbose;
        }
        curl_setopt_array($curl, $options);
        curl_setopt($curl, CURLOPT_URL, $url);
        $server_output = curl_exec($curl);

        if ($isDebug) {
            rewind($verbose);
            $verboseLog = stream_get_contents($verbose);
        }
        curl_close($curl);

        if (!$server_output) {
            die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }
        $returnResponse = [
            'status' => 1,
            'response' => $server_output,
            'verbose' => $verboseLog
        ];

        return $returnResponse;

    }
}


<?php

namespace Apachish\AccessLevel\App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    const SUCCESS = "Success";
    const FAILED = "Failed";
    const BADREQUEST = "BadRequest";
    const UNAUTHORIZED = "Unauthorized";
    const INACCESSIBILITY = "Inaccessibility";
    const NOTFOUND = "NotFound";

    public function responseData($error, $data, $message = NULL, $headers = [])
    {
        $status = ($error == self::SUCCESS) ? self::SUCCESS : self::FAILED;

        if ($message == NULL) $message = config('errors.' . $error . '.message');

        $http_code = config('errors.' . $error . '.http_code') ?: $error;

        if ($http_code == 200 && $error != self::FAILED) $status = self::SUCCESS;
        
        return response()->json([
            'status' => $status,
            'meta' => [
                'code' => config('errors.' . $error . '.code') ?: $http_code,
                'message' => $message,
            ],
            'data' => $data,
        ], $http_code, $headers);
    }
}

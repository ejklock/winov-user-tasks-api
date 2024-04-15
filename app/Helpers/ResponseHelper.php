<?php

namespace App\Helpers;

class ResponseHelper
{

    public static function notFound($message = null, $data = null, $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }


    public static function success($message = null, $data = null, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $data
        ];

        if (!is_null($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }

    public static function error($message = null, $data = null, $code = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}

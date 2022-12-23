<?php

namespace App\Traits;

trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            // "status" => 'Request was succesfull',
            "status" => true,
            "message" => $message,
            "data" => $data
        ], $code);
    }
    protected function error($data, $message = null, $code)
    {
        return response()->json([
            // "status" => 'Error has occurred',
            "status" => false,
            "message" => $message,
            "data" => $data
        ], $code);
    }
}

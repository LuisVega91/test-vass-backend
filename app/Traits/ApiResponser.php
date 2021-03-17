<?php

namespace App\Traits;

trait ApiResponser
{

    protected function successResponse($data, $code)
    {
        return response()->json([
                'success' => true,
                'data' => $data], $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json([
            'success' => false,
            'error' => $message,
            'code' => $code], $code);
    }
}
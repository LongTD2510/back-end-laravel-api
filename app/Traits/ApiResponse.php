<?php


namespace App\Traits;


trait ApiResponse
{
    protected function successResponse($data, $message = 'Successfully', $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => $code,
            'status' => 'Success',
            'success' => true,
            'message' => $message,
            'data' => $data,
            'response_time' => date('Y-m-d H:i:s')
        ], $code);
    }

    protected function errorResponse($message = null, $code = 400): \Illuminate\Http\JsonResponse
    {
        if ($code < 200 || $code > 600) {
            $code = 500;
        }
        return response()->json([
            'code' => $code,
            'status' => 'Error',
            'success' => false,
            'message' => $message,
            'data' => null,
            'response_time' => date('Y-m-d H:i:s')
        ], $code);
    }
}

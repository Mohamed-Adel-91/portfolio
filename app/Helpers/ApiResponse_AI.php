<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse_AI
{
    /**
     * Response with status code 200.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @return JsonResponse
     */
    public static function success(mixed $data = [], string $message = null): JsonResponse
    {
        if (!$message) {
            $message = trans('api.response.success');
        }

        $response = [
            'status' => true,
            'meta' => [
                'message' => $message,
                'errors' => [],
            ],
            'data' => $data,
        ];

        return new JsonResponse($response, Response::HTTP_OK);
    }

    /**
     * Error Response.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public static function error(mixed $errors = [], string $message = null, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        if (!$message) {
            $message = trans('api.response.error');
        }

        $response = [
            'status' => false,
            'meta' => [
                'message' => $message,
                'errors' => $errors,
            ],
            'data' => [],
        ];

        return new JsonResponse($response, $statusCode);
    }
}

<?php

declare(strict_types=1);

namespace App\Traits\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

trait ApiResponserTrait
{

    protected function successResponse($data, string $message = null, int $code = 200): JsonResponse
    {
        return new JsonResponse([
            'status'  => 'Success',
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected function errorResponse(string $message = null, int $code = 400): JsonResponse
    {
        return new JsonResponse([
            'status'  => 'Error',
            'message' => $message,
            'data'    => null,
        ], $code);
    }
}

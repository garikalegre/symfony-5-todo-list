<?php

namespace App\Common\Utils\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Trait ApiResponser
 * @package App\Common\Utils\Traits
 */
trait ApiResponser
{
    /**
     * @param $data
     * @param null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data, $message = null, $code = 200)
    {
        return new JsonResponse([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param $code
     * @param null $error
     * @return JsonResponse
     */
    protected function errorResponse($code, $error = null)
    {
        return new JsonResponse([
            'status' => 'Error',
            'errors' => $error
        ], $code);
    }
}

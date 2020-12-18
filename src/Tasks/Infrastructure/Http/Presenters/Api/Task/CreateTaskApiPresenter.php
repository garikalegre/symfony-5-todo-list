<?php

namespace App\Tasks\Infrastructure\Http\Presenters\Api\Task;

use App\Common\Utils\Traits\ApiResponser;
use App\Tasks\Application\Results\CreateTaskResult;
use App\Tasks\Infrastructure\Http\Presenters\Contracts\Task\CreateTaskPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateTaskApiPresenter implements CreateTaskPresenter
{
    use ApiResponser;

    public function present(CreateTaskResult $result): JsonResponse
    {
        if ($result->isSuccess()) {
            return $this->successResponse($result->getTask());
        }

        return $this->errorResponse(500, $result->getMessage());
    }
}

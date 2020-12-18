<?php

namespace App\Tasks\Infrastructure\Http\Presenters\Api\Task;

use App\Common\Utils\Traits\ApiResponser;
use App\Tasks\Application\Results\UpdateTaskResult;
use App\Tasks\Infrastructure\Http\Presenters\Contracts\Task\UpdateTaskPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;

class UpdateTaskApiPresenter implements UpdateTaskPresenter
{
    use ApiResponser;

    public function present(UpdateTaskResult $result): JsonResponse
    {
        if ($result->isSuccess()) {
            return $this->successResponse($result->getTask());
        }

        return $this->errorResponse(500, $result->getMessage());
    }
}

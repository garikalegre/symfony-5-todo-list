<?php

namespace App\Tasks\Infrastructure\Http\Presenters\Api\Task;

use App\Common\Utils\Traits\ApiResponser;
use App\Tasks\Application\Results\ActiveTodayTaskResult;
use App\Tasks\Infrastructure\Http\Presenters\Contracts\Task\GetUserTaskForTodayPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUserTaskForTodayApiPresenter implements GetUserTaskForTodayPresenter
{
    use ApiResponser;

    public function present(ActiveTodayTaskResult $result): JsonResponse
    {
        if (!$result->isSuccess()) {
            return $this->errorResponse(500, $result->getMessage());
        }

        return $this->successResponse($result->getTasks());
    }
}

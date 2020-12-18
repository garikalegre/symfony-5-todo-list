<?php

namespace App\Authentication\Infrastructure\Http\Presenters\Api\User;

use App\Authentication\Application\Results\CreateUserResult;
use App\Authentication\Infrastructure\Http\Presenters\Contracts\User\CreateUserPresenter;
use App\Common\Utils\Traits\ApiResponser;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CreateUserApiPresenter implements CreateUserPresenter
{
    use ApiResponser;

    public function present(CreateUserResult $result): JsonResponse
    {
        if ($result->isSuccess()) {
            return $this->successResponse($result->getUser());
        }

        return $this->errorResponse(500, $result->getMessage());
    }
}

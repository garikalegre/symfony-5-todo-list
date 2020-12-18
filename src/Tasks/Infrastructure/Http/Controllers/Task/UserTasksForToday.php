<?php

namespace App\Tasks\Infrastructure\Http\Controllers\Task;

use App\Common\Application\CQRS\Query\QueryBus;
use App\Tasks\Application\Query\GetActiveTaskQuery;
use App\Tasks\Infrastructure\Http\Presenters\Contracts\Task\GetUserTaskForTodayPresenter;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class UserTasksForToday extends AbstractController
{
    private QueryBus $queryBus;
    private GetUserTaskForTodayPresenter $presenter;

    public function __construct(QueryBus $queryBus, GetUserTaskForTodayPresenter $presenter)
    {
        $this->queryBus = $queryBus;
        $this->presenter = $presenter;
    }

    /**
     * @Route("/api/tasks", name="task_active", methods={"GET"})
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $result = $this->queryBus->handle(new GetActiveTaskQuery($this->getUser(), new DateTime()));

        return $this->presenter->present($result);
    }
}

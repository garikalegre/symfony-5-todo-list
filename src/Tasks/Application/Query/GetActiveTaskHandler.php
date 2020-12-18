<?php

namespace App\Tasks\Application\Query;

use App\Common\Application\CQRS\Query\QueryHandler;
use App\Tasks\Application\Results\ActiveTodayTaskResult;
use App\Tasks\Domain\Task\Entity\Task;
use App\Tasks\Domain\Task\Repository\TaskRepository;

class GetActiveTaskHandler implements QueryHandler
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function __invoke(GetActiveTaskQuery $query): ActiveTodayTaskResult
    {
        try {
            $tasks = $this->taskRepository->findBy(
                [
                    'user' => $query->user(),
                    'status' => Task::STATUS_ACTIVE,
                    'date' => $query->date()->setTime(0, 0)
                ]
            );

            return ActiveTodayTaskResult::getSuccessResult($tasks);
        } catch (\Exception $e) {
            return ActiveTodayTaskResult::getFailedResult($e->getMessage());
        }
    }
}

<?php

namespace App\Tasks\Application\Command;

use App\Common\Application\CQRS\Command\CommandHandler;
use App\Tasks\Application\Results\CreateTaskResult;
use App\Tasks\Domain\Services\Contracts\TaskServiceInterface;
use App\Tasks\Domain\Task\Repository\TaskRepository;

class CreateTaskHandler implements CommandHandler
{
    private TaskRepository $taskRepository;
    private TaskServiceInterface $taskService;

    public function __construct(TaskRepository $taskRepository, TaskServiceInterface $taskService)
    {
        $this->taskRepository = $taskRepository;
        $this->taskService = $taskService;
    }

    public function __invoke(CreateTaskCommand $command): CreateTaskResult
    {
        try {
            $task = $this->taskService->buildTask($command);
            $this->taskRepository->create($task);

            return CreateTaskResult::getSuccessResult($task);
        } catch (\Exception $e) {
            return CreateTaskResult::getFailedResult($e->getMessage());
        }
    }
}

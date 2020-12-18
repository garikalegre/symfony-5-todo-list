<?php

namespace App\Tasks\Application\Command;

use App\Common\Application\CQRS\Command\CommandHandler;
use App\Tasks\Application\Results\UpdateTaskResult;
use App\Tasks\Domain\Task\Repository\TaskRepository;

class UpdateTaskHandler implements CommandHandler
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function __invoke(UpdateTaskCommand $command): UpdateTaskResult
    {
        if (!$this->checkTaskOwner($command)) {
            return UpdateTaskResult::getFailedResult('This is the task of someone else\'s user');
        }
        try {
            $task = $command->getTask();
            if (!is_null($command->getName())) {
                $task->setName($command->getName());
            }
            if (!is_null($command->getDate())) {
                $task->setDate($command->getDate());
            }
            if (!is_null($command->getStatus())) {
                $task->setStatus($command->getStatus());
            }
            $this->taskRepository->save();

            return UpdateTaskResult::getSuccessResult($task);
        } catch (\Exception $e) {
            return UpdateTaskResult::getFailedResult($e->getMessage());
        }
    }

    private function checkTaskOwner(UpdateTaskCommand $command): bool
    {
        return $command->getUser()->getId() === $command->getTask()->getUser()->getId();
    }
}

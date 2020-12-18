<?php

namespace App\Tasks\Domain\Services;

use App\Tasks\Application\Command\CreateTaskCommand;
use App\Tasks\Domain\Services\Contracts\TaskServiceInterface;
use App\Tasks\Domain\Task\Entity\Task;

class TaskService implements TaskServiceInterface
{

    public function buildTask(CreateTaskCommand $command): Task
    {
        return new Task(
            $command->getUser(),
            $command->getName(),
            $command->getDate(),
            $command->getStatus()
        );
    }
}

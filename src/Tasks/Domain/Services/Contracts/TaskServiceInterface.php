<?php

namespace App\Tasks\Domain\Services\Contracts;

use App\Tasks\Application\Command\CreateTaskCommand;
use App\Tasks\Domain\Task\Entity\Task;

interface TaskServiceInterface
{
    public function buildTask(CreateTaskCommand $command): Task;
}
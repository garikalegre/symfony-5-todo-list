<?php

namespace App\Tasks\Domain\Task\Repository;

use App\Tasks\Domain\Task\Entity\Task;

interface TaskRepository
{
    public function create(Task $task);
    public function save();
}

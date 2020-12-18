<?php

namespace App\Tasks\Application\Results;

use App\Tasks\Domain\Task\Entity\Task;

class CreateTaskResult
{
    private ?Task $task;
    private bool $isSuccess;
    private ?string $message;

    private function __construct(?Task $task, bool $isSuccess, ?string $message = null)
    {
        $this->task = $task;
        $this->isSuccess = $isSuccess;
        $this->message = $message;
    }

    public static function getSuccessResult(Task $task): CreateTaskResult
    {
        return new self($task, true);
    }

    public static function getFailedResult(string $message): CreateTaskResult
    {
        return new self(null, false, $message);
    }

    /**
     * @return Task|null
     */
    public function getTask(): ?Task
    {
        return $this->task;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}

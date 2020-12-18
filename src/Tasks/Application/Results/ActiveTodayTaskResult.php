<?php

namespace App\Tasks\Application\Results;

class ActiveTodayTaskResult
{
    private ?array $tasks;
    private bool $isSuccess;
    private ?string $message;

    private function __construct(?array $tasks, bool $isSuccess, ?string $message = null)
    {
        $this->tasks = $tasks;
        $this->isSuccess = $isSuccess;
        $this->message = $message;
    }

    public static function getSuccessResult(array $tasks): ActiveTodayTaskResult
    {
        return new self($tasks, true);
    }

    public static function getFailedResult(string $message): ActiveTodayTaskResult
    {
        return new self(null, false, $message);
    }

    /**
     * @return array|null
     */
    public function getTasks(): ?array
    {
        return $this->tasks;
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

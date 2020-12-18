<?php

namespace App\Tasks\Application\Command;

use App\Authentication\Domain\User\Entity\User;
use App\Common\Application\CQRS\Command\Command;
use App\Tasks\Domain\Task\Entity\Task;
use DateTime;

class UpdateTaskCommand implements Command
{
    private User $user;
    private Task $task;
    private ?string $name = null;
    private ?DateTime $date = null;
    private ?string $status = null;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * @param Task $task
     */
    public function setTask(Task $task): void
    {
        $this->task = $task;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = DateTime::createFromFormat('Y-m-d', $date)->setTime(0,0);
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
}

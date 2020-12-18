<?php

namespace App\Authentication\Application\Results;

use App\Authentication\Domain\User\Entity\User;

class CreateUserResult
{
    private ?User $user;
    private bool $isSuccess;
    private ?string $message;

    private function __construct(?User $user, bool $isSuccess, ?string $message = null)
    {
        $this->user = $user;
        $this->isSuccess = $isSuccess;
        $this->message = $message;
    }

    public static function getSuccessResult(User $user): CreateUserResult
    {
        return new self($user, true);
    }

    public static function getFailedResult(string $message): CreateUserResult
    {
        return new self(null, false, $message);
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
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

<?php

namespace App\Authentication\Application\Command;

use App\Common\Application\CQRS\Command\Command;

final class CreateUserCommand implements Command
{
    private string $username;
    private string $password;
    private array $role;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getRole(): array
    {
        return $this->role;
    }

    /**
     * @param array $role
     */
    public function setRole(array $role): void
    {
        $this->role = $role;
    }
}

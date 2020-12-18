<?php

namespace App\Authentication\Application\Query;

use App\Common\Application\CQRS\Query\Query;

class GetUserByNameQuery implements Query
{
    private string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function username(): string
    {
        return $this->username;
    }
}

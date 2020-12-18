<?php

namespace App\Tasks\Application\Query;

use App\Authentication\Domain\User\Entity\User;
use App\Common\Application\CQRS\Query\Query;
use DateTime;

class GetActiveTaskQuery implements Query
{
    private User $user;
    private DateTime $date;

    public function __construct(User $user, DateTime $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function date(): DateTime
    {
        return $this->date;
    }
}

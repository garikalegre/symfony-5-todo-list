<?php

namespace App\Authentication\Domain\User\Repository;

use App\Authentication\Domain\User\Entity\User;

interface UserRepository
{
    public function create(User $user);
}

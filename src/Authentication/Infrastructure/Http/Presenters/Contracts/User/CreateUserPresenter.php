<?php

namespace App\Authentication\Infrastructure\Http\Presenters\Contracts\User;

use App\Authentication\Application\Results\CreateUserResult;

interface CreateUserPresenter
{
    public function present(CreateUserResult $result);
}

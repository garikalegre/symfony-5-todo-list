<?php

namespace App\Tasks\Infrastructure\Http\Presenters\Contracts\Task;

use App\Tasks\Application\Results\CreateTaskResult;

interface CreateTaskPresenter
{
    public function present(CreateTaskResult $result);
}

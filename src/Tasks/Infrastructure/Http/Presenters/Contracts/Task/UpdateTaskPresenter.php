<?php

namespace App\Tasks\Infrastructure\Http\Presenters\Contracts\Task;

use App\Tasks\Application\Results\UpdateTaskResult;

interface UpdateTaskPresenter
{
    public function present(UpdateTaskResult $result);
}

<?php

namespace App\Tasks\Infrastructure\Http\Presenters\Contracts\Task;

use App\Tasks\Application\Results\ActiveTodayTaskResult;

interface GetUserTaskForTodayPresenter
{
    public function present(ActiveTodayTaskResult $result);
}

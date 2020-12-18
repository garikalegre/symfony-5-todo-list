<?php

namespace App\Common\Application\CQRS\Command;

interface CommandBus
{
    /**
     * @param Command $command
     */
    public function handle (Command $command);
}

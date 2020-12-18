<?php

namespace App\Tests\Common;

use App\Common\Application\CQRS\Command\CommandHandler;

class DummyHandler implements CommandHandler
{
    public function __invoke(DummyCommand $command)
    {

    }
}

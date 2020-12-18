<?php

namespace App\Common\Utils\CQRS;

use App\Common\Application\CQRS\Command\Command;
use App\Common\Application\CQRS\Command\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $commandBus;

    /**
     * MessengerCommandBus constructor.
     * @param MessageBusInterface $commandBus
     */
    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}

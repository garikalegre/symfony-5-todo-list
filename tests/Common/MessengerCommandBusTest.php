<?php

namespace App\Tests\Common;

use App\Common\Application\CQRS\Command\Command;
use App\Common\Utils\CQRS\MessengerCommandBus;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Envelope;

final class MessengerCommandBusTest extends TestCase
{
    private MessageBusInterface $symfonyMessageBus;
    private MessengerCommandBus $commandBus;

    protected function setUp(): void
    {
        $this->symfonyMessageBus = $this->assembleSymfonyMessageBus();
        $this->commandBus = new MessengerCommandBus($this->symfonyMessageBus);
    }

    public function testMessageForwardedToMessageBusWhileDispatching(): void
    {
        $command = new DummyCommand();
        $this->commandBus->handle($command);

        self::assertSame($command, $this->symfonyMessageBus->lastDispatchedCommand());
    }

    private function assembleSymfonyMessageBus(): MessageBusInterface
    {
        return new class() implements MessageBusInterface {
            private Command $dispatchedCommand;

            public function dispatch($message, array $stamps = []): Envelope
            {
                $this->dispatchedCommand = $message;

                return new Envelope($message);
            }

            public function lastDispatchedCommand(): Command
            {
                return $this->dispatchedCommand;
            }
        };
    }
}

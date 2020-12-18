<?php

namespace App\Tests\Tasks\Application\Command;

use App\Tasks\Application\Command\UpdateTaskCommand;
use App\Tasks\Application\Command\UpdateTaskHandler;
use App\Tasks\Application\Results\UpdateTaskResult;
use App\Tasks\Domain\Task\Entity\Task;
use App\Tasks\Domain\Task\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;

class UpdateTaskHandlerTest extends TestCase
{
    private const DUMMY_STRING = 'dummy';

    private TaskRepository $taskRepository;
    private UpdateTaskHandler $handler;

    protected function setUp(): void
    {
        $this->taskRepository = $this->createMock(TaskRepository::class);
        $this->handler = new UpdateTaskHandler(
            $this->taskRepository
        );
    }

    public function commandProvider(): array
    {
        $command = new UpdateTaskCommand();
        $command->setUser($this->createMock(User::class));
        $command->setTask($this->createMock(Task::class));
        $command->setName(self::DUMMY_STRING);
        $command->setDate('2020-12-21');
        $command->setStatus(Task::STATUS_ACTIVE);

        return [
            [$command]
        ];
    }

    /**
     * @param UpdateTaskCommand $command
     * @dataProvider commandProvider
     */
    public function testSuccess(UpdateTaskCommand $command)
    {
        $this->assertInstanceOf(UpdateTaskResult::class, $this->handler->__invoke($command));
    }
}

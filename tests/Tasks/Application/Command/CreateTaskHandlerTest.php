<?php

namespace App\Tests\Tasks\Application\Command;

use App\Authentication\Domain\User\Entity\User;
use App\Tasks\Application\Command\CreateTaskCommand;
use App\Tasks\Application\Command\CreateTaskHandler;
use App\Tasks\Application\Results\CreateTaskResult;
use App\Tasks\Domain\Services\Contracts\TaskServiceInterface;
use App\Tasks\Domain\Task\Entity\Task;
use App\Tasks\Domain\Task\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;

class CreateTaskHandlerTest extends TestCase
{
    private const DUMMY_STRING = 'dummy';

    private TaskRepository $taskRepository;
    private TaskServiceInterface $taskService;
    private CreateTaskHandler $handler;

    protected function setUp(): void
    {
        $this->taskRepository = $this->createMock(TaskRepository::class);
        $this->taskService = $this->createMock(TaskServiceInterface::class);
        $this->handler = new CreateTaskHandler(
            $this->taskRepository,
            $this->taskService
        );
    }

    public function commandProvider(): array
    {
        $command = new CreateTaskCommand();
        $command->setUser($this->createMock(User::class));
        $command->setName(self::DUMMY_STRING);
        $command->setDate('2020-12-21');
        $command->setStatus(Task::STATUS_ACTIVE);

        return [
            [$command]
        ];
    }

    /**
     * @param CreateTaskCommand $command
     * @dataProvider commandProvider
     */
    public function testSuccess(CreateTaskCommand $command)
    {
        $this->assertInstanceOf(CreateTaskResult::class, $this->handler->__invoke($command));
    }
}

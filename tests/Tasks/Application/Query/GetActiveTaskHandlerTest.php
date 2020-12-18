<?php

namespace App\Tests\Tasks\Application\Query;

use App\Authentication\Domain\User\Entity\User;
use App\Tasks\Application\Query\GetActiveTaskHandler;
use App\Tasks\Application\Query\GetActiveTaskQuery;
use App\Tasks\Application\Results\ActiveTodayTaskResult;
use App\Tasks\Domain\Task\Repository\TaskRepository;
use PHPUnit\Framework\TestCase;

class GetActiveTaskHandlerTest extends TestCase
{
    private TaskRepository $taskRepository;
    private GetActiveTaskHandler $handler;

    protected function setUp(): void
    {
        $this->taskRepository = $this->createMock(TaskRepository::class);
        $this->handler = new GetActiveTaskHandler(
            $this->taskRepository
        );
    }

    public function queryProvider(): array
    {
        $query = new GetActiveTaskQuery(
            $this->createMock(User::class),
            new \DateTime()
        );
        return [
            [$query]
        ];
    }

    /**
     * @param GetActiveTaskQuery $query
     * @dataProvider queryProvider
     */
    public function testSuccess(GetActiveTaskQuery $query)
    {
        $this->assertInstanceOf(ActiveTodayTaskResult::class, $this->handler->__invoke($query));
    }
}

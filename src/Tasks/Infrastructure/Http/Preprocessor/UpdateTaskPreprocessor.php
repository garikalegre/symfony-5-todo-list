<?php

namespace App\Tasks\Infrastructure\Http\Preprocessor;

use App\Authentication\Domain\User\Entity\User;
use App\Tasks\Application\Command\UpdateTaskCommand;
use App\Tasks\Domain\Task\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateTaskPreprocessor
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function prepare(Request $request, Task $task, User $user): UpdateTaskCommand
    {
        $command = $this->serializer
            ->deserialize($request->getContent(), UpdateTaskCommand::class, $request->getContentType());
        $command->setTask($task);
        $command->setUser($user);

        return $command;
    }
}

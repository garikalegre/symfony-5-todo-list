<?php

namespace App\Tasks\Infrastructure\Http\Preprocessor;

use App\Authentication\Domain\User\Entity\User;
use App\Tasks\Application\Command\CreateTaskCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class CreateTaskPreprocessor
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
      $this->serializer = $serializer;
    }

    public function prepare(Request $request, User $user): CreateTaskCommand
    {
       $command = $this->serializer
            ->deserialize($request->getContent(), CreateTaskCommand::class, $request->getContentType());
       $command->setUser($user);

       return $command;
    }
}

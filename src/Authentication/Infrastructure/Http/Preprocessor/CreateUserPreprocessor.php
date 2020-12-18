<?php

namespace App\Authentication\Infrastructure\Http\Preprocessor;

use App\Authentication\Application\Command\CreateUserCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class CreateUserPreprocessor
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
      $this->serializer = $serializer;
    }

    public function prepare(Request $request): CreateUserCommand
    {
       return $this->serializer
            ->deserialize($request->getContent(), CreateUserCommand::class, $request->getContentType());
    }
}

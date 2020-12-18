<?php

namespace App\Authentication\Application\Command;

use App\Authentication\Application\Query\GetUserByNameQuery;
use App\Authentication\Application\Results\CreateUserResult;
use App\Authentication\Domain\Services\Contracts\UserService;
use App\Authentication\Domain\User\Entity\User;
use App\Authentication\Domain\User\Repository\UserRepository;
use App\Common\Application\CQRS\Command\CommandHandler;
use App\Common\Application\CQRS\Query\QueryBus;

final class CreateUserHandler implements CommandHandler
{
    private QueryBus $queryBus;
    private UserRepository $userRepository;
    private UserService $userService;

    public function __construct(UserRepository $userRepository, QueryBus $queryBus, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->queryBus = $queryBus;
        $this->userService = $userService;
    }

    public function __invoke(CreateUserCommand $command): CreateUserResult
    {
        $user = $this->queryBus->handle(new GetUserByNameQuery($command->getUsername()));
        if ($user instanceof User) {
            return CreateUserResult::getFailedResult('User exist');
        }
        try {
            $user = $this->userService->buildUser($command);
            $this->userRepository->create($user);

            return CreateUserResult::getSuccessResult($user);
        } catch (\Exception $e) {
            return CreateUserResult::getFailedResult($e->getMessage());
        }
    }
}

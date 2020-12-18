<?php

namespace App\Authentication\Infrastructure\Http\Controllers;

use App\Authentication\Infrastructure\Http\Preprocessor\CreateUserPreprocessor;
use App\Authentication\Infrastructure\Http\Presenters\Contracts\User\CreateUserPresenter;
use App\Common\Application\CQRS\Command\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class UserCreate extends AbstractController
{
    private CommandBus $commandBus;
    private CreateUserPreprocessor $preprocessor;
    private CreateUserPresenter $presenter;

    public function __construct(CommandBus $commandBus, CreateUserPreprocessor $preprocessor, CreateUserPresenter $presenter)
    {
        $this->commandBus = $commandBus;
        $this->preprocessor = $preprocessor;
        $this->presenter = $presenter;
    }

    /**
     * @Route("/api/user/create", name="user_create", methods={"POST"})
     * @param Request $apiRequest
     * @return JsonResponse
     */
    public function __invoke(Request $apiRequest): JsonResponse
    {
        $command = $this->preprocessor->prepare($apiRequest);
        $result = $this->commandBus->handle($command);
        return $this->presenter->present($result);
    }
}

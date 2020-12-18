<?php

namespace App\Tasks\Infrastructure\Http\Controllers\Task;

use App\Common\Application\CQRS\Command\CommandBus;
use App\Tasks\Infrastructure\Http\Preprocessor\CreateTaskPreprocessor;
use App\Tasks\Infrastructure\Http\Presenters\Contracts\Task\CreateTaskPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class CreateTask extends AbstractController
{
    private CreateTaskPreprocessor $preprocessor;
    private CreateTaskPresenter $presenter;
    private CommandBus $commandBus;

    public function __construct( CreateTaskPreprocessor $preprocessor, CommandBus $commandBus, CreateTaskPresenter $presenter)
    {
        $this->preprocessor = $preprocessor;
        $this->commandBus = $commandBus;
        $this->presenter = $presenter;
    }

    /**
     * @Route("/api/task/create", name="task_create", methods={"POST"})
     * @param Request $apiRequest
     * @return JsonResponse
     */
    public function __invoke(Request $apiRequest): JsonResponse
    {
        $command = $this->preprocessor->prepare($apiRequest, $this->getUser());
        $result = $this->commandBus->handle($command);

        return $this->presenter->present($result);
    }
}

<?php

namespace App\Tasks\Infrastructure\Http\Controllers\Task;

use App\Common\Application\CQRS\Command\CommandBus;
use App\Tasks\Infrastructure\Http\Preprocessor\UpdateTaskPreprocessor;
use App\Tasks\Domain\Task\Entity\Task;
use App\Tasks\Infrastructure\Http\Presenters\Contracts\Task\UpdateTaskPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class UpdateTask extends AbstractController
{
    private UpdateTaskPreprocessor $preprocessor;
    private CommandBus $commandBus;
    private UpdateTaskPresenter $presenter;

    public function __construct(UpdateTaskPreprocessor $preprocessor, CommandBus $commandBus, UpdateTaskPresenter $presenter)
    {
        $this->preprocessor = $preprocessor;
        $this->commandBus = $commandBus;
        $this->presenter = $presenter;
    }

    /**
     * @Route("/api/tasks/{id}", name="task_update", methods={"PUT"})
     * @param Request $apiRequest
     * @param Task $task
     * @return JsonResponse
     */
    public function __invoke(Request $apiRequest, Task $task): JsonResponse
    {
        $command = $this->preprocessor->prepare($apiRequest, $task, $this->getUser());
        $result = $this->commandBus->handle($command);

        return $this->presenter->present($result);
    }
}

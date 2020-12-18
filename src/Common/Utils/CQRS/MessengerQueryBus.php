<?php

namespace App\Common\Utils\CQRS;

use App\Common\Application\CQRS\Query\Query;
use App\Common\Application\CQRS\Query\QueryBus;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    /**
     * @param Query $query
     * @return mixed
     */
    public function handle(Query $query)
    {
        return $this->handleQuery($query);
    }
}

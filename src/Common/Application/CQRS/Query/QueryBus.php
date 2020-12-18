<?php

namespace App\Common\Application\CQRS\Query;

interface QueryBus
{
    /**
     * @param Query $query
     * @return mixed
     */
    public function handle(Query $query);
}

<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

interface Query
{
    public function toArray(): array;
}

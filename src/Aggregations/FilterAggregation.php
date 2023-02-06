<?php

namespace AskonaWeb\ElasticQueryBuilder\Aggregations;

use AskonaWeb\ElasticQueryBuilder\AggregationCollection;
use AskonaWeb\ElasticQueryBuilder\Aggregations\Mixins\WithAggregations;
use AskonaWeb\ElasticQueryBuilder\Queries\Query;

class FilterAggregation extends Aggregation
{
    use WithAggregations;

    protected Query $filter;

    public static function create(
        string $name,
        Query $filter,
        Aggregation ...$aggregations
    ): self {
        return new self($name, $filter, ...$aggregations);
    }

    public function __construct(
        string $name,
        Query $filter,
        Aggregation ...$aggregations
    ) {
        $this->name         = $name;
        $this->filter       = $filter;
        $this->aggregations = new AggregationCollection(...$aggregations);
    }

    public function payload(): array
    {
        return [
            "filter" => $this->filter->toArray(),
            "aggs"   => $this->aggregations->toArray(),
        ];
    }
}

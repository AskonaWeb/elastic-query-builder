<?php

namespace AskonaWeb\ElasticQueryBuilder\Aggregations;

use AskonaWeb\ElasticQueryBuilder\AggregationCollection;
use AskonaWeb\ElasticQueryBuilder\Aggregations\Mixins\WithAggregations;
use stdClass;

class ReverseNestedAggregation extends Aggregation
{
    use WithAggregations;

    public static function create(string $name, Aggregation ...$aggregations): self
    {
        return new self($name, ...$aggregations);
    }

    public function __construct(string $name, Aggregation ...$aggregations)
    {
        $this->name         = $name;
        $this->aggregations = new AggregationCollection(...$aggregations);
    }

    public function payload(): array
    {
        return [
            "reverse_nested" => new stdClass(),
            "aggs"           => $this->aggregations->toArray(),
        ];
    }
}

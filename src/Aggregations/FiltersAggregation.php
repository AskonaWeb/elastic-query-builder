<?php

namespace AskonaWeb\ElasticQueryBuilder\Aggregations;

use AskonaWeb\ElasticQueryBuilder\AggregationCollection;
use AskonaWeb\ElasticQueryBuilder\Aggregations\Mixins\WithAggregations;
use AskonaWeb\ElasticQueryBuilder\Queries\Query;

class FiltersAggregation extends Aggregation
{
    use WithAggregations;

    /** @var Query[] */
    protected array $queries = [];

    public static function create(string $name): self
    {
        return new self($name);
    }

    public function __construct(string $name)
    {
        $this->name         = $name;
        $this->aggregations = new AggregationCollection();
    }

    public function addQuery(string $name, Query $query): self
    {
        $this->queries[$name] = $query;
        return $this;
    }

    public function payload(): array
    {
        $aggs = [];
        foreach ($this->queries as $aggName => $query) {
            $aggs[$aggName] = $query->toArray();
        }
        $payload = [
            "filters" => [
                "filters" => $aggs,
            ],
        ];
        if (!$this->aggregations->isEmpty()) {
            $payload["aggs"] = $this->aggregations->toArray();
        }
        return $payload;
    }
}

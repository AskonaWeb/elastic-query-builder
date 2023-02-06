<?php

namespace AskonaWeb\ElasticQueryBuilder\Aggregations;

use AskonaWeb\ElasticQueryBuilder\SortCollection;
use AskonaWeb\ElasticQueryBuilder\Sorts\Sort;

class TopHitsAggregation extends Aggregation
{
    protected int $size;

    protected ?SortCollection $sorts = null;

    public static function create(string $name, int $size): TopHitsAggregation
    {
        return new self($name, $size);
    }

    public function __construct(string $name, int $size)
    {
        $this->name = $name;
        $this->size = $size;
    }

    public function addSort(Sort $sort): TopHitsAggregation
    {
        if (!$this->sorts) {
            $this->sorts = new SortCollection();
        }
        $this->sorts->add($sort);
        return $this;
    }

    public function payload(): array
    {
        $parameters = [
            "size" => $this->size,
        ];

        if (isset($this->sorts) && !$this->sorts->isEmpty()) {
            $parameters["sort"] = $this->sorts->toArray();
        }

        return [
            "top_hits" => $parameters,
        ];
    }
}

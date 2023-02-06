<?php

namespace AskonaWeb\ElasticQueryBuilder\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\Mixins\WithMissing;

class MaxAggregation extends Aggregation
{
    use WithMissing;

    protected string $field;

    public static function create(string $name, string $field): self
    {
        return new self($name, $field);
    }

    public function __construct(string $name, string $field)
    {
        $this->name  = $name;
        $this->field = $field;
    }

    public function payload(): array
    {
        $parameters = [
            "field" => $this->field,
        ];

        if (isset($this->missing)) {
            $parameters["missing"] = $this->missing;
        }

        return [
            "max" => $parameters,
        ];
    }
}

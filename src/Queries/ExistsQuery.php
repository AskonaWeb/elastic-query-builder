<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

class ExistsQuery implements Query
{
    protected string $field;

    public static function create(string $field): self
    {
        return new self($field);
    }

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function toArray(): array
    {
        return [
            "exists" => [
                "field" => $this->field,
            ],
        ];
    }
}

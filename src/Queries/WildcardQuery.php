<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

class WildcardQuery implements Query
{
    protected string $field;
    protected string $value;

    public static function create(string $field, string $value): WildcardQuery
    {
        return new self($field, $value);
    }

    public function __construct(string $field, string $value)
    {
        $this->value = $value;
        $this->field = $field;
    }

    public function toArray(): array
    {
        return [
            "wildcard" => [
                $this->field => [
                    "value" => $this->value,
                ],
            ],
        ];
    }
}

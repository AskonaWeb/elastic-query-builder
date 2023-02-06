<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

class TermQuery implements Query
{
    protected string $field;

    protected string $value;

    public static function create(string $field, string $value): TermQuery
    {
        return new self($field, $value);
    }

    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            "term" => [
                $this->field => $this->value,
            ],
        ];
    }
}

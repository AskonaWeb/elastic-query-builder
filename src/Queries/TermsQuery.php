<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

class TermsQuery implements Query
{
    protected string $field;

    protected array $value;

    public static function create(string $field, array $value): TermsQuery
    {
        return new self($field, $value);
    }

    public function __construct(string $field, array $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            "terms" => [
                $this->field => $this->value,
            ],
        ];
    }
}

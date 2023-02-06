<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

class PrefixQuery implements Query
{
    protected string $field;

    /** @var string | int */
    protected $query;

    /**
     * @param string $field
     * @param string|int $query
     * @return self
     */
    public static function create(string $field, $query): self
    {
        return new self($field, $query);
    }

    /**
     * @param string $field
     * @param string|int $query
     */
    public function __construct(string $field, $query)
    {
        $this->query = $query;
        $this->field = $field;
    }

    public function toArray(): array
    {
        return [
            "prefix" => [
                $this->field => [
                    "value" => $this->query,
                ],
            ],
        ];
    }
}

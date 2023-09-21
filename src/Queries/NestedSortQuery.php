<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

class NestedSortQuery
{
    protected string $path;

    protected Query $query;

    public static function create(string $path, Query $query): self
    {
        return new self($path, $query);
    }

    public static function fromNestedQuery(NestedQuery $query): NestedSortQuery
    {
        return new self($query->getPath(), $query->getQuery());
    }

    public function __construct(string $path, Query $query)
    {
        $this->path  = $path;
        $this->query = $query;
    }

    public function toArray(): array
    {
        return [
            "path"   => $this->path,
            "filter" => $this->query->toArray(),
        ];
    }
}

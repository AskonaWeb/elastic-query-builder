<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

use AskonaWeb\ElasticQueryBuilder\Misc\InnerHits;

class NestedQuery implements Query
{
    protected string $path;

    protected Query $query;

    protected ?InnerHits $innerHits = null;

    public static function create(string $path, Query $query): self
    {
        return new self($path, $query);
    }

    public function __construct(string $path, Query $query)
    {
        $this->path  = $path;
        $this->query = $query;
    }

    public function innerHits(InnerHits $innerHits = null): self
    {
        if (!$innerHits) {
            $innerHits = new InnerHits();
        }
        $this->innerHits = $innerHits;
        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQuery(): Query
    {
        return $this->query;
    }

    public function toArray(): array
    {
        $query = [
            "nested" => [
                "path"  => $this->path,
                "query" => $this->query->toArray(),
            ],
        ];
        if (isset($this->innerHits)) {
            $query["nested"]["inner_hits"] = $this->innerHits->toQuery();
        }
        return $query;
    }
}

<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

use AskonaWeb\ElasticQueryBuilder\Exceptions\BoolQueryTypeDoesNotExist;

class BoolQuery implements Query
{
    protected array  $must                = [];
    protected array  $filter              = [];
    protected array  $should              = [];
    protected array  $must_not            = [];
    protected array  $allowedEmptyQueries = [];
    protected string $minimumShouldMatch;

    public static function create(): BoolQuery
    {
        return new self();
    }

    public function add(Query $query, string $type = "filter"): BoolQuery
    {
        if (!in_array($type, self::getAllowedQueryTypes())) {
            throw new BoolQueryTypeDoesNotExist($type);
        }

        $this->$type[] = $query;

        return $this;
    }

    public function allowEmptyQueries(array $types): BoolQuery
    {
        if (array_diff($types, self::getAllowedQueryTypes())) {
            throw new BoolQueryTypeDoesNotExist(implode(", ", $types));
        }
        $this->allowedEmptyQueries = $types;
        return $this;
    }

    public function setMinimumShouldMatch(string $minimumShouldMatch): BoolQuery
    {
        $this->minimumShouldMatch = $minimumShouldMatch;
        return $this;
    }

    public function toArray(): array
    {
        $bool = [
            "must"     => array_map(static fn(Query $query) => $query->toArray(), $this->must),
            "filter"   => array_map(static fn(Query $query) => $query->toArray(), $this->filter),
            "should"   => array_map(static fn(Query $query) => $query->toArray(), $this->should),
            "must_not" => array_map(static fn(Query $query) => $query->toArray(), $this->must_not),
        ];

        $payload = [
            "bool" => array_filter($bool),
        ];

        foreach ($this->allowedEmptyQueries as $queryType) {
            if (empty($payload["bool"][$queryType])) {
                $payload["bool"][$queryType] = [];
            }
        }

        if (!empty($this->minimumShouldMatch) && !empty($payload["bool"])) {
            $payload["bool"]["minimum_should_match"] = $this->minimumShouldMatch;
        }

        return $payload;
    }

    protected static function getAllowedQueryTypes(): array
    {
        return ["must", "filter", "should", "must_not"];
    }
}

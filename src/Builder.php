<?php

namespace AskonaWeb\ElasticQueryBuilder;

use AskonaWeb\ElasticQueryBuilder\Aggregations\Aggregation;
use AskonaWeb\ElasticQueryBuilder\Queries\BoolQuery;
use AskonaWeb\ElasticQueryBuilder\Queries\Query;
use AskonaWeb\ElasticQueryBuilder\Sorts\Sort;

class Builder
{
    protected ?BoolQuery             $query            = null;
    protected ?AggregationCollection $aggregations     = null;
    protected ?SortCollection        $sorts            = null;
    protected ?string                $searchIndex      = null;
    protected ?int                   $size             = null;
    protected ?int                   $from             = null;
    protected ?array                 $searchAfter      = null;
    protected ?array                 $source           = null;
    protected bool                   $withAggregations = true;

    public static function create(): Builder
    {
        return new self();
    }

    public function addQuery(Query $query, string $boolType = "filter"): Builder
    {
        if (!$this->query) {
            $this->query = new BoolQuery();
        }

        $this->query->add($query, $boolType);

        return $this;
    }

    public function addAggregation(Aggregation $aggregation): Builder
    {
        if (!$this->aggregations) {
            $this->aggregations = new AggregationCollection();
        }

        $this->aggregations->add($aggregation);

        return $this;
    }

    public function addSort(Sort $sort): Builder
    {
        if (!$this->sorts) {
            $this->sorts = new SortCollection();
        }

        $this->sorts->add($sort);

        return $this;
    }

    public function getQuery(): ?BoolQuery
    {
        return $this->query;
    }

    public function getRequestParams(): array
    {
        $payload = $this->getPayload();

        $params = [
            "body" => $payload,
        ];

        if ($this->searchIndex) {
            $params["index"] = $this->searchIndex;
        }

        if ($this->size !== null) {
            $params["size"] = $this->size;
        }

        if ($this->from !== null) {
            $params["from"] = $this->from;
        }
        return $params;
    }

    public function index(string $searchIndex): Builder
    {
        $this->searchIndex = $searchIndex;

        return $this;
    }

    public function size(int $size): Builder
    {
        $this->size = $size;

        return $this;
    }

    public function from(int $from): Builder
    {
        $this->from = $from;

        return $this;
    }

    public function searchAfter(?array $searchAfter): Builder
    {
        $this->searchAfter = $searchAfter;

        return $this;
    }

    public function source(array $source): Builder
    {
        $this->source = array_merge($this->source ?? [], $source);

        return $this;
    }

    public function withAggregations(bool $withAggregations): Builder
    {
        $this->withAggregations = $withAggregations;

        return $this;
    }

    public function getPayload(): array
    {
        $payload = [];

        if ($this->query) {
            $payload["query"] = $this->query->toArray();
        }

        if ($this->withAggregations && $this->aggregations) {
            $payload["aggs"] = $this->aggregations->toArray();
        }

        if ($this->sorts) {
            $payload["sort"] = $this->sorts->toArray();
        }

        if ($this->source) {
            $payload["_source"] = $this->source;
        }

        if ($this->searchAfter) {
            $payload["search_after"] = $this->searchAfter;
        }

        return $payload;
    }
}

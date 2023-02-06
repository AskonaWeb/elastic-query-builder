<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\FilterAggregation;
use AskonaWeb\ElasticQueryBuilder\Queries\TermQuery;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;
use AskonaWeb\ElasticQueryBuilder\Tests\WithAggregationTestTrait;

/**
 * @property FilterAggregation $agg
 */
class FilterAggregationTest extends AggTestCase
{
    use WithAggregationTestTrait;

    private string    $field;
    private TermQuery $filter;

    protected function setUp(): void
    {
        $this->field  = "somefield";
        $this->filter = TermQuery::create("foo", "bar");
        $this->agg    = FilterAggregation::create($this->aggName, $this->filter);
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "filter" => $this->filter->toArray(),
            "aggs"   => [],
        ];
    }
}

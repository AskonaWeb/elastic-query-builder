<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\FilterAggregation;
use AskonaWeb\ElasticQueryBuilder\Aggregations\NestedAggregation;
use AskonaWeb\ElasticQueryBuilder\Aggregations\ReverseNestedAggregation;
use AskonaWeb\ElasticQueryBuilder\Queries\TermQuery;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;
use AskonaWeb\ElasticQueryBuilder\Tests\WithAggregationTestTrait;
use stdClass;

/**
 * @property ReverseNestedAggregation $agg
 */
class ReverseNestedAggregationTest extends AggTestCase
{
    use WithAggregationTestTrait;

    protected function setUp(): void
    {
        $this->agg = ReverseNestedAggregation::create($this->aggName);
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "reverse_nested" => new stdClass(),
            "aggs"           => [],
        ];
    }
}

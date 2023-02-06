<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\FilterAggregation;
use AskonaWeb\ElasticQueryBuilder\Aggregations\NestedAggregation;
use AskonaWeb\ElasticQueryBuilder\Queries\TermQuery;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;
use AskonaWeb\ElasticQueryBuilder\Tests\WithAggregationTestTrait;

/**
 * @property NestedAggregation $agg
 */
class NestedAggregationTest extends AggTestCase
{
    use WithAggregationTestTrait;

    private string $path;

    protected function setUp(): void
    {
        $this->path = "path.to.neseted";
        $this->agg  = NestedAggregation::create($this->aggName, $this->path);
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "nested" => [
                "path" => $this->path,
            ],
            "aggs"   => [],
        ];
    }
}

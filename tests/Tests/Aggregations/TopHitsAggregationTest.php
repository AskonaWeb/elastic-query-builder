<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\MaxAggregation;
use AskonaWeb\ElasticQueryBuilder\Aggregations\StatsAggregation;
use AskonaWeb\ElasticQueryBuilder\Aggregations\TopHitsAggregation;
use AskonaWeb\ElasticQueryBuilder\Sorts\Sort;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;

/**
 * @property TopHitsAggregation $agg
 */
class TopHitsAggregationTest extends AggTestCase
{
    private int $size;

    protected function setUp(): void
    {
        $this->size = 15;
        $this->agg  = TopHitsAggregation::create($this->aggName, $this->size);
    }

    public function testWithSort()
    {
        $sortField = "some.field.to.sort.on";
        $sortOrder = Sort::ASC;
        $sort      = Sort::create($sortField, $sortOrder);
        $this->agg->addSort($sort);

        $expectedPayload             = $this->getDefaultExpectedPayload();
        $expectedPayload["top_hits"] = array_merge($expectedPayload["top_hits"], [
            "sort" => [
                [
                    $sortField => [
                        "order" => $sortOrder,
                    ],
                ],
            ],
        ]);

        $this->assertEquals($expectedPayload, $this->agg->toArray());
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "top_hits" => [
                "size" => $this->size,
            ],
        ];
    }
}

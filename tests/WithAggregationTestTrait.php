<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests;

use AskonaWeb\ElasticQueryBuilder\Aggregations\MaxAggregation;

trait WithAggregationTestTrait
{
    abstract protected function getDefaultExpectedPayload(): array;

    public function testWithAgg(): void
    {
        $fooBarAggName           = "moreAggName";
        $fooBarAggField          = "moreAggField";
        $fooBarAgg               = MaxAggregation::create($fooBarAggName, $fooBarAggField);
        $expectedPayload         = $this->getDefaultExpectedPayload();
        $expectedPayload["aggs"] = [
            $fooBarAggName => $fooBarAgg->payload(),
        ];
        $this->agg->aggregation($fooBarAgg);
        $this->assertEquals($expectedPayload, $this->agg->payload());
    }
}

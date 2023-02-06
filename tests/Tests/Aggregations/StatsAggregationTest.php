<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\MaxAggregation;
use AskonaWeb\ElasticQueryBuilder\Aggregations\StatsAggregation;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;

/**
 * @property StatsAggregation $agg
 */
class StatsAggregationTest extends AggTestCase
{
    private string $field;
    private string $missing;

    protected function setUp(): void
    {
        $this->field   = "somefield";
        $this->missing = "0";
        $this->agg     = StatsAggregation::create($this->aggName, $this->field);
    }

    public function testWithMissing(): void
    {
        $expectedPayload = $this->getDefaultExpectedPayload();

        $expectedPayload["stats"]["missing"] = $this->missing;
        $this->agg->missing($this->missing);
        $this->assertEquals($expectedPayload, $this->agg->payload());
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "stats" => [
                "field" => $this->field,
            ],
        ];
    }
}

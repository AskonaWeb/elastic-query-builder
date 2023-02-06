<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\MinAggregation;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;

/**
 * @property MinAggregation $agg
 */
class MinAggregationTest extends AggTestCase
{
    private string $field;
    private string $missing;

    protected function setUp(): void
    {
        $this->field   = "somefield";
        $this->missing = "0";
        $this->agg     = MinAggregation::create($this->aggName, $this->field);
    }

    public function testWithMissing(): void
    {
        $expectedPayload = $this->getDefaultExpectedPayload();

        $expectedPayload["min"]["missing"] = $this->missing;
        $this->agg->missing($this->missing);
        $this->assertEquals($expectedPayload, $this->agg->payload());
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "min" => [
                "field" => $this->field,
            ],
        ];
    }
}

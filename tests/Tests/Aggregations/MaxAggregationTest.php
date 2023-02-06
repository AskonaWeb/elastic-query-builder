<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\MaxAggregation;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;

/**
 * @property MaxAggregation $agg
 */
class MaxAggregationTest extends AggTestCase
{
    private string $field;
    private string $missing;

    protected function setUp(): void
    {
        $this->field   = "somefield";
        $this->missing = "0";
        $this->agg     = MaxAggregation::create($this->aggName, $this->field);
    }

    public function testWithMissing(): void
    {
        $expectedPayload = $this->getDefaultExpectedPayload();

        $expectedPayload["max"]["missing"] = $this->missing;
        $this->agg->missing($this->missing);
        $this->assertEquals($expectedPayload, $this->agg->payload());
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "max" => [
                "field" => $this->field,
            ],
        ];
    }
}

<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\CardinalityAggregation;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;

/**
 * @property CardinalityAggregation $agg
 */
class CardinalityAggregationTest extends AggTestCase
{
    private string $field;
    private string $missing;

    protected function setUp(): void
    {
        $this->field   = "somefield";
        $this->missing = "missing_value";
        $this->agg     = CardinalityAggregation::create($this->aggName, $this->field);
    }

    public function testWithMissing(): void
    {
        $expectedPayload = $this->getDefaultExpectedPayload();
        $expectedPayload["cardinality"]["missing"] = $this->missing;
        $this->agg->missing($this->missing);
        $this->assertEquals($expectedPayload, $this->agg->payload());
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "cardinality" => [
                "field" => $this->field,
            ],
        ];
    }
}

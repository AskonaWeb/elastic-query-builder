<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\FilterAggregation;
use AskonaWeb\ElasticQueryBuilder\Aggregations\NestedAggregation;
use AskonaWeb\ElasticQueryBuilder\Aggregations\TermsAggregation;
use AskonaWeb\ElasticQueryBuilder\Queries\TermQuery;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;
use AskonaWeb\ElasticQueryBuilder\Tests\WithAggregationTestTrait;

/**
 * @property TermsAggregation $agg
 */
class TermsAggregationTest extends AggTestCase
{
    use WithAggregationTestTrait;

    private string $field;
    private string $missing;

    protected function setUp(): void
    {
        $this->field   = "fieldname";
        $this->missing = "0";
        $this->agg     = TermsAggregation::create($this->aggName, $this->field);
    }

    public function testWithMissing(): void
    {
        $expectedPayload = $this->getDefaultExpectedPayload();

        $expectedPayload["terms"]["missing"] = $this->missing;
        $this->agg->missing($this->missing);
        $this->assertEquals($expectedPayload, $this->agg->payload());
    }

    public function testOrderAndSize(): void
    {
        $size  = 10;
        $order = ["some_nested_agg" => "desc"];
        $this->agg->size($size);
        $this->agg->order($order);

        $expectedPayload          = $this->getDefaultExpectedPayload();
        $expectedPayload["terms"] = array_merge($expectedPayload["terms"], [
            "size"  => $size,
            "order" => $order,
        ]);

        $this->assertEquals($expectedPayload, $this->agg->toArray());
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "terms" => [
                "field" => $this->field,
            ],
        ];
    }
}

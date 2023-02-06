<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\RangeQuery;
use PHPUnit\Framework\TestCase;

class RangeQueryTest extends TestCase
{
    private string     $fieldName;
    private RangeQuery $rangeQuery;

    protected function setUp(): void
    {
        $this->fieldName  = "price";
        $this->rangeQuery = RangeQuery::create($this->fieldName);
    }

    public function testEmptyRanges(): void
    {
        $expectedPayload = [
            "range" => [
                $this->fieldName => [],
            ],
        ];
        $this->assertEquals($expectedPayload, $this->rangeQuery->toArray());
    }

    public function testFilledRanges(): void
    {
        $lt  = 1;
        $gt  = 2;
        $lte = 3;
        $gte = 4;
        $this->rangeQuery->lt($lt)->gt($gt)->lte($lte)->gte($gte);
        $expectedPayload = [
            "range" => [
                $this->fieldName => [
                    "lt"  => $lt,
                    "gt"  => $gt,
                    "lte" => $lte,
                    "gte" => $gte,
                ],
            ],
        ];
        $this->assertEquals($expectedPayload, $this->rangeQuery->toArray());
    }
}

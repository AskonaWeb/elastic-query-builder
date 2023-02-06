<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Misc;

use AskonaWeb\ElasticQueryBuilder\Misc\InnerHits;
use AskonaWeb\ElasticQueryBuilder\Sorts\Sort;
use PHPUnit\Framework\TestCase;
use stdClass;

class InnerHitsTest extends TestCase
{
    private InnerHits $innerHits;

    protected function setUp(): void
    {
        $this->innerHits = InnerHits::create();
    }

    public function testEmpty(): void
    {
        $this->assertEquals(new stdClass(), $this->innerHits->toQuery());
    }

    public function testSorted(): void
    {
        $sortFieldA = "sorts.fieldA";
        $sortFieldB = "sorts.fieldB";
        $this->innerHits
            ->addSort(Sort::create($sortFieldA))
            ->addSort(Sort::create($sortFieldB, Sort::ASC));
        $expectedPayload = [
            "sort" => [
                [
                    $sortFieldA => [
                        "order" => Sort::DESC,
                    ],
                ],
                [
                    $sortFieldB => [
                        "order" => Sort::ASC,
                    ],
                ],
            ],
        ];
        $this->assertEquals($expectedPayload, $this->innerHits->toQuery());
    }

    public function testSource(): void
    {
        $source = [
            "path.to.source",
        ];
        $this->innerHits->source($source);

        $expectedPayload = [
            "_source" => $source,
        ];

        $this->assertEquals($expectedPayload, $this->innerHits->toQuery());
    }

    public function testFromSize(): void
    {
        $from = 5;
        $size = 20;
        $this->innerHits->from($from);
        $this->innerHits->size($size);
        $expectedPayload = [
            "from" => $from,
            "size" => $size,
        ];
        $this->assertEquals($expectedPayload, $this->innerHits->toQuery());
    }
}

<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Sorts;

use AskonaWeb\ElasticQueryBuilder\Queries\NestedSortQuery;
use AskonaWeb\ElasticQueryBuilder\Queries\TermsQuery;
use AskonaWeb\ElasticQueryBuilder\Sorts\Sort;
use PHPUnit\Framework\TestCase;

class SortTest extends TestCase
{
    private string $field;
    private string $missing;
    private string $unmappedType;
    private string $customOrder;
    private Sort   $sort;

    protected function setUp(): void
    {
        $this->field        = "sortFieldName";
        $this->missing      = "_last";
        $this->unmappedType = "keyword";
        $this->customOrder  = Sort::ASC;
        $this->sort         = Sort::create($this->field);
    }

    public function testDefaultOrder(): void
    {
        $payload = $this->sort->toArray();
        $this->assertEquals(Sort::DESC, $payload[$this->field]["order"]);
    }

    public function testCustomOrderPayload(): void
    {
        $this->sort->order($this->customOrder);
        $expectedPayload = [
            $this->field => [
                "order" => $this->customOrder,
            ],
        ];
        $this->assertEquals($expectedPayload, $this->sort->toArray());
    }

    public function testMissingAndUnmappedPayload(): void
    {
        $this->sort->missing($this->missing);
        $this->sort->unmappedType($this->unmappedType);
        $expectedPayload = [
            $this->field => [
                "order"         => Sort::DESC,
                "missing"       => $this->missing,
                "unmapped_type" => $this->unmappedType,
            ],
        ];
        $this->assertEquals($expectedPayload, $this->sort->toArray());
    }

    public function testSortWithNestedQuery(): void
    {
        $nestedSortQuery = NestedSortQuery::create("foo.bar", TermsQuery::create("foo", ["foobar"]));

        $this->sort->setNestedQuery($nestedSortQuery);
        $this->assertArrayHasKey("nested", $this->sort->toArray()[$this->field]);
        $this->assertEquals($nestedSortQuery->toArray(), $this->sort->toArray()[$this->field]["nested"]);

    }
}

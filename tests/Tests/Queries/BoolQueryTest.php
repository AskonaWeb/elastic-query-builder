<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\BoolQuery;
use AskonaWeb\ElasticQueryBuilder\Queries\TermQuery;
use AskonaWeb\ElasticQueryBuilder\Tests\UnitUtils;
use PHPUnit\Framework\TestCase;

class BoolQueryTest extends TestCase
{
    private BoolQuery $boolQuery;

    protected function setUp(): void
    {
        $this->boolQuery = BoolQuery::create();
    }

    public function testAllowEmptyQueries(): void
    {
        $this->assertEquals(
            [
                "bool" => [],
            ],
            $this->boolQuery->toArray()
        );
        $this->boolQuery->allowEmptyQueries(["filter"]);
        $this->assertEquals(
            [
                "bool" => [
                    "filter" => [],
                ],
            ],
            $this->boolQuery->toArray()
        );
    }

    public function testDefaultQueryType(): void
    {
        $this->boolQuery->add(TermQuery::create("foo", "bar"));
        $actualQueryType = key($this->boolQuery->toArray()["bool"]);
        $this->assertEquals("filter", $actualQueryType);
    }

    public function testQueryTypes(): void
    {
        $expectedQueryTypes = ["must", "filter", "should", "must_not"];
        $actualQueryTypes = UnitUtils::callMethod($this->boolQuery, "getAllowedQueryTypes");
        $this->assertEquals($expectedQueryTypes, $actualQueryTypes);
    }
}

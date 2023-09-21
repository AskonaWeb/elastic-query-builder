<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\MatchQuery;
use AskonaWeb\ElasticQueryBuilder\Queries\NestedQuery;
use AskonaWeb\ElasticQueryBuilder\Queries\NestedSortQuery;
use PHPUnit\Framework\TestCase;

class NestedSortQueryTest extends TestCase
{
    private NestedSortQuery $nestedSortQuery;
    private string          $path;
    private MatchQuery      $exampleQuery;

    protected function setUp(): void
    {
        $this->path            = "example.path";
        $this->exampleQuery    = MatchQuery::create("foo", "bar");
        $this->nestedSortQuery = NestedSortQuery::create($this->path, $this->exampleQuery);
    }

    public function testToArray(): void
    {
        $expectedPayload = [
            "path"   => $this->path,
            "filter" => $this->exampleQuery->toArray(),
        ];
        $this->assertEquals($expectedPayload, $this->nestedSortQuery->toArray());
    }

    public function testFromNestedQuery(): void
    {
        $nestedQuery = NestedQuery::create($this->path, $this->exampleQuery);
        $sut         = NestedSortQuery::fromNestedQuery($nestedQuery);
        $this->assertEquals([
            "path"   => $this->path,
            "filter" => $this->exampleQuery->toArray(),
        ], $sut->toArray());
    }
}

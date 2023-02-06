<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\MatchQuery;
use AskonaWeb\ElasticQueryBuilder\Queries\NestedQuery;
use PHPUnit\Framework\TestCase;
use stdClass;

class NestedQueryTest extends TestCase
{
    private NestedQuery $nestedQuery;
    private string      $path;
    private MatchQuery  $exampleQuery;

    protected function setUp(): void
    {
        $this->path         = "example.path";
        $this->exampleQuery = MatchQuery::create("foo", "bar");
        $this->nestedQuery  = NestedQuery::create($this->path, $this->exampleQuery);
    }

    public function testPayloadNoInnerHits(): void
    {
        $expectedPayload = [
            "nested" => [
                "path"  => $this->path,
                "query" => $this->exampleQuery->toArray(),
            ],
        ];
        $this->assertEquals($expectedPayload, $this->nestedQuery->toArray());
    }

    public function testPayloadWithInnerHits(): void
    {
        $this->nestedQuery->innerHits();

        $expectedPayload = [
            "nested" => [
                "path"       => $this->path,
                "query"      => $this->exampleQuery->toArray(),
                "inner_hits" => new stdClass(),
            ],
        ];

        $this->assertEquals($expectedPayload, $this->nestedQuery->toArray());
    }
}

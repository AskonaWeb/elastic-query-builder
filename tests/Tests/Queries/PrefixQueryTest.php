<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\PrefixQuery;
use PHPUnit\Framework\TestCase;

class PrefixQueryTest extends TestCase
{
    private string      $fieldName;
    private string      $matchQueryString;
    private PrefixQuery $prefixQuery;

    protected function setUp(): void
    {
        $this->fieldName        = "foo";
        $this->matchQueryString = "match this example";
        $this->prefixQuery      = PrefixQuery::create($this->fieldName, $this->matchQueryString);
    }

    public function testPayloadNoFuzzy(): void
    {
        $expectedPayload = [
            "prefix" => [
                $this->fieldName => [
                    "value" => $this->matchQueryString,
                ],
            ],
        ];
        $this->assertEquals($expectedPayload, $this->prefixQuery->toArray());
    }
}

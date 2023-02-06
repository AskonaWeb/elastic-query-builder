<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\WildcardQuery;
use PHPUnit\Framework\TestCase;

class WildcardQueryTest extends TestCase
{
    private WildcardQuery $query;
    private string    $field;
    private string    $value;

    protected function setUp(): void
    {
        $this->field = "foo";
        $this->value = "bar";
        $this->query = WildcardQuery::create($this->field, $this->value);
    }

    public function testPayload(): void
    {
        $expectedPayload = [
            "wildcard" => [
                $this->field => [
                    "value" => $this->value,
                ],
            ],
        ];
        $this->assertEquals($expectedPayload, $this->query->toArray());
    }
}

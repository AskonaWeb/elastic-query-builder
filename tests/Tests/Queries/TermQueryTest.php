<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\TermQuery;
use PHPUnit\Framework\TestCase;

class TermQueryTest extends TestCase
{
    private TermQuery $query;
    private string    $field;
    private string    $value;

    protected function setUp(): void
    {
        $this->field = "foo";
        $this->value = "bar";
        $this->query = TermQuery::create($this->field, $this->value);
    }

    public function testPayload(): void
    {
        $expectedPayload = [
            "term" => [
                $this->field => $this->value,
            ],
        ];
        $this->assertEquals($expectedPayload, $this->query->toArray());
    }
}

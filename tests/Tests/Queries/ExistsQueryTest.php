<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\ExistsQuery;
use PHPUnit\Framework\TestCase;

class ExistsQueryTest extends TestCase
{
    private ExistsQuery $query;
    private string      $fieldName;

    protected function setUp(): void
    {
        $this->fieldName = "foo";
        $this->query     = ExistsQuery::create($this->fieldName);
    }

    public function testPayload(): void
    {
        $expectedPayload = [
            "exists" => [
                "field" => $this->fieldName,
            ],
        ];
        $this->assertEquals($expectedPayload, $this->query->toArray());
    }
}

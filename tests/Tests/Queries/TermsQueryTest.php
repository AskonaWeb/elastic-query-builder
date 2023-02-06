<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\TermsQuery;
use PHPUnit\Framework\TestCase;

class TermsQueryTest extends TestCase
{
    private TermsQuery $query;
    private string     $field;
    private array      $value;

    protected function setUp(): void
    {
        $this->field = "foo";
        $this->value = [
            "foo.bar1",
            "foo.bar2",
        ];
        $this->query = TermsQuery::create($this->field, $this->value);
    }

    public function testPayload(): void
    {
        $expectedPayload = [
            "terms" => [
                $this->field => $this->value,
            ],
        ];
        $this->assertEquals($expectedPayload, $this->query->toArray());
    }
}

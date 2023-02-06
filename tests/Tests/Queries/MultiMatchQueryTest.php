<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\MultiMatchQuery;
use PHPUnit\Framework\TestCase;

class MultiMatchQueryTest extends TestCase
{
    private string $queryString;
    private string $fuzziness;
    private string $type;
    private array  $fields;

    protected function setUp(): void
    {
        $this->queryString = "match this example";
        $this->fuzziness   = "AUTO";
        $this->type        = MultiMatchQuery::TYPE_PHRASE;
        $this->fields      = [
            "*.name",
            "title",
        ];
    }

    public function testPayloadNoFuzzyNoType(): void
    {
        $query = MultiMatchQuery::create($this->queryString, $this->fields);

        $expectedPayload = [
            "multi_match" => [
                "query"  => $this->queryString,
                "fields" => $this->fields,
            ],
        ];

        $this->assertEquals($expectedPayload, $query->toArray());
    }

    public function testPayloadFuzzyWithType(): void
    {
        $query = MultiMatchQuery::create($this->queryString, $this->fields, $this->fuzziness, $this->type);

        $expectedPayload = [
            "multi_match" => [
                "query"     => $this->queryString,
                "fields"    => $this->fields,
                "type"      => $this->type,
                "fuzziness" => $this->fuzziness,
            ],
        ];

        $this->assertEquals($expectedPayload, $query->toArray());
    }
}

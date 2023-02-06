<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Queries;

use AskonaWeb\ElasticQueryBuilder\Queries\MatchQuery;
use PHPUnit\Framework\TestCase;

class MatchQueryTest extends TestCase
{
    private string $fieldName;
    private string $matchQueryString;
    private string $fuzziness;

    protected function setUp(): void
    {
        $this->fieldName        = "foo";
        $this->matchQueryString = "match this example";
        $this->fuzziness        = "AUTO";
    }

    public function testPayloadNoFuzzy(): void
    {
        $query           = MatchQuery::create($this->fieldName, $this->matchQueryString);
        $expectedPayload = [
            "match" => [
                $this->fieldName => [
                    "query" => $this->matchQueryString,
                ],
            ],
        ];
        $this->assertEquals($expectedPayload, $query->toArray());
    }

    public function testPayloadFuzzy(): void
    {
        $query = MatchQuery::create($this->fieldName, $this->matchQueryString, $this->fuzziness);

        $expectedPayload = [
            "match" => [
                $this->fieldName => [
                    "query"     => $this->matchQueryString,
                    "fuzziness" => $this->fuzziness,
                ],
            ],
        ];
        $this->assertEquals($expectedPayload, $query->toArray());
    }
}

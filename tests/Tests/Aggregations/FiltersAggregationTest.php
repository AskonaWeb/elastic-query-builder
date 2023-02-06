<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\FiltersAggregation;
use AskonaWeb\ElasticQueryBuilder\Queries\TermQuery;
use AskonaWeb\ElasticQueryBuilder\Queries\TermsQuery;
use AskonaWeb\ElasticQueryBuilder\Tests\AggTestCase;
use AskonaWeb\ElasticQueryBuilder\Tests\WithAggregationTestTrait;

/**
 * @property FiltersAggregation $agg
 */
class FiltersAggregationTest extends AggTestCase
{
    use WithAggregationTestTrait;

    private TermQuery $filter;

    protected function setUp(): void
    {
        $this->filter = TermQuery::create("foo", "bar");
        $this->agg    = FiltersAggregation::create($this->aggName);
    }

    public function testAggQueries(): void
    {
        $queryAggNameA   = "agg_queryA";
        $queryA          = TermQuery::create("foo", "bar");
        $queryAggNameB   = "agg_queryB";
        $queryB          = TermsQuery::create("foo", ["bar"]);
        $expectedPayload = $this->getDefaultExpectedPayload();

        $expectedPayload["filters"]["filters"][$queryAggNameA] = $queryA->toArray();
        $expectedPayload["filters"]["filters"][$queryAggNameB] = $queryB->toArray();

        $this->agg->addQuery($queryAggNameA, $queryA);
        $this->agg->addQuery($queryAggNameB, $queryB);

        $this->assertEquals($expectedPayload, $this->agg->payload());
    }

    protected function getDefaultExpectedPayload(): array
    {
        return [
            "filters" => [
                "filters" => [],
            ],
        ];
    }
}

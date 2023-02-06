<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests;

use AskonaWeb\ElasticQueryBuilder\Aggregations\Aggregation;
use PHPUnit\Framework\TestCase;

abstract class AggTestCase extends TestCase
{
    protected Aggregation $agg;
    protected string      $aggName = "agg_name";
    protected array       $meta    = [
        "custom-metadata-field" => "foo"
    ];

    public function testName(): void
    {
        $this->assertEquals($this->aggName, $this->agg->getName());
    }

    public function testMeta(): void
    {
        $this->agg->meta($this->meta);
        $aggPayload = $this->agg->payload();
        $aggPayload["meta"] = $this->meta;
        $this->assertEquals($aggPayload, $this->agg->toArray());
    }

    public function testDefaultPayload(): void
    {
        $this->assertEquals($this->getDefaultExpectedPayload(), $this->agg->payload());
    }

    abstract protected function getDefaultExpectedPayload(): array;
}

<?php

namespace AskonaWeb\ElasticQueryBuilder\Tests\Tests\Aggregations;

use AskonaWeb\ElasticQueryBuilder\Aggregations\Mixins\WithMissing;
use PHPUnit\Framework\TestCase;

class WithMissingTest extends TestCase
{
    use WithMissing;

    public function testValue(): void
    {
        $this->assertNull($this->missing);
        $missingValue = "100";
        $this->missing($missingValue);
        $this->assertEquals($missingValue, $this->missing);
    }
}

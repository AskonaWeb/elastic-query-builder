<?php

namespace AskonaWeb\ElasticQueryBuilder\Aggregations\Mixins;

use AskonaWeb\ElasticQueryBuilder\AggregationCollection;
use AskonaWeb\ElasticQueryBuilder\Aggregations\Aggregation;

trait WithAggregations
{
    protected AggregationCollection $aggregations;

    public function aggregation(Aggregation $aggregation): self
    {
        $this->aggregations->add($aggregation);

        return $this;
    }
}

<?php

namespace AskonaWeb\ElasticQueryBuilder\Aggregations\Mixins;

trait WithMissing
{
    protected ?string $missing = null;

    public function missing(string $missingValue): self
    {
        $this->missing = $missingValue;

        return $this;
    }
}

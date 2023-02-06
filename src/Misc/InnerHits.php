<?php

namespace AskonaWeb\ElasticQueryBuilder\Misc;

use AskonaWeb\ElasticQueryBuilder\SortCollection;
use AskonaWeb\ElasticQueryBuilder\Sorts\Sort;
use stdClass;

class InnerHits
{
    private SortCollection $sorts;
    private ?int           $from = null;
    private ?int           $size = null;
    private ?array         $source = null;

    public static function create(): InnerHits
    {
        return new self();
    }

    public function __construct()
    {
        $this->sorts = new SortCollection();
    }

    public function addSort(Sort $sort): InnerHits
    {
        $this->sorts->add($sort);
        return $this;
    }

    public function from(int $from): InnerHits
    {
        $this->from = $from;
        return $this;
    }

    public function size(int $size): InnerHits
    {
        $this->size = $size;
        return $this;
    }

    public function source(array $source): InnerHits
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return array|stdClass
     */
    public function toQuery()
    {
        $payload = [];
        if (!$this->sorts->isEmpty()) {
            $payload["sort"] = $this->sorts->toArray();
        }
        if ($this->from) {
            $payload["from"] = $this->from;
        }
        if (isset($this->size)) {
            $payload["size"] = $this->size;
        }
        if (isset($this->source)) {
            $payload["_source"] = $this->source;
        }
        return $payload === [] ? new stdClass() : $payload;
    }
}

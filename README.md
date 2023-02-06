# elastic-query-builder

## Installation

Composer:
```bash
composer require spatie/elasticsearch-query-builder
```

## Usage
```php
use AskonaWeb\ElasticQueryBuilder\Aggregations\MaxAggregation;
use AskonaWeb\ElasticQueryBuilder\Builder;
use AskonaWeb\ElasticQueryBuilder\Queries\NestedQuery;
use AskonaWeb\ElasticQueryBuilder\Queries\TermQuery;
use AskonaWeb\ElasticQueryBuilder\Sorts\Sort;

$payload = Builder::create()
    ->index("indexName")
    ->addQuery(NestedQuery::create("path.to.something", TermQuery::create("field", "value")))
    ->addSort(Sort::create("sortfield", Sort::ASC))
    ->addAggregation(MaxAggregation::create("agg_max_score", "myscore"))
    ->getPayload();
```

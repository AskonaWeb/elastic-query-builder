# elastic-query-builder

[![Latest Stable Version](http://poser.pugx.org/askonaweb/elastic-query-builder/v)](https://packagist.org/packages/askonaweb/elastic-query-builder) [![Total Downloads](http://poser.pugx.org/askonaweb/elastic-query-builder/downloads)](https://packagist.org/packages/askonaweb/elastic-query-builder) [![License](http://poser.pugx.org/askonaweb/elastic-query-builder/license)](https://packagist.org/packages/askonaweb/elastic-query-builder) [![PHP Version Require](http://poser.pugx.org/askonaweb/elastic-query-builder/require/php)](https://packagist.org/packages/askonaweb/elastic-query-builder)

## Installation

Composer:
```bash
composer require askonaweb/elastic-query-builder
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

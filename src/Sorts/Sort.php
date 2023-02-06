<?php

namespace AskonaWeb\ElasticQueryBuilder\Sorts;

class Sort
{
    public const ASC = "asc";
    public const DESC = "desc";

    protected string $field;

    protected string $order;

    protected ?string $missing = null;

    protected ?string $unmappedType = null;

    public static function create(string $field, string $order = self::DESC): Sort
    {
        return new self($field, $order);
    }

    public function __construct(string $field, string $order)
    {
        $this->field = $field;
        $this->order = $order;
    }

    public function order(string $order): Sort
    {
        $this->order = $order;
        return $this;
    }

    public function missing(string $missing): Sort
    {
        $this->missing = $missing;

        return $this;
    }

    public function unmappedType(string $unmappedType): Sort
    {
        $this->unmappedType = $unmappedType;

        return $this;
    }

    public function toArray(): array
    {
        $payload = [
            "order" => $this->order,
        ];

        if (isset($this->missing)) {
            $payload["missing"] = $this->missing;
        }

        if ($this->unmappedType) {
            $payload["unmapped_type"] = $this->unmappedType;
        }

        return [
            $this->field => $payload,
        ];
    }
}

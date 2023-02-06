<?php

namespace AskonaWeb\ElasticQueryBuilder\Queries;

class MatchQuery implements Query
{
    /** @var null|string|int */
    protected $fuzziness;

    /** @var string|int */
    protected $query;

    protected string $field;

    /**
     * @param string $field
     * @param string|int $query
     * @param string|int $fuzziness
     * @return self
     */
    public static function create(string $field, $query, $fuzziness = null): MatchQuery
    {
        return new self($field, $query, $fuzziness);
    }

    /**
     * @param string $field
     * @param string|int $query
     * @param string|int $fuzziness
     */
    public function __construct(string $field, $query, $fuzziness = null)
    {
        $this->field     = $field;
        $this->query     = $query;
        $this->fuzziness = $fuzziness;
    }

    public function toArray(): array
    {
        $match = [
            "match" => [
                $this->field => [
                    "query" => $this->query,
                ],
            ],
        ];

        if ($this->fuzziness) {
            $match["match"][$this->field]["fuzziness"] = $this->fuzziness;
        }

        return $match;
    }
}

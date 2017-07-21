<?php

namespace App\Models\Database;

/**
 * Trait Queryable
 *
 * @author EB
 * @package Api\Models\Query
 */
trait Queryable
{
    /**
     * @author EB
     * @var array
     */
    protected $queryable = [];

    /**
     * @author EB
     * @return array
     */
    public function getQueryableAttributes()
    {
        return $this->queryable;
    }
}

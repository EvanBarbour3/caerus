<?php

namespace App\Models\Contracts;

/**
 * Interface Queryable
 *
 * @author EB
 * @package Api\Models\Query
 */
interface Queryable
{
    /** Unused for now */
    const FILTER_TYPE_STRICT = 1;

    /**
     * @author EB
     * @return array
     */
    public function getQueryableAttributes();
}

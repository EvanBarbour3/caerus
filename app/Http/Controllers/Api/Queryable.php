<?php

namespace App\Http\Controllers\Api;

use App\Models\Exception\ModelNotQueryableException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class Queryable
 *
 * @author EB
 * @package App\Http\Controllers\Api
 */
trait Queryable
{
    /**
     * @author EB
     * @var int
     */
    protected $paginationCount = 15;

    /**
     * @author EB
     * @param Model $model
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function queryModel(Model $model)
    {
        $model = $this->checkModelIsQueryable($model);

        $query = $this->getQuery($model);
        $request = $this->getCurrentRequest();

        $filters = $request->only($model->getQueryableAttributes());

        foreach ($filters as $k => $v) {
            $query->where($k, 'like', '%' . $v . '%');
        }

        return $query->paginate($request->get('per_page', $this->getPaginationCount()));
    }

    /**
     * @author EB
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getQuery(Model $model)
    {
        return $model->newQuery();
    }

    /**
     * @author EB
     * @return Request
     */
    protected function getCurrentRequest()
    {
        return Request::capture();
    }

    /**
     * Returns the pagination count
     *
     * @author EB
     * @return int
     */
    protected function getPaginationCount()
    {
        return $this->paginationCount;
    }

    /**
     * @author EB
     * @param Model $model
     * @return \App\Models\Contracts\Queryable
     * @throws ModelNotQueryableException
     */
    private function checkModelIsQueryable(Model $model)
    {
        if (!($model instanceof \App\Models\Contracts\Queryable)) {
            throw new ModelNotQueryableException('Unable to query Model');
        }

        return $model;
    }

    private function getFilters(\App\Models\Contracts\Queryable $model)
    {
        return $model->getQueryableAttributes();
    }
}

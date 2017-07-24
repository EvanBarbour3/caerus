<?php

namespace App\Http\Controllers\Api;

use App\Http\Exception\ApiException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class Retrievable
 *
 * @author EB
 * @package App\Http\Controllers\Api
 */
trait Retrievable
{
    /**
     * @author EB
     * @param int $id
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Collection|Model
     * @throws ApiException
     */
    public function retrieveModelById($id, Model $model)
    {
        try {
            /** @var Builder $model */
            return $model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // TODO: Log model not found by ID
            throw new ApiException('Unable to find requested resource', 404);
        } catch (\Exception $e) {
            throw new ApiException('Unable to retrieve resource', 500);
        }
    }
}

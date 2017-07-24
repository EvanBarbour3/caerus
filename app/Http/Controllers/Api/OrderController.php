<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;

/**
 * Class OrderController
 *
 * @author EB
 * @package App\Http\Controllers\Api
 */
class OrderController extends Controller
{
    use Queryable;
    use Retrievable;

    /**
     * @author EB
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->queryModel(new Order());
    }

    /**
     * @author EB
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        return $this->retrieveModelById($id, new Order());
    }
}

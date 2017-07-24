<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

/**
 * Class OrderController
 *
 * @author EB
 * @package App\Http\Controllers\Web
 */
class OrderController extends Controller
{
    /**
     * @author EB
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('order.index');
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * @author EB
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
}

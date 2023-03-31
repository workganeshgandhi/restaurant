<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('cashier.auth:cashier');
    }

    public function index() {
        return route('cashier.index');
    }
}

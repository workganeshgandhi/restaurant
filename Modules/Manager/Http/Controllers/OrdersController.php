<?php

namespace Modules\Manager\Http\Controllers;

use Datatables;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\Order;
use Modules\Manager\Entities\Cashier;


class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('cashier', 'branch', 'offer')->with('ordercategories', function ($query) {
            return $query->with('category');
        })->get();
        return view('manager::pages.order.index', compact('orders'));
    }
}

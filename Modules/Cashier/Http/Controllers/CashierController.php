<?php

namespace Modules\Cashier\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Manager\Entities\DeliveryBoy;
use Modules\Manager\Entities\DeliveryOrder;
use Modules\Manager\Entities\Order;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{

    public function index()
    {
        return view('cashier::index');
    }
    public function orders()
    {
        return view('cashier::orders');
    }
    public function getorders(Request $request)
    {
        $orders = Order::when($request['number'], function ($q) use ($request) {
            return $q->where('number', $request['number']);
        })->with('cashier', 'branch', 'offer')->latest()->paginate(8);
        return response()->json($orders);
    }
    public function getsingleorder($id)
    {
        // return $id; ->salutation
        $order = Order::where('orders.id', $id)->with('cashier', 'branch', 'offer')->with('ordercategories', function ($query) {
            return $query->with('category');
        })->first();
        return response()->json($order);
    }
    public function shwoonlineorders()
    {
        return view('cashier::onlineOrders');
    }
    public function onlineorders(Request $request)
    {
        // return $request ;
        $nullableOrders = DeliveryOrder::where('status', null)->when($request['searchNullableNumber'], function ($q) use ($request) {
            return $q->where('number', $request['searchNullableNumber']);
        })->with('delivery_order_categories',)->with('delivery_order_categories', function ($query) {
            return $query->with('category');
        })->latest()->get();
        $orders = DeliveryOrder::where('status', '!=', null)->when($request['searchOrderNumber'], function ($q) use ($request) {
            return $q->where('number', $request['searchOrderNumber']);
        })->with('delivery_order_categories',)->with('delivery_order_categories', function ($query) {
            return $query->with('category');
        })->latest()->get();
        $data = [$nullableOrders, $orders];
        return response()->json($data);

        // return view('cashier::onlineOrders',compact('orders'));
    }
    public function getBranchDeliveryBoys()
    {
        $DeliveryBoy = DeliveryBoy::where('branch_id', Auth::guard('cashier')->user()->branch_id)->get();

        return response()->json($DeliveryBoy);
    }
    public function updateDeliveryOrder(Request $request)
    {
        $delvieryOrder = DeliveryOrder::where('id', $request[0]['id'])->update([
            'branch_id' => Auth::guard('cashier')->user()->branch_id,
            'cashier_id' => Auth::guard('cashier')->user()->id,
            'delivery_boy_id' => $request[2],
            'status' => $request[1],
        ]);
        return $delvieryOrder;
    }
}

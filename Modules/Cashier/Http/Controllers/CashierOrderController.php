<?php

namespace Modules\Cashier\Http\Controllers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Manager\Entities\Category;
use Modules\Manager\Entities\MainCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Manager\Entities\Order;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Modules\Manager\Entities\Offer;

class CashierOrderController extends Controller
{

    public function maincategories()
    {
        // return 'ok' ;
        $maincategories = MainCategory::with('categories')->get();
        return response()->json($maincategories);
    }
    public function storeorder(Request $request)
    {
       // return $request[1]['OrderType'];
        $cashier = Auth::guard('cashier')->user();

        $orderNumber = IdGenerator::generate([
            'table' => 'orders', 'field' => 'number', 'length' => 9, 'prefix' => date('d-m'),
            'reset_on_prefix_change' => true
        ]);
        if ($request[5]['offerId'] != '') {
            $orderData = [
                'total_price' =>  $request[3]['totalPrice'],
                'number' => $orderNumber,
                'order_type' => $request[1]['OrderType'],
                'state' => 1,
                'branch_id' =>  $cashier->branch_id,
                'offer_id' =>  $request[5]['offerId'],
                'cashier_id' =>  $cashier->id,
            ];
        } else {
            $orderData = [
                'total_price' =>  $request[3]['totalPrice'],
                'number' => $orderNumber,
                'order_type' => $request[1]['OrderType'],
                'state' => 1,
                'branch_id' =>  $cashier->branch_id,
                'cashier_id' =>  $cashier->id,
            ];
        }

        $order = Order::create($orderData);
        $ordercategories = ['order_id' => $order->id];
        foreach ($request[0]['orderCategores'] as  $ordercategory) {
            if ($ordercategory['category_type'] == '') {
                $order->ordercategories()->create([
                    'order_id' => $order->id,
                    'category_id' => $ordercategory['category_id'],
                    'mount' => $ordercategory['mount'],
                    'subtotal' => $ordercategory['subtotal'],
                ]);
            } else {
                $order->ordercategories()->create([
                    'order_id' => $order->id,
                    'category_id' => $ordercategory['category_id'],
                    'category_type' => $ordercategory['category_type'],
                    'mount' => $ordercategory['mount'],
                    'subtotal' => $ordercategory['subtotal'],
                ]);
            }
        }

        return response()->json($order->id);
    }
    public function printorder($id)
    {
        $order = Order::with('ordercategories')->find($id);
        return response()->json('printed');
    }
    public function checkcode($code)
    {
        $offer = Offer::where('code', $code)->get();
        return response()->json($offer);
    }
}

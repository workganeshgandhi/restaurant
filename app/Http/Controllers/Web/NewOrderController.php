<?php

namespace App\Http\Controllers\Web;

use App\Events\OrderEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Manager\Entities\Category;
use Modules\Manager\Entities\MainCategory;
use Modules\Manager\Entities\DeliveryOrder;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class NewOrderController extends Controller
{
    public function view()
    {
        return view('web.newOrder');
    }
    public function getMainCategories()
    {
        $maincategories = MainCategory::with('categories')->get();
        return response()->json($maincategories);
    }
    public function sendOrderToCashier(Request $request)
    {
        //  return $request ;

        $orderNumber = IdGenerator::generate([
            'table' => 'delivery_orders', 'field' => 'number', 'length' => 9, 'prefix' => date('d-m'),
            'reset_on_prefix_change' => true
        ]);
        $deliveryOrderData = [
            'total_price' =>  $request[2]['totalPrice'],
            'number' => $orderNumber,
            'offer_id' =>  $request[4]['offerId'],
            'deliveryFees' =>  $request[3]['deliveryFees'],
            'name' =>  $request[6]['name'],
            'mobile' =>  $request[7]['mobile'],
            'address' =>  $request[8]['address'],
        ];

        $order = DeliveryOrder::create($deliveryOrderData);

        foreach ($request[0]['orderCategores'] as  $ordercategory) {
            $order->delivery_order_categories()->create([
                'delivery_order_id' => $order->id,
                'category_id' => $ordercategory['category_id'],
                'category_type' => $ordercategory['category_type'],
                'mount' => $ordercategory['mount'],
                'subtotal' => $ordercategory['subtotal'],
            ]);
        }
        $order = DeliveryOrder::with('delivery_order_categories')->with('delivery_order_categories', function ($query) {
            return $query->with('category');
        })->latest()->first();
        event(new OrderEvent($order));
        // return response()->json($order);
    }
}

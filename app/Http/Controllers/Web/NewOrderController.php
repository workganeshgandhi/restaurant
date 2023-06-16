<?php

namespace App\Http\Controllers\Web;

use App\Events\OrderEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Manager\Entities\Category;
use Modules\Manager\Entities\MainCategory;
use Modules\Manager\Entities\DeliveryOrder;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Http;
use Modules\Manager\Entities\DeliveryOrderCategories;

class NewOrderController extends Controller
{
    private $order_id = '';
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
        // generate order number
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
        $items = [];
        foreach ($request[0]['orderCategores'] as  $item) {
            $i =
                [
                    "name" => $item['name'],
                    "amount_cents" => intval(round($item['price'])) * 100,
                    "description" => "...",
                    "quantity" =>  $item['mount']
                ];
            array_push($items, $i);
        }
        foreach ($request[0]['orderCategores'] as $category) {
            DeliveryOrderCategories::create([
                'delivery_order_id' => $order->id,
                'category_id' => $category['category_id'],
                'category_type' => $category['category_type'],
                'mount' => $category['mount'],
                'subtotal' => $category['subtotal'],
            ]);
        }
        $this->order_id = $order->id;
        $total = intval(round($deliveryOrderData['total_price'])) * 100;
        $token = $this->getToken();
        $order = $this->createOrder($token, $items, $total);
        $paymentToken = $this->getPaymentToken($order, $token, $total, $deliveryOrderData);
        return ['iframe' => env('PAYMOB_IFRAME_ID'), 'token' => $paymentToken];
    }
    public function getToken()
    {
        $response = Http::withOptions(['verify' => false])->post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => env('PAYMOB_API_KEY')
        ]);
        return $response->object()->token;
    }

    public function createOrder($token, $items, $total)
    {
        $data = [
            "auth_token" =>   $token,
            "delivery_needed" => "false",
            "amount_cents" => $total,
            "currency" => "EGP",
            "items" => $items,

        ];
        $response = Http::withOptions(['verify' => false])->post('https://accept.paymob.com/api/ecommerce/orders', $data);
        return $response->object();
    }

    public function getPaymentToken($order, $token, $total, $deliveryOrderData)
    {
        $billingData = [
            "apartment" => "a",
            "email" => 'a@a.a',
            "floor" => "1",
            "first_name" => $deliveryOrderData['name'],
            "street" => $deliveryOrderData['address'],
            "building" => "1",
            "phone_number" => $deliveryOrderData['mobile'],
            "shipping_method" => "PKG",
            "postal_code" => "1334",
            "city" => $deliveryOrderData['address'],
            "country" => "EG",
            "last_name" => $deliveryOrderData['name'],
            "state" => "EG"
        ];

        $data = [
            "auth_token" => $token,
            "amount_cents" => $total,
            "expiration" => 3600,
            "order_id" => $order->id,
            "billing_data" => $billingData,
            "currency" => "EGP",
            "integration_id" => env('PAYMOB_INTEGRATION_ID')
        ];
        $response = Http::withOptions(['verify' => false])->post('https://accept.paymob.com/api/acceptance/payment_keys', $data);
        return $response->object()->token;
    }
    public function callback(Request $request)
    {

        $data = $request->all();
        ksort($data);
        $hmac = $data['hmac'];
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];
        $connectedString = '';
        foreach ($data as $key => $element) {
            if (in_array($key, $array)) {
                $connectedString .= $element;
            }
        }
        $secret = env('PAYMOB_HMAC');
        $hased = hash_hmac('sha512', $connectedString, $secret);
        if ($hased == $hmac) {

            $order = DeliveryOrder::with('delivery_order_categories')->with('delivery_order_categories', function ($query) {
                return $query->with('category');
            })->latest()->first();

            event(new OrderEvent($order));
            return redirect()->route('index');
        } else {
            DeliveryOrder::where('id', $this->order_id)->delete();
            DeliveryOrderCategories::where('delivery_order_id', $this->order_id)->delete();
            return redirect()->route('index');
        }
        DeliveryOrder::find($this->order_id)->delivery_order_categories()->delete();
        DeliveryOrder::find($this->order_id)->delete();
        return redirect()->route('index');
    }
}

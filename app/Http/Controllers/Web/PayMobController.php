<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PayMobController extends Controller
{
    public function credit()
    {
        $items = [
            [
                "name" => "ASC1515",
                "amount_cents" => 2400,
                "description" => "Smart Watch",
                "quantity" => 2
            ],
            [
                "name" => "ERT6565",
                "amount_cents" => 4500,
                "description" => "Power Bank",
                "quantity" => 1
            ]
        ];
        $total = 0;
        foreach ($items as $item) {
            $total = $total + ($item['amount_cents'] * $item['quantity']);
        }
        $token = $this->getToken();
        $order = $this->createOrder($token, $items, $total);
        $paymentToken = $this->getPaymentToken($order, $token, $total);

        return \Redirect::away('https://portal.weaccept.co/api/acceptance/iframes/' . env('PAYMOB_IFRAME_ID') . '?payment_token=' . $paymentToken);
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

    public function getPaymentToken($order, $token, $total)
    {
        $billingData = [
            "apartment" => "803",
            "email" => "claudette09@exa.com",
            "floor" => "42",
            "first_name" => "Clifford",
            "street" => "Ethan Land",
            "building" => "8028",
            "phone_number" => "+86(8)9135210487",
            "shipping_method" => "PKG",
            "postal_code" => "01898",
            "city" => "Jaskolskiburgh",
            "country" => "CR",
            "last_name" => "Nicolas",
            "state" => "Utah"
        ];
        $data = [
            "auth_token" => $token,
            "amount_cents" => $total,
            "expiration" => 3600,
            "order_id" => $order->id,
            "billing_data" => $billingData,
            "currency" => "EGP",
            "integration_id" => env('PAYMOB_MOBILE_WALLET_INTEGRATION_ID')
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
            // echo "secure";
            return ' you payed successfuly';
        }
        echo 'not secure';
        exit;
    }
}

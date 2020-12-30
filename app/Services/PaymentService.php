<?php

namespace App\Services;

use App\Order;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class PaymentService {


    protected $endpointBase;
    protected $login;
    protected $secretKey;

    public function __construct()
    {
    $this->endpointBase = config('services.placetopay.endpoint_base');
    $this->login = config('services.placetopay.login');
    $this->secretKey = config('services.placetopay.secret_key');

    }


    public function handlePayment(Order $order, Request $request)
    {
        $response = Http::post(url($this->endpointBase . '/api/session'),[
                'auth' => $this->getCredentials(),
            'payment' => [
                'reference' => $order->id,
                'description' => $request->texTarea,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->total,
                ],
            ],
            'expiration' => date('c', strtotime('+1 hour')),
            'returnUrl' => route('orders.show', $order->id),
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'PlacetoPay Sandbox',
             ]);

        return $response->json();
    }

        public function getCredentials()
    {
        $login = $this->login;
        $secretKey = $this->secretKey;
        $seed = date('c');
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        return [

            'login' => $login,
            'seed' => $seed,
            'nonce' => $nonceBase64,
            'tranKey' => $tranKey,

        ];
    }

}
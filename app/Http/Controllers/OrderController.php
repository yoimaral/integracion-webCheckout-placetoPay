<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     *Para validar de que si allá un usuario autenticado 
     * $user = $request->user();
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $user = $request->user();
        $order = $user->orders()->create();

        $payment = $this->paymentService->handlePayment($order, $request);
        $order->requestId = $payment['requestId'];
        $order->processUrl = $payment['processUrl'];
        $order->save();

        return redirect($payment['processUrl']);
    }
}

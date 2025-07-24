<?php

namespace App\Http\Controllers;

use App\Models\StripePayment;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index()
    {
        $stripe=StripePayment::first();
        $nirob= get_stripe_key('stripe_key');
        // return $nirob;
        return view('admin.paymentgetway.stripe',compact('stripe'));
    }
    public function update(Request $request){
        $data=StripePayment::first();

        StripePayment::updateOrCreate([
            'stripe_key'=> $request->stripe_key,
            'stripe_secret_key'=> $request->stripe_secret_key,
        ]);

        return redirect()->route('stripe.config')->with(['message'=>'Payment getway updated successfully','alert-type'=>'success']);

    }
    public function stripe(){
        return view('admin.paymentgetway.stripe-payment');
    }

    public function stripe_post(Request $request){
        \Stripe\Stripe::setApiKey(get_stripe_key('stripe_secret_key')); // your helper to get secret key from DB

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Test Product',
                    ],
                    'unit_amount' => 10000, // 100.00 USD
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }
    public function success(){
        return redirect()->route('stripe.config')->with(['message'=>'Payment successful','alert-type'=>'success']);
    }
    public function cancle(){
        return redirect()->route('stripe.config')->with(['message'=>'Payment successful','alert-type'=>'error']);
    }
}

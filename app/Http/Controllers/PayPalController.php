<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payment;

class PayPalController extends Controller
{
    public function paypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => config('paypal.currency'),
                        "value" => $request->price
                    ]
                ]
            ]
        ]);
        // dd($response);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    session()->put('product_name', $request->product_name);
                    session()->put('price', $request->price);
                    session()->put('payer_name', $request->name);
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }


    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // Insert data into database

            $payment = new Payment;
            $payment->payment_id = $response['id'];
            $payment->product_name = session()->get('product_name');
            $payment->price = session()->get('price');
            $payment->payer_name = $response['payer']['name']['given_name'] . ' ' .
                                  $response['payer']['name']['surname'];
            $payment->payer_email = $response['payer']['email_address'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = "PayPal";
            $payment->save();

            return "Payment is successful";

            unset($_SESSION['product_name']);
            unset($_SESSION['amount']);
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        // dd($response);

    }

    public function cancel()
    {
        return "Payment has been cancelled";
    }
}

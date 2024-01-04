<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user is logged in
        if ($user) {
            // Process the checkout with the subscription details
            $subscriptionId = $request->session()->get('selected-subscription-id');
            $subscription = Subscription::findById($subscriptionId);

            // Redirect the user after successful checkout
            return redirect('/checkout')->with('message', 'Checkout successful');
        } else {
            // Redirect to login page if the user is not logged in
            return redirect('/login')->with('message', 'Please log in to proceed with the checkout');
        }
    }

    public function showCheckoutForm()
    {
        // Retrieve the selected subscription ID from the session
        $selectedSubscriptionId = session('selected-subscription_id');

        // Get the subscription details using the retrieved ID
        $selectedSubscription = Subscription::findById($selectedSubscriptionId);

        return view('checkout', ['subscription' => $selectedSubscription]);
    }


    public function placeOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'subscription_id' => 'required|exists:subscriptions,id',
            // Add other validation rules as needed
        ]);

        // Retrieve the subscription by ID
        $subscriptionId = $request->input('subscription_id');
        $subscription = Subscription::find($subscriptionId);

        if (!$subscription) {
            return redirect('/error')->with('message', 'Invalid subscription ID');
        }

        // Your order placement logic here

        // Redirect the user after successful order placement
        return redirect('/success')->with('message', 'Order placed successfully');
    }

    public function processCheckout(Request $request)
    {
        //return('Hello world');
        // If it's a POST request, process the checkout
        if ($request->isMethod('post')) {
            // Validate the request data for the checkout
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'subscription_id' => 'required|exists:subscriptions,id',
                // Add other validation rules as needed
            ]);

            // Store the selected subscription ID in the session
            Session::put('selected_subscription_id', $request->subscription_id);
            // Redirect to the checkout form
            return redirect()->route('checkout.form');
        }

            //Retrieve the selected subscription ID from the session
            $selectedSubscriptionId = session('selected_subscription_id');

            // Get the subscription details
            $selectedSubscription = Subscription::find($selectedSubscriptionId);

            // Show the checkout form with the selected subscription details
            return view('checkout', ['selectedSubscription' => $selectedSubscription]);
        }
}

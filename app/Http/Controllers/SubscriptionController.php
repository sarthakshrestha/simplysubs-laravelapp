<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();

        $isAdmin = auth()->user() && auth()->user()->isAdmin();

        if (!$isAdmin) {
            return view('subs', ['subscriptions' => $subscriptions]);
        } elseif ($isAdmin){
            $subscriptions = Subscription::all();
            return view('admin-subs', ['subscriptions' => $subscriptions, 'isAdmin' => $isAdmin]);        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/images/sub-images', $imageName);
        } else {
            $imageName = null;
        }

        Subscription::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $imageName ? 'images/sub-images/' . $imageName : null,
            'price' => $data['price']
        ]);

        return redirect()->route('admin')->with('success', 'Subscription added successfully!');
    }

    // Function to delete the subscriptions

    public function deleteSubscription($id)
    {
        // Find the subscription by ID
        $subscription = Subscription::find($id);

        if (!$subscription) {
            // Subscription not found
            return redirect()->route('admin')->with('error', 'Subscription not found.');
        }

        // Delete the subscription image if it exists
        if ($subscription->image) {
            $imagePath = storage_path("app/public/{$subscription->image}");

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the subscription
        $subscription->delete();

        return redirect()->route('admin')->with('success', 'Subscription deleted successfully!');
    }

    // Helps to show all the subscriptions that the administrator can update

    public function showUpdateList()
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            $subscriptions = Subscription::all();
            return view('admin-subs', ['subscriptions' => $subscriptions]);
        }

        abort(403, 'Unauthorized action.');
    }

    // Helps in showing the update form
    public function showUpdateForm($id)
    {
        $subscription = Subscription::findOrFail($id);

        return view('update', ['subscription' => $subscription]);
    }

    // Main update function to handle the request and id
    public function updateSubscription(Request $request, $id)
    {
        // Validate the request data as needed
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        // Find the subscription by ID
        $subscription = Subscription::findOrFail($id);

        // Update the subscription data
        $subscription->title = $data['title'];
        $subscription->description = $data['description'];
        $subscription->price = $data['price'];

        // Handle image update
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/images/sub-images', $imageName);

            // Delete the old image if it exists
            if ($subscription->image) {
                $imagePath = storage_path("app/public/{$subscription->image}");

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Update the subscription with the new image path
            $subscription->image = 'images/sub-images/' . $imageName;
        }

        // Save the updated subscription
        $subscription->save();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully!');    }



}

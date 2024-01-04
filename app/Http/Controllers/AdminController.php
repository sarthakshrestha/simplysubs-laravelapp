<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class AdminController extends Controller
{

    public function editSubscription($id)
    {
        $subscription = Subscription::findOrFail($id);

        return view('update', ['subscription' => $subscription]);
    }

    public function updateSubscription(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string',
            'description' => 'required|string',

        ]);

        $subscription = Subscription::findOrFail($id);

        if ($request->hasFile('image')) {

            $path = $request->file('image')->store('images', 'public');
            $subscription->image = $path;
        }

        $subscription->title = $request->input('title');
        $subscription->description = $request->input('description');
        $subscription->price = $request->input('price');
        $subscription->save();

        return redirect()->back()->with('success', 'Subscription updated successfully.');
    }
}

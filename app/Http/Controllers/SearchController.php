<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $subscriptions = Subscription::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        return view('subs', compact('subscriptions'));
    }

    public function sort(Request $request)
    {
        $field = $request->input('field');
        $direction = $request->input('direction');

        $subscriptions = Subscription::orderBy($field, $direction)->get();

        return view('subs', compact('subscriptions'));
    }
}

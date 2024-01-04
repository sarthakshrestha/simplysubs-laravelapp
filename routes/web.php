<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/add-product', [\App\Http\Controllers\SubscriptionController::class, 'store'])->name('admin');

Route::get('/subs', [SubscriptionController::class, 'index'])->name('subscriptions.index');

Route::get('/about-us', function (){
    return view('aboutus');
});

Route::post('/admin/subscribe', [SubscriptionController::class, 'store'])->name('admin.subscribe');

Route::get('/updatesub/{id}', function ($id) {
    $subscription = App\Models\Subscription::findOrFail($id);
    return view('update', ['subscription' => $subscription]);
});

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/sort', [SearchController::class, 'sort'])->name('sort');


Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form')->middleware('auth');

Route::any('/checkout/order-complete', function(Request $request){
    $id = $request->subscription_id;
    $sub = \App\Models\Subscription::findById($id);
    return view('checkoutform', compact('sub'));
});

Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('place.order');
Route::post('/checkout', [CheckoutController::class, 'processCheckout']);

Route::post('/checkout/paypal', [PayPalController::class, 'paypal'])->name('paypal');
Route::get('/checkout/success', [PayPalController::class, 'success'])->name('success');
Route::post('/checkout/cancel', [PayPalController::class, 'paypal'])->name('cancel');



Route::put('/updatesub/{id}', [AdminController::class, 'updateSubscription'])->name('admin.subscriptions.update-subscription');



// Redirect to user dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Common routes for authenticated users

    Route::get('/admin/create', function () {

        // Only allow access to '/admin' if the user is an admin

        if (Gate::allows('isAdmin', auth()->user())) {
            return view('admin-create');
        }

        abort(403, 'Unauthorized action.');
    })->name('admin');

    // Admin Route, Prefix adds admin in the starting of the URL
    Route::prefix('admin')->group(function () {

        Route::get('/updatesub', [SubscriptionController::class, 'showUpdateList'])->name('admin.updatesub.show');
        Route::get('/updatesub/{id}', [SubscriptionController::class, 'showUpdateForm'])->name('admin.updatesub.show');
        Route::put('/updatesub/{id}', [SubscriptionController::class, 'updateSubscription'])->name('admin.updatesub.update');

        Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'deleteSubscription'])->name('admin.subscriptions.delete-subscription');
    });

    Route::get('/updatesub/{id}', [SubscriptionController::class, 'showUpdateForm'])->name('updatesub');
});

require __DIR__.'/auth.php';

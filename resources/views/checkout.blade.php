@php use App\Models\Subscription; @endphp
@extends('components.topbar')

@section('main-body')
    <div class="checkout-container">
        <div class="top-form">
            <h1>Checkout</h1>
        </div>
        <?php
        use Illuminate\Support\Facades\Session;
        $sessionId = Session::get('selected-subscription-id');
        $subscription = Subscription::findById($sessionId);
        ?>
        @if ($subscription)
            <div class="selected-container">
                <h2>Selected Subscription</h2>
                <p>Title: <span id="selected-subscription-title">{{ $subscription->title }}</span></p>
                <p>Description: <span id="selected-subscription-description">{{ $subscription->description }}</span></p>
                <p>Price: Rs. <span id="selected-subscription-price">{{ $subscription->price }}</span></p>
            </div>
        @else
            <p>No subscription selected.</p>
        @endif

        <form method="post" action="{{ route('paypal') }}" id="checkout-form">
            @csrf
            <input type="hidden" name="price" value="{{ $subscription ? $subscription->price : '' }}">
            <input type="hidden" name="product_name" value="{{ $subscription ? $subscription->title : '' }}">

            <input type="hidden" name="subscription_id" id="subscription_id"
                   value="{{ $subscription ? $subscription->id : '' }}">
            <input type="hidden" name="price" id="price" value="{{ $subscription ? $subscription->price : '' }}">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" required>
            </div>

            <button type="submit" class="order-btn">Place Order with PayPal</button>
        </form>
    </div>

@endsection

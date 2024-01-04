@php use App\Models\Subscription; @endphp
@extends('components.topbar')

@section('main-body')
    <div class="checkout-container">
        <div class="top-form">
            <h1><img src="{{url('/images/checkout/check.png')}}" class="checkout-icon" alt="checkout-logo"> Checkout</h1>
        </div>
        @if ($sub)
            <div class="selected-container">
                <h2>Selected Subscription</h2>
                <p>Title: <span id="selected-subscription-title">{{ $sub->title }}</span></p>
                <p>Description: <span id="selected-subscription-description">{{ $sub->description }}</span></p>
                <p>Price: Rs. <span id="selected-subscription-price">{{ $sub->price }}</span></p>
            </div>
        @else
            <p>No subscription selected.</p>
        @endif

        <form method="post" action="{{ route('paypal') }}" id="checkout-form">
            @csrf
            <input type="hidden" name="price" value="{{ $sub ? $sub->price : '' }}">
            <input type="hidden" name="product_name" value="{{ $sub ? $sub->title : '' }}">

            <input type="hidden" name="subscription_id" id="subscription_id"
                   value="{{ $sub ? $sub->id : '' }}">
            <input type="hidden" name="price" id="price" value="{{ $sub ? $sub->price : '' }}">

{{--            <div class="form-group">--}}
{{--                <label for="name">Name</label>--}}
{{--                <input type="text" name="name" id="name" required>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="email">Email</label>--}}
{{--                <input type="email" name="email" id="email" required>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="address">Address</label>--}}
{{--                <input type="text" name="address" id="address" required>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="city">City</label>--}}
{{--                <input type="text" name="city" id="city" required>--}}
{{--            </div>--}}
            <button type="submit" class="order-btn">Place Order with PayPal</button>
        </form>
    </div>

@endsection

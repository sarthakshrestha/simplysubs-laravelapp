@extends('components.topbar')

@section('main-body')
    <div class="sub-main-container">
        <h1>Subscription Items <br> offered by SimplySubs</h1>
    </div>

    <div class="search-option">
        <form action="{{ route('search') }}" method="get">
            <input type="text" name="query" id="subscription-search" placeholder="Search subscriptions">
            <button type="submit">Search</button>
        </form>

        <form action="{{ route('sort') }}" method="get">
            <label>
                Sort by:
                <select name="field">
                    <option value="title">Title</option>
                    <option value="price">Price</option>
                </select>
            </label>

            <label>
                Direction:
                <select name="direction">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </label>

            <button type="submit">Sort</button>
        </form>
    </div>

    <div class="sub-container">
        @foreach($subscriptions as $subscription)
            <div class="product-card-horizontal">
                <div class="product-details">
                    <div class="image-container">
                        @if($subscription->image)
                            <img src="{{ asset('storage/' . $subscription->image) }}" alt="{{ $subscription->title }}" class="product-image">
                        @else
                            <img src="{{ asset('public/images/sub-images/image-error.jpg') }}" alt="Error Image" class="product-image"/>
                        @endif
                    </div>
                    <div class="product-title">{{ $subscription->title }}</div>
                    <div class="product-description">{{ $subscription->description }}</div>
                    <div class="product-price">Rs. {{$subscription->price}}</div>
                    @auth
                        <form method="post" action="{{ url('/checkout/order-complete') }}" class="buy-form">
                            @csrf
                            <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                            <button type="submit" class="buy-button">Buy Now</button>
                        </form>

                    @else
                        <a href="{{ route('login') }}" class="buy-button">Login to Buy</a>
                    @endauth

                </div>
            </div>
        @endforeach
    </div>

    <script>
        // function handleFormSubmit(form, subscriptionId) {
        //     window.location.href = '/checkout';
        //     return false;
        // }
    </script>

@endsection

@section('footer')
    @include('partials.footer')
@endsection

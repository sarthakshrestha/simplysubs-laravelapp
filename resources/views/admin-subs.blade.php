@extends('components.topbar')

@section('main-body')
    <div class="sub-main-container">
        <h1>Subscription Items <br> offered by SimplySubs</h1>
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
                    <a href="{{ route('admin.updatesub.show', ['id' => $subscription->id]) }}" class="update-button">Update</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

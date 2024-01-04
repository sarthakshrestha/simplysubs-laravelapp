@extends('components.topbar')

@section('banner')
    <div class="main-container">
        <div class="header">
            <h1>SimplySubs<img class="main-logo" src="images/Logo.png" alt="logo"></h1>
            <h2>Your gateway for subscriptions simplified.</h2>
        </div>
        <div class="text-box">
            <h3>Providing a range of digital subscriptions and so much more- </h3>
        </div>

        <div class="divider"></div>

        <div class="subscription-container">
            <img src="{{url('/images/logos/netflix-icon.png')}}" alt="Netflix Icon"/>

            <img src="{{url('/images/logos/hulu-icon.png')}}" alt="Hulu Icon"/>

            <img src="{{url('/images/logos/apple-music-icon.png')}}" alt="Apple Music Icon"/>

            <img src="{{url('/images/logos/spotify-icon.png')}}" alt="Spotify Icon"/>
        </div>
    </div>
    <div class="top-picks">
        <h1>Dive into your favorite movies and shows on your preferred streaming platform with zero hassles</h1><img
            src="{{url('/images/banners/banner-2.png')}}" class="banner-img" alt="Banner-1"/>
    </div>
@endsection

@section('banner-1')
    <div class="banner-1-container">
        <h1><img
                src="{{url('/images/banners/banner-3.png')}}" class="banner-1-img" alt="Banner-1"/>ay swiftly and
            securely <br>through
            PayPal </h1>
    </div>
@endsection

@section('banner-2')
    <div  class="banner-2-container">
        <h1>
            Instantly subscribe to your favorite subscriptions! </h1> <img src="{{url('/images/banners/deadline.png')}}" class="banner-2-img" alt="Banner-3"/>
    </div>
@endsection

@section('footer')
    @auth
        @include('partials.footer', ['isAdmin' => auth()->user()->isAdmin()])
    @else
        @include('partials.footer', ['isAdmin' => false])
    @endauth
@endsection


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/subs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">

    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@1&family=Urbanist:wght@500&display=swap"
          rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz@9..40&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@1&family=Lexend+Deca&family=Urbanist:wght@500&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz@9..40&family=Fugaz+One&display=swap" rel="stylesheet">
    <title>SimplySubs</title>
</head>
<body>
<div class="navigation">
    <nav id="main-navbar">
        <ul>
            <li><a href="/">Home

                </a></li>
            <li><a href="/subs">Subscriptions
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512">
                        <!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                        <path fill="#ffffff"
                              d="M80 0C44.7 0 16 28.7 16 64V448c0 35.3 28.7 64 64 64H304c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H80zm80 432h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H160c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                    </svg>

                </a></li>

{{--            @if(auth()->check())--}}
{{--                @if(auth()->user()->isAdmin())--}}
{{--                    <div class="dashboard-redirect">--}}
{{--                        <a href="{{ route('admin.dashboard') }}">Go to Admin Dashboard</a>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="dashboard-redirect">--}}
{{--                        <a href="{{ route('dashboard') }}">Go to User Dashboard</a>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endif--}}


            @auth
                <li class="signin-nav"><a href="/dashboard">Dashboard
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path fill="#ffffff"
                                  d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                        </svg>
                    </a></li>
                <li class="register-nav"><a href="{{ route('profile.edit') }}">Edit Profile Info</a></li>
            @else
                <li class="signin-nav"><a href="/login">Sign in
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path fill="#ffffff"
                                  d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                        </svg>
                    </a></li>
                <li class="register-nav"><a href="{{ route('register') }}">Register</a></li>
            @endauth

        </ul>
    </nav>
</div>
@yield('banner')
@yield('banner-1')
@yield('banner-2')
@yield('main-body')
@yield('footer')
</body>
</html>

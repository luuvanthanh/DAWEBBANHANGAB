<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    <!-- CSS -->
    @include('frontend.layouts.css')
</head>
<body>
    <!-- header -->
    @include('frontend.layouts.header')

    <!-- slider -->
    @include('frontend.layouts.slider')

    <div class="container">
        <div class="row">
            <!-- sidebar -->
            @if (url()->current() == "http://localhost/LARAVEL/laravel-8/public/getAccount")
                @include('frontend.layouts.sidebar-account')
            @else
                @if (url()->current() == "http://localhost/LARAVEL/laravel-8/public/getCart")
                    
                @else
                    @include('frontend.layouts.sidebar')
            @endif
            @endif

            <!-- content -->
            @yield('content')
        </div>
    </div>

    <!-- footer -->
    @include('frontend.layouts.footer')
</body>
    <!-- CSS -->
    @include('frontend.layouts.js')
</html>
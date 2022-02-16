<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    {{-- css --}}
    @include('admin.layouts.css')
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        {{-- header --}}
        @include('admin.layouts.header')

        @include('admin.layouts.sidebar')

        <div class="page-wrapper">
            {{-- content --}}
            @yield('content')

            {{-- footer --}}
            @include('admin.layouts.footer')
        </div>
    </div>

    {{-- js --}}
    @include('admin.layouts.js')
</body>


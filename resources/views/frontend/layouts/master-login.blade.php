<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <!-- CSS -->
    @include('frontend.layouts.css')
</head>
<body>
    <!-- header -->
    @include('frontend.layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-1">
                <!-- content -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- footer -->
    @include('frontend.layouts.footer')
</body>
    <!-- CSS -->
    @include('frontend.layouts.js')
</html>
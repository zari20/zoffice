<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>پنل مدیریت</title>

        <link href="{{asset('css/welcome.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/welcome.animate.css')}}" rel="stylesheet">
        <link href="{{asset('css/welcome.fonts.css')}}" rel="stylesheet">
        <link href="{{asset('css/welcome.css')}}" rel="stylesheet">

    </head>

    <body>
        @include('welcome_partials.flash')
        @include('welcome_partials.are_you_sure')
        @yield('content')
    </body>

    <script src="{{asset('js/welcome.jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/welcome.js')}}"></script>
</html>

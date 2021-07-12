<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div style="text-align: center">
    <h1 style="text-align: center">Hello to Ecommerce </h1>
    <div> please click the following link to Reset your password</div>
    <div  style="background-color: #1d643b
   ;color: white;font-size: 15px;padding: 5px;margin-top: 20px;cursor:hand;width:25%;margin:20px auto">
    <a href="{{url($ver)}}" style="font-size: 20px;color:white;text-decoration: none" >Confirm Password Reset </a>
    </div>
    </div>
</body>
</html>

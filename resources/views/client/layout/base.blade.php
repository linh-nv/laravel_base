<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>{{config('app.name')}} - {{$pageTitle ?? 'Unknown'}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('client/assets/images/favicon.ico')}}">
    <!-- App css -->
    <link href="{{mix('css/libs.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{mix('css/home.css')}}" rel="stylesheet" type="text/css"/>

</head>


<body class="{{$bodyClass ?? ''}}">

<!-- HOME -->
@yield('content')
<!-- END HOME -->
<!-- jQuery  -->
@yield('head-script')
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/home.js') }}"></script>
@yield('foot-script')
</body>
</html>

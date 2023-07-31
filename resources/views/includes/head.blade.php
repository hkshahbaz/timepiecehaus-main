<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/images/logo1.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">

    <title>{{ config('app.name', 'TimePiece Haus') }} | @yield('title')</title>


    @include("includes.styles")

</head>

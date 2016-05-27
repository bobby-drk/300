<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/ico" href="/favicon.ico"/>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-theme-flatly.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">

@stack('page-css')

<title>@yield('page-title') :: {{ config('app.site_name') }}</title>
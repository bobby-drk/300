<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')
    <div class="container">

        <div id="main" class="row">
            @include('includes.notification')
            @yield('content')

        </div>

        <footer class="row">
            @include('includes.footer')
        </footer>

    </div>
    <script src="{{ URL::asset('assets/js/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>
@stack('page-js')
</body>
</html>
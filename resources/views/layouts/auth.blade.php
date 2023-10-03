<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon/favicon.ico">
        <link rel="stylesheet" href="{{ asset('dashboard/assets/css/theme.css') }}">
        <title>@yield('title')</title>
    </head>

    <body class="bg-light">
        @yield('content')

        <script src="{{ asset('dashboard/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/auth.bundle.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/function.js') }}"></script>
        @stack('footer_scripts')

    </body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('pageTitle')
        <title>@yield('pageTitle') | {{ config('app.name', 'SSCONLINECOACHING.COM') }}</title>
    @else
        <title>{{ config('app.name', 'SSCONLINECOACHING.COM') }} | Best Online Education Resources</title>
    @endif

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="@yield('bodyClasses')">
    @yield('body')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
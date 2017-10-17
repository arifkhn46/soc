<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    .admin-container { padding-top: 20px; }
    nav.navbar {
        border-top: 4px solid #276cda;
        margin-bottom: 1rem;
     }
    html, body {
        font-size: 16px;
        line-height: 1.5;
        height: 100%;
        background: rgb(236, 240, 243);
    }
    .menu-item>ul{display:block}    
    ul>li>ul{display:none}
    </style>
</head>
<body>
    <div id="app">
        @include('admin.layouts.nav')    
        <div class="container admin-container">
            <div class="columns">
                <div class="column is-3">
                    @include('admin.layouts.side_nav')    
                </div>  
                <div class="column is-9 ">
                    @yield('content')  
                </div>
            </div>
        </div>

        <flash message="{{ session('flash') }}"></flash>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function () {
            window.wow.init();
            $('.menu-link').click(function(){
                $(this).toggleClass('is-active');
                $(this).next().slideToggle();
            });
        });
    </script>
</body>
</html>

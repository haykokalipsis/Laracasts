<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="keywords" content="">
    {{--{!! SEO::generate() !!}--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The Saas Header Image</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/thesaas.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

</head>

<body>

<div id="app">

    <!-- Topbar -->
    <nav class="topbar topbar-inverse topbar-expand-md topbar-sticky">
        <div class="container">

            <div class="topbar-left">
                <button class="topbar-toggler">&#9776;</button>
                <a class="topbar-brand" href="/" style="color: white;">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="logo-default">
                    <img src="{{ asset('assets/img/logo-light.png') }}" alt="logo" class="logo-inverse">
                </a>
            </div>


            <div class="topbar-right">
                <ul class="topbar-nav nav">

                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('series.index') }}">All series</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Hello {{ auth()->user()->name  }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('series.create') }}">Create series</a></li>
                    @endauth

                    @guest
                        <li class="nav-item"><a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#loginModal">Login</a></li>
                    @endguest
                    <!-- added data toggle and id for login vue component -->
                </ul>
            </div>

        </div>
    </nav>
    <!-- END Topbar -->

    <!-- Header -->
    @yield('header')
    <!-- END Header -->

    <!-- Main container -->
    <main class="main-content">
        @yield('content')
    </main>
    <!-- END Main container -->

    <!-- Mount vue login component (modal window) -->
    {{--@if( ! auth()->check())--}}
        {{--<vue-login></vue-login>--}}
    {{--@endif--}}

    <vue-noty></vue-noty>

    @guest()
        <vue-login></vue-login>
    @endguest

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row gap-y justify-content-center">
                <div class="col-12 col-lg-6">
                    <ul class="nav nav-primary nav-hero">
                        <li class="nav-item hidden-sm-down">
                            <a class="nav-link" href="/">Bahdcasts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->

</div>
<!-- END div id app -->

<!-- Scripts -->
<script src="{{ asset('assets/js/core.min.js') }}"></script>
<script src="{{ asset('assets/js/thesaas.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>

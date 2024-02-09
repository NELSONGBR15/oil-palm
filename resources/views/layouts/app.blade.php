<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- dash theme -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/app-style.css') }}" type="text/css">
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('assets/libraries/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/libraries/select2/dist/js/select2.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="bg-theme bg-theme3">
    <div id="wrapper">
        @include('partials.sidebar')
        @include('partials.navbar')
        <div class="clearfix"></div>
        <div class="content-wrapper">
            <div class="container-fluid">
                @livewireScripts
                @if(isset($slot))
                    <div class="card">
                        <div class="card-body">
                            {{ $slot }}
                        </div>
                    </div>
                @else
                    @yield('content')
                @endif
            </div>
        </div>
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        @include('partials.footer')
    </div>
</body>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('notify', (content) => {
            setTimeout(() => {
                toastr[content[0].alert_type](content[0].message);
            }, 1000);
        });
    });
</script>
<script src="{{ asset('assets/js/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/plugins/simplebar/js/simplebar.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/sidebar-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/app-script.js') }}" type="text/javascript"></script>
</html>

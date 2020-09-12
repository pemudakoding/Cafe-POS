<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ asset('css/apps.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        {{-- Sidebar --}}
        @include('includes.sidebar')
        <div id="main">
            {{-- Navbar --}}
            @include('includes.navbar')

            {{-- Content --}}
            <div class="main-content container-fluid">
                @yield('content')
            </div>

            {{-- Footer --}}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.0/dist/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('js/apps.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
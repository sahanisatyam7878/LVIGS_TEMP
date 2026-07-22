<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'LVIGS MART')</title>

    <script>
        (function () {
            var theme = localStorage.getItem('lvigs-theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">

    @stack('css')

</head>

<body>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Page Content --}}
    <main class="site-main">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="site-footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span>&copy; {{ date('Y') }} LVIGS MART. All Rights Reserved.</span>
            <span class="footer-note">Smart shopping. Better growth.</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}"></script>

    @stack('js')

</body>
</html>

<!DOCTYPE html>
<html lang="en" class="@yield('htmlClass')">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Devis Portfolio')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Personal portfolio website')">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')
</head>

<body class="@yield('bodyClass')">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- JS (optional, clean) --}}
    <script>
        // 🌙 Dark mode toggle (ready for DB/session later)
        function toggleTheme() {
            document.body.classList.toggle('dark')
        }
    </script>

    @stack('scripts')

</body>
</html>

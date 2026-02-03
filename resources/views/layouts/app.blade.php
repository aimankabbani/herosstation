<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="@yield('htmlClass')">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Heroes Station')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Personal portfolio website')">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    @stack('styles')
</head>

<body class="dark">
    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Page Content --}}
    <main dir="{{ in_array(app()->getLocale(), ['ar','he','fa']) ? 'rtl' : 'ltr' }}">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.scroll-up');
            console.log(elements);
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    }
                });
            }, {
                threshold: 0.1
            }); // 10% visible to trigger

            elements.forEach(el => observer.observe(el));
        });
    </script>


    @yield('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
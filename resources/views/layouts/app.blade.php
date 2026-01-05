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

<body class="dark">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Page Content --}}
    <main class="container">
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


    @stack('scripts')

</body>

</html>
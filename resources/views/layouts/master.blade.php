<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Heroes Station</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />



    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />


    <!-- Alpine -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Tailwind -->
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>

<body class="font-sans antialiased bg-gray-100">

    <!-- Mobile overlay for sidebar -->
    <div
        x-show="sidebarOpen"
        class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden"
        @click="sidebarOpen = false"
        x-transition.opacity>
    </div>

    <!-- Page container -->
    <div class="flex pt-16 min-h-screen">

        <!-- MAIN CONTENT (full width, mobile friendly) -->

        <div class="flex-1 p-6 flex items-center justify-center min-h-[calc(100vh-4rem)]">
            <main>
                <div class="container">
                    @yield('content')
                </div>
            </main>
        </div>

    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Select2 -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

</body>

</html>
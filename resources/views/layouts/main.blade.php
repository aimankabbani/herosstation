<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Main Website — All Sites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('css/custom/custom.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">

    @yield('style')

</head>

<body>
    @include('partials.navbar')
    <div class="container">


        @if(isset($sites) && $sites->count())
        <section class="hero">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

                <div class="carousel-inner">
                    @foreach($sites as $index => $slide)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img
                            src="{{ 
    !empty($slide->hero_image_url) 
        ? asset('storage/'.$slide->hero_image_url) 
        : 'https://picsum.photos/600/400?random=' . $slide->id 
}}"
                            class="d-block w-100 hero-image"
                            alt="{{ $slide->name }}">

                        <div class="carousel-caption d-flex align-items-center justify-content-center">
                            <h1>{{ $slide->name ?? 'Welcome to Heores Stations' }}</h1>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>
        </section>
        @else
        <section class="hero">
            <h1>@yield('hero_title', 'Welcome to Heores Stations')</h1>
        </section>
        @endif

        <!-- Sites Grid -->
        @yield('content')


    </div>
    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} — Smart Impact
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
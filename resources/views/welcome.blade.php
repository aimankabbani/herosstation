@extends('layouts.main')

@section('hero_title', $heroTitle ?? 'Welcome to Heores Stations')

@section('style')
<style>
    /* Ads banner container */
    #adsCarousel,
    #adsCarousel .carousel-inner,
    #adsCarousel .carousel-item {
        height: 140px;
        /* ⭐ fixed banner height */
        max-height: 140px;
    }

    /* Ads carousel height control */
    #adsCarousel {
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
    }

    #adsCarousel .ad-banner-img {
        width: 100%;
        height: 140px;
        /* crop nicely */
        display: block;
        object-fit: fill;
        /* fill without distortion */
        object-position: center;
        /* center crop */
    }

    #page-loader {
        position: fixed;
        inset: 0;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity .5s ease, visibility .5s ease;
    }

    #page-loader.hidden {
        opacity: 0;
        visibility: hidden;
    }

    .loader {
        width: 60px;
        height: 60px;
        border: 5px solid #eee;
        border-top: 5px solid #2c3e50;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .reveal-card {
        opacity: 0;
        transform: translateY(40px) scale(0.95);
        filter: blur(6px);
        transition:
            opacity 0.6s ease,
            transform 0.6s ease,
            filter 0.6s ease;
        will-change: transform, opacity;
    }

    .reveal-card.show {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
    }
</style>

@endsection

@section('content')
<div id="page-loader">
    <div class="loader"></div>
</div>
@section('ads')
@if(count($ads))
<section class="py-2">
    <div class="container-fluid px-3">

        <div id="adsCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <div class="carousel-inner">

                @foreach($ads as $index => $slide)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img
                        src="{{ !empty($slide->image_url) 
                                    ? asset('storage/'.$slide->image_url) 
                                    : 'https://picsum.photos/1200/400?random=' . $slide->id }}"
                        class="ad-banner-img"
                        alt="Ad Banner">
                </div>
                @endforeach

            </div>

            {{-- Controls OUTSIDE loop --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#adsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>

    </div>
</section>

@endif
@endsection

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @foreach($sites as $site)
            <div class="col-md-4">
                <a href="{{ url(app()->getLocale() . '/' . $site->slug) }}" class="text-decoration-none">
                    <div class="card site-card shadow-sm h-100 reveal-card">
                        <img src="{{ 
    !empty($site->hero_image_url) 
        ? asset('storage/'.$site->hero_image_url) 
        : 'https://picsum.photos/600/400?random=' . $site->id 
}}"
                            alt="{{ $site->name }}" class="banner">
                        <div class="card-body text-center">
                            <img src="{{ 
    !empty($site->logo_path) 
        ? asset('storage/'.$site->logo_path) 
        : 'https://img.icons8.com/color/96/000000/company.png?text=' . urlencode($site->name) 
}}" alt="{{ $site->name }}" style="height:50px; margin-bottom:10px;">
                            <h5>{{ $site->{'name_' . app()->getLocale()} }}</h5>
                            <p>{{ $site->{'slogan_' . app()->getLocale()} ?? 'Visit this site to learn more.' }}</p>
                            <button class="btn btn-primary btn-visit" style="background-color: {{ $site->branding['primary_color'] ?? '#2c3e50' }}; border:none;">{{__('translate.visit_site')}}</button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('scripts')

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const cards = document.querySelectorAll('.reveal-card');

        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('show');
            }, index * 150);
        });
    });
</script>
<script>
    window.addEventListener('load', function() {
        document.getElementById('page-loader').classList.add('hidden');
    });
</script>
@endsection
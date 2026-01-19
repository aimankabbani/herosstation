@extends('layouts.main')

@section('hero_title', $heroTitle ?? 'Welcome to Heores Stations')

@section('style')
<style>
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
    !empty($site->branding['logo_path']) 
        ? asset('storage/'.$site->branding['logo_path']) 
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
@extends('layouts.main')

@section('hero_title', $heroTitle ?? 'Welcome to Heores Stations')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @foreach($sites as $site)
            <div class="col-md-4">
                <a href="{{ url(app()->getLocale() . '/' . $site->slug) }}" class="text-decoration-none">
                    <div class="card site-card shadow-sm h-100">
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
                            <h5>{{ $site->name }}</h5>
                            <p>{{ $site->pages()->where('slug','about')->first()?->excerpt ?? 'Visit this site to learn more.' }}</p>
                            <button class="btn btn-primary btn-visit" style="background-color: {{ $site->branding['primary_color'] ?? '#2c3e50' }}; border:none;">Visit Site</button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
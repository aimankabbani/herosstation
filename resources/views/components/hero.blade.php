<section class="hero scroll-up delay-1"
    style="background-image: url('{{ 
    !empty($site->hero_image_url) 
        ? asset('storage/'.$site->hero_image_url) 
        : 'https://picsum.photos/600/400?random=' . $site->id 
}}')">
    <div class="container">
        
        <h1>
            <span class="highlight">{{ $site->name }}</span>
        </h1>
        <p class="hero-subtitle">
            {{ $site->slogan }}
        </p>
        
    </div>
</section>

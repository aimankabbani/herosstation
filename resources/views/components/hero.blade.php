<section class="hero scroll-up delay-1"
    style="background-image: url('{{ asset($site->hero_image_url) }}')">
    <div class="container">
        <span class="hero-phone">{{ $site->phone_number }}</span>
        <h1>
            <span class="highlight">{{ $site->name }}</span>
        </h1>
        <p class="hero-subtitle">
            {{ $site->slogan }}
        </p>
    </div>
</section>

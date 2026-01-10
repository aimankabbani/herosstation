<section class="portfolio scroll-up delay-4">
    <div class="container">
       <h2>{{ __('translate.portfolio') }}</h2>


        <div class="grid">
            @foreach($gallery as $media)
            <div class="portfolio-item">
                <img src="{{ $media->file_path ? asset('storage/' . $media->file_path) : $media->url }}"
                    alt="{{ $media->alt ?? 'Project Image' }}">

                <div class="overlay">
                    <span>{{ $media->alt ?? '' }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
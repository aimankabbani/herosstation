<section class="portfolio">
    <div class="container">
        <h2>Portfolio</h2>

        <div class="grid">
            @foreach($gallery as $media)
            <div class="portfolio-item">
                <img src="{{ $media->file_path ? asset('storage/' . $media->file_path) : $media->url }}"
                    alt="{{ $media->alt ?? 'Project Image' }}">

                <div class="overlay">
                    <span>{{ $media->alt ?? 'Project' }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
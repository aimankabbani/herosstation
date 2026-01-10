<section class="services scroll-up delay-3">
    <div class="container">
        <h2>Services</h2>

        <div class="grid">
            @foreach ($services as $service)
            <div class="card">
                <h3>{!! app()->getLocale() === 'ar' ? $service->title_ar : $service->title_en !!}</h3>
                <p>{!! app()->getLocale() === 'ar' ? $service->content_ar : $service->content_en !!}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
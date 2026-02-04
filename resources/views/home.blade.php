@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section id="hero"
    class="py-5 d-flex align-items-center"
    style="min-height: 85vh; background: url('{{ asset('assets/images/hero-bg.jpg') }}') center/cover no-repeat;">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- TEXT -->
            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start order-2 order-lg-1">

                <h1 class="fw-bold display-1 lh-1 mb-3 text-white">
                    {{$site->name}}
                </h1>

                <p class="fs-5  text-secondary mb-4">
                    {{$site->slogan}}
                </p>
            </div>
            <!-- IMAGE -->
            <div class="col-12 col-lg-6 text-center order-1 order-lg-2 d-none d-lg-block">
                <img
                    src="{{ !empty($site->hero_image_url) 
            ? asset('storage/'.$site->hero_image_url) 
            : 'https://picsum.photos/600/800?random='.$site->id }}"
                    alt="Heroes Station"
                    class="img-fluid rounded-4 shadow-lg"
                    loading="lazy"
                    decoding="async">
            </div>


        </div>
    </div>

</section>
<section id="about" class="py-5">
    <div class="container position-relative text-center">

        <!-- Watermark -->
        <div class="watermark position-absolute top-50 start-50 translate-middle text-uppercase fw-bold opacity-01"
            style="font-size: 5rem; letter-spacing: 0.3em; pointer-events: none;">
            {{ $page['about-us']->title }}
        </div>

        <!-- Title -->
        <div class="title-container d-flex flex-column align-items-center justify-content-center position-relative">
            <h2 class="title mb-3 text-yellow position-relative">
                {{ $page['about-us']->title }}
            </h2>

            <div class="underline d-flex justify-content-center align-items-center mt-2 w-100" style="max-width: 200px; margin:auto;">
                <div class="flex-grow-1 bg-dark" style="height: 2px;"></div>
                <div class="bg-warning" style="height: 2px; width: 80px;"></div>
                <div class="flex-grow-1 bg-dark" style="height: 2px;"></div>
            </div>
        </div>
    </div>

    <!-- About Us Content -->
    <div class="about-us-content py-5">
        <div class="container">
            <div class="row align-items-center g-4">

                <!-- IMAGE LEFT -->
                <div class="col-12 col-md-6 text-center text-md-start">
                    <img
                        src="{{ 
        $site->media && $site->media->count() > 0 
            ? asset('storage/'.$site->media->random()->file_path) 
            : (!empty($site->hero_image_url) 
                ? asset('storage/'.$site->hero_image_url) 
                : 'https://picsum.photos/600/800?random='.$site->id) 
    }}"
                        alt="Heroes Station"
                        class="img-fluid rounded-4 shadow-lg"
                        loading="lazy"
                        decoding="async">
                </div>

                <!-- TEXT RIGHT -->
                <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center text-center text-white">
                    {!! $page['about-us']->content !!}
                </div>


            </div>
        </div>
    </div>
</section>

<section id="services" class="py-5">
    <div class="container text-center">

        <!-- Section Title Container -->
        <div class="title-container d-flex flex-column align-items-center justify-content-center position-relative mb-5">

            <!-- Watermark behind title -->
            <div class="watermark position-absolute top-50 start-50 translate-middle text-uppercase fw-bold opacity-01"
                style="font-size: 5rem; letter-spacing: 0.3em; pointer-events: none;">
                {{ __('translate.services') }}
            </div>

            <h2 class="title fw-bold mb-3 text-yellow position-relative">
                {{ __('translate.services') }}
            </h2>

            <!-- Underline with yellow center -->
            <div class="underline d-flex justify-content-center align-items-center w-100" style="max-width: 200px;">
                <div class="flex-grow-1 bg-dark" style="height: 2px;"></div>
                <div class="bg-warning" style="height: 2px; width: 70px;"></div>
                <div class="flex-grow-1 bg-dark" style="height: 2px;"></div>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="row g-4 justify-content-center">
            @foreach ($site->services as $service)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 text-center p-4 shadow-sm border-0"
                    style="background-color: #101624; color: #fff;">
                    <h3 class="fw-bold mb-2">
                        {!! app()->getLocale() === 'ar' ? $service->title_ar : $service->title_en !!}
                    </h3>
                    <p class="text-light">
                        {!! app()->getLocale() === 'ar' ? $service->content_ar : $service->content_en !!}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

<section id="portfolio" class="portfolio scroll-up delay-4">
    <div class="container text-center">
        <div class="title-container d-flex flex-column align-items-center justify-content-center position-relative mb-5">

            <!-- Watermark behind title -->
            <div class="watermark position-absolute top-50 start-50 translate-middle text-uppercase fw-bold opacity-01"
                style="font-size: 5rem; letter-spacing: 0.3em; pointer-events: none;">
                {{ __('translate.portfolio') }}
            </div>

            <h2 class="title fw-bold mb-3 text-yellow position-relative">
                {{ __('translate.portfolio') }}
            </h2>

            <!-- Underline with yellow center -->
            <div class="underline d-flex justify-content-center align-items-center w-100" style="max-width: 200px;">
                <div class="flex-grow-1 bg-dark" style="height: 2px;"></div>
                <div class="bg-warning" style="height: 2px; width: 70px;"></div>
                <div class="flex-grow-1 bg-dark" style="height: 2px;"></div>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="grid">
                @foreach($site->media as $media)
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

    </div>
</section>

@php
$siteId = $site->id ?? 1;
@endphp
<section class="py-5">
    <div class="container">
        <div id="rating-{{ $siteId }}" class="mb-5 p-4 rounded shadow-sm" style="background:#fff; border:1px solid #eee;">
            <h4 class="fw-bold mb-3 text-yellow">{{ __('translate.rate_this_site') }}</h4>

            <form id="ratingForm-{{ $siteId }}">
                @csrf
                <input type="hidden" name="site_id" value="{{ $siteId }}">
                <input type="hidden" name="stars" id="starsInput-{{ $siteId }}" value="{{ $userRating->stars ?? 0 }}">

                <!-- Star Rating -->
                <div class="stars mb-3 fs-2 text-yellow">
                    @for($i=1; $i<=5; $i++)
                        <span class="star" data-star="{{ $i }}" style="cursor:pointer;">
                        ☆
                        </span>
                        @endfor
                </div>

                <!-- Note Textarea -->
                <textarea class="form-control mb-3" id="note-{{ $siteId }}" name="note" rows="2" placeholder="{{ __('translate.leave_note') }}" style="border-radius:8px;"></textarea>

                <button type="submit" class="btn btn-yellow w-100 fw-bold">{{ __('translate.submit_rating') }}</button>
            </form>

            <!-- Average Rating -->
            <div class="average-rating mt-4 mb-3">
                <h5 class="text-yellow">{{ __('translate.average_rating') }} <span id="avg-{{ $siteId }}">{{ number_format($averageRating, 0) }}</span> / 5</h5>
            </div>

            <!-- Last 5 Reviews -->
            @if($lastReviews->count() > 0)
            <h5 class="fw-bold mb-3" style="color:#023047;">{{ __('translate.latest_reviews') }}</h5>
            <div class="row g-3">
                @foreach($lastReviews as $review)
                <div class="col-md-12">
                    <div class="card p-3 shadow-sm text-end" style="border-radius:10px;">
                        <div class="d-flex align-items-center mb-2">
                            <!-- User avatar or initials -->
                            <div class="me-3" style="width:40px; height:40px; border-radius:50%; background:#FFB703; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                                {{ strtoupper(substr($review->user->name,0,1)) }}
                            </div>
                            <div>
                                <strong>{{ $review->user->name }}</strong>
                                <div class="stars" style="color:#FFB703; font-size:1rem;">
                                    @for($i=1; $i<=5; $i++)
                                        <span>{{ $i <= $review->stars ? '★' : '☆' }}</span>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @if($review->note)
                        <p class="mb-1" style="color:#555;">{{ $review->note }}</p>
                        @endif
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-yellow"> {{ __('translate.no_reviews_yet') }}</p>
            @endif
        </div>
    </div>
</section>

<section id="contact" class="py-5">
    <div class="container">

        <div class="title-container d-flex flex-column align-items-center justify-content-center position-relative mb-5">

            <!-- Watermark behind title -->
            <div class="watermark position-absolute top-50 start-50 translate-middle text-uppercase fw-bold opacity-01"
                style="font-size: 5rem; letter-spacing: 0.3em; pointer-events: none;">
                {{ __('translate.contact_us') }}
            </div>

            <h2 class="title fw-bold mb-3 text-yellow position-relative">
                {{ __('translate.contact_us') }}
            </h2>

            <!-- Underline with yellow center -->
            <div class="underline d-flex justify-content-start align-items-start w-100" style="max-width: 200px;">
                <div class="flex-grow-1 bg-dark" style="height: 2px;"></div>
                <div class="bg-warning" style="height: 2px; width: 70px;"></div>
                <div class="flex-grow-1 bg-dark" style="height: 2px;"></div>
            </div>
        </div>

        <!-- Form + Contact Info Row -->
        <div class="row g-4 justify-content-center align-items-start text-white">

            <!-- Right Column - Contact Info -->
            <div class="col-12 col-lg-5">
                <div class="contact-info">
                    <h3 class="mb-3">{{__('translate.contact_info')}}</h3>
                    <p class="text-secondary mb-4">
                        {!! __('translate.contact_description') !!}
                    </p>

                    <!-- Email -->
                    <div class="d-flex align-items-start mb-3 gap-1">
                        <div class="me-3 d-flex align-items-center justify-content-center rounded-circle border border-white" style="width: 50px; height: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>

                        <div>
                            <h5 class="mb-1">{{__('translate.email')}}</h5>
                            <p class="mb-0">info@heroesstation.org</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="d-flex align-items-start mb-3 gap-1">
                        <div class="me-3 d-flex align-items-center justify-content-center rounded-circle border border-white" style="width: 50px; height: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                        </div>

                        <div>
                            <h5 class="mb-1">{{__('translate.phone')}}</h5>
                            <p class="mb-0" dir="ltr">{{$site->phone_number ?? ' +963-987-040-707'}}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3 gap-1">
                        <div class="me-3 d-flex align-items-center justify-content-center rounded-circle border border-white" style="width: 50px; height: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>

                        <div>
                            <h5 class="mb-1"></u>{{__('translate.address')}}</u></h5>
                            <p class="mb-0"><b>دمشق, سوريا </b>داماسكينو مول , B3</p>
                        </div>
                    </div>
                    <!-- Social Media -->
                    <div class="d-flex align-items-start mb-3 gap-1">
                        <div class="me-3 d-flex align-items-center justify-content-center rounded-circle border border-white"
                            style="width: 50px; height: 50px;">

                            <!-- share icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5" width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.5 12a4.5 4.5 0 019 0m-9 0a4.5 4.5 0 009 0m-9 0v.01M12 7.5v.01M16.5 12v.01M12 16.5v.01" />
                            </svg>
                        </div>

                        <div>
                            <h5 class="mb-2">{{ __('translate.follow_us') ?? 'Follow Us' }}</h5>

                            <div class="d-flex gap-3">

                                <!-- Facebook -->
                                <a href="{{$site->facebook ?? 'https://www.facebook.com/HeroesStation1'}}"
                                    target="_blank"
                                    class="text-white text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24" width="22" height="22">
                                        <path d="M22 12a10 10 0 10-11.5 9.87v-6.99H7.9V12h2.6V9.8c0-2.56 1.52-3.98 3.84-3.98 1.11 0 2.27.2 2.27.2v2.5h-1.28c-1.27 0-1.67.79-1.67 1.6V12h2.85l-.46 2.88h-2.39v6.99A10 10 0 0022 12z" />
                                    </svg>
                                </a>

                                <!-- Instagram -->
                                <a href="{{$site->instagram ?? 'https://www.instagram.com/heroesstation1/'}}"
                                    target="_blank"
                                    class="text-white text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24" width="22" height="22">
                                        <path d="M7.5 2h9A5.5 5.5 0 0122 7.5v9A5.5 5.5 0 0116.5 22h-9A5.5 5.5 0 012 16.5v-9A5.5 5.5 0 017.5 2zm0 2A3.5 3.5 0 004 7.5v9A3.5 3.5 0 007.5 20h9a3.5 3.5 0 003.5-3.5v-9A3.5 3.5 0 0016.5 4h-9zm4.5 3.25A5.25 5.25 0 1112 17.75 5.25 5.25 0 0112 7.25zm0 2A3.25 3.25 0 1015.25 12 3.25 3.25 0 0012 9.25zm4.75-2.75a1 1 0 110 2 1 1 0 010-2z" />
                                    </svg>
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Left Column - Form -->
            <div class="col-12 col-lg-6">
                <div class="contact-form">
                    <h3 class="mb-4">{{__('translate.contact_us_title')}}</h3>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="{{__('translate.your_name')}}">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="{{__('translate.your_email')}}">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="{{__('translate.your_subject')}}">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" placeholder="{{__('translate.your_message')}}" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-yellow rounded-pill text-muted">{{__('translate.send_message')}}</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Address with Embedded Map -->
<section class="mb-4">
    <div class="container">
        <!-- Embedded Google Map -->
        <div class="map-container" style="width: 100%; height: 300px; border-radius:10px; overflow:hidden;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.540367984123!2d36.27338621520915!3d33.50060818077106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518e127fff3c7bf%3A0x31aff5f1c5ce3cbe!2sHeroes%20Station!5e0!3m2!1sen!2ssy!4v1706198322321!5m2!1sen!2ssy"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

</section>



@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const siteId = '{{ $siteId }}';
        const form = document.getElementById(`ratingForm-${siteId}`);
        const starsInput = document.getElementById(`starsInput-${siteId}`);
        const noteInput = document.getElementById(`note-${siteId}`);
        const starsContainer = document.getElementById(`rating-${siteId}`).querySelector('.stars');

        let selectedStars = parseInt(starsInput.value) || 0;

        // Highlight stars on click
        starsContainer.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', function() {
                selectedStars = parseInt(this.dataset.star);
                starsInput.value = selectedStars; // update hidden input
                starsContainer.querySelectorAll('.star').forEach((s, i) => {
                    s.textContent = i < selectedStars ? '★' : '☆';
                });
            });
        });

        // Submit form
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Validation
            if (selectedStars === 0) {
                alert("{{ __('translate.please_select_stars') }}");
                return;
            }

            if (!noteInput.value.trim()) {
                alert("{{ __('translate.please_write_feedback') }}");
                return;
            }

            const formData = new FormData(form);

            const res = await fetch('/rate', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            const data = await res.json();
            if (data.status) {
                location.reload();
            }
        });
    });
</script>


@endsection
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
                    alt="Edward Devis - Visual Designer"
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
        <div class="watermark position-absolute top-50 start-50 translate-middle text-uppercase fw-bold opacity-25"
            style="font-size: 5rem; letter-spacing: 0.3em; pointer-events: none;">
            {{ $page['about-us']->title }}
        </div>

        <!-- Title -->
        <div class="title-container d-flex flex-column align-items-center justify-content-center position-relative">
            <h2 class="title mb-3 text-warning position-relative">
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
                        src="{{ !empty($site->hero_image_url) 
                            ? asset('storage/'.$site->hero_image_url) 
                            : 'https://picsum.photos/600/800?random='.$site->id }}"
                        alt="Edward Devis - Visual Designer"
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
            <div class="watermark position-absolute top-50 start-50 translate-middle text-uppercase fw-bold opacity-25"
                style="font-size: 5rem; letter-spacing: 0.3em; pointer-events: none;">
                {{ __('translate.services') }}
            </div>

            <h2 class="title fw-bold mb-3 text-warning position-relative">
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
            <div class="watermark position-absolute top-50 start-50 translate-middle text-uppercase fw-bold opacity-25"
                style="font-size: 5rem; letter-spacing: 0.3em; pointer-events: none;">
                {{ __('translate.portfolio') }}
            </div>

            <h2 class="title fw-bold mb-3 text-warning position-relative">
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


<section id="contact" class="py-5">
    <div class="container">

        <div class="title-container d-flex flex-column align-items-center justify-content-center position-relative mb-5">

            <!-- Watermark behind title -->
            <div class="watermark position-absolute top-50 start-50 translate-middle text-uppercase fw-bold opacity-25"
                style="font-size: 5rem; letter-spacing: 0.3em; pointer-events: none;">
                {{ __('translate.contact_us') }}
            </div>

            <h2 class="title fw-bold mb-3 text-warning position-relative">
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
                            <p class="mb-0" dir="ltr">+963-987-040-707</p>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="d-flex align-items-start mb-3 gap-1">
                        <div class="me-3 d-flex align-items-center justify-content-center rounded-circle border border-white" style="width: 50px; height: 50px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>

                        <div>
                            <h5 class="mb-1">Address</h5>
                            <p class="mb-0"><b>دمشق, سوريا </b>داماسكينو مول , B3</p>
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
                        <button type="submit" class="btn btn-warning rounded-pill text-muted">{{__('translate.send_message')}}</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection
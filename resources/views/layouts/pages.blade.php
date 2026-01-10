<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --brand-color: {
                    {
                    $site->branding['primary_color'] ?? '#2c3e50'
                }
            }

            ;
        }

        body {
            scroll-behavior: smooth;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        header {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: background 0.3s, box-shadow 0.3s;
        }

        .navbar.scrolled {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            color: white;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link.active {
            font-weight: 700;
            color: var(--brand-color) !important;
        }

        .navbar-nav .nav-link:hover {
            color: #000;
        }

        .navbar.scrolled .nav-link {
            color: var(--brand-color);
        }

        /* Hero */
        .hero {
            height: 90vh;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero h1 {
            position: relative;
            z-index: 1;
            font-size: 3.5rem;
            margin-bottom: 20px;
        }

        .hero .btn-primary {
            background-color: var(--brand-color);
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
        }

        section {
            padding: 100px 0;
        }

        section h2 {
            color: var(--brand-color);
            margin-bottom: 40px;
            font-weight: 700;
            text-align: center;
        }

        .feature-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .gallery img {
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .contact-info i {
            color: var(--brand-color);
            margin-right: 10px;
        }

        footer {
            background: #222;
            color: #ddd;
            padding: 60px 0;
            text-align: center;
        }

        footer a {
            color: #ddd;
            margin: 0 10px;
            transition: color 0.3s;
        }

        footer a:hover {
            color: var(--brand-color);
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark py-3">
            <div class="container">
                <a class="navbar-brand" href="#home">
                    @if(!empty($site->branding['logo_path']))
                    <img src="{{ 
    !empty($site->branding['banner_path']) 
        ? asset('storage/'.$site->branding['banner_path']) 
        : 'https://picsum.photos/600/400?random=' . $site->id 
}}" alt="{{ $site->name }}" height="50">
                    @else
                    {{ $site->name }}
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @php
                        $menu = $site->menus()->where('name','main')->first();
                        @endphp
                        @if($menu)
                        @foreach($menu->items as $item)
                        @php
                        $href = $item->page ? '#'.$item->page->slug : $item->url;
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $href }}">{{ $item->title }}</a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero" style="background-image: url('{{ 
    !empty($site->branding['banner_path']) 
        ? asset('storage/'.$site->branding['banner_path']) 
        : 'https://picsum.photos/600/400?random=' . $site->id 
}}');">
    </section>

    <!-- About Section -->
    <section id="about" class="bg-light">
        <div class="container">
            <h2>{{__('translate.about_us')}}</h2>
            {!! $site->pages()->where('slug','about')->first()?->content !!}
        </div>
    </section>

    <!-- Features Section -->
    <section id="features">
        <div class="container">
            <h2>Our Features</h2>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm feature-card">
                        <i class="bi bi-gear-fill fs-1 mb-3" style="color: var(--brand-color)"></i>
                        <h5>Feature One</h5>
                        <p>Short description about feature one.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm feature-card">
                        <i class="bi bi-lightning-fill fs-1 mb-3" style="color: var(--brand-color)"></i>
                        <h5>Feature Two</h5>
                        <p>Short description about feature two.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm feature-card">
                        <i class="bi bi-globe fs-1 mb-3" style="color: var(--brand-color)"></i>
                        <h5>Feature Three</h5>
                        <p>Short description about feature three.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="bg-light">
        <div class="container">
            <h2>Gallery</h2>
            <div class="row">
                @foreach($site->media as $m)
                <div class="col-md-4 mb-3">

                    @if($m->type === 'image')
                    <img
                        src="{{ $m->file_path }}"
                        alt="{{ $m->alt }}"
                        class="img-fluid rounded"
                        loading="lazy">

                    @elseif($m->type === 'video')
                    <video
                        class="w-100 rounded"
                        controls
                        preload="metadata">
                        <source src="{{ $m->file_path }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @endif

                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <form action="{{ route('contact.send') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                            <label for="name">Your Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
                            <label for="email">Your Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" name="message" placeholder="Write your message..." style="height: 150px" required></textarea>
                            <label for="message">Message</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" style="background-color: var(--brand-color); border: none;">Send Message</button>
                        </div>
                        @if(session('success'))
                        <div class="alert alert-success text-center mt-3">
                            {{ session('success') }}
                        </div>
                        @endif
                    </form>
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <div class="contact-info">
                        <p><i class="bi bi-geo-alt-fill"></i>123 Main Street, Your City</p>
                        <p><i class="bi bi-telephone-fill"></i>+123 456 7890</p>
                        <p><i class="bi bi-envelope-fill"></i>info@yourdomain.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} — {{ $site->name }}
        <div class="mt-3">
            <a href="#"><i class="bi bi-facebook fs-4"></i></a>
            <a href="#"><i class="bi bi-twitter fs-4"></i></a>
            <a href="#"><i class="bi bi-instagram fs-4"></i></a>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.querySelector('.navbar');
            const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
            const sections = document.querySelectorAll("section");

            // Navbar scroll background
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                // Highlight active menu link
                let current = "";
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - navbar.offsetHeight - 5;
                    if (window.scrollY >= sectionTop) {
                        current = section.getAttribute("id");
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === "#" + current) {
                        link.classList.add("active");
                    }
                });
            });

            // Smooth scroll with offset
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute("href").startsWith("#")) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute("href"));
                        const offsetTop = target.offsetTop - navbar.offsetHeight;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: "smooth"
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
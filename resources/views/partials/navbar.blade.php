<header class="header">
    <!-- Logo -->
    <a href="/" class="logo d-flex align-items-center pt-1">
        <img src="{{ url(asset('assets/images/logo.png')) }}" width="200" height="100" alt="Logo">
    </a>

    <nav class="nav">
        <ul class="nav-links mb-0 d-flex align-items-center gap-1">

            @guest
            <li class="nav-item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-link text-white">
                    {{ __('translate.login') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" class="nav-link text-white">
                    {{ __('translate.singup') }}
                </a>
            </li>
            @endguest

            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown">
                    👤 {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">
                                {{ __('translate.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            @endauth

            @foreach($globalMenus as $menu)
            <li>
                <a href="{{ $menu->link }}" class="text-white nav-link">
                    {{ $menu->{'title_' . app()->getLocale()} }}
                </a>
            </li>
            @endforeach

            <li>
                <a href="{{ url(app()->getLocale().'/reserve-now') }}" class="text-yellow nav-link">
                    {{ __('translate.reserve_now') }}
                </a>
            </li>

            @php
            $currentSegment = request()->segment(2) ?? '';
            @endphp
            <!-- Language Switcher -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                    {{ strtoupper(app()->getLocale()) }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach(['en', 'ar'] as $lang)
                    @if(app()->getLocale() !== $lang)
                    <li>
                        <a class="dropdown-item" href="{{ url($lang . '/' . $currentSegment) }}">
                            {{ strtoupper($lang) }}
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </li>

        </ul>

        <div class="divider"></div>

        <a href='https://wa.me/963949512052'
            class="phone" target="_blank" rel="noopener">
            <svg class="phone-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
            +963 949 512 052
        </a>
    </nav>

</header>

<div class="modal fade" id="loginModal" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
    <div class="modal-dialog">
        <div class="modal-content p-4">

            <h5>{{ __('translate.login') }}</h5>

            <form id="loginForm">
                @csrf
                <input class="form-control mb-2" name="email" type="email" placeholder="{{ __('translate.email') }}">
                <input class="form-control mb-3" name="password" type="password" placeholder="{{ __('translate.your_password') }}">

                <button type="submit" class="btn btn-warning w-100">{{ __('translate.login') }}</button>
            </form>

            <hr>

            <p class="text-center mb-0">
                {{ __('translate.no_account') }}
                <a href="javascript:void(0)" id="openSignup">{{ __('translate.sign_up_here') }}</a>
            </p>

        </div>
    </div>
</div>


<div class="modal fade" id="registerModal" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
    <div class="modal-dialog">
        <div class="modal-content p-4">

            <h5>{{__('translate.singup')}}</h5>

            <form id="registerForm">
                @csrf
                <input class="form-control mb-2" name="name" placeholder="{{__('translate.your_name')}}">
                <input class="form-control mb-2" name="email" type="email" placeholder="{{__('translate.email')}}">
                <input class="form-control mb-3" name="password" type="password" placeholder="{{__('translate.your_password')}}">

                <button class="btn btn-warning w-100">{{__('translate.singup')}}</button>
            </form>

        </div>
    </div>
</div>


<script>
    function ajaxForm(id, url) {
        document.getElementById(id).onsubmit = async function(e) {
            e.preventDefault();

            let form = new FormData(this);

            let res = await fetch(url, {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: form
            });

            if (res.ok) location.reload();
            else alert('Invalid data');
        }
    }

    ajaxForm('loginForm', '/login');
    ajaxForm('registerForm', '/register');


    document.addEventListener('DOMContentLoaded', function() {
        const loginModalEl = document.getElementById('loginModal');
        const registerModalEl = document.getElementById('registerModal');

        const loginModal = new bootstrap.Modal(loginModalEl);
        const registerModal = new bootstrap.Modal(registerModalEl);

        // Open signup when clicking the link
        document.getElementById('openSignup').addEventListener('click', function() {
            loginModal.hide();
            registerModal.show();
        });
    });
</script>
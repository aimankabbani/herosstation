<header class="header">
    <!-- Logo -->
    <a href="/" class="logo d-flex align-items-center pt-3">
        <img src="{{ url(asset('assets/images/logo.png')) }}" width="200" height="100" alt="Logo">
    </a>

    <nav class="nav">
        <ul class="nav-links mb-0">
            @foreach($globalMenus as $menu)
            <li><a href="{{ $menu->link }}" class="text-white">
                    {{ $menu->{'title_' . app()->getLocale()} }}
            </li>
            @endforeach
        </ul>

        <div class="divider"></div>

        <a href='https://wa.me/963949512052'
            class="phone" target="_blank" rel="noopener">
            <svg class="phone-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
            +963 949 512 052
        </a>
    </nav>
</header>
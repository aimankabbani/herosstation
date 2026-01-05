<section class="services scroll-up delay-3">
    <div class="container">
        <h2>Services</h2>

        <div class="grid">
            @foreach ([
                ['title' => 'Web Development', 'desc' => 'Clean & scalable websites'],
                ['title' => 'UI / UX Design', 'desc' => 'Beautiful user experiences'],
                ['title' => 'Performance', 'desc' => 'Fast loading & optimized']
            ] as $service)
                <div class="card">
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

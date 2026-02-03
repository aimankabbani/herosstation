@extends('layouts.app')

@section('title', 'Reserve Now!')

@section('content')

<section class="py-5">
    <div class="container">
        <div class="card p-4 shadow-sm" style="border-radius:10px; max-width:500px; margin:auto;">
            <h4 class="fw-bold mb-3 text-yellow" >{{ __('translate.reserve_now') }}</h4>

            <form id="reserveForm">
                @csrf

                <!-- Site selection -->
                <div class="mb-3">
                    <label for="siteSelect" class="form-label">{{ __('translate.choose_activity') }} </label>
                    <select id="siteSelect" name="site_id" class="form-control" required>
                        <option value="">-- {{ __('translate.choose_activity') }} --</option>
                        @foreach($sites as $site)
                        <option value="{{ $site->id }}" data-phone="{{ $site->settings['phone_number'] ?? '+963949512052' }}">
                            {{ $site->{'name_' . app()->getLocale()} }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date selection -->
                <div class="mb-3">
                    <label for="reserveDate" class="form-label">{{ __('translate.choose_date') }}</label>
                    <input type="date" id="reserveDate" name="date" class="form-control" required min="{{ date('Y-m-d') }}">
                </div>

                <!-- Time selection -->
                <div class="mb-3">
                    <label for="reserveTime" class="form-label">{{ __('translate.choose_time') }}</label>
                    <input type="time" id="reserveTime" name="time" class="form-control" required>
                </div>


                <!-- Note -->
                <div class="mb-3">
                    <label for="reserveNote" class="form-label">{{ __('translate.contact_us_title') }}</label>
                    <textarea id="reserveNote" name="note" rows="2" class="form-control" placeholder="{{ __('translate.contact_description') }}"></textarea>
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-bold"> {{ __('translate.reserve_now') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reserveForm = document.getElementById('reserveForm');

        reserveForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            // Check if user is logged in
            const isLoggedIn = {{auth()->check() ? 'true' : 'false'}};
            if (!isLoggedIn) {
                // Open login modal
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
                return;
            }
            const siteSelect = document.getElementById('siteSelect');
            const reserveDate = document.getElementById('reserveDate').value;
            const reserveTime = document.getElementById('reserveTime').value;
            const note = document.getElementById('reserveNote').value.trim();
            const phoneNumber = siteSelect.options[siteSelect.selectedIndex].dataset.phone;

            if (!siteSelect.value) {
                alert("{{ __('translate.please_select_activity') }}");
                return;
            }
            if (!reserveDate) {
                alert("{{ __('translate.please_select_date') }}");
                return;
            }
            if (!reserveTime) {
                alert("{{ __('translate.please_select_time') }}");
                return;
            }
            if (!phoneNumber) {
                alert("{{ __('translate.phone_not_set') }}");
                return;
            }

            // Prepare data
            const formData = new FormData();
            formData.append('site_id', siteSelect.value);
            formData.append('date', reserveDate);
            formData.append('time', reserveTime);
            formData.append('note', note);
            formData.append('phone_number', phoneNumber);
            formData.append('_token', '{{ csrf_token() }}');

            try {
                const res = await fetch("{{ route('reserve.store') }}", {
                    method: 'POST',
                    body: formData
                });

                const data = await res.json();

                if (data.status) {
                    // Open WhatsApp after saving
                    const siteName = siteSelect.options[siteSelect.selectedIndex].text;
                    let message = `Reservation request for: ${siteName}`;
                    message += `\nDate: ${reserveDate}`;
                    message += `\nTime: ${reserveTime}`;
                    if (note) {
                        message += `\nNote: ${note}`;
                    }

                    const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                    window.open(url, '_blank');

                    // Optionally reset form
                    reserveForm.reset();
                }
            } catch (err) {
                alert("Something went wrong. Please try again.");
                console.error(err);
            }
        });
    });
</script>
@endsection
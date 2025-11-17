@extends('layouts.app')

@section('head')
<style>
    /* Match Select2 height with Bootstrap input */
    .select2-container--default .select2-selection--single {
        height: 48px !important;
        padding: 6px 12px;
        display: flex;
        align-items: center;
        border: 1px solid #ced4da !important;
        /* border-radius: 6px !important; */
    }

    /* Text inside select2 */
    .select2-selection__rendered {
        line-height: 36px !important;
        font-size: 15px;
    }

    /* Arrow alignment */
    .select2-selection__arrow {
        top: 10px !important;
    }

    /* Input shadow */
    .phone-input {
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.08) !important;
        /* border-radius: 6px !important; */
    }

    /* Select2 shadow to match */
    .select2-selection--single {
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.08) !important;
    }

    /* Keep edges clean inside input-group */
    .phone-group .select2-container .select2-selection--single,
    .phone-group input {
        height: 48px;
    }

    /* Country select width */
    .country-select {
        width: 120px !important;
    }
</style>
@endsection
@section('content')

<div class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card shadow p-4" style="width: 400px;">

        {{-- Logo --}}
        <div class="text-center mb-4">
            <img src="/images/herosstaion_logo.png" alt="Logo" style="width: 100px;">
        </div>

        <h2 class="text-center mb-4">Add Phone Number</h2>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('phone.store') }}" method="POST">
            @csrf

            {{-- Hidden Hall ID --}}
            <input name="hall_id" value="1" type="hidden" />

            <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">Phone Number</label>

                <div class="input-group shadow-sm rounded-3">

                    {{-- Country Code Dropdown --}}
                    <span class="input-group-text p-0" style="overflow: hidden;">
                        <select name="country_code" id="country_code"
                            class="form-select select2 border-0"
                            style="min-width: 120px;">
                            @foreach ($countries as $country)
                            <option value="{{ $country->dial_code }}"
                                @if ($country->dial_code == '+963') selected @endif>
                                {{ $country->flag }} {{ $country->dial_code }}
                            </option>
                            @endforeach
                        </select>
                    </span>

                    {{-- Phone Number Input --}}
                    <input type="tel"
                        name="phone"
                        id="phone"
                        class="form-control border-0"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        placeholder="9XXXXXXXX"
                        maxlength="9"
                        autocomplete="tel"
                        required>

                </div>
            </div>


            <button type="submit" class="btn btn-warning w-100">Save</button>
        </form>
    </div>

</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#country_code').select2({
            templateResult: formatFlags,
            templateSelection: formatFlags,
            width: 'resolve'
        });
    });

    function formatFlags(state) {
        if (!state.id) {
            return state.text;
        }
        return state.text;
    }
</script>
@endsection
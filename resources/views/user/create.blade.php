@extends('layouts.master')

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

        <h2 class="text-center mb-4">{{ __('translate.title') }}</h2>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success text-center">
            {{ __('translate.success') }}
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

        <form action="{{ route('phone.store', ['locale' => app()->getLocale()]) }}" method="POST">
            @csrf

            {{-- Hidden Hall ID --}}
            <input name="hall_id" value="{{$hallId}}" type="hidden" />

            {{-- Full Name --}}
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold"> {{ __('translate.full_name') }}</label>
                <input type="text"
                    name="name"
                    id="name"
                    class="form-control shadow-sm"
                    placeholder="{{ __('translate.full_name') }}"
                    value="{{ old('name') }}"
                    required>
            </div>

            {{-- Date of Birth --}}
            <div class="mb-3">
                <label for="dob" class="form-label fw-semibold"> {{ __('translate.date_of_birth') }}</label>
                <input type="date"
                    name="dob"
                    id="dob"
                    class="form-control shadow-sm"
                    value="{{ old('dob') }}"
                    required>
            </div>

            {{-- Gender --}}
            <div class="mb-3">
                <label class="form-label fw-semibold d-block"> {{ __('translate.gender') }}</label>

                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input"
                            type="radio"
                            name="gender"
                            id="male"
                            value="male"
                            {{ old('gender') === 'male' ? 'checked' : '' }}
                            required>
                        <label class="form-check-label" for="male">
                            {{ __('translate.male') }}
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                            type="radio"
                            name="gender"
                            id="female"
                            value="female"
                            {{ old('gender') === 'female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="female">
                            {{ __('translate.female') }}

                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-semibold"> {{ __('translate.phone_number') }}</label>

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


            <button type="submit" class="btn btn-warning w-100"> {{ __('translate.save') }} </button>
        </form>
    </div>

</div>
@endsection
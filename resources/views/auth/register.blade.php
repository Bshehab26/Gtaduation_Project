@extends('layouts.app')

@section('title')
    Register
@endsection

@section('content')
<!-- Page Title -->
<div class="page-title" data-aos="fade" style="background-image: url(/assets/img/page-title-bg.webp);">
    <div class="container position-relative">
        <h1>Sign up</h1>
    </div>
</div>
<!-- End Page Title -->
<div class="container p-4 w-50">

        <form action="{{ route('register') }}" method="POST" class="border p-4 shadow-sm">
            @csrf
            {{-- //add phone --}}
            <div class="form-group mb-3">
                <label for="username">Username <span class="text-danger">*</span>:</label>
                <input type="text" name="username" id="username" class="form-control" required value="{{ old('username') }}">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="first_name">First Name <span class="text-danger">*</span>:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required value="{{ old('first_name') }}">
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="last_name">Last Name <span class="text-danger">*</span>:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required value="{{ old('last_name') }}">
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email">Email <span class="text-danger">*</span>:</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="phone">Phone <span class="text-danger">*</span>:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="birth_date">Birth Date <span class="text-danger">*</span>:</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}">
                @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="bio">Bio:</label>
                <textarea name="bio" id="bio" class="form-control">{{ old('bio') }}</textarea>
                @error('bio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="pssword">Password <span class="text-danger">*</span>:</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control @error('password') 'is=invlaid' @enderror"
                    value="{{ old('birth_date') }}"
                    required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="form-group mb-3">
                <label for="pssword_confirmation">Repeat Password <span class="text-danger">*</span>:</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control @error('password') 'is=invlaid' @enderror"
                    required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="row mb-0 w-100">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary mx-atuo" style="background-color: #f82249; border: 0;">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('styles')
    <style>
        input:focus {
            border-color: #f82249 !important;
            box-shadow: 0 0 0 .25rem rgba(248,34,73,0.25) !important;
        }
    </style>
@endpush

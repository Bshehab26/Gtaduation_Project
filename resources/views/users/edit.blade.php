@extends('layouts.app')

@section('title')
    Edit My data
@endsection

@section('content')
<!-- Page Title -->
<div class="page-title" data-aos="fade" style="background-image: url(/assets/img/page-title-bg.webp);">
    <div class="container position-relative">
        <h1>Edit My Data</h1>
    </div>
</div>
<!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="container p-2 w-50">

                    <form action="{{ route('webusers.update', $user->id) }}" method="POST" class="border p-4 shadow-sm">
                        @csrf
                        @method('PUT')
                        {{-- //add phone --}}
                        @if ($successMsg = Session::get('success'))
                            <div class="alert alert-success text-center">
                                {{ $successMsg }}
                            </div>
                        @endif
                        <div class="form-group mb-3">
                            <label for="username">Username <span class="text-danger">*</span>:</label>
                            <input type="text" name="username" id="username" class="form-control" required value="{{ old('username', $user->username) }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="first_name">First Name <span class="text-danger">*</span>:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required value="{{ old('first_name', $user->first_name) }}">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="last_name">Last Name <span class="text-danger">*</span>:</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required value="{{ old('last_name', $user->last_name) }}">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email <span class="text-danger">*</span>:</label>
                            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email', $user->email) }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone <span class="text-danger">*</span>:</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="birth_date">Birth Date <span class="text-danger">*</span>:</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date', $user->birth_date) }}">
                            @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="bio">Bio:</label>
                            <textarea name="bio" id="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
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

            </div>
        </div>
    </section>
@endsection
@push('styles')
    <style>
        input:focus {
            border-color: #f82249 !important;
            box-shadow: 0 0 0 .25rem rgba(248,34,73,0.25) !important;
        }
    </style>
@endpush


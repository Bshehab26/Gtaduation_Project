@extends('layouts.app')

@section('content')
 <div class="container">
        <h2 class="mt-4 mb-4">Register User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="border p-4 shadow-sm">
            @csrf
            <div class="form-group mb-3">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required value="{{ old('username') }}">
            </div>
            <div class="form-group mb-3">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required value="{{ old('first_name') }}">
            </div>

            <div class="form-group mb-3">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required value="{{ old('last_name') }}">
            </div>

            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="form-group mb-3">
                <label for="birth_date">Birth Date:</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}">
            </div>

            <div class="form-group mb-3">
                <label for="bio">Bio:</label>
                <textarea name="bio" id="bio" class="form-control">{{ old('bio') }}</textarea>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end"><span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="id_card_no">ID Card No:</label>
                <input type="text" name="id_card_no" id="id_card_no" class="form-control" value="{{ old('id_card_no') }}">
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    User Profile | {{ $user->username }}
@endsection

@section('content')

<!-- Page Title -->
<div class="page-title" data-aos="fade" style="background-image: url(/assets/img/page-title-bg.webp);">
    <div class="container position-relative">
        <h1>User Profile</h1>
    </div>
</div>
<!-- End Page Title -->
<div class="container mt-5">
    <!-- Profile Section -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">{{ $user->username }}'s Profile</h3>
                </div>
                <div class="card-body">
                    <!-- Profile Information -->
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Username:</h4>
                            <p>{{ $user->username }}</p>
                        </div>
                        <div class="col-md-12">
                            <h4>Full Name:</h4>
                            <p>{{ $user->first_name }} {{ $user->last_name }}</p>
                        </div>
                    </div>

                    <hr>

                    <!-- Description Section -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <h4>Description:</h4>
                            <p>{{ $user->description ?? 'No description available.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .card {
            margin-top: 20px;
        }
        .card-header {
            background-color: #007bff !important;
            color: white;
        }
        .card-body h4 {
            font-weight: bold;
        }
        .card-body p {
            font-size: 1.1rem;
            color: #555;
        }
        hr {
            border-top: 1px solid #ddd;
        }
    </style>
@endpush

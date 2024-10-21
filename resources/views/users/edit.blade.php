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

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Edit My data
                        </h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($successMsg = Session::get('success'))
                            <div class="alert alert-success text-center">
                                {{ $successMsg }}
                            </div>
                        @endif

                        <!-- General Form Elements -->
                        <form action="{{ route('webusers.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('users.form')
                        </form><!-- End General Form Elements-->
                    </div>
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


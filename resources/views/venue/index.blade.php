@extends('layouts.app')


@section('title')
    Venues
@endsection

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade" style="background-image: url({{ asset('assets/img/hotels-2.jpg') }}); ">
        <div class="container position-relative">
            <h1>Venues</h1>
        </div>
    </div>

    <!-- End Page Title -->

    {{--              Search    Bar --}}

    <br>
    <br>
    
    <form action="{{ route('venues.search') }}" method="GET" class="d-flex justify-content-center mt-3">
        <div class="input-group w-50">
            <input type="text" name="search" class="form-control fs-5" 
                   placeholder="Search For Venue Name or Book City or Capacity" 
                   aria-label="Search"  aria-describedby="search-addon">
    
            <button id="search-addon" type="submit"   class="btn btn-primary" 
                    style="background-color: #0e1b4d; border-radius: 0 5px 5px 0;">
                <i class="fa fa-search fs-5 text-white"></i>
            </button>
        </div>
    </form>
    
    {{--  End Search bar      --}}

    <section id="schedule" class="schedule section">

        <div class="container mt-4">
        
            @if ($venues->isNotEmpty())
                <div class="row">
                    @foreach ($venues as $venue)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . $venue->venue_image) }}" class="card-img-top"
                                    alt="{{ $venue->name }}">
                                <div class="card-body">
                                    <p class="card-text text-center">{{ $venue->name }}</p>
                                    <a href="{{ route('venues-user.show', $venue->id) }}"
                                        class="btn btn-primary " style="margin-left:150px; background-color: #0e1b4d;">Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No venues found matching your search.</p>
            @endif

        </div>

    </section>
@endsection

@section('style-card')
    <style>
        .card {
            height: 500px;
        }

        .card img {
            height: 400px;
            object-fit: cover;
        }

        /* تعديل عرض البطاقة */
        .card {

            width: 100%;
        }
    </style>
@endsection




@extends('layouts.app')

@section('title')
    Venues {{ $venue->name }}
@endsection

@section('add_css')
    <link rel="stylesheet" href="/assets/vendor/css/fontawesome.css">
    <link rel="stylesheet" href="/assets/vendor/css/templatemo-liberty-market.css">
    <link rel="stylesheet" href="/assets/vendor/css/owl.css">
    <link rel="stylesheet" href="/assets/vendor/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
@endsection

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade" style="background-image: url({{ asset('assets/img/hotels-2.jpg') }}); ">
        <div class="container position-relative">
            <h1>Venues</h1>
        </div>
    </div>
    <!-- End Page Title -->
    <section id="schedule" class="schedule section">

        <div class="item-details-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <div class="line-dec"></div>
                            <h2 style="margin-left: 160px">View Details of <em>{{ $venue->name }}</em> venue Here.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <section> --}}


        <!-- Grid for left image and right content with margin -->
        <div class="row" style="align-items: center; gap: 30px;">
            <!-- Left Image -->
            <div class="col-lg-5">
                <div class="left-image" style="margin: 20px 0px 20px 100px;">
                    <img src="{{ asset('storage/' . $venue->venue_image) }}" alt=""
                        style="border-radius: 20px; width: 100%;">
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-lg-5 align-self-center" style="margin-left: 130px">

                <div class="bid my-3">

                    <h4>Name venue</h4>
                    <h5 style="margin-left:20px ">{{ $venue->name }}</h5>

                </div>

                <div class="bid my-3">

                    <h4>Phone</h4>
                    <h5 style="margin-left:20px ">{{ $venue->phone }}</h5>

                </div>


                <div class="bid my-3">

                    <h4>Capacity</h4>
                    <h5 style="margin-left:20px ">{{ $venue->capacity }}</h5>

                </div>


                <div class="bid my-3">

                    <h4>City</h4>
                    <h5 style="margin-left:20px ">{{ $venue->city }}</h5>

                </div>


                <div class="bid my-3">

                    <h4>Address</h4>
                    <h5 style="margin-left:20px ">{{ $venue->address }}</h5>

                </div>

            </div>

        </div>

        </div>
        </div>
        </div>
    </section>
@endsection



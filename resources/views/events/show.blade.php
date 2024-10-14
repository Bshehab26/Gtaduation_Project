@extends('layouts.app')

@section('title')
    {{ $event->name }}
@endsection

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade" style="background-image: url(/assets/img/page-title-bg.webp);">
        <div class="container position-relative">
        <h1>Event Details</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('events.index') }}">Events</a></li>
                <li class="current">{{ $event->name }}</li>
            </ol>
        </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Events Section -->
    <section id="events" class="events section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-md-6">
                <img src="/assets/img/speaker.jpg" alt="Speaker" class="img-fluid">
                </div>

                <div class="col-md-6 d-flex flex-column gap-2">
                    <div class="details row">
                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <a href="{{ route('events.edit', ['event' => $event->slug]) }}">
                                Edit this event
                            </a>
                            <a href="{{ route('ticket-status.index', $event->id) }}">
                                Status of Tickets to this event
                            </a>
                        @endif
                        <h2>{{ $event->name }}</h2>
                        <p>
                            {!! $event->description !!}
                        </p>
                    </div>
                    <div class="details row">
                        <h4 class="d-inline-block" style="width: fit-content;">Food:</h4>
                        <p class="d-inline bg-light p-2 mx-1 rounded text-black" style="width: fit-content;">
                            sea food
                        </p>
                        <p class="d-inline bg-light p-2 mx-1 rounded text-black" style="width: fit-content;">
                            sea food
                        </p>
                        <p class="d-inline bg-light p-2 mx-1 rounded text-black" style="width: fit-content;">
                            sea food
                        </p>
                        <p class="d-inline bg-light p-2 mx-1 rounded text-black" style="width: fit-content;">
                            sea food
                        </p>
                        <p class="d-inline bg-light p-2 mx-1 rounded text-black" style="width: fit-content;">
                            sea food
                        </p>
                        <p class="d-inline bg-light p-2 mx-1 rounded text-black" style="width: fit-content;">
                            sea food
                        </p>
                        <p class="d-inline bg-light p-2 mx-1 rounded text-black" style="width: fit-content;">
                            sea food
                        </p>
                        <p class="d-inline bg-light p-2 mx-1 rounded text-black" style="width: fit-content;">
                            sea food
                        </p>
                        <p class="d-inline bg-light p-2 mx-1 rounded text-black" style="width: fit-content;">
                            sea food
                        </p>
                    </div>
                </div>
            </div>

            <!-- Buy Tickets Section -->
            <section id="buy-tickets" class="buy-tickets details light-background mt-4">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Book a seat now!</h2>
                </div><!-- End Section Title -->

                <div class="container">

                    <div class="row gy-4 pricing-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <h3>Standard Access</h3>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <h4><sup>$</sup>150<span> / month</span></h4>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <ul>
                            <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                            <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                            <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="row gy-4 pricing-item featured mt-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <h3>Premium Access<br></h3>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <h4><sup>$</sup>250<span> / month</span></h4>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <ul>
                            <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                            <li><i class="bi bi-check"></i> <strong>Nec feugiat nisl pretium</strong></li>
                            <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                        </div>
                    </div><!-- End Pricing Item -->

                    <div class="row gy-4 pricing-item mt-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <h3>Pro Access<br></h3>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <h4><sup>$</sup>350<span> / month</span></h4>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <ul>
                            <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                            <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                            <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-center">
                            <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                        </div>
                    </div><!-- End Pricing Item -->

                </div>

            </section>
            <!-- /Buy Tickets Section -->

        </div>

    </section>
    <!-- /Events Section -->
@endsection

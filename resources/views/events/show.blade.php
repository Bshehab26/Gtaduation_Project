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
                        @if (Auth::check() && Auth::user()->id == $event->organizer_id)
                            <a href="{{ route('events.edit', ['event' => $event->slug]) }}" class="my-1">
                                Edit this event
                            </a>
                            <a href="{{ route('ticket-status.index', $event->id) }}" class="my-1">
                                Status of Tickets to this event
                            </a>
                        @elseif (Auth::check() && Auth::user()->role == 'admin')
                            <a href="{{ route('dashboard.events.edit', ['event' => $event->slug]) }}">
                                Edit this event
                            </a>
                        @endif

                        @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'moderator' || (Auth::user()->role == 'organizer' && auth()->user()->id == $event->organizer->id)))
                            <a href="{{ route('ticket-status.index', $event->id) }}">
                                Status of Tickets to this event
                            </a>
                        @endif

                        <h2 class="my-2">
                            <span class="{{ $event->status }} text-white px-2 py-1 fs-6 rounded lh-base">{{ $event->status }}</span> - {{ $event->name }}
                        </h2>

                        <h6><strong>By:</strong> {{ $event->organizer->first_name }} {{ $event->organizer->last_name }}</h6>

                        <div style="text-indent: 1.5rem;" class="my-2">
                            <p>
                                {!! $event->description !!}
                            </p>
                        </div>

                    </div>
                    @if ($event->subject)
                        <div class="detailes row my-1">
                            <h3>What's this event about?</h3>
                            <p>{{ $event->subject }}</p>
                        </div>
                    @endif
                    @foreach ($categories as $category)
                        <div class="details row">
                            <h5 class="d-inline-block my-auto" style="width: fit-content;">{{ $category->name }}:</h5>
                            @foreach ($event->subcategories as $sub)
                                @if ($sub->category->id === $category->id)
                                    <p class="d-inline bg-light p-2 mx-1 rounded text-black my-auto" style="width: fit-content;">
                                        {{ $sub->name }}
                                    </p>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Buy Tickets Section -->
            <section id="buy-tickets" class="buy-tickets details light-background mt-4">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Book a ticket now!</h2>
                </div><!-- End Section Title -->

                <div class="container">

                    @if ($successMsg = Session::get('success'))
                        <div class="alert alert-success text-center">
                            {{ $successMsg }}
                        </div>
                    @endif

                    @forelse ($event->tickets as $ticket)

                        <div class="row gy-4 pricing-item featured mt-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="col-lg-3 d-flex align-items-center justify-content-center">
                                <h3>{{ $ticket->type }}<br></h3>
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-center">
                                <h4><sup>$</sup>{{$ticket->price}}<span></span></h4>
                            </div>
                            <div class="col-lg-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-check"></i> <span>Avaliable tickets <h2 id="avaliable-tickets">{{ $ticket->available }}</h2></span>
                            </div>
                            @if ($ticket->available > 0)
                                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                                    <div class="text-center"><a href="{{route("decrease-no-ticket", $ticket->id)}}" class="buy-btn" >Buy Now</a></div>
                                </div>
                            @endif
                        </div><!-- End Pricing Item -->

                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="alert alert-info text-center">
                                    No Tickets found.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </div>


            </section>
            <!-- /Buy Tickets Section -->

        </div>

    </section>
    <!-- /Events Section -->
@endsection
@push('styles')
    <style>
        .upcoming {
            background-color: green;
            color: white;
        }
        .canceled {
            background-color: red;
            color: white
        }
        .ended {
            background-color: white;
            color: black;
        }
        .ongoing {
            background-color: yellow;
            color: black;
        }
    </style>
@endpush

@extends('layouts.dashboard.master')

@section('title')
    Event: {{$event->name}}
@endsection

@section('page-title')
    Events
@endsection

@section('page-title-1', 'Events')

@section('page-title-2')
    {{ $event->name }}
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">

                    {{-- EVENTS DROPDOWN --}}
                    <div class="bg-light py-2 px-4 rounded d-flex">
                        <h6 style="font-weight: bold; display: inline-block;" style="width: 15%;">Event:</h6>
                        <h6
                            id="event-dropdown-toggle"
                            class="w-75 dorpdown-toggle px-2"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="cursor: pointer; display:inline-block; font-size:1rem;"
                            >{{ $event->name }} <i class="bi bi-chevron-down toggle-dropdown"></i></h6>
                        <div class="dropdown">
                            <ul class="dropdown-menu overflow-y-scroll" style="height: 15rem;" aria-labelledby="event-dropdown-toggle">
                                @foreach ($events as $e)
                                    <li class="dropdown-item" style="cursor: pointer;">
                                        <a href="{{ route('dashboard.events.show', ['event' => $e->slug]) }}" class="text-black">
                                            {{ $e->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('dashboard.events.edit', ['event' => $event->slug]) }}">Edit this event</a>
                        </div>
                    </div>
                    {{-- END EVENTS DROPDOWN --}}

                    <div class="p-4 container">
                        <div class="row">
                            <h5 class="col-3">Name:</h5>
                            <p class="col-9 my-auto">{{ $event->name }}</p>
                        </div>
                        <div class="row my-4">
                            <h5 class="col-3">Description:</h5>
                            <div class="col-9 my-auto" style="text-indent: 1.5rem; text-align: justify;">
                                <p>{!! $event->description !!}</p>
                            </div>
                        </div>
                        <div class="row my-4">
                            <h5 class="col-3">Orgnizer:</h5>
                            <p class="col-9 my-auto">{{ $event->name }}</p>
                        </div>
                        <div class="row">
                            <h5 class="col-3 my-4">Venue:</h5>
                            <p class="col-9 my-auto">{{ $event->name }}</p>
                        </div>
                        <div class="row">
                            <h5 class="col-3 my-4">Thumbnail:</h5>
                            <p class="col-9 my-auto">{{ $event->name }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

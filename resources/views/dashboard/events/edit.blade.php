@extends('layouts.dashboard.master')
@section('title')
    Edit Evet ({{ $event->name }})
@endsection

@section('page-title-1', 'Events')

@section('page-title-2')
    Edit Event
@endsection

@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">

                    {{-- EVENTS DROPDOWN --}}
                    <div class="bg-light py-2 px-4 rounded d-flex">
                        <h6 class="my-auto" style="font-weight: bold; display: inline-block;">Event:</h6>
                        <h6
                            id="event-dropdown-toggle"
                            class="w-75 dorpdown-toggle px-2 my-auto"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="cursor: pointer; display:inline-block; font-size:1rem;"
                            >{{ $event->name }} <i class="bi bi-chevron-down toggle-dropdown"></i></h6>
                        <div class="dropdown">
                            <ul class="dropdown-menu overflow-y-scroll" style="height: 15rem;" aria-labelledby="event-dropdown-toggle">
                                @foreach ($events as $e)
                                    <li class="dropdown-item" style="cursor: pointer;">
                                        <a href="{{ route('dashboard.events.edit', ['event' => $e->slug]) }}" class="text-black">
                                            {{ $e->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('dashboard.events.show', ['event' => $event->slug]) }}">Show this event</a>
                        </div>
                    </div>
                    {{-- END EVENTS DROPDOWN --}}

                    @livewire('dashboard.events.edit', ['event' => $event], key($event->id))
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


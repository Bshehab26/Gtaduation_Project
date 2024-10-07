@extends('layouts.app')

@section('title')
    New event
@endsection

@section('content')
    <div class="page-title" data-aos="fade" style="background-image: url(/assets/img/page-title-bg.webp);">
        <div class="container position-relative">
            <h1>New Event</h1>
        </div>
    </div>

    <div class="p-4 bg-light" data-aos="fade-up">

        @livewire('events.event-create')

    </div>

@endsection

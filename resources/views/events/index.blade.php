@extends('layouts.app')

@section('title')
    Events
@endsection

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade" style="background-image: url(/assets/img/page-title-bg.webp);">
        <div class="container position-relative">
            <h1>Events</h1>
        </div>
    </div>
    <!-- End Page Title -->
    <section id="schedule" class="schedule section">

        <div data-aos="fade-up" data-aos-delay="200">
            @livewire('events.event-index')
        </div>

    </section>
@endsection

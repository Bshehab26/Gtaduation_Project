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
                    @livewire('dashboard.events.edit', ['event' => $event], key($event->id))
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@extends('layouts.dashboard.master')

@section('page-title')
    New Event
@endsection

@section('title')
    Create Category
@endsection

@section('page-title-1', 'Events')
@section('page-title-2', 'New Event')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            @livewire('dashboard.events.create')

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

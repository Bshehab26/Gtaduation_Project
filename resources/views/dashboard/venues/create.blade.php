@extends('layouts.dashboard.master')
@inject('venue', '\App\Models\Venue')

@section('title')
    Create Venue
@endsection

@section('page-title-1')

<a href="{{ route('venues.index') }}">Venues</a>
@endsection

@section('page-title-2', 'Create Venue')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create Venue</h5>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($successMsg = Session::get('success'))
                <div class="alert alert-success text-center">
                    {{ $successMsg }}
                </div>
            @endif

            <!-- General Form Elements -->
            <form action="{{ route('venues.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('dashboard.venues.form')

                <div class="d-flex justify-content-lg-center">
                    <input class="btn btn-success" type="submit" value="Add">
                </div>
            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@extends('layouts.dashboard.master')
@section('title')
    Edit Venue ({{ $venue->name }})
@endsection

@section('page-title-1')   

<a href="{{ route('venues.index') }}">Venues</a>
@endsection

@section('page-title-2')
     Edit Venue
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit venue ({{ $venue->name }})</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
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
                        <form action="{{ route('venues.update', $venue->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('dashboard.venues.form')
                            <div class="d-flex justify-content-lg-end">
                                <input class="btn btn-sm btn-success" type="submit" value="Update">
                                <a href="{{ route('venues.index') }}" class="btn btn-sm btn-warning">All venues</a>
                            </div>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

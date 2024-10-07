@extends('layouts.dashboard.master')

@section('title')
    @if(auth()->user()->id != $user->id)
        Edit User ({{ $user->username }})
    @else
        Edit My Data
    @endif
@endsection

@section('page-title-1', 'Users')

@section('page-title-2')
    @if(auth()->user()->id != $user->id)
        Edit User ({{ $user->username }})
    @else
        Edit My Data
    @endif
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
                @if(auth()->user()->id != $user->id)
                    Edit User ({{ $user->username }})
                @else
                    Edit My Data
                @endif
            </h5>

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
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.users.form')
                <div class="d-flex justify-content-lg-around">
                    <div class="row">
                        <div class="col-lg-4">
                            <input class="btn btn-success" type="submit" value="Update">
                        </div>
                        <div class="col-lg-8">
                            <a class="btn btn-dark" href="{{ route('users.index') }}">Return to users</a>
                        </div>
                    </div>
                </div>
            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

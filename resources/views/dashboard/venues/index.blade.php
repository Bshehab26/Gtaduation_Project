@extends('layouts.dashboard.master')

@section('title')
    All Venues ({{ $venues->count() }})
@endsection

@section('page-title-1')   

<a href="{{ route('venues.index') }}">Venues</a>
@endsection

@section('page-title-2')
<a href="{{ route('venues.index') }}">All venues ({{ $venues->count() }})</a> 
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            @if ($successMsg = Session::get('success'))
                <div class="alert alert-success text-center mt-3">
                    {{ $successMsg }}
                </div>
            @endif

            @if ($unauthorizedEdit = Session::get('unauthorized_action_edit'))
                <div class="alert alert-danger text-center mt-3">
                    {{ $unauthorizedEdit }}
                </div>
            @endif
            <table class="table datatable">
              <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>phone</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Capacity</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($venues as $venue)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $venue->id  }}</td>
                        <td>{{ $venue->name }}</td>
                        <td>{{ $venue->phone }}</td>
                        <td>{{ $venue->city }}</td>
                        <td>{{ $venue->address }}</td>
                        <td>{{ $venue->capacity }}</td>
                        <td>
                            <a href="{{ route('venues.show', [$venue->id]) }}" class="btn btn-sm btn-warning">Show</a>

                            @if(auth()->user()->user_type == "admin")

                               <a href="{{ route('venues.edit', $venue->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" style="display: inline-block">
                                   @csrf
                                   @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure that you want to delete the venue ({{ $venue->name }})?');">Delete</button>
                                </form>

                            @endif
                        </td>
                    </tr>
                  @empty
                    <tr>
                        <td colspan="8">
                            <div class="alert alert-info text-center">
                                No venues found.
                            </div>
                        </td>
                    </tr>
                @endforelse
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

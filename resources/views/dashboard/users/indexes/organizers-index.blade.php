@extends('layouts.dashboard.master')

@section('title')
    All organizers ({{ $organizers_count }})
@endsection

@section('page-title-1', 'organizers')
@section('page-title-2')
    All organizers ({{ $organizers_count }})
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
            @if ($unauthorizedAction = Session::get('unauthorized_action'))
                <div class="alert alert-danger text-center mt-3">
                    {{ $unauthorizedAction }}
                </div>
            @endif
            <table class="table">
              <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($organizers as $organizer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $organizer->id }}</td>
                        <td>{{ $organizer->username }}</td>
                        <td>{{ $organizer->email }}</td>
                        <td>
                            <a href="{{ route('users.show', [$organizer->username]) }}" class="btn btn-sm btn-warning">Show</a>
                            @if(auth()->user()->role == "admin")
                            <a href="{{ route('users.edit', $organizer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('users.destroy', $organizer->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure that you want to delete the user ({{ $organizer->username }})?');">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="alert alert-info text-center">
                                No organizers found.
                            </div>
                        </td>
                    </tr>
                @endforelse
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

            {{-- {{ $organizers->links('vendor.pagination.bootstrap-5') }} --}}

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

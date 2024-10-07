@extends('layouts.dashboard.master')

@section('title')
    All Moderators ({{ $moderators_count }})
@endsection

@section('page-title-1', 'Moderators')
@section('page-title-2')
    All Moderators ({{ $moderators_count }})
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
            <table class="table datatable table-bordered">
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
                @forelse ($moderators as $moderator)
                    <tr>
                        <td @if(auth()->user()->id == $moderator->id) class="bg-dark text-white" @endif>{{ $loop->iteration }}</td>
                        <td @if(auth()->user()->id == $moderator->id) class="bg-dark text-white" @endif>{{ $moderator->id }}</td>
                        <td @if(auth()->user()->id == $moderator->id) class="bg-dark text-white" @endif>{{ $moderator->username }}</td>
                        <td @if(auth()->user()->id == $moderator->id) class="bg-dark text-white" @endif>{{ $moderator->email }}</td>
                        <td @if(auth()->user()->id == $moderator->id) class="bg-dark text-white" @endif>
                            <a href="{{ route('users.show', [$moderator->username]) }}" class="btn btn-sm btn-warning">Show</a>
                            @if(auth()->user()->user_type == "moderator" && auth()->user()->id == $moderator->id)
                            <a href="{{ route('users.edit', auth()->user()->id) }}" class="btn btn-sm btn-primary">Edit My Data</a>
                            @elseif(auth()->user()->user_type == "admin")
                            <a href="{{ route('users.edit', $moderator->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('users.destroy', $moderator->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure that you want to delete the user ({{ $moderator->username }})?');">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="alert alert-info text-center">
                                No moderators found.
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

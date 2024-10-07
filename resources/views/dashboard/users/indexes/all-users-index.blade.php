@extends('layouts.dashboard.master')

@section('title')
    All Users ({{ $users->count() }})
@endsection

@section('page-title-1', 'Users')
@section('page-title-2')
    All Users ({{ $users->count() }})
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
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td @if(auth()->user()->id == $user->id) class="bg-dark text-white" @endif>{{ $loop->iteration }}</td>
                        <td @if(auth()->user()->id == $user->id) class="bg-dark text-white" @endif>{{ $user->id }}</td>
                        <td @if(auth()->user()->id == $user->id) class="bg-dark text-white" @endif>{{ $user->username }}</td>
                        <td @if(auth()->user()->id == $user->id) class="bg-dark text-white" @endif>{{ $user->email }}</td>
                        <td @if(auth()->user()->id == $user->id) class="bg-dark text-white" @endif>{{ ucfirst($user->user_type) }}</td>
                        <td @if(auth()->user()->id == $user->id) class="bg-dark text-white" @endif>
                            <a href="{{ route('users.show', [$user->username]) }}" class="btn btn-sm btn-warning">Show</a>
                            @if(auth()->user()->user_type == "admin" && $user->user_type != "admin")
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            @elseif(auth()->user()->id == $user->id)
                            <a href="{{ route('users.edit', auth()->user()->id) }}" class="btn btn-sm btn-primary">Edit My Data</a>
                            @endif
                            @if(auth()->user()->user_type == "admin" && $user->user_type != "admin")
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure that you want to delete the user ({{ $user->username }})?');">Delete</button>
                            </form>
                            @endif
                            @if ((auth()->user()->user_type == "admin"||auth()->user()->user_type == "moderator")&& auth()->user()->id == $user->id)
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-success"> Create New user </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

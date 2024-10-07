@extends('layouts.dashboard.master')

@section('title')
    All Admins ({{ $admins_count }})
@endsection

@section('page-title-1', 'Admins')
@section('page-title-2')
    All Admins ({{ $admins_count }})
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
                @foreach ($admins as $admin)
                    <tr>
                        <td @if(auth()->user()->id == $admin->id) class="bg-dark text-white" @endif>{{ $loop->iteration }}</td>
                        <td @if(auth()->user()->id == $admin->id) class="bg-dark text-white" @endif>{{ $admin->id }}</td>
                        <td @if(auth()->user()->id == $admin->id) class="bg-dark text-white" @endif>{{ $admin->username }}</td>
                        <td @if(auth()->user()->id == $admin->id) class="bg-dark text-white" @endif>{{ $admin->email }}</td>
                        <td @if(auth()->user()->id == $admin->id) class="bg-dark text-white" @endif>
                            <a href="{{ route('users.show', [$admin->username]) }}" class="btn btn-sm btn-warning">Show</a>
                            @if(auth()->user()->role == "admin" && auth()->user()->id == $admin->id)
                            <a href="{{ route('users.edit', auth()->user()->id) }}" class="btn btn-sm btn-primary">Edit My Data</a>
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

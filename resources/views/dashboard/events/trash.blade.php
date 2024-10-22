@extends('layouts.dashboard.master')

@section('page-title')
    Trashed events ({{ \App\Models\Event::onlyTrashed()->count() }})
@endsection

@section('title')
    Trashed events ({{ \App\Models\Event::onlyTrashed()->count() }})
@endsection

@section('page-title-1', 'Events')
@section('page-title-2', 'Trash')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

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
                                <th>Organizer</th>
                                <th>Status</th>
                                <th>Venue</th>
                                @if (Auth::user()->role === 'admin')
                                    <th>Actions</th>
                                @endif
                                <th>Deleted at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->organizer->fullName() }}</td>
                                    <td>{{ $event->status }}</td>
                                    <td>
                                        {{ $event->venue->name }}
                                    </td>
                                    <td>
                                        {{ $event->deleted_at->diffForHumans() }}
                                    </td>
                                    @if (Auth::user()->role === 'admin')
                                        <td>
                                            <form
                                                method="POST"
                                                action="{{ route('dashboard.events.restore', $event->id ) }}"
                                                class="my-1"
                                                style="display: inline-block"
                                                > @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" style="font-size: 0.75rem;">Restore</button>
                                            </form>
                                            <form
                                                method="POST"
                                                action="{{ route('dashboard.events.forceDelete', $event->id ) }}"
                                                class="my-1"
                                                style="display: inline-block"
                                                > @csrf
                                                @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" style="font-size: 0.75rem;" onclick="return confirm('Are you sure that you want to delete ({{ $event->name }}) permanently?');">Delete permanently</button>
                                            </form>
                                        </td>
                                    @endif
                                    <td>
                                        {{ $event->deleted_at }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-info text-center">
                                            No events found.
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

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection


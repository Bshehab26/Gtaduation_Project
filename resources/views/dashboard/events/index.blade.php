@extends('layouts.dashboard.master')

@section('page-title')
    Events ({{ \App\Models\Event::count() }})
@endsection

@section('title')
    Events ({{ \App\Models\Event::count() }})
@endsection

@section('page-title-1', 'Events')

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
                                <th>Description</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Venue</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ Str::words($event->name, 2, '...') }}</td>
                                    <td>{{ $event->description == null ? '-' : Str::words($event->description, 2, '...') }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_time)->format('y M, d H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->end_time)->format('y M, d H:i') }}</td>
                                    <td>
                                        This is a venue
                                    </td>
                                    <td class="{{ $event->status }}">
                                        {{ $event->status }}
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.events.show', [ 'event' => $event->slug] ) }}" class="btn btn-sm btn-warning" style="font-size: 0.75rem;">Show</a>
                                        <a href="{{ route('dashboard.events.edit', [ 'event' => $event->slug]) }}" class="btn btn-sm btn-primary my-1" style="font-size: 0.75rem;">Edit</a>
                                        <form
                                            method="POST"
                                            action="{{ route('dashboard.events.destroy', [ 'event' => $event->slug] ) }}"
                                            class="my-1"
                                            style="display: inline-block"
                                            > @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" style="font-size: 0.75rem;" onclick="return confirm('Are you sure that you want to delete ({{ $event->name }})?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
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


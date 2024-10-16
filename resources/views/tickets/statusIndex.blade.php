@extends('layouts.dashboard.master')

@section('title')
    All Tickets To {{$event->name}} ({{ $event->tickets->count() }})
@endsection

@section('page-title-1', 'Tickets')
@section('page-title-2')
    All Tickets To {{$event->name}} ({{ $event->tickets->count() }})
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
            @if ($unauthorizedEdit = Session::get('unsuccess'))
                <div class="alert alert-danger text-center mt-3">
                    {{ $unauthorizedEdit }}
                </div>
            @endif

            <a href="{{ route('events.index') }}" class="btn btnbtn-sm btn-warning">All Events</a>
            <a href="{{ route('ticket.create', $event->id) }}" class="btn btnbtn-sm btn-warning">Make Tickets to this event</a>
            <table class="table datatable">
              <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>type</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>available</th>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($event->tickets as $ticket)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->type }}</td>
                        <td>{{ $ticket->price}}</td>
                        <td>{{ $ticket->quantity}}</td>
                        <td>{{ $ticket->available}}</td>
                        <td>{{ $ticket->event->id}}</td>
                        <td>{{ $ticket->event->name}}</td>
                        <td>
                            <a href="{{ route('tickets.show', [$ticket->id]) }}" class="btn btn-sm btn-warning">Show</a>
                            @if(auth()->user()->role == "admin" || (auth()->user()->role == "moderator" && auth()->user()->id ==  $ticket->event->organizer->id) || (auth()->user()->role == "organizer" && auth()->user()->id ==  $ticket->event->organizer->id))
                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure that you want to delete the ticket ({{ $ticket->type }})?');">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="alert alert-info text-center">
                                No Tickets found.
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

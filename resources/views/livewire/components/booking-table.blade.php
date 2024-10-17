<div class="card recent-sales overflow-auto">

    <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
                <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#" wire:click="$set('filter', 'today')">Today</a></li>
            <li><a class="dropdown-item" href="#" wire:click="$set('filter', 'this month')">This Month</a></li>
            <li><a class="dropdown-item" href="#" wire:click="$set('filter', 'this year')">This Year</a></li>
        </ul>
    </div>

    <div class="card-body">
        <h5 class="card-title">Recent bookings <span>| {{ ucfirst($filter) }}</span></h5>

        <table class="table table-borderless datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Attendee</th>
                    <th scope="col">Event</th>
                    <th scope="col">Ticket</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                        <td>{{ $booking->attendee->first_name }} {{ $booking->attendee->last_name }}</td>
                        <td><a href="{{ route('events.show', ['event' => $booking->event->slug]) }}">{{ $booking->event->name }}</a></td>
                        <td>{{ $booking->ticket->type }}</td>
                        <td>{{ $booking->quantity }}</td>
                    </tr>
                @empty
                    <h3>There's no bookings</h3>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

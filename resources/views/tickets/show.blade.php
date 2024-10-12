@extends('layouts.dashboard.master')
@section('title')
    you show ({{$ticket->type}})
@endsection

@section('page-title-1', 'Tickets')
@section('page-title-2')
    {{ $ticket->type }}
@endsection

@section('content')
    <nav>
        <a href="{{route('tickets.index')}}">All tickets</a>
    </nav><br>

    <table class="table datatable">
        <thead>
        <tr>
            <th>ID</th>
            <th>type</th>
            <th>price</th>
            <th>quantity</th>
            <th>available</th>
            <th>Event</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->type }}</td>
                <td>{{ $ticket->price}}</td>
                <td>{{ $ticket->quantity}}</td>
                <td>{{ $ticket->available}}</td>
                <td>{{ $ticket->event->id}}</td>
            </tr>
        </tbody>
    </table>
@endsection

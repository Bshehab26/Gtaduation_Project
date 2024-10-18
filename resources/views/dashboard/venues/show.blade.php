@extends('layouts.dashboard.master')

@section('title')
 you show ({{$venue->name}})
@endsection

@section('page-title-1')   

<a href="{{ route('venues.index') }}">Venues</a>
@endsection

@section('page-title-2')
      Venue ({{$venue->name}})
@endsection

@section('content')
<nav style="color: #0e1b4d;>
    <a href="{{route('venues.index')}}">All venues</a>
</nav>
<br>

<div class="d-flex align-items-start" style="gap: 20px;">
    
    <img src="{{ asset('storage/' . $venue->venue_image) }}" 
         width="400px" height="300px" 
         alt="Venue Image" style="object-fit: cover; border-radius: 10px;">
    <br>

    <div style="margin-top: 50px; color: #0e1b4d;">
        <p><strong>Name:</strong> {{$venue->name}}</p>
        <p><strong>Phone:</strong> {{$venue->phone}}</p>
        <p><strong>City:</strong> {{$venue->city}}</p>
        <p><strong>Address:</strong> {{$venue->address}}</p>
        <p><strong>Capacity:</strong> {{$venue->capacity}}</p>
    </div>
</div>



@endsection

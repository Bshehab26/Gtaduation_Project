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
<nav>
    <a href="{{route('venues.index')}}">All venues</a>
</nav>
<br>

<span>  Name: </span>  {{$venue->name}} 
<br>
<br>
<span>  Phone:  </span>  {{$venue->phone }}
<br>
<br>
<span>  City: </span>   {{$venue->city}}
<br>
<br>
<span>  Address:</span>   {{$venue->address }}
<br>
<br>
<span>  Capacity:</span>  {{$venue->capacity}}
<br>
<br>
@endsection

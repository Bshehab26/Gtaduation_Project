@extends('layouts.dashboard.master')

@section('title')
 you show ({{$category->name}})
@endsection

@section('page-title-1', 'categories')

@section('page-title-2')
Category ({{$category->name}})
@endsection

@section('content')
<nav>
    <a href="{{route('categories.index')}}">All categories</a>
</nav><br>
<span>Name:</span>{{$category->name}}<br>
<br>
<span>Description:</span>{{$category->description ?? 'N/A'}}<br>
@endsection

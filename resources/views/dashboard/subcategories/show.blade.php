@extends('layouts.dashboard.master')
@section('title')
 you show ({{$subcategory->name}})
@endsection

@section('page-title-1', 'Subcategories')
@section('page-title-2')
    {{ $subcategory->name }}
@endsection

@section('content')
<nav>
    <a href="{{route('dashboard.subcategories.index')}}">All Subcategories</a>
</nav><br>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">

                    <div class="p-4 container">
                        <div class="row my-4">
                            <h5 class="col-3">Category:</h5>
                            <p class="col-9 my-auto">{{ $subcategory->category->name }}</p>
                        </div>
                        <div class="row my-4">
                            <h5 class="col-3">Name:</h5>
                            <p class="col-9 my-auto">{{ $subcategory->name }}</p>
                        </div>
                        <div class="row my-4">
                            <h5 class="col-3">Description:</h5>
                            <div class="col-9 my-auto" style="text-align: justify;">
                                <p>{!! $subcategory->description !!}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

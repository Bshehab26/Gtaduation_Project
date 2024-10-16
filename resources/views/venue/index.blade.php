
@extends('layouts.app')


@section('title')
    Venues
@endsection

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade" style="background-image: url({{ asset('assets/img/hotels-2.jpg') }}); ">
        <div class="container position-relative">
            <h1>Venues</h1>
        </div>
    </div>
    <!-- End Page Title -->
    <section id="schedule" class="schedule section">
   
         <div class="container mt-4">
            <div class="row">
                @foreach ($venues as $venue)
                    <div class="col-md-3 mb-4"> 
                        <div class="card h-100 d-flex flex-column"> 
                           
                                <img src="{{ asset('storage/' . $venue->venue_image) }}" class="card-img-top" alt="{{ $venue->name }}">
                            
                            <div class="card-body d-flex flex-column flex-grow-1 justify-content-between">
                                <p class="card-text text-center" style="font-size: 1.2rem; margin-bottom: 0;">{{ $venue->name }}</p>
                                <a href="{{ route('venues-user.show',$venue->id) }}" class="btn btn-primary mt-auto">details</a> 
                            </div>
                        </div>
                    </div>
                    @if (($loop->iteration % 4 === 0) && !$loop->last) 
                        <div class="row">  </div>
                    @endif
                @endforeach
            </div>
        </div>
        
    </section>
@endsection

@section('style-card')
 <style>
   .card {
    height: 500px; 
}

.card img {
    height: 400px; 
    object-fit: cover; 
}

/* تعديل عرض البطاقة */
.card {
    
    width: 100%; 
}

 </style>
@endsection


{{-- @section("venue-home")

@foreach ($venues as $venue)
    
<div class="col-lg-3 col-md-4">
    <div class="venue-gallery">

    
        <img src="{{ asset('storage/' . $venue->venue_image) }}" class="card-img-top" alt="{{ $venue->name }}">
                            
  
    </div>
</div>


@endforeach

@endsection --}}
 @php
     $count = 0;
 @endphp

 @foreach ($venues as $venue)
     @if ($count < 12)

         <div class="col-lg-3 col-md-4 mb-4 d-flex align-items-stretch">
             <div class="venue-gallery">
                 <img src="{{ asset('storage/' . $venue->venue_image) }}" class="fixed-size-img card-img-top"
                     alt="{{ $venue->name }}">
             </div>
         </div>

         @php
             $count++;
         @endphp
     @else
     @break


 @endif
@endforeach


@section('venue_home_css')
 <style>
    .fixed-size-img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    object-position: top;
    border-radius: 20px;
}



     .venue-gallery {
         width: 100%;
         height: 300px;
         overflow: hidden;
         position: relative;
     }
 </style>
@endsection

@extends('layouts.app')

@section('title')
    Venue {{ $venue->name }}
@endsection

@section('add_css')
    <link rel="stylesheet" href="/assets/vendor/css/fontawesome.css">
    <link rel="stylesheet" href="/assets/vendor/css/templatemo-liberty-market.css">
    <link rel="stylesheet" href="/assets/vendor/css/owl.css">
    <link rel="stylesheet" href="/assets/vendor/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
@endsection

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade" style="background-image: url({{ asset('/assets/img/hotels-2.jpg') }}); ">
        <div class="container position-relative">
            <h1>Venues</h1>
        </div>
    </div>
    <!-- End Page Title -->
    <section id="schedule" class="schedule section">

        <div class="item-details-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <div class="line-dec">
                            <h2 style="margin-left: 160px">View Details of <em>{{ $venue->name }}</em> venue Here.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
        
        <div class="d-flex align-items-start" style="gap: 20px; margin-left: 170px">
    
            <img src="{{ asset('storage/' . $venue->venue_image) }}" 
                 width="400px" height="300px" 
                 alt="Venue Image" style="object-fit: cover; border-radius: 10px;">
            <br>
        
            <div style="margin: 50px 0px 0px 50px; color: #0e1b4d;">
                <p><strong>Name:</strong> {{$venue->name}}</p>
                <p><strong>Phone:</strong> {{$venue->phone}}</p>
                <p><strong>City:</strong> {{$venue->city}}</p>
                <p><strong>Address:</strong> {{$venue->address}}</p>
                <p><strong>Capacity:</strong> {{$venue->capacity}}</p>
            </div>
        </div>

        
    </section>
    <section id="venue" class="venue section">

        <div class="container-fluid" data-aos="fade-up">

          <div class="row g-0">
            <div class="col-lg-6 venue-map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0" allowfullscreen=""></iframe>
            </div>

            <div class="col-lg-6 venue-info">
              <div class="row justify-content-center">
                <div class="col-11 col-lg-8 position-relative">
                  <h3>Downtown Conference Center, New York</h3>
                  <p>Iste nobis eum sapiente sunt enim dolores labore accusantium autem. Cumque beatae ipsam. Est quae sit qui voluptatem corporis velit. Qui maxime accusamus possimus. Consequatur sequi et ea suscipit enim nesciunt quia velit.</p>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="container-fluid venue-gallery-container" data-aos="fade-up" data-aos-delay="100">
          <div class="row g-0">

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-1.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-1.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-2.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-2.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-3.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-3.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-4.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-4.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-5.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-5.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-6.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-6.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-7.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-7.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-8.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-8.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

          </div>
        </div>
    </section>
    <section id="venue" class="venue section">

        <div class="container-fluid" data-aos="fade-up">

          <div class="row g-0">
            <div class="col-lg-6 venue-map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0" allowfullscreen=""></iframe>
            </div>

            <div class="col-lg-6 venue-info">
              <div class="row justify-content-center">
                <div class="col-11 col-lg-8 position-relative">
                  <h3>Downtown Conference Center, New York</h3>
                  <p>Iste nobis eum sapiente sunt enim dolores labore accusantium autem. Cumque beatae ipsam. Est quae sit qui voluptatem corporis velit. Qui maxime accusamus possimus. Consequatur sequi et ea suscipit enim nesciunt quia velit.</p>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="container-fluid venue-gallery-container" data-aos="fade-up" data-aos-delay="100">
          <div class="row g-0">

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-1.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-1.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-2.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-2.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-3.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-3.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-4.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-4.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-5.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-5.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-6.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-6.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-7.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-7.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

            <div class="col-lg-3 col-md-4">
              <div class="venue-gallery">
                <a href="/assets/img/venue-gallery/venue-gallery-8.jpg" class="glightbox" data-gall="venue-gallery">
                  <img src="/assets/img/venue-gallery/venue-gallery-8.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div>

          </div>
        </div>

      </section
@endsection



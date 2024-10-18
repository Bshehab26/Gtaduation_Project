@extends('layouts.app')

@section('content')

<div>

<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

    <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in" class="">

    <div class="container d-flex flex-column align-items-center text-center mt-auto">
        <h2 data-aos="fade-up" data-aos-delay="100" class="">{{ $featuredEvent->name }}</h2>
        <p data-aos="fade-up" data-aos-delay="200">
        @php
            $startTime = \Carbon\Carbon::parse($featuredEvent->start_time);
            $endTime = \Carbon\Carbon::parse($featuredEvent->end_time);
            if ($startTime->format('Y-m-d') == $endTime->format('Y-m-d')) {
                $date = $startTime->format('d F');
                $whenDate = $startTime->format('l d F');
            } elseif ($startTime->format('Y-m') == $endTime->format('Y-m')) {
                $date = $startTime->format('d') . $endTime->format(' - d F');
                $whenDate = $startTime->format('l d') . $endTime->format(' - l d F');
            } else {
                $date = $startTime->format('d m') . $endTime->format('to d m');
                $whenDate = $startTime->format('l d m') . $endTime->format(' - l d m');
            };
        @endphp
        {{ $date }}, {{ $featuredEvent->venue->name . ', ' . $featuredEvent->venue->city }}</p>
        <div data-aos="fade-up" data-aos-delay="300" class="">
            <a href="{{ route('events.show', ['event' => $featuredEvent->slug]) }}" class="glightbox pulsating-play-btn mt-3"></a>
        </div>
    </div>

    <div class="about-info mt-auto position-relative">
        <div class="container position-relative" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-6">
                    <h2>About The Event</h2>
                    <p>{!! Str::words($featuredEvent->description, 50, '...') !!}</p>
                </div>
                <div class="col-lg-3">
                    <h3>Where</h3>
                    <p>{{ $featuredEvent->venue->name }}, {{ $featuredEvent->venue->city }}</p>
                </div>
                <div class="col-lg-3">
                    <h3>When</h3>
                    <p>
                        {{ $whenDate }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /Hero Section -->

<!-- Schedule Section -->
<section id="schedule" class="schedule section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Event Schedule<br></h2>
      <p>Check upcoming events and don't forget to rigester for an event before tickets are out!</p>
    </div>
    <!-- End Section Title -->

    <div data-aos="fade-up" data-aos-delay="200">
        @livewire('events.event-schedule')
    </div>

</section>
<!-- /Schedule Section -->

<!-- Venue Section -->
<section id="venue" class="venue section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">

   <a href="{{ route('venues-user.index') }}" >

      <h2>Event Venue<br></h2>

    </a>

</div><!-- End Section Title -->

<div class="container-fluid" data-aos="fade-up">

  <div class="container-fluid venue-gallery-container" data-aos="fade-up" data-aos-delay="100">
      <div class="row g-0">

        @include('venue.venue_home', ['venues' => $venues])

      </div>
  </div>
</div>



</section>
<!-- /Venue Section -->

<!-- Gallery Section -->
<section id="gallery" class="gallery section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Gallery</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="swiper init-swiper">
    <script type="application/json" class="swiper-config">
        {
        "loop": true,
        "speed": 600,
        "autoplay": {
            "delay": 5000
        },
        "slidesPerView": "auto",
        "centeredSlides": true,
        "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
        },
        "breakpoints": {
            "320": {
            "slidesPerView": 1,
            "spaceBetween": 0
            },
            "768": {
            "slidesPerView": 3,
            "spaceBetween": 20
            },
            "1200": {
            "slidesPerView": 5,
            "spaceBetween": 20
            }
        }
        }
    </script>
    <div class="swiper-wrapper align-items-center">
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/event-gallery/event-gallery-1.jpg"><img src="assets/img/event-gallery/event-gallery-1.jpg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/event-gallery/event-gallery-2.jpg"><img src="assets/img/event-gallery/event-gallery-2.jpg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/event-gallery/event-gallery-3.jpg"><img src="assets/img/event-gallery/event-gallery-3.jpg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/event-gallery/event-gallery-4.jpg"><img src="assets/img/event-gallery/event-gallery-4.jpg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/event-gallery/event-gallery-5.jpg"><img src="assets/img/event-gallery/event-gallery-5.jpg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/event-gallery/event-gallery-6.jpg"><img src="assets/img/event-gallery/event-gallery-6.jpg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/event-gallery/event-gallery-7.jpg"><img src="assets/img/event-gallery/event-gallery-7.jpg" class="img-fluid" alt=""></a></div>
        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/event-gallery/event-gallery-8.jpg"><img src="assets/img/event-gallery/event-gallery-8.jpg" class="img-fluid" alt=""></a></div>
    </div>
    <div class="swiper-pagination"></div>
    </div>

</div>

</section>
<!-- /Gallery Section -->

<!-- Sponsors Section -->
<section id="sponsors" class="sponsors section light-background">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Sponsors</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row g-0 clients-wrap">

    <div class="col-xl-3 col-md-4 client-logo">
        <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
    </div><!-- End Client Item -->

    <div class="col-xl-3 col-md-4 client-logo">
        <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
    </div><!-- End Client Item -->

    <div class="col-xl-3 col-md-4 client-logo">
        <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
    </div><!-- End Client Item -->

    <div class="col-xl-3 col-md-4 client-logo">
        <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
    </div><!-- End Client Item -->

    <div class="col-xl-3 col-md-4 client-logo">
        <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
    </div><!-- End Client Item -->

    <div class="col-xl-3 col-md-4 client-logo">
        <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
    </div><!-- End Client Item -->

    <div class="col-xl-3 col-md-4 client-logo">
        <img src="assets/img/clients/client-7.png" class="img-fluid" alt="">
    </div><!-- End Client Item -->

    <div class="col-xl-3 col-md-4 client-logo">
        <img src="assets/img/clients/client-8.png" class="img-fluid" alt="">
    </div><!-- End Client Item -->

    </div>

</div>

</section>
<!-- /Sponsors Section -->

<!-- Faq Section -->
<section id="faq" class="faq section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Frequently Asked Questions</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
</div><!-- End Section Title -->

<div class="container">

    <div class="row justify-content-center">

    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

        <div class="faq-container">

        <div class="faq-item faq-active">
            <h3>Non consectetur a erat nam at lectus urna duis?</h3>
            <div class="faq-content">
            <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
            <h3>Feugiat scelerisque varius morbi enim nunc faucibus?</h3>
            <div class="faq-content">
            <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
            <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
            <div class="faq-content">
            <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
            <h3>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h3>
            <div class="faq-content">
            <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
            <h3>Tempus quam pellentesque nec nam aliquam sem et tortor?</h3>
            <div class="faq-content">
            <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        <div class="faq-item">
            <h3>Perspiciatis quod quo quos nulla quo illum ullam?</h3>
            <div class="faq-content">
            <p>Enim ea facilis quaerat voluptas quidem et dolorem. Quis et consequatur non sed in suscipit sequi. Distinctio ipsam dolore et.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
        </div><!-- End Faq item-->

        </div>

    </div><!-- End Faq Column-->

    </div>

</div>

</section>
<!-- /Faq Section -->

<!-- Contact Section -->
<section id="contact" class="contact section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Contact</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

    <div class="col-lg-6">
        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
        <i class="bi bi-geo-alt"></i>
        <h3>Address</h3>
        <p>A108 Adam Street, New York, NY 535022</p>
        </div>
    </div><!-- End Info Item -->

    <div class="col-lg-3 col-md-6">
        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
        <i class="bi bi-telephone"></i>
        <h3>Call Us</h3>
        <p>+1 5589 55488 55</p>
        </div>
    </div><!-- End Info Item -->

    <div class="col-lg-3 col-md-6">
        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
        <i class="bi bi-envelope"></i>
        <h3>Email Us</h3>
        <p>info@example.com</p>
        </div>
    </div><!-- End Info Item -->

    </div>

    <div class="row gy-4 mt-1">
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div><!-- End Google Maps -->

    <div class="col-lg-6">
        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="400">
        <div class="row gy-4">

            <div class="col-md-6">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
            </div>

            <div class="col-md-6 ">
            <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
            </div>

            <div class="col-md-12">
            <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
            </div>

            <div class="col-md-12">
            <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
            </div>

            <div class="col-md-12 text-center">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>

            <button type="submit">Send Message</button>
            </div>

        </div>
        </form>
    </div><!-- End Contact Form -->

    </div>

</div>

</section>
<!-- /Contact Section -->

</div>

@endsection

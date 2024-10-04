<div class="container">

  <ul class="nav nav-tabs" role="tablist" data-aos="fade-up" data-aos-delay="100">
    <li class="nav-item">
      <a class="nav-link active" href="#day-1" role="tab" data-bs-toggle="tab">{{ \Carbon\Carbon::today()->format('M, j') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#day-2" role="tab" data-bs-toggle="tab">{{ \Carbon\Carbon::tomorrow()->format('M, j') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#day-3" role="tab" data-bs-toggle="tab">{{ \Carbon\Carbon::tomorrow()->addDays(1)->format('M, j') }}</a>
    </li>
  </ul>

  <div class="tab-content row justify-content-center" data-aos="fade-up" data-aos-delay="200">

    <h3 class="sub-heading">Voluptatem nulla veniam soluta et corrupti consequatur neque eveniet officia. Eius necessitatibus voluptatem quis labore perspiciatis quia.</h3>

    <!-- Schdule Day 1 -->
    <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">

        @foreach ($eventsDay1 as $event)

            <div wire:key="{{ $event->id }}" class="row schedule-item">
                <div class="col-md-2">
                    <time>{{ date('H:i A', strtotime($event->start_time)) }}</time>
                </div>
                <div class="col-md-9">
                    <div class="speaker">
                        <img src="/assets/img/speakers/speaker-1-2.jpg" alt="Brenden Legros">
                    </div>
                    <h4 class="text-nowrap">
                        {{ Str::words($event->name, 5) }} <span>Brenden Legros</span>
                    </h4>
                    <p>
                        {{ Str::words($event->description, 15, '...') }}
                    </p>
                </div>
                <div class="col-md-1 align-self-center">
                    <a href="{{ route('events.show', $event->slug) }}" class="my-auto">
                        More...
                    </a>
                </div>
            </div>

        @endforeach

    </div>
    <!-- End Schdule Day 1 -->

    <!-- Schdule Day 2 -->
    <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-2">

        @foreach ($eventsDay2 as $event)

            <div wire:key="{{ $event->id }}" class="row schedule-item">
                <div class="col-md-2">
                    <time>{{ date('H:i A', strtotime($event->start_time)) }}</time>
                </div>
                <div class="col-md-9">
                    <div class="speaker">
                        <img src="/assets/img/speakers/speaker-1-2.jpg" alt="Brenden Legros">
                    </div>
                    <h4 class="text-nowrap">
                        {{ Str::words($event->name, 5) }} <span>Brenden Legros</span>
                    </h4>
                    <p>
                        {{ Str::words($event->description, 15, '...') }}
                    </p>
                </div>
                <div class="col-md-1 align-self-center">
                    <a href="{{ route('events.show', $event->slug) }}" class="my-auto">
                        More...
                    </a>
                </div>
            </div>

        @endforeach

    </div><!-- End Schdule Day 2 -->

    <!-- Schdule Day 3 -->
    <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-3">

        @foreach ($eventsDay3 as $event)

            <div wire:key="{{ $event->id }}" class="row schedule-item">
                <div class="col-md-2">
                    <time>{{ date('H:i A', strtotime($event->start_time)) }}</time>
                </div>
                <div class="col-md-9">
                    <div class="speaker">
                        <img src="/assets/img/speakers/speaker-1-2.jpg" alt="Brenden Legros">
                    </div>
                    <h4 class="text-nowrap">
                        {{ Str::words($event->name, 5) }} <span>Brenden Legros</span>
                    </h4>
                    <p>
                        {{ Str::words($event->description, 15, '...') }}
                    </p>
                </div>
                <div class="col-md-1 align-self-center">
                    <a href="{{ route('events.show', $event->slug) }}" class="my-auto">
                        More...
                    </a>
                </div>
            </div>

        @endforeach

    </div>
    <!-- End Schdule Day 3 -->

  </div>

</div>

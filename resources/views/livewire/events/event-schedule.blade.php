<div class="container">

  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item" wire:click="changeDate(0)">
        <a class="nav-link {{ $day == 0 ? 'active' : ''}}" style="cursor: pointer;"
            >{{ \Carbon\Carbon::tomorrow()->format('M, j') }}
        </a>
    </li>
    <li class="nav-item" wire:click="changeDate(1)">
        <a class="nav-link {{ $day == 1 ? 'active' : ''}}" style="cursor: pointer;"
            >{{ \Carbon\Carbon::tomorrow()->addDay()->format('M, j') }}
        </a>
    </li>
    <li class="nav-item" wire:click="changeDate(2)">
        <a class="nav-link {{ $day == 2 ? 'active' : ''}}" style="cursor: pointer;"
            >{{ \Carbon\Carbon::tomorrow()->addDays(2)->format('M, j') }}
        </a>
    </li>
  </ul>

  <div class="tab-content row justify-content-center">

    <h3 class="sub-heading">Voluptatem nulla veniam soluta et corrupti consequatur neque eveniet officia. Eius necessitatibus voluptatem quis labore perspiciatis quia.</h3>

    <!-- Schdule -->
    <div role="tabpanel" class="col-lg-9 tab-pane fade show active">

        @forelse ($events as $event)

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
                        {!! Str::words($event->description, 15, '...') !!}
                    </p>
                </div>
                <div class="col-md-1 align-self-center">
                    <a href="{{ route('events.show', $event->slug) }}" class="my-auto">
                        More...
                    </a>
                </div>
            </div>
        @empty
            <div>
                <h2>There's No events for this day</h2>
            </div>

        @endforelse

    </div>
    <!-- End Schdule -->

  </div>

</div>

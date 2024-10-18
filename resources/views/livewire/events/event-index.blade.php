@push('styles')
    <style>
        .form-control:focus{
            border-color: #f82249;
            box-shadow: 0 0 0 0.25rem rgba(248, 34, 73, 0.25);
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(() => {
            $('#filters-trigger').on("click", function () {
                $('#filters-form').slideToggle();
            });
        });
    </script>
@endpush

<div class="container">

    {{-- <ul class="nav nav-tabs" role="tablist">
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
    </ul> --}}

    <form wire:submit='$refresh' class="form input-group w-50 mx-auto my-3 py-2">

        <input wire:model='search' type="text" name="search" class="form-control fs-5 rounded-left" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />

        <button id="search-addon" type="submit" class="input-group-text border-0" style="background-color: #0e1b4d;">
            <i class="fa fa-search fs-5 text-white"></i>
        </button>

    </form>

    <div class="d-flex flex-column flex-lg-row mx-auto my-2 mb-4" style="gap: 2rem;">

        <button class="btn fs-5 px-3 mx-lg-0 text-white" style="width:fit-content; height:fit-content; background-color: #f82249;" id="filters-trigger">
            Filters
        </button>

        <form wire:submit='filter' class="form input-group rounded w-100 bg-light border rounded" style="display: none;" id="filters-form">
            <div class="container w-100">
                <div class="row">
                    <div class="col-8 container">
                        <div class="row">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($categories as $category)
                                @php
                                    $i ++;
                                @endphp
                                <div class="col-4 p-3 rounded" wire:key='{{ $category->id }}'>
                                    <h4>{{ $category->name }}:</h4>
                                    <div class="px-3">
                                        <div class="my-3">
                                            <input wire:model='category{{ $i }}' type="radio" name="{{ $category->name }}" id="none{{ $category->id }}" value="">
                                            <label for="none{{ $category->id }}">All</label>
                                        </div>
                                        @foreach ($category->subcategories as $sub)
                                            <div class="my-3" wire:key='{{ $sub->id }}'>
                                                <input wire:model='category{{ $i }}' type="radio" name="{{ $category->name }}" id="{{ $sub->name }}" value="{{ $sub->name }}">
                                                <label for="{{ $sub->name }}">{{ $sub->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-4 p-3">
                        <div>
                            <h5 style="font-weight: bold; display: inline-block;">Time:</h5>
                            <h5
                                id="event-dropdown-toggle"
                                class="w-75 dorpdown-toggle px-2"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                style="cursor: pointer; display:inline-block;"
                                >{{ $time }} <i class="bi bi-chevron-down toggle-dropdown"></i></h5>
                            <div class="dropdown">
                                <ul class="dropdown-menu" aria-labelledby="event-dropdown-toggle">
                                    <li class="dropdown-item" wire:click="$set('time', 'This week')">This week</li>
                                    <li class="dropdown-item" wire:click="$set('time', 'This month')">This month</li>
                                    <li class="dropdown-item" wire:click="$set('time', 'This year')">This year</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-end w-100 p-3 d-flex justify-content-end">
                    <button type="submit" class="btn text-white" style="background-color: #f82249; width:fit-content; height:fit-content;" id="search-addon">
                        Apply
                    </button>
                </div>
            </div>
        </form>

    </div>

    <div class="tab-content row justify-content-center align-items-center" id="events-schedule">

        <!-- Schdule -->
        <div role="tabpanel" class="col-lg-9 tab-pane fade show active w-100">

            <div>
                <h3>{{ $events->total() }} results found:</h3>
            </div>

            <div class="row schedule-item px-2 rounded-top" style="background-color: #0e1b4d;">
                <div class="col-md-1" wire:click="order('start')" style="cursor: pointer;">
                    <h4 class="text-white mb-0">
                        Date <span style="font-style: normal; color:white;">{!! $orderQ == 'start' ? $orderType == 'desc' ? '&#11205;' : '&#11206;' : '' !!}</span>
                    </h4>
                </div>
                <div class="col-md-2" wire:click="order('organizer')" style="cursor: pointer;">
                    <h4 class="text-white mb-0">
                        Organizer <span style="font-style: normal; color:white;">{!! $orderQ == 'organizer' ? $orderType == 'desc' ? '&#11205;' : '&#11206;' : '' !!}</span>
                    </h4>
                </div>
                <div class="col-md-4" wire:click="order('event')" style="cursor: pointer;">
                    <h4 class="text-white mb-0">
                        Event <span style="font-style: normal; color:white;">{!! $orderQ == 'event' ? $orderType == 'desc' ? '&#11205;' : '&#11206;' : '' !!}</span>
                    </h4>
                </div>
                <div class="col-md-2" wire:click="order('subject')" style="cursor: pointer;">
                    <h4 class="text-white mb-0">
                        Subject <span style="font-style: normal; color:white;">{!! $orderQ == 'subject' ? $orderType == 'desc' ? '&#11205;' : '&#11206;' : '' !!}</span>
                    </h4>
                </div>
                <div class="col-md-2" wire:click="order('venue')" style="cursor: pointer;">
                    <h4 class="text-white mb-0">
                        Venue <span style="font-style: normal; color:white;">{!! $orderQ == 'venue' ? $orderType == 'desc' ? '&#11205;' : '&#11206;' : '' !!}</span>
                    </h4>
                </div>
                <div class="col-md-1">
                </div>
            </div>

            @foreach ($events as $event)

                <div wire:key="{{ $event->id }}" class="row schedule-item">
                    <div class="col-md-1 align-self-center">
                        <time style="font-size: 0.9rem; font-weight: bold;">{{ date('y M d H:i A', strtotime($event->start_time)) }}</time>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <div class="speaker flex-shrink-0">
                            <img class="ratio ratio-1x1 object-fit-cover" src="/assets/img/speakers/speaker-1-2.jpg" alt="Brenden Legros" style="image">
                        </div>
                        <h6>
                            {{ $event->organizer->fullName() }}
                        </h6>
                    </div>
                    <div class="col-md-4">
                        <h5>{{ Str::words($event->name, 4, '...') }}</h5>
                        <p>
                            {!! Str::words($event->description, 8, '...') !!}
                        </p>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <h6>{{ Str::words($event->subject, 3, '...') ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <h6>{{ $event->venue->name }}</h6>
                    </div>
                    <div class="col-md-1 align-self-center">
                        <a href="{{ route('events.show', $event->slug) }}" class="my-auto">
                            More...
                        </a>
                    </div>
                </div>

            @endforeach

        </div>

        <div class="mt-5">
            {{ $events->links(data: ['scrollTo' => '#schedule']) }}
        </div>
        <!-- End Schdule -->
    </div>

</div>

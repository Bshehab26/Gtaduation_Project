<div class="card info-card revenue-card">

    <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
                <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#" wire:click="$set('filter', 'today')">Today</a></li>
            <li><a class="dropdown-item" href="#" wire:click="$set('filter', 'this month')">This Month</a></li>
            <li><a class="dropdown-item" href="#" wire:click="$set('filter', 'this year')">This Year</a></li>
        </ul>
    </div>

    <div class="card-body">
        <h5 class="card-title">Tickets sold <span>| {{ ucfirst($filter) }}</span></h5>

        <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-collection"></i>
            </div>
            <div class="ps-3">
                <h6>{{ $sold }}</h6>
            </div>
        </div>
    </div>

</div>

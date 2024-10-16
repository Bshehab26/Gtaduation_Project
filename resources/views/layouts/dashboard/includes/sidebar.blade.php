<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard-home') }}">
                <i class="fs-5 ri-home-gear-line"></i>
                <span>Dashboard</span>
            </a>
          </li>

        {{-- Categories --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#categories-nav" data-bs-toggle="collapse" href="#">
                <i class="fs-5 bx bx-category"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="categories-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('categories.index') }}">
                        <i class="fs-5 bx bx-list-ul"></i><span>All Categories
                            ({{ \App\Models\Category::count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('categories.create') }}">
                        <i class="fs-5 bx bxs-plus-circle"></i><span>Create Category</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('categories.trash') }}">
                        <i class="fs-5 bx bxs-trash"></i><span>Trashed Categories
                            ({{ \App\Models\Category::onlyTrashed()->count() }})</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->

        {{-- Subcategories --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#subcategories-nav" data-bs-toggle="collapse" href="#">
                <i class="fs-5 bx bx-category"></i><span>Subcategories</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="subcategories-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('dashboard.subcategories.index') }}">
                        <i class="fs-5 bx bx-list-ul"></i><span>All Subcategories
                            ({{ \App\Models\Subcategory::count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.subcategories.create') }}">
                        <i class="fs-5 bx bxs-plus-circle"></i><span>Create Subcategory</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.subcategories.trash') }}">
                        <i class="fs-5 bx bxs-trash"></i><span>Trashed Subcategories
                            ({{ \App\Models\Subcategory::onlyTrashed()->count() }})</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->

        <!-- EVENTS -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-calendar-event"></i><span>Events</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('dashboard.events.index') }}">
                        <i class="bi bi-calendar-week" style="font-size: 1rem;"></i><span>All events ({{ \App\Models\Event::count() }})</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.events.show', ['event' => \App\Models\Event::latest()->first()->slug]) }}">
                        <i class="bi bi-calendar-event" style="font-size: 1rem;"></i><span>Show events</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.events.create') }}">
                        <i class="bi bi-calendar-plus" style="font-size: 1rem;"></i><span>New event</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.events.edit', ['event' => \App\Models\Event::latest()->first()->slug]) }}">
                        <i class="bi bi-pencil-square" style="font-size: 1rem;"></i><span>Edit events</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.events.trash') }}">
                        <i class="bi bi-calendar-x" style="font-size: 1rem;"></i><span>Trashed events ({{ \App\Models\Event::onlyTrashed()->count() }})</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Events Nav -->

        {{-- Users --}}
        <li class="nav-item">

            <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                <i class="fs-5 bx bxs-user-account"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="fs-5 ri-file-user-line"></i></i><span>All Users
                            ({{ \App\Models\User::count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.customers') }}">
                        <i class="fs-5 ri-user-fill"></i><span>customers
                            ({{ \App\Models\User::where('role', 'customer')->count() }})</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('users.orginzers') }}">
                        <i class="fs-5 ri-user-fill"></i><span>orginzer
                            ({{ \App\Models\User::where('role', 'orginzer')->count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.moderators') }}">
                        <i class="fs-5 ri-user-star-fill"></i><span>Moderators
                            ({{ \App\Models\User::where('role', 'moderator')->count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.admins') }}">
                        <i class="fs-5 ri-shield-user-fill"></i><span>Admins
                            ({{ \App\Models\User::where('role', 'admin')->count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.create') }}">
                        <i class="fs-5 ri-user-add-fill"></i><span>Create User</span>
                    </a>
                </li>
            </ul>
        </li>

            {{-- Tickets --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tickets-nav" data-bs-toggle="collapse" href="#">
                <i class="fs-5 bx bxs-user-account"></i><span>Tickets</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tickets-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('tickets.index') }}">
                        <i class="fs-5 ri-file-user-line"></i></i><span>All Tickets
                            ({{ \App\Models\Ticket::count() }})</span>
                    </a>
                </li>

            </ul>
        </li>
            


        {{-- ******************************* --}}

        {{-- Venues --}}
        
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#venues-nav" data-bs-toggle="collapse" href="#">
                <i class="fs-5 bi bi-door-open"></i><span>venues</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="venues-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('venues.index') }}">
                        <i class="fs-5 bx bx-list-ul"></i><span>All venues
                            ({{ \App\Models\Venue::count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('venues.create') }}">
                        <i class="fs-5 bx bxs-plus-circle"></i><span>Create Venue</span>
                    </a>
                </li>

                
            </ul>
        </li><!-- End Components Nav -->
</aside>

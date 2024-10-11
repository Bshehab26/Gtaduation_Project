<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard-home') }}">
                <i class="fs-5 ri-home-gear-line"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

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
                            ({{ \App\Models\User::where('user_type', 'customer')->count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.moderators') }}">
                        <i class="fs-5 ri-user-star-fill"></i><span>Moderators
                            ({{ \App\Models\User::where('user_type', 'moderator')->count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.admins') }}">
                        <i class="fs-5 ri-shield-user-fill"></i><span>Admins
                            ({{ \App\Models\User::where('user_type', 'admin')->count() }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.create') }}">
                        <i class="fs-5 ri-user-add-fill"></i><span>Create User</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->



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

                {{-- <li>
                    <a href="{{ route('venues.trash') }}">
                        <i class="fs-5 bx bxs-"></i><span>Edit venues
                            ({{ \App\Models\Venue::onlyTrashed()->count() }})</span>
                    </a>
                </li> --}}
            </ul>
        </li><!-- End Components Nav -->
</aside>

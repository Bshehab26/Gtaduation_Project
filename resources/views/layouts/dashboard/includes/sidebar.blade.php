<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard-home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('categories.index') }}">
                        <i class="bi bi-circle"></i><span>All Categories ({{ \App\Models\Category::count() }})</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.create') }}">
                        <i class="bi bi-circle"></i><span>Create Category</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('categories.trash') }}">
                        <i class="bi bi-circle"></i><span>Trashed categories ({{ \App\Models\Category::onlyTrashed()->count() }})</span>
                    </a>
                </li>


            </ul>
        </li><!-- End Components Nav -->

</aside>

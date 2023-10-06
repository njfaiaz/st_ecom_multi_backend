<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo/logo.png') }}" alt="logo" />
            <span class="text-white">{{ env('APP_NAME') }}</span>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('admin.dashboard') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('brand') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Brands
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('category') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Category
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('subcategory') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Subcategory
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#subcatMenu" aria-expanded="false" aria-controls="navPages">
                <i
                    data-feather="layers"
                    class="nav-icon icon-xs me-2">
                </i> Subcategory
                </a>
                <div id="subcatMenu" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="#">
                            Add Sub Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow"  href="#" >
                            All Sub Category
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}


        </ul>
    </div>
</nav>

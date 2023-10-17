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

            <li class="nav-item">
                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#productPage" aria-expanded="false" aria-controls="navPages">
                <i
                    data-feather="layers"
                    class="nav-icon icon-xs me-2">
                </i> Products
                </a>
                <div id="productPage" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link has-arrow"  href="{{ route('product') }}" >
                            Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow"  href="{{ route('all.inactive.product') }}" >
                            Inactive Products
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#userVendorPage" aria-expanded="false" aria-controls="navPages">
                <i
                    data-feather="layers"
                    class="nav-icon icon-xs me-2">
                </i> Sellers
                </a>
                <div id="userVendorPage" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link has-arrow"  href="{{ route('allSeller') }}" >
                                Seller List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow"  href="{{ route('allBlockedSeller') }}" >
                                Blocked Seller
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('city') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i> Manage City
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('order') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Manage Order
                </a>
            </li>
<hr>
            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('seller.dashboard') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Seller Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#sellerproductPage" aria-expanded="false" aria-controls="navPages">
                <i
                    data-feather="layers"
                    class="nav-icon icon-xs me-2">
                </i> Products
                </a>
                <div id="sellerproductPage" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('seller.product.create') }}">
                            Add Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow"  href="{{ route('seller.product') }}" >
                            Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow"  href="{{ route('seller.all.inactive.product') }}" >
                            Inactive Products
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('seller.brand') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Brands
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('seller.category') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Category
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('seller.subcategory') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Subcategory
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  active " href="{{ route('seller.order') }}">
                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Order
                </a>
            </li>


        </ul>
    </div>
</nav>

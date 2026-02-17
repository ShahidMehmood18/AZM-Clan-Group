<!-- Header -->
<header class="header shop v2">
    <!-- Topbar -->
    <div class="topbar" style="background: #000; padding: 15px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="top-contact">
                        <ul class="list-main">
                            <li>
                                <i class="ti-headphone-alt"></i>
                                <span>{{ \App\Models\Setting::get('site_phone', '+060 (800) 801-582') }}</span>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <span>{{ \App\Models\Setting::get('site_email', 'support@viraldistributors.com')
                                    }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            @if(\App\Models\Setting::get('logo_type', 'text') == 'image')
                                <img src="{{ asset(\App\Models\Setting::get('logo_image', 'logo.png')) }}" alt="logo">
                            @else
                                <h2>
                                    {!! \App\Models\Setting::get('logo_text', 'AZM<span style="color: #F7941D;"> CLAN</span>') !!}
                                </h2>
                            @endif
                        </a>
                    </div>
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-6 col-12 d-none d-lg-block">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select name="category" form="header-search-form">
                                <option value="" selected="selected">All Category</option>
                                @foreach(\App\Models\Category::where('is_active', true)->get() as $searchCat)
                                    <option value="{{ $searchCat->slug }}" {{ request('category') == $searchCat->slug ? 'selected' : '' }}>{{ $searchCat->name }}</option>
                                @endforeach
                            </select>
                            <form id="header-search-form" action="{{ route('products.all') }}" method="GET">
                                <input name="search" placeholder="Search Products Here....." type="search"
                                    value="{{ request('search') }}">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 d-none d-lg-block">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar pr-2">
                            <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="sinlge-bar pr-2">
                            <a href="{{ route('login') }}" class="single-icon"><i class="fa fa-user-circle-o"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="sinlge-bar shopping">
                            <a href="#" class="single-icon"><i class="ti-bag"></i> <span
                                    class="total-count">0</span></a>
                            <!-- Shopping Item -->
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>0 Items</span>
                                    <a href="#">View Cart</a>
                                </div>
                                <ul class="shopping-list">
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>Total</span>
                                        <span class="total-amount">$0.00</span>
                                    </div>
                                    <a href="#" class="btn animate">Checkout</a>
                                </div>
                            </div>
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a
                                                    href="{{ url('/') }}">Home</a></li>
                                            <li class="{{ request()->is('category*') ? 'active' : '' }}"><a
                                                    href="javascript:void(0)">Browse Categories<i
                                                        class="ti-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    @foreach(\App\Models\Category::where('is_active', true)->get() as $headerCat)
                                                        <li><a
                                                                href="{{ route('products.category', $headerCat->slug) }}">{{ $headerCat->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="{{ request()->is('brand*') ? 'active' : '' }}"><a
                                                    href="javascript:void(0)">All
                                                    Brands<i class="ti-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    @foreach(\App\Models\Brand::where('is_active', true)->whereNotNull('slug')->where('slug', '!=', '')->get() as $headerBrand)
                                                        <li><a
                                                                href="{{ route('products.brand', $headerBrand->slug) }}">{{ $headerBrand->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="{{ request()->is('products') ? 'active' : '' }}"><a
                                                    href="{{ route('products.all') }}">All Products</a></li>
                                            <li class="{{ request()->is('partner-with-us') ? 'active' : '' }}"><a
                                                    href="{{ route('partner') }}">Partner With Us</a></li>

                                            <li class="{{ request()->is('about-us') ? 'active' : '' }}"><a
                                                    href="{{ route('about') }}">About Us</a></li>

                                            <li class="{{ request()->is('contact-us') ? 'active' : '' }}"><a
                                                    href="{{ route('contact') }}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* ===== TOPBAR STYLING ===== */
        .topbar {
            background: #000;
        }

        .topbar .list-main {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
            margin: 0;
            align-items: center;
        }

        .topbar .list-main li {
            display: flex;
            align-items: center;
            padding: 5px 10px;
            margin: 0;
            border: none;
        }

        .topbar .list-main li i {
            color: #F7941D;
            margin-right: 8px;
            font-size: 16px;
            flex-shrink: 0;
        }

        .topbar .list-main li span,
        .topbar .list-main li a {
            color: #F7941D;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
        }

        .topbar .list-main li a:hover {
            color: #fff;
        }

        /* Mobile/Tablet: Center align and stack vertically */
        @media (max-width: 991px) {
            .topbar .list-main {
                justify-content: center;
                gap: 15px;
            }

            .topbar .list-main li {
                flex: 0 0 auto;
                max-width: 100%;
                padding: 5px 10px;
            }

            .topbar .list-main li i {
                font-size: 14px;
                margin-right: 6px;
            }

            .topbar .list-main li span,
            .topbar .list-main li a {
                font-size: 12px;
            }
        }

        /* ===== MIDDLE HEADER STYLING ===== */
        .middle-inner {
            padding: 20px 0;
        }

        .middle-inner .logo {
            margin: 0;
        }

        .middle-inner .logo a {
            display: inline-block;
        }

        .middle-inner .logo h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 28px;
            line-height: 1;
            color: #333;
            margin: 0;
            letter-spacing: -1px;
        }

        .middle-inner .logo img {
            max-height: 50px;
            width: auto;
        }

        /* Search Bar */
        .middle-inner .search-bar-top {
            margin: 0;
        }

        /* Right Bar Icons */
        .middle-inner .right-bar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 25px;
            margin: 0;
            padding: 0;
            position: static !important;
            top: auto !important;
            float: none !important;
        }

        .middle-inner .right-bar .sinlge-bar {
            margin: 0 !important;
            display: inline-block;
        }

        .middle-inner .right-bar .single-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #333;
            transition: all 0.3s ease;
        }

        .middle-inner .right-bar .single-icon:hover {
            color: #F7941D;
        }

        /* ===== MAIN MENU STYLING ===== */
        .header-inner {
            background: #111;
            border: none;
            padding: 0;
        }

        .header-inner .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .header-inner .navbar {
            padding: 0 !important;
        }

        .header-inner .nav-inner {
            margin: 0 !important;
        }

        .main-menu.menu {
            margin: 0;
            padding: 0;
        }

        .main-menu.menu li {
            margin: 0;
            position: relative;
        }

        .main-menu.menu li a {
            color: #fff !important;
            font-weight: 600;
            padding: 18px 20px;
            display: block;
            transition: all 0.3s ease;
            text-decoration: none;
            background: transparent !important;
        }

        .main-menu.menu li a:hover,
        .main-menu.menu li.active a {
            background: #F7941D !important;
            color: #fff !important;
        }

        .main-menu.menu li a i {
            margin-left: 5px;
            font-size: 10px;
            color: inherit;
        }

        /* Force navbar background */
        .header-inner,
        .header-inner .cat-nav-head,
        .header-inner .menu-area,
        .header-inner .navbar,
        .header-inner .navbar-collapse,
        .header-inner .nav-inner {
            background: #111 !important;
        }


        /* Dropdown */
        .main-menu.menu .dropdown {
            background: #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 0 0 8px 8px;
            width: 220px;
        }

        .main-menu.menu .dropdown li a {
            color: #333 !important;
            font-weight: 500;
            font-size: 14px;
            padding: 12px 20px;
        }

        .main-menu.menu .dropdown li a:hover {
            background: #F7941D !important;
            color: #fff !important;
            padding-left: 25px !important;
        }

        /* ===== PREMIUM MOBILE MENU STYLING ===== */
        .slicknav_menu {
            display: none;
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Modern Toggle Button */
        .slicknav_btn {
            background: #F7941D !important;
            border-radius: 6px;
            width: 38px !important;
            height: 38px !important;
            padding: 0 !important;
            display: flex !important;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
            margin: 0 !important;
            float: right !important;
            border: none;
        }

        .slicknav_btn:hover {
            background: #e68a1a !important;
        }

        /* Proper 3-Bar Hamburger Icon */
        .slicknav_icon {
            width: 18px;
            height: 12px;
            display: flex !important;
            flex-direction: column;
            justify-content: space-between;
            margin: 0 !important;
            position: relative;
        }

        .slicknav_icon-bar {
            background-color: #fff !important;
            height: 2px !important;
            width: 100% !important;
            display: block !important;
            border-radius: 2px !important;
            transition: all 0.3s ease;
            margin: 0 !important;
        }

        /* Mobile Nav Dropdown */
        .slicknav_nav {
            background: #111 !important;
            border-radius: 8px;
            margin-top: 15px !important;
            padding: 5px 0 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid #222;
            position: absolute;
            left: 15px;
            right: 15px;
            z-index: 9999;
            list-style: none;
        }

        .slicknav_nav li {
            margin: 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            /* Subtle divider */
        }

        .slicknav_nav li:last-child {
            border-bottom: none !important;
        }

        .slicknav_nav li a {
            color: #eee !important;
            font-weight: 500 !important;
            font-size: 15px !important;
            padding: 14px 20px !important;
            /* Added space */
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .slicknav_nav li a:hover {
            background: #222 !important;
            color: #F7941D !important;
            padding-left: 25px !important;
        }

        /* Arrow Styling */
        .slicknav_arrow {
            font-size: 12px !important;
            color: #F7941D !important;
        }

        /* Media Queries for Mobile Alignment */
        @media (max-width: 991px) {
            .middle-inner {
                padding: 15px 0 !important;
                background: #000 !important;
                /* Matches topbar as seen in screenshot */
            }

            .middle-inner .container {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            /* The core fix: Align logo and toggle in one row */
            .middle-inner .row {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                flex-wrap: nowrap !important;
            }

            /* Make the logo container and mobile-nav sit on the same line */
            .middle-inner .col-lg-2.col-md-3.col-12 {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                justify-content: space-between !important;
                width: 100% !important;
                max-width: 100% !important;
                flex: 0 0 100% !important;
                padding: 0 15px !important;
            }

            .middle-inner .logo {
                margin: 0 !important;
                flex: 0 0 auto !important;
            }

            .middle-inner .logo h2 {
                font-size: 22px !important;
                color: #fff !important;
                margin: 0 !important;
            }

            .mobile-nav {
                display: block !important;
                flex: 0 0 auto !important;
                margin: 0 !important;
                width: auto !important;
            }

            .slicknav_menu {
                display: block !important;
            }

            /* Hide Desktop Nav Bar */
            .header-inner {
                display: none !important;
            }
        }
    </style>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->
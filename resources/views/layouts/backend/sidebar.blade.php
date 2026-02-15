<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <span class="logo logo-lg fw-bold fs-4 text-primary text-uppercase">
                    {!! \App\Models\Setting::get('logo_text', 'AZM<span style="color: #F7941D;"> CLAN</span>') !!}</span>
                <span class="logo logo-sm fw-bold fs-4 text-primary text-uppercase">
                    {!! \App\Models\Setting::get('logo_text', 'AZM<span style="color: #F7941D;"> CLAN</span>') !!}</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar">
                {{-- <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li> --}}
                <li class="nxl-item">
                    <a href="{{ route('dashboard') }}"
                        class="nxl-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="nxl-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-grid"></i></span>
                        <span class="nxl-mtext">Categories</span>
                    </a>
                </li>
                <li class="nxl-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brands.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-tag"></i></span>
                        <span class="nxl-mtext">Brands</span>
                    </a>
                </li>
                <li
                    class="nxl-item {{ request()->routeIs('admin.products.*') && !request()->routeIs('admin.products.import*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-box"></i></span>
                        <span class="nxl-mtext">Products</span>
                    </a>
                </li>
                <li
                    class="nxl-item nxl-hasmenu {{ request()->routeIs('admin.inquiries.*') ? 'active nxl-trigger' : '' }}">
                    <a href="javascript:void(0);"
                        class="nxl-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                        <span class="nxl-micon"><i class="feather-message-square"></i></span>
                        <span class="nxl-mtext">Inquiries</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a
                                class="nxl-link {{ request()->routeIs('admin.inquiries.index') || request()->routeIs('admin.inquiries.show') ? 'active' : '' }}"
                                href="{{ route('admin.inquiries.index') }}">Product Inquiries</a></li>
                        <li class="nxl-item"><a
                                class="nxl-link {{ request()->routeIs('admin.inquiries.contact.*') ? 'active' : '' }}"
                                href="{{ route('admin.inquiries.contact.index') }}">Contact Us</a></li>
                    </ul>
                </li>
                <li class="nxl-item {{ request()->routeIs('admin.homepage-sections.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.homepage-sections.index') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-home"></i></span>
                        <span class="nxl-mtext">Homepage Management</span>
                    </a>
                </li>
                <li
                    class="nxl-item nxl-hasmenu {{ request()->routeIs('admin.products.import*') ? 'active nxl-trigger' : '' }}">
                    <a href="javascript:void(0);"
                        class="nxl-link {{ request()->routeIs('admin.products.import*') ? 'active' : '' }}">
                        <span class="nxl-micon"><i class="feather-upload-cloud"></i></span>
                        <span class="nxl-mtext"> Import Products</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a
                                class="nxl-link {{ route('admin.products.import') == url()->current() ? 'active' : '' }}"
                                href="{{ route('admin.products.import') }}">Import
                                Products</a></li>
                        <li class="nxl-item"><a
                                class="nxl-link {{ route('admin.products.import.template') == url()->current() ? 'active' : '' }}"
                                href="{{ route('admin.products.import.template') }}">Download Template</a></li>
                    </ul>
                </li>
                <li
                    class="nxl-item nxl-hasmenu {{ request()->routeIs('profile.*') || request()->routeIs('admin.settings.*') ? 'active nxl-trigger' : '' }}">
                    <a href="javascript:void(0);"
                        class="nxl-link {{ request()->routeIs('profile.*') || request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <span class="nxl-micon"><i class="feather-settings"></i></span>
                        <span class="nxl-mtext">Settings</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                                href="{{ route('profile.edit') }}">My Profile</a></li>
                        <li class="nxl-item"><a
                                class="nxl-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}"
                                href="{{ route('admin.settings.general') }}">General
                                Settings</a></li>
                        <li class="nxl-item"><a
                                class="nxl-link {{ request()->routeIs('admin.settings.seo') ? 'active' : '' }}"
                                href="{{ route('admin.settings.seo') }}">SEO</a></li>
                    </ul>
                </li>
                <li class="nxl-item">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="#" class="nxl-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="nxl-micon"><i class="feather-log-out"></i></span>
                            <span class="nxl-mtext">Log Out</span>
                        </a>
                    </form>
                </li>
            </ul>

        </div>
    </div>
</nav>
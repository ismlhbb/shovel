<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; Shovel</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('stisla/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    @yield('csslibraries')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/custom.css') }}">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-94034622-3');
    </script>
    <script type="text/javascript">
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js') + (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? ' svg' : ' no-svg');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                                <i class="fas fa-bars"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
                                <i class="fas fa-search"></i>
                            </a>
                        </li>
                    </ul>

                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            {{-- <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> --}}
                            @if(\Auth::user())
                            <div class="d-sm-none d-lg-inline-block">
                                Hi, {{Auth::user()->name}}
                            </div>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- <div class="dropdown-title">Logged in 5 min ago</div> --}}
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            {{-- Logout --}}
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                            {{-- !Logout --}}
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('home') }}">Shovel</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('home') }}">svl</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ request()->is('home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-fire"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        {{-- Master Data --}}
                        <li class="menu-header">Master Data</li>
                        {{-- Management Users --}}
                        <li class="dropdown {{ request()->routeIs('users*') ? 'active' : '' }}">
                            <a class="nav-link has-dropdown" href="#">
                                <i class="far fa-user"></i>
                                <span>Manage Users</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('users.index') }}">List Users</a>
                                </li>
                                <li class="{{ request()->routeIs('users.create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('users.create') }}">Create New User</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Management Categories --}}
                        <li class="dropdown {{ request()->routeIs('categories*') ? 'active' : '' }}">
                            <a class="nav-link has-dropdown" href="#">
                                <i class="fas fa-tags"></i>
                                <span>Manage Categories</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('categories.index') }}">
                                        List Categories
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('categories.create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('categories.create') }}">
                                        Create New Category
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('categories.trash') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('categories.trash') }}">
                                        All Trashed Categories
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Management books --}}
                        <li class="dropdown {{ request()->routeIs('books*') ? 'active' : '' }}">
                            <a class="nav-link has-dropdown" href="#">
                                <i class="fas fa-book"></i>
                                <span>Manage Books</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="{{ request()->routeIs('books.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('books.index') }}">
                                        List All Books
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('books.create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('books.create') }}">
                                        Create New Book
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('books.trash') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('books.trash') }}">
                                        All Trashed Books
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Management Orders --}}
                        <li class="dropdown {{ request()->routeIs('orders*') ? 'active' : '' }}">
                            <a class="nav-link has-dropdown" href="#">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Manage Orders</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="{{ request()->routeIs('orders.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('orders.index') }}">List Orders</a>
                                </li>
                            </ul>
                        </li>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield("pageTitle")</h1>
                    </div>
                    <div class="section-body">
                        @yield("content")
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                </div>
                <div class="footer-right">
                    Copyright &copy; 2020 <div class="bullet"></div> Built By
                    <a href="https://ismailhabibi.netlify.app/">Ismail Habibi Herman</a>
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('stisla/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('stisla/modules/popper.js') }}"></script>
    <script src="{{ asset('stisla/modules/tooltip.js') }}"></script>
    <script src="{{ asset('stisla/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('stisla/modules/moment.min.js') }}"></script>
    <script src="{{ asset('stisla/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    @yield('jslibraries')

    <!-- Page Specific JS File -->
    @yield('jspage')

    <!-- Template JS File -->
    <script src="{{ asset('stisla/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/js/custom.js') }}"></script>
</body>

</html>
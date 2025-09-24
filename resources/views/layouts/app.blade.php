<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') Stock Mgt System</title>

    <!-- Fonts & Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header d-flex justify-content-between">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo">
                        </a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block">
                            <i class="bi bi-x bi-middle"></i>
                        </a>
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="{{ url('/home') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i><span>Dashboard</span>
                            </a>
                        </li>

                        <!-- Stock -->
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-bag"></i><span>Purchases</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item"><a href="{{ route('purchases.create') }}">Add Purchase</a></li>
                                <li class="submenu-item"><a href="{{ route('purchases.index') }}">View Purchase</a></li>
                            </ul>
                        </li>

                        <!-- Sales -->
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                              <i class="bi bi-person-lines-fill"></i><span>Supplier</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item"><a href="{{ route('suppliers.create') }}">Make Supplier</a></li>
                                <li class="submenu-item"><a href="{{ route('suppliers.index') }}">View Supplier</a></li>
                            </ul>
                        </li>

                        <!-- Expenses -->
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-diagram-2"></i><span>Product</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item"><a href="{{ route('products.create') }}">Add Product</a></li>
                                <li class="submenu-item"><a href="{{ route('products.index') }}">View Product</a></li>
                            </ul>
                        </li>


                         <!-- Sales -->
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                   <i class="bi bi-cart-check"></i><span>Sales</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item"><a href="{{ route('sales.create') }}">Add Sales</a></li>
                                <li class="submenu-item"><a href="{{ route('sales.index') }}">View Sales</a></li>
                            </ul>
                        </li>

                         <!-- Expenses -->
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-arrow-left-square"></i><span>Expenses</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item"><a href="{{ route('expenses.create') }}">Add Expenses</a></li>
                                <li class="submenu-item"><a href="{{ route('expenses.index') }}">View Expenses</a></li>
                            </ul>
                        </li>

                        <!-- Reports -->
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-card-checklist"></i><span>Reports</span>
                            </a>
                            <ul class="submenu">
                            <li class="submenu-item"><a href="{{ route('reports.daily') }}">Daily</a></li>
                            <li class="submenu-item"><a href="{{ route('reports.weekly') }}">Weekly</a></li>
                            <li class="submenu-item"><a href="{{ route('reports.monthly') }}">Monthly</a></li>
                            {{-- <li class="submenu-item"><a href="{{ route('reports.create') }}">Annual</a></li> --}}
                            </ul>
                        </li>

                        <!-- Settings -->
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-gear-fill"></i><span>Settings</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item"><a href="#">Add User</a></li>
                                <li class="submenu-item"><a href="#">Edit User</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div id="main">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ms-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                       Welcome {{ Auth::user()->name }} <br>({{ Auth::user()->email }})
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Content Section -->
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

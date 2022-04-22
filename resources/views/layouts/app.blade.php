<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script src="{{ asset('/') }}assets/modules/jquery.min.js"></script>

    {{-- toastr --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
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
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('/') }}assets/img/avatar/avatar-1.png"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->username }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/">Stisla</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/">St</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class={{ request()->routeIs('home') ? 'active' : '' }}><a class="nav-link"
                                href="{{ route('home') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
                        </li>


                        @if (Auth::user()->role != 'pelanggan')
                            <li class="menu-header">Master Data</li>
                            <li class="dropdown @if (request()->routeIs('users.index') || request()->routeIs('aktifitas') || request()->routeIs('menus.index') || request()->routeIs('transaksis.index') || request()->routeIs('laporan')) active @endif">
                                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                        class="fas fa-columns"></i> <span>Master Data</span></a>
                                <ul class="dropdown-menu">
                                    @if (Auth::user()->role == 'admin')
                                        <li><a class="nav-link" href="{{ route('users.index') }}">Data pengguna</a>
                                        </li>

                                        <li><a class="nav-link" href="{{ route('menus.index') }}">Data menu</a>
                                        </li>
                                        <li><a class="nav-link" href="{{ route('laporan') }}">Laporan transaksi</a>
                                        </li>
                                    @elseif(Auth::user()->role == 'kasir')
                                        <li><a class="nav-link" href="{{ route('transaksis.index') }}">Data transaksi</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @else
                            <li class="menu-header">Pesanan</li>
                            <li><a class="nav-link" href="{{ route('pesanan.index') }}"><i
                                    class="fas fa-sign-out-alt"></i> <span>Pesanan</span></a></li>
                        @endif
                        

                        <li class="menu-header">Logout</li>
                        <li><a class="nav-link" href="{{ route('logout') }}"><i
                                    class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a
                        href="https://nauval.in/">Muhamad Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('/') }}assets/modules/popper.js"></script>
    <script src="{{ asset('/') }}assets/modules/tooltip.js"></script>
    <script src="{{ asset('/') }}assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('/') }}assets/modules/moment.min.js"></script>
    <script src="{{ asset('/') }}assets/js/stisla.js"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('/') }}assets/js/scripts.js"></script>
    <script src="{{ asset('/') }}assets/js/custom.js"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @elseif(Session::has('error'))
            toastr.error("{{ Session::get('error') }}")
        @elseif(Session::has('info'))
            toastr.info("{{ Session::get('info') }}")
        @endif
    </script>
    @yield('script')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('template/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('template/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('template/admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('template/admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ url('template/admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ url('template/admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ url('template/admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <!-- Template Main CSS File -->
    <link href="{{ url('template/admin/assets/css/style.css') }}" rel="stylesheet">
    @yield('css')

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Hardianto Shop's</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        {{-- <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar --> --}}

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('dologout') }}">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>Keluar</span>
                    </a>
                </li>
            </ul>
        </nav>

    </header><!-- End Header -->

    @include('layouts.management.sidebar')

    <main id="main" class="main">

        @yield('content')

    </main>

    <!-- ======= Footer ======= -->
    {{-- <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer --> --}}

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('template/admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('template/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('template/admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ url('template/admin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ url('template/admin/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ url('template/admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ url('template/admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('template/admin/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <!-- Template Main JS File -->
    <script src="{{ url('template/admin/assets/js/main.js') }}"></script>
    @yield('js')

</body>

</html>

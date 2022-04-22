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
    <link rel="stylesheet" href="{{ asset('/') }}assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script src="{{ asset('/') }}assets/modules/jquery.min.js"></script>

    {{-- toastr --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
    @yield('content')

    <!-- General JS Scripts -->
    <script src="{{ asset('/') }}assets/modules/popper.js"></script>
    <script src="{{ asset('/') }}assets/modules/tooltip.js"></script>
    <script src="{{ asset('/') }}assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('/') }}assets/modules/moment.min.js"></script>
    <script src="{{ asset('/') }}assets/js/stisla.js"></script>
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('/') }}assets/js/scripts.js"></script>
    <script src="{{ asset('/') }}assets/js/custom.js"></script>

    <script>
        @if(Session::has('success'))
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

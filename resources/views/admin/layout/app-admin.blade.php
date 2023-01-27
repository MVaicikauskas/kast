<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="/favicon.ico">
    <title>Klaipėda aš su Tavim valdymo įrankis</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('dist/dashboard/css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        
    @yield('styles')

    <!-- Custom CSS -->
    <link href="{{ asset('dist/dashboard/css/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/dashboard/css/style.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('dist/css/admin.css') }}" rel="stylesheet">-->
    <link href="{{ asset('dist/css/admin.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body class="fix-header fix-sidebar">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <div id="main-wrapper">

        @guest
          @yield('auth')
        @else
          @include('admin.layout.partials.sidebar')
          <div class="page-wrapper">
            @yield('content')
          </div>
        @endguest
    </div>

    <script src="{{ asset('dist/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('dist/dashboard/js/lib/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('dist/dashboard/js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/dashboard/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('dist/dashboard/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/dashboard/js/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

    @yield('scripts')

    <script src="{{ asset('dist/dashboard/js/scripts.js') }}"></script>
    <script src="{{ asset('dist/dashboard/js/custom.min.js') }}"></script>

    <script src="{{ asset('dist/ckeditor/ckeditor.js') }}" defer></script>
</body>
</html>
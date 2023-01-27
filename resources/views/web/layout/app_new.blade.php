<!DOCTYPE html>
<html lang="lt">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="referer" content="origin">

    <link rel="icon" type="image/ico" sizes="48x48" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    {{--SEO: meta --}}
    @yield('title')
    @yield('meta')

    <link rel="canonical" href="@yield('seo_canonical', url()->current())">
    <meta name="keywords" content="renginiai, naujienos, bureliai, uzsiemimai, pramogos, klaipeda">

    {{--SEO: robots --}}
    <meta name="robots" content="index, follow">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    {{--SEO: og data --}}
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Klaipeda aš su Tavim">
    <meta property="fb:app_id" content="431887467190993"/>
    <meta property="fb:pages" content="431887467190993"/>
    <meta property="og:title"
          content="@yield('facebook_share_title', 'Klaipėda, aš su tavim - sparčiausiai vakarų Lietuvoje auganti socialinių tinklų ir portalo grupė')"/>
    <meta property="og:url" content="@yield('facebook_share_url', url()->current())">
    <meta property="og:image" content="@yield('facebook_share_image', asset('facebook_dalintis.jpg'))">
    <meta property="og:description"
          content="@yield('facebook_share_description', 'Tai, kas svarbiausia: karščiausios naujienos, vakarų Lietuvos renginiai, Klaipėdos krašto aktualijos, būreliai, pramogos')"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>

    {{--CSS libs --}}
    {{--Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    {{--FontAwesome --}}
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    {{--Owl Carousel --}}
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    {{--magnific --}}
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    {{--Template styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ config('app.version') }}">
    {{--HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. --}}
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->

    {{--Custom styles from other blades --}}
  <style>
    .nav-item.add-event a {
        color: var(--color-dark-green);
    }
    @media (max-width: 575px) {
        .nav-item.add-event a {
            color: var(--color-orange);
        }
    }
    @stack('styles')
  </style>
</head>

<body>
    {{--Analytics, ads: scripts noscript --}}
    @include('web.layout.partials.analytics-noscript')

    {{-- Trending, Header, Menu --}}
    @include('web.layout.header_new')

    {{-- Main content of page --}}
    @yield('content')

    <div class="gap-50"></div>

    {{--Footer start --}}
    @include('web.layout.footer_new')
    {{--Footer End-->

    {{--Analytics, ads: scripts --}}
    @include('web.layout.partials.analytics')

    {{--Javascript Files --}}
    {{--initialize jQuery Library --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    {{--Popper Jquery --}}
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    {{--Bootstrap jQuery --}}
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    {{--magnific-popup --}}
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    {{--Owl Carousel --}}
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    {{--Template custom --}}
    <script src="{{ asset('assets/js/custom.js') }}?v={{ config('app.version') }}"></script>
    {{-- Custom js from blades --}}
    @yield('scripts')
</body>
</html>
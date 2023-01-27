<!DOCTYPE html>
<html lang="lt">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="referer" content="origin">

    @yield('title')
    @yield('meta')

    <link rel="canonical" href="@yield('seo_canonical', url()->current())">
    <meta name="keywords" content="renginiai, naujienos, bureliai, uzsiemimai, pramogos, klaipeda">

    <meta name="robots" content="index, follow">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <link rel="icon" type="image/ico" sizes="48x48" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Klaipeda aš su Tavim">
    <meta property="fb:app_id" content="431887467190993"/>
    <meta property="fb:pages" content="431887467190993" />
    <meta property="og:title" content="@yield('facebook_share_title', 'Klaipėda, aš su tavim - sparčiausiai vakarų Lietuvoje auganti socialinių tinklų ir portalo grupė')"/>
    <meta property="og:url" content="@yield('facebook_share_url', url()->current())">
    <meta property="og:image" content="@yield('facebook_share_image', asset('facebook_dalintis.jpg'))">
    <meta property="og:description" content="@yield('facebook_share_description', 'Tai, kas svarbiausia: karščiausios naujienos, vakarų Lietuvos renginiai, Klaipėdos krašto aktualijos, būreliai, pramogos')"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- CSS libs -->
    @yield('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/owl.theme.default.min.css') }}">

    <!-- CSS fancybox -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/jquery.fancybox.min.css') }}">

    <!-- MAIN CSS file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/main.css') }}?v=3.19.1">
    <style>
        /*Homepage*/
        .inner .hero-block {
            min-height: 354px;
        }
        section.posts-section {
            margin-top: 0;
            position: relative;
            background-color: #0b3134;
        }

        .posts-section .posts .post-container {
            position: relative;
        }
        .posts-section .posts .post-container .post-details {
            position: absolute;
            bottom: 0;
            background-color: #ffffffe6;
            padding: 0 10px 10px;
            width: 100%;
        }
        .posts-section .posts .post-container .post-details .middle-row .title {
            margin-bottom: 0;
        }
        .posts-section .posts .post-container .post-details .bottom-row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            color: #594f4f;
            letter-spacing: 2px;
            text-decoration: none;
            -webkit-transition: ease-out 0.4s;
            transition: ease-out 0.4s;
        }
        .posts-section .posts .post-container .post-details .post-category {
            color: #594f4f;
            font-size: 0.7rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
        }

        .posts-section .events-calendar__container {
            width: auto;
            float: none;
            max-width: 400px;
            position: absolute;
            right: 10%;
            margin: 0;
            top: -1.5em;
        }
        .posts-section .section-title h2, section .section-title h2 {
            color: white;
            font-weight: 700;
            line-height: 1.2rem;
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 20px;
        }
        section .section-title h2 {
            color: #594f4f;
        }
        .landing-gallery .section-title h2 {
            margin: 0 10px;
            text-align: center;
            line-height: 1.3;
        }
        .ad-list .item.add-event {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #3e9b96;
        }
        .ad-list .item.add-event a {
            width: auto;
            height: auto;
            color: #fff;
            font-size: 1.5em;
            text-align: center;
        }
        .partners > .controls {
            bottom: -30px;
        }
        .gallery .video_watermark {
            height: 100%;
            width: 100%;
            max-width: 150px;
            background-size: 100%;
            background-repeat: no-repeat;
            background-position: center;
        }
        .gallery .grid__item:hover .item__details {
            top: 70%;
        }
        /*Category*/
        .catsCollapse {
            background-color: #45ada8;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }
        .catsCollapse:hover {
            background-color: #3e9b96;
        }
        .catsCollapse:after {
            content: '\002B';
            color: white;
            font-weight: bold;
            float: right;
            margin-left: 5px;
        }
        .catsCollapse.active:after {
            content: "\2212";
        }
        .subCats {
            padding: 0 18px;
            font-size: 14px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            background-color: #45ada8;
        }
        .subCats li{
            text-align: center;
            margin-bottom: 5px;
            margin-top: 5px;
            padding: 5px;
        }
        .subCats li:hover,
        .subCats li.active {
            background-color: #3e9b96;
            font-weight: bold;
        }
        .subCats li a{
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
        }
        .posts-block .posts-list .post .post__details .middle-row .title a {
            overflow: inherit!important;
        }
        /*Single post*/
        .inner-page .info-container a:first-child {
            margin-bottom: 0;
        }
        .similar-events-container h5 {
            color: #45ada8;
            padding-bottom: 10px;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .posts_page .similar-events .s-item h3 {
            color: #594f4f;
            font-weight: bold;
            text-align: center;
            position: absolute;
            width: 100%;
            bottom: 0;
            left: 0;
            margin: 0;
            padding: 0;
            padding-right: 5px;
            padding-left: 5px;
            font-size: 12px;
            height: 35%;
            background-color: transparent;
            line-height: 15px;
            overflow: hidden;
            text-transform: capitalize;
        }

        /*Responsive*/
        @media (max-width: 768px) {
            .hero-block {
                display: none!important;
            }
            .hideTo768 {
                display: none!important;
            }
            /*Single post*/
            .posts_page .inner-page {
                padding: 0 10px;
            }
            .page section.no-m-t.posts_page {
                margin-top: 10px!important;
            }
        }
        @media (min-width: 768px) {
            .gallery .grid {
                display: grid;
                grid-template-rows: repeat(1, 350px);
            }
            .hideFrom768 {
                display: none!important;
            }
            .catsCollapse {
                display: none;
            }
            .subCats {
                max-height: initial;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-direction: normal;
                -webkit-box-orient: horizontal;
                -moz-box-direction: normal;
                -moz-box-orient: horizontal;
                flex-direction: row;
                -webkit-flex-wrap: wrap;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                -webkit-justify-content: center;
                -webkit-box-pack: center;
                -moz-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
            }
            .subCats li{
                padding: 5px 15px;
            }
            .posts-section .section-title h2, section .section-title h2 {
                line-height: 1.5rem;
                font-size: 1.8rem;
            }
            section .section-title h2 {
                text-align: left;
            }
        }
        @media (max-width: 992px) {
            .events-calendar__container {
                display: none;
            }
            section .section-title {
                margin-top: 25px;
            }
        }
        @media (min-width: 992px) {
            .events__calendar .title {
                color: #fff;
                font-weight: 600;
                text-transform: uppercase;
                line-height: 18px;
                font-size: 16px;
                letter-spacing: 1px;
                padding: 5px 20px;
            }
        }
        @media (min-width: 1024px) {
            #st-1 .st-btn[data-network='messenger'], #st-1 .st-btn[data-network='sms'] {
                display: none!important;
            }
        }
        @media (max-width: 1200px) {
            .ad-list .item.add-event {
                display: none;
            }
        }
    </style>
    <!-- Cookies juosta -->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css"/>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- follow us buttons -->
    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5da9bfc74634070014dce34b&product=inline-share-buttons"
            async="async"></script>

    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script>
        window.addEventListener("load", function () {
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#1d8a8a"
                    },
                    "button": {
                        "background": "#62ffaa"
                    }
                },
                "theme": "edgeless",
                "position": "bottom-right",
                "content": {
                    "message": "Svetainėje naudojami slapukai (angl. cookies), kurie padeda užtikrinti Jums teikiamų paslaugų kokybę. Paspaudę \"Sutinku\" , patvirtinsite savo sutikimą. Bet kada galėsite atšaukti savo pasirinkimą, pakeisdami interneto naršyklės nustatymus ir ištrindami įrašytus slapukus.",
                    "dismiss": "SUTINKU",
                    "link": "Privatumo politika",
                    // pakoreguoti privatumo link'ą
                    "href": "/privatumo-politika"
                }
            })
        });
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C1SCJ0PXHY"></script>
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5LR9RM2');</script>
    <script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "ca-pub-8503410126696629",
			enable_page_level_ads: true
		});

        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-C1SCJ0PXHY');
    </script>
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '755509754889319');
        fbq('track', 'PageView');
    </script>
    @if(!auth()->check())
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:2363847,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    @endif
</head>

<body class="{{ Request::is('/') ? 'landing-page' : 'inner' }}">
<noscript>
    <img height="1" width="1" src="https://www.facebook.com/tr?id=755509754889319&ev=PageView&noscript=1" alt="Facebook kodas"/>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5LR9RM2" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>

{{-- Main application --}}
<div class="page">

    {{-- Header --}}
    @include('web.layout.header')
    @include('web.layout.partials.hero')

    @yield('content')

    {{-- Footer --}}
    @include('web.layout.footer')
</div>

<!-- FB share button -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/lt_LT/sdk.js#xfbml=1&version=v3.3"></script>

<!-- JS fancybox-->
<script src="{{ asset('dist/js/jquery.fancybox.min.js') }}" async></script>
</body>

</html>
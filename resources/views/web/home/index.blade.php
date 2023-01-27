@extends('web.layout.app')

@section('title')
    <title>Naujienos iš Klaipėdos ir Lietuvos, renginiai, įvykiai, būreliai</title>
@endsection

@section('meta')
    <meta name="description"
          content="Karščiausios naujienos iš Klaipėdos ir Lietuvos, miestiečių nuomonės, Klaipėdos krašto renginiai, aktualijos, būreliai, pramogos. Tik tai, kas svarbiausia, nes mes vertiname tavo laiką!">
    <script type="application/ld+json">
    {
      "@context" : "http://schema.org",
      "@type" : "WebSite",
      "name" : "Klaipėda, aš su tavim",
      "alternateName" : "Naujienos iš Klaipėdos ir Lietuvos, renginiai, įvykiai, būreliai",
      "url":"https://klaipedaassutavim.lt/",
      "image":"https://klaipedaassutavim.lt/dist/images/web/default_logo.png"
    }
    </script>
@endsection

@section('content')
        @include('web.home.sections.news')
        @include('web.home.sections.events')
        @include('web.home.sections.courses')
        @include('web.home.sections.partners')
        @include('web.home.sections.gallery')
@endsection

@section('scripts')
    <script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
        var events = [];

        @foreach($full_events as $e)
        events.push({
            date: '{{ $e->date }}',
            title: '{{ $e->title }}',
            url: '{{ URL("/renginiai/" . $e->slug) }}'
        });
        @endforeach

        $('#clndr').clndr({
            template: $('#full-clndr-template').html(),
            weekOffset: 1,
            daysOfTheWeek: ['S', 'P', 'A', 'T', 'K', 'P', 'Š'],
            numberOfRows: 5,
            events: events,
            clickEvents: {
                click: function (target) {
                    if (target.events.length) {
                        const url = "{{ route('events.page') }}"
                        window.location.href = url + "?date=" + target.date.format('YYYY-MM-DD') + ""
                    }
                }
            },
        });
    </script>
    <script>
        $('#eventsContainer').on('click', function (e) {
            const calendarContainer = $('#calendarContainer');
            calendarContainer.toggleClass('active');
        })
    </script>
    <script>
        $(window).scroll(function () {
            var hT = $('#scroll-to').offset().top,
                hH = $('#scroll-to').outerHeight(),
                wH = $(window).height(),
                wS = $(this).scrollTop();
            if (wS > (hT + hH - wH)) {
                $('.events-calendar__container').addClass('not_visible');
            } else {
                $('.events-calendar__container').removeClass('not_visible');
            }
            /*if (wS > (hT+hH-wH) && (hT > wS) && (wS+wH > hT+hH)){

            }*/
        });
    </script>
    <script>
        var owl = $('#owl_carousel');
        owl.owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 2500,
            lazyLoad: true,
            autoplayHoverPause: true,
            dots: false,
            responsive : {
                0 : {
                    items: 1,
                },
                480 : {
                    items: 2,
                },
                600 : {
                    items: 3,
                },
                768 : {
                    items: 4,
                },
                992 : {
                    items: 5,
                },
                1200 : {
                    items: 6,
                }
            }
        });

    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endsection
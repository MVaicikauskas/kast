@extends('web.layout.app_new')

@section('title')
    <title>Renginiai Klaipėdoje | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
    <meta name="description"
          content="Laikas - pinigai! Greitai ir lengvai rask viską ką veikti Klaipėdoje ir aplink ją vienoje vietoje! TOP renginiai, nemokami, vakarėliai, koncertai, šeimai, sporto varžybos, spektakliai, kinas. Renginių kalendoriuje rasi renginius pagal datą. Sužinok kas vyksta šiandien, rytoj, savaitgalį, ar kas mėnesį.">
@endsection


@section('content')
    @include('web.posts.partials.breadcrumb_new')

    <section class="main-content category-layout-2">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="block-title">
                                <span class="title-angle-shap">
                                    @if( isset($heading) && $heading != 'Renginiai' )
                                        Renginiai: {{ $heading }}
                                    @else
                                        Renginiai
                                    @endif
                                </span>
                            </h1>
                            @include('web.events.partials.filter-bar_new')
                        </div>
                    </div>
                    <div class="events-list">
                        @include('web.events.partials.events-list_new')
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        @include('web.layout.widgets.socials')

                        <div class="sidebar-widget">
                            @include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE_EVENTS'])
                        </div>

                        @include('web.layout.widgets.news_sidebar')

                        @include('web.layout.widgets.tag_sidebar')
                    </div>
                </div><!-- sidebar col end -->
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('dist/js/underscore.js') }}"></script>
    <script src="{{ asset('dist/js/moment.js') }}"></script>
    <script src="{{ asset('dist/js/clndr.min.js') }}"></script>
    <script type="text/javascript">
        moment.locale('lt');
        moment.updateLocale('lt', {
            months : [
                "Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
                "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"
            ]
        });

        var events = {!! $unlimited_events !!};
        var coll = document.getElementsByClassName("catsCollapse");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight){
                    content.style.maxHeight = null;
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                    content.style.maxHeight = (content.scrollHeight + 10) + "px";
                }
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        (function($){
            //filtering
            //close dropdown
            $(document).mouseup(function(e){
                var container = $(".filterDropdown");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.fadeOut(100);
                }
            });

            //open dropdown
            $('.filterLabel').click(function () {
                $(this).next('.filterDropdown').toggle();
            });

            //filter by select
            $('.filter a').click(function (e) {
                e.preventDefault()

                const filterText = $(this).text()
                const filterSlug = $(this).data('filter')
                const filterType = $(this).data('type')

                const filterElem = $(this).closest('.filter')
                const labelValue = filterElem.find('.label-value')

                filterElem.find('label').addClass('active')
                labelValue.text(filterText)

                // set selected type value
                $("#" + filterType + "").val(filterSlug)

                triggerAjaxRequest()
            });

            //filter by date
            $('#dateFilter').click(function (e) {
                e.preventDefault()
                const labelValue = $(this).find('.label-value');

                $('#clndr').clndr({
                    template: $('#full-clndr-template').html(),
                    weekOffset: 1,
                    daysOfTheWeek: ['S', 'P', 'A', 'T', 'K', 'P', 'Š'],
                    numberOfRows: 5,
                    events: events,
                    trackSelectedDate: true,
                    clickEvents: {
                        click: function (target) {
                            const date = target.date.format('YYYY-MM-DD')
                            $('#data').val(date)
                            labelValue.text(date)
                            triggerAjaxRequest();
                        }
                    }
                });
            })

            //remove date filter
            $('#removeDate').click(function (e) {
                e.preventDefault()

                if($('#data').val() === 0) {
                    $('.filterDropdown').hide();
                }else {
                    $('#data').val(0);
                    $('#dateFilter .label-value').text('Visi');

                    triggerAjaxRequest();
                }
            })

            function triggerAjaxRequest() {
                const search_url = '{{ route('events.page') }}';
                //reset pagination if url
                let url = new URL(window.location.href);
                url.searchParams.delete('page');
                window.history.pushState("", "", url.href);

                if($('#data').val() === 0) { $('#data').val(null) }

                    $.ajax({
                    url: search_url,
                    type: 'GET',
                    data: {
                        region: $('#regionas').val(),
                        category: $('#kategorija').val(),
                        price: $('#kaina').val(),
                        date: $('#data').val(),
                        name: $('#raktazodis').val()
                    },
                    success: function (data) {
                        $('.events-list').hide().html(data).fadeIn();
                    }
                }).done(function (){
                    $('.filterDropdown').hide();
                })
            }

            //Ajax pagination
            $('body').on('click', '.ts-pagination a, .pagination a', function (e) {
                e.preventDefault();

                let results = $('.events-list');
                let url = $(this).attr('href');

                results.html();

                $.ajax({
                    url : url
                }).done(function (data) {
                    results.html(data);
                    $('html, body').stop().animate({
                        'scrollTop': (results.offset().top - 175)
                    }, 150);
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.error('Events could not be loaded.', errorThrown);
                });

                window.history.pushState("", "", url);
            });
        })(jQuery);
    </script>
@endsection
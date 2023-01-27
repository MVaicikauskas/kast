@extends('web.layout.app_new')

@section('title') 
  <title>Būreliai | Klaipėda aš su Tavim!</title>
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
                                    Būreliai {{ $heading }}
                                </span>
                            </h1>
                            @include('web.activities.partials.filter-bar_new')
                        </div><!-- col end -->
                    </div><!-- row end -->
                    <div class="activities-list">
                        @include('web.activities.partials.list_new')
                    </div>
                </div><!-- col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        @include('web.layout.widgets.socials')

                        <div class="sidebar-widget">
                            @include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE_ACTIVITIES'])
                        </div>

                        @include('web.layout.widgets.news_sidebar')

                        @include('web.layout.widgets.tag_sidebar')
                    </div>
                </div><!-- sidebar col end -->
            </div><!-- row end -->
        </div><!-- container end -->
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        (function($){
            //filtering
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

            function triggerAjaxRequest() {
                const search_url = '{{ $activity_route }}';

                //reset pagination
                let url = new URL(window.location.href);
                url.searchParams.delete('page');
                window.history.pushState("", "", url.href);

                $.ajax({
                    url: search_url,
                    type: 'GET',
                    data: {
                        region: $('#regionas').val(),
                        category: $('#kategorija').val(),
                        subcategory: $('#subkategorija').val(),
                        name: $('#raktazodis').val()
                    },
                    success: function (data) {
                        $('.activities-list').hide().html(data).fadeIn();
                    }
                }).done(function (){
                    $('.filterDropdown').hide();
                })
            }

            //Ajax pagination
            $('body').on('click', '.ts-pagination a, .pagination a', function (e) {
                e.preventDefault();

                let results = $('.activities-list');
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
                    console.error('Activities could not be loaded.', errorThrown);
                });

                window.history.pushState("", "", url);
            });
        })(jQuery);
    </script>
@endsection
@extends('web.layout.app_new')

@section('title')
    @if( isset($heading) )
        <title>Naujienos - {{ $heading }} | Klaipėda aš su Tavim!</title>
    @else
        <title>Naujienos | Klaipėda aš su Tavim!</title>
    @endif
@endsection

@section('meta')
    @if( isset($heading) )
        <meta name="description"
              content="{{ $heading }}. Aktualiausios Vakarų Lietuvos naujienos iš Klaipėdos, Klaipėdos rajono, Palangos, Neringos, Šilutės, Kretingos ir jų rajonų.">
    @else
        <meta name="description"
              content="Aktualiausios Vakarų Lietuvos naujienos iš Klaipėdos, Klaipėdos rajono, Palangos, Neringos, Šilutės, Kretingos ir jų rajonų.">
    @endif
    <link rel="canonical" href="{{ url()->current() }}"/>
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
                                    @if( isset($heading) && $heading != 'Naujienos' )
                                        Naujienų kategorija :  {{ $heading }}
                                    @else
                                        Naujienos
                                    @endif
                                </span>
                            </h1>
                        </div><!-- col end -->
                    </div><!-- row end -->
                    @include('web.posts.partials.list_new')
                </div><!-- col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        @include('web.layout.widgets.socials')

                        <div class="sidebar-widget">
                            @include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE_NEWS'])
                        </div>

                        @include('web.layout.widgets.news_sidebar')

                        @include('web.layout.widgets.tag_sidebar')
                    </div>
                </div><!-- sidebar col end -->
            </div><!-- row end -->
        </div><!-- container end -->
    </section>
@endsection
{{-- todo: news search, maybe for future Client request
@section('scripts')
    <script>
        $('.filter__news a[data-category]').on('click', function (e) {
            e.preventDefault()

            const categoryID = $(this).data('category')
            const url = 'naujienu-paieska/' + categoryID

            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    const html = $(data)
                    $('.posts-list').hide().html(html).fadeIn()
                }
            })
        })
    </script>
@endsection
--}}
@extends('web.layout.app_new')
@section('title')
    <title>Puslapis nerastas | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
    <meta name="description"
          content="Ieškomas puslapis nerastas. Sekite aktualiausios Vakarų Lietuvos naujienos iš Klaipėdos, Klaipėdos rajono..">
    <meta name="robots" content="noindex" />
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
                                <span class="title-angle-shap">404</span>
                            </h1>
                        </div>
                    </div>
                    <h3 class="text-uppercase text-center">Puslapis nerastas</h3>
                    <p class="text-center">Atsiprašome, tačiau ieškomo puslapio neradome. Pamėginkite pasinaudoti meniu arba grįžkite į pradinį.</p>
                    <div class="text-center mb-20">
                        <a class="btn btn-rounded" href="{{ route('home') }}">Grįžti į pradinį</a>
                    </div>
                    <p class="text-muted text-center">Jeigu turite pastabų susisiekite su administracija - <a href="{{ route('contacts') }}">kontaktai</a>.</p>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        @include('web.layout.widgets.socials')

                        <div class="sidebar-widget">
                            @include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE'])
                        </div>

                        @include('web.layout.widgets.news_sidebar')

                        @include('web.layout.widgets.tag_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
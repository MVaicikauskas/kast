@extends('web.layout.app_new')

@section('title')
    <title>{{ $tag->seo_title ? $tag->seo_title : $tag->title . " | „Klaipėda, aš su tavim“" }}</title>
@endsection


@section('meta')
    <meta name="date" content="{{ $tag->created_at }}">
    <meta name="revised" content="{{ $tag->updated_at }}">
    @isset($tag->seo_description)
        <meta name="description" content="{{ $tag->seo_description }}">
    @endisset
    <link rel="canonical" href="{{ url()->current() }}" />
@endsection

@section('facebook_share_title', $tag->seo_title ? $tag->seo_title : $tag->title)
@section('facebook_share_description', $tag->seo_description)

@section('content')
    @include('web.posts.partials.breadcrumb_new')
    <section class="main-content category-layout-2">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="block-title">
                                <span class="title-angle-shap">Žyma:  {{ $heading }}</span>
                            </h1>
                            <p>{{ $tag->short_description }}</p>
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
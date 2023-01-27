@extends('web.layout.app_new')

@section('title')
    <title>{{ $post->title }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($post->meta_description), $limit = 160, $end = '...') }}">
    <meta name="date" content="{{ $post->created_at }}">
    <meta name="revised" content="{{ $post->updated_at }}">
@endsection

@section('facebook_share_title', $post->title)
@section('facebook_share_image', asset('storage_old/posts/' . $post->image))
@section('facebook_share_description', strip_tags($post->description))


@section('content')
    @include('web.posts.partials.breadcrumb_new')

    <section class="main-content">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8">
                    <div class="single-post" itemscope itemtype="http://schema.org/Article" >
                        @include('web.layout.widgets.ad_block', ['type' => 'POST_MOBILE_RE'])

                        <div class="post-header-area">
                            <h1 itemprop="headline name"
                                class="post-title title-lg"
                                title="{{ $post->title }}">{{ $post->title }}</h1>
                            <ul class="post-meta">
                                <li>
                                    <i class="fa fa-clock-o"></i>
                                    <span itemprop="datePublished" content="{{ date('Y-m-d', strtotime($post->created_at)) }}">{{ date('Y-m-d', strtotime($post->created_at)) }}</span>
                                </li>
                                <li>
                                    <i class="fa fa-user"></i>
                                    <span itemprop="author" itemscope itemtype="http://schema.org/Organization"><span itemprop="name" style="margin: 0">{{ $post->author ?? 'Klaipėda aš su Tavim' }}</span></span>
                                </li>
                                {!! $reading_time !!}
                                <li class="social-share">
                                    <i class="shareicon fa fa-share" title="Pasidalinkite"></i>
                                    <ul class="social-list">
                                        @php
                                            $share_link = url('naujienos/' . $category->slug . '/' . $post->slug);
                                            $share_title = $post->title;
                                        @endphp
                                        @include('web.layout.partials.share-list', ['type' => 'facebook'])
                                        @include('web.layout.partials.share-list', ['type' => 'messenger'])
                                        @include('web.layout.partials.share-list', ['type' => 'linkedin'])
                                        @include('web.layout.partials.share-list', ['type' => 'copy'])
                                    </ul>
                                </li>
                            </ul>
                            <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
                                <meta itemprop="name" content="Klaipėda, aš su tavim">
                            </span>
                            <meta itemprop="url" content="{{ url('naujienos/' . $category->slug . '/' . $post->slug) }}">
                        </div>
                        <div class="post-content-area">
                            <div class="post-media mb-20">
                                @if ($post->youtube_main && $post->youtube_url)
                                    <iframe width="100%" height="350" src="{{ $post->youtube_url }}" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                @else
                                    <a href="{{ asset('storage_old/posts/' . $post->image) }}"
                                       class="gallery-popup cboxElement"
                                       title="{{ $post->title }}">
                                        <img itemprop="image"
                                             src="{{ asset('storage_old/posts/' . $post->image) }}"
                                             data-src="{{ asset('storage_old/posts/' . $post->image) }}"
                                             class="img-fluid"
                                             alt="{{ $post->title }}"
                                             loading="lazy">
                                    </a>
                                @endif
                            </div>
                            <div class="font-size">
                                <div class="font-size__letter">
                                    <span>A</span><span class="font-size__larger">A</span>
                                </div>
                            </div>

                            {!! $post->description !!}
                            @include('web.layout.widgets.ad_block', ['type' => 'POST_1_RE'])

                            @if($post->description2)
                                {!! $post->description2 !!}
                                @include('web.layout.widgets.ad_block', ['type' => 'POST_2_RE'])
                            @endif

                            @if($post->description3)
                                {!! $post->description3 !!}
                                @include('web.layout.widgets.ad_block', ['type' => 'POST_3_RE'])
                            @endif

                            @if( !$post->media->isEmpty() )
                                <div class="gap-20"></div>
                                <div class="owl-carousel gallery" id="post-gallery">
                                    @foreach($post->media as $m)
                                        <div class="item" style="background-image:url({{ asset('storage_old/posts/' . $m->name) }})">
                                            <a href="{{ asset('storage_old/posts/' . $m->name) }}" class="image-link gallery-popup">&nbsp;</a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="post-footer">
                            @if( !$post->post_tag->isEmpty() )
                                <div class="gap-20"></div>
                                <div class="tag-lists">
                                    <span>Žymos: </span>
                                        @foreach($post->post_tag as $tag)
                                            <a href="{{ url('/zyma/' . $tag->slug) }}">{{ $tag->title }}</a>
                                        @endforeach
                                </div>
                            @endif

                            <div class="gap-50"></div>

                            <div class="related-post">
                                <p class="block-title">
                                    <span class="title-angle-shap"> Taip pat skaitykite</span>
                                </p>
                                <div class="row">
                                    @foreach($similar_posts as $s_post)
                                    <div class="col-md-4">
                                        <div class="post-block-style">
                                            <div class="post-thumb">
                                                <a href="{{ url('naujienos/' .$s_post->category->slug . '/' . $s_post->slug) }}">
                                                    @if (!empty($s_post->image))
                                                        <img
                                                            class="img-fluid lazyload"
                                                            src="{{ asset('storage_old/posts/' . $s_post->image) }}"
                                                            data-src="{{ asset('storage_old/posts/' . $s_post->image) }}"
                                                            alt="{{ $s_post->title }}"
                                                            loading="lazy">
                                                    @else
                                                        <img
                                                                class="img-fluid lazyload"
                                                                src="{{ asset('dist/images/web/default_logo.png') }}"
                                                                data-src="{{ asset('dist/images/web/default_logo.png') }}"
                                                                loading="lazy">
                                                    @endif
                                                </a>
                                            </div>

                                            <div class="post-content">
                                                <h2 class="post-title">
                                                    <a href="{{ url('naujienos/' . $s_post->category->slug . '/' . $s_post->slug) }}"
                                                    title="Skaityti straipsnį - {{ $s_post->title }}">{{ $s_post->title }}</a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        @include('web.layout.widgets.socials')

                        <div class="sidebar-widget">
                            @include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE_NEWS'])
                        </div>

                        @include('web.layout.widgets.news_sidebar')

                        @include('web.layout.widgets.tag_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('web.layout.widgets.ad_block', ['type' => 'BOTTOM_FIXED'])
@endsection

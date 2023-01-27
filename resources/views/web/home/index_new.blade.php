@extends('web.layout.app_new')

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
    {{-- Featured posts --}}
    <section class="featured-post-area d-none d-lg-block">
        <div class="container">
            <div class="row">
                @foreach($featured_news as $featured_post)
                    @php
                        $image = $featured_post->image ? 'storage_old/posts/' . $featured_post->image : 'assets/images/placeholder.png';
                        $link = url('naujienos/' . $featured_post->category->slug . '/' . $featured_post->slug)
                    @endphp
                    <div class="col-lg-4 col-md-12 pad-r">
                        <div class="post-overaly-style post-md"
                             style="background-image:url({{ $image }})">
                            <div class="featured-post">
                                <a href="{{ $link }}" class="image-link">&nbsp;</a>
                                <div class="overlay-post-content">
                                    <div class="post-content">
                                        <h2 class="post-title title-md">
                                            <a href="{{ $link }}">{{ $featured_post->title }}</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- News post, events, sidebar #1 --}}
    <section class="block-wrapper pb-lg-0">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8 col-md-12">
                    {{-- news_1 --}}
                    <div class="block-home-news">
                        <h2 class="block-title">
                            <span class="title-angle-shap">Naujienos</span>
                        </h2>
                        <div class="row ts-gutter-30">
                            <div class="col-lg-6 col-md-6">
                                @php
                                    $image = $news_1_first->image ? 'storage_old/posts/' .$news_1_first->image : 'assets/images/placeholder.png';
                                    $link = url('naujienos/' . $news_1_first->category->slug . '/' . $news_1_first->slug)
                                @endphp
                                <div class="post-block-style post-overaly-style post-md"
                                     style="background-image:url('{{ asset($image) }}')">
                                    <div class="featured-post">
                                        <a href="{{ $link }}" class="image-link">&nbsp;</a>
                                        <div class="overlay-post-content">
                                            <div class="post-content">
                                                <h2 class="post-title title-md">
                                                    <a href="{{ $link }}">{{ $news_1_first->title }}</a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row ts-gutter-30">
                                    @foreach($news_1 as $news_post)
                                        @if($loop->first) @continue @endif
                                        @php
                                            $image = $news_post->image ? 'storage_old/posts/' . $news_post->image : 'assets/images/placeholder.png';
                                            $link = url('naujienos/' . $news_post->category->slug . '/' . $news_post->slug)
                                        @endphp
                                        <div class="col-6">
                                            <div class="post-block-style">
                                                <div class="post-thumb post-thumb__small">
                                                    <a href="{{ $link }}">
                                                        <img class="img-fluid owl-lazy"
                                                             src="{{ asset($image) }}"
                                                             data-src="{{ asset($image) }}"
                                                             alt="{{ $news_post->title }}"
                                                             title="{{ $news_post->title }}"
                                                             loading="lazy">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <h2 class="post-title">
                                                        <a href="{{ $link }}">{{ $news_post->title }}</a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row ts-gutter-30">
                            <div class="col col-12 col-sm-6 mt-2 mt-md-4">
                                <div class="text-center">
                                    <a href="{{ route('news.page') }}" class="btn btn-dark all-news-btn"> Visos naujienos </a>
                                </div>
                            </div>
                            <div class="col col-12 col-sm-6 mt-2 mt-md-4">
                                <div class="text-center">
                                    <a href="{{ route('user.add-event') }}" class="btn text-uppercase font-weight-bold"> Įkelk renginį nemokamai </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- news_1_ad --}}
                    <div class="d-lg-none">
                        <div class="gap-50"></div>
                        @include('web.layout.widgets.ad_block', ['type' => 'HOME_MOBILE_RE'])
                    </div>

                    <div class="gap-50"></div>

                    <div class="block-events text-light">
                        <h2 class="block-title">
                            <span class="title-angle-shap"> Renginiai </span>
                        </h2>

                        <div class="row">
                            @if( !$events->isEmpty() )
                            <div class="col-lg-6 col-md-6">
                                @php
                                    $image = $events->first()->image ? 'storage_old/events/' . $events->first()->image : 'assets/images/placeholder.png';
                                    $link = url('renginiai/' . $events->first()->category->slug . '/' . $events->first()->slug);
                                @endphp

                                <div class="post-block-style">
                                    <div class="post-thumb">
                                        <a href="{{ $link }}">
                                            <img class="img-fluid lazyload"
                                                 src="{{ asset($image) }}"
                                                 data-src="{{ asset($image) }}"
                                                 alt="{{ $events->first()->title }}"
                                                 title="{{ $events->first()->title }}"
                                                 loading="lazy"/>
                                        </a>
                                        <div class="grid-cat">
                                            <a class="post-cat event-cat-{{ $events->first()->category_id }}" href="{{ $link }}">{{ $events->first()->category->name }}</a>
                                        </div>
                                    </div>
                                    <div class="post-content">
                                        <h2 class="post-title title-md">
                                            <a href="{{ $link }}">{{ $events->first()->title }}</a>
                                        </h2>
                                        @if( $events->first()->excerpt )
                                            <p>{{ $events->first()->excerpt  }}</p>
                                        @endif
                                        <div class="post-meta mb-7">
                                            <span class="post-date"><i class="fa fa-clock-o"></i> {{ $events->first()->date }} {{ $events->first()->start_time }}</span>
                                            @if($events->first()->location)
                                                <span class="post-date"><i class="fa fa-map-marker"></i> {{ $events->first()->location }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php $events->shift() @endphp
                                @php
                                    $image = $events->first()->image ? 'storage_old/events/' . $events->first()->image : 'assets/images/placeholder.png';
                                    $link = url('renginiai/' . $events->first()->category->slug . '/' . $events->first()->slug);
                                @endphp
                                <div class="post-block-style">
                                    <div class="post-thumb">
                                        <a href="{{ $link }}">
                                            <img class="img-fluid lazyload"
                                                 src="{{ asset($image) }}"
                                                 data-src="{{ asset($image) }}"
                                                 alt="{{ $events->first()->title }}"
                                                 title="{{ $events->first()->title }}"
                                                 loading="lazy"/>
                                        </a>
                                        <div class="grid-cat">
                                            <a class="post-cat event-cat-{{ $events->first()->category_id }}" href="{{ $link }}">{{ $events->first()->category->name }}</a>
                                        </div>
                                    </div>
                                    <div class="post-content">
                                        <h2 class="post-title title-md">
                                            <a href="{{ $link }}">{{ $events->first()->title }}</a>
                                        </h2>
                                        @if( $events->first()->excerpt )
                                            <p>{{ $events->first()->excerpt  }}</p>
                                        @endif
                                        <div class="post-meta mb-7">
                                            <span class="post-date"><i class="fa fa-clock-o"></i> {{ $events->first()->date }} {{ $events->first()->start_time }}</span>
                                            @if($events->first()->location)
                                                <span class="post-date"><i class="fa fa-map-marker"></i> {{ $events->first()->location }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="row ts-gutter-20">
                                    @php $events->shift() @endphp
                                    @foreach($events as $event)
                                        @php
                                            $image = $event->image ? 'storage_old/events/' . $event->image : 'assets/images/placeholder.png';
                                            $link = url('renginiai/' . $event->category->slug . '/' . $event->slug);
                                        @endphp

                                        <div class="col-md-6">
                                            <div class="post-block-style">
                                                <div class="post-thumb post-thumb__small">
                                                    <a href="{{ $link }}" title="Renginio {{ $event->title }} nuoroda">
                                                        <img class="img-fluid lazyload"
                                                             src="{{ asset($image) }}"
                                                             data-src="{{ asset($image) }}"
                                                             alt="{{ $event->title }}"/>
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <h2 class="post-title">
                                                        <a href="{{ $link }}">{{ $event->title }}</a>
                                                    </h2>
                                                    <div class="post-meta mb-7">
                                                        <span class="post-date"><i class="fa fa-clock-o"></i> {{ $event->date }} {{ $event->start_time }}</span>
                                                        @if($event->location)
                                                            <span class="post-date"><i class="fa fa-map-marker"></i> {{ $event->location }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                                <div class="col-12">
                                    <p class="text-center">Renginių nėra</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="gap-30"></div>

                    <div class="row events-buttons">
                        <div class="col-6 pr-1 pr-md-3">
                            <div class="text-center">
                                <a href="{{ route('events.page') }}" class="btn btn-dark btn-block"> Visi renginiai </a>
                            </div>
                        </div>
                        <div class="col-6 pl-1 pl-md-3">
                            <div class="text-center">
                                <a href="{{ route('user.add-event') }}" class="btn btn-block"> Įkelk renginį nemokamai </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        @include('web.layout.widgets.socials')

                        <div class="sidebar-widget mt-20">
                            @include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE_HOME'])
                        </div>

                        @include('web.layout.widgets.news_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Add banner --}}
    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                   @include('web.layout.widgets.ad_block', ['type' => 'HOME_LEADERBORD_RE'])
                </div>
            </div>
        </div>
    </section>

    {{-- Activities --}}
    <section class="block-wrapper pt-0">
        <div class="container">
            <h2 class="block-title">
                <span class="title-angle-shap"> Būreliai</span>
            </h2>
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 mb-20 mb-md-0">
                    <div class="post-overaly-style post-lg"
                         style="background-image:url({{ asset('assets/images/bureliai-vaikams-ir-jaunimui.jpg') }})">

                        <a href="{{ route('activities.forChildren') }}" class="image-link">&nbsp;</a>
                        <div class="overlay-post-content">
                            <div class="post-content">
                                <h2 class="post-title title-md">
                                    <a href="{{ route('activities.forChildren') }}">Vaikams ir jaunimui</a>
                                </h2>
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="icon icon-fire"></i> {{ $activitiesChildrenCount }}+</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="post-overaly-style post-lg"
                         style="background-image:url({{ asset('assets/images/bureliai-suaugusiems.jpg') }})">
                        <a href="{{ route('activities.forAdults') }}" class="image-link">&nbsp;</a>
                        <div class="overlay-post-content">
                            <div class="post-content">
                                <h2 class="post-title title-md">
                                    <a href="{{ route('activities.forAdults') }}">Suaugusiems</a>
                                </h2>
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="icon icon-fire"></i> {{ $activitiesAdultsCount }}+</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="gap-50"></div>

    {{-- Image/Video gallery --}}
    <section class="trending-slider full-width no-padding">
        <div class="ts-grid-box gallery">
            <div class="owl-carousel gallery" id="fullbox-slider">
                @foreach($images as $image)
                    @if ($image->image != null)
                        <div class="item post-overaly-style post-lg" style="background-image:url({{ asset('storage_old/gallery/' . $image->image) }})">
                            <a href="{{ asset('storage_old/gallery/' . $image->image) }}" class="image-link gallery-popup">&nbsp;</a>
                            <div class="overlay-post-content">
                                <div class="post-content">
                                    <div class="post-meta">
                                        <ul>
                                            <li><i class="fa fa-user"></i> {{ $image->author }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($image->video != null)
                        <div class="item post-overaly-style post-lg">
                            <a href="{{ asset('storage/gallery/' . $image->video) }}" class="image-link video-popup mfp-iframe">&nbsp;</a>
                            <div class="overlay-post-content">
                                <div class="video_watermark"></div>
                                <video
                                        src="{{ asset('storage/gallery/' . $image->video) }}"
                                        width="100%"
                                        height="auto"></video>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <ul>
                                            <li><i class="fa fa-user"></i> {{ $image->author }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <div class="gap-50"></div>

    {{-- Partners list --}}
    <section class="partners-list">
        <div class="container">
            <div class="ts-grid-box">
                <h2 class="block-title">
                    <span class="title-angle-shap"> Partneriai</span>
                </h2>
                <div class="partners-slider">
                    <div class="owl-carousel dot-style2" id="partners-slider">
                        @foreach($partners as $p)
                            <a href="{{ $p->link }}" target="_blank" rel="nofollow" title="{{ $p->name }}">
                                <img src="{{ asset('storage/partners/' . $p->logo) }}"
                                     data-src="{{ asset('storage/partners/' . $p->logo) }}"
                                     alt="{{ $p->name }}"
                                     loading="lazy">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
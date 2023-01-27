@extends('web.layout.app_new')

@section('title')
    <title>
        @if( strlen($event->title) > 45 )
            {{ \Illuminate\Support\Str::limit($event->title, 68, '..') }}</title>
        @else
            {{ \Illuminate\Support\Str::limit($event->title, 55, '..') }} | Renginiai
        @endif
    </title>
@endsection

@section('meta')
    <meta name="description" content="{!! strip_tags(\Illuminate\Support\Str::limit($event->description,$limit = 160, $end = '...')) !!}">
@endsection

@section('facebook_share_title'){{$event->title}}
@endsection
@section('facebook_share_url'){{trim(Request::url())}}
@endsection
@section('facebook_share_image'){{asset('storage_old/events/' . $event->image)}}
@endsection
@section('facebook_share_description'){{ strip_tags($event->description)}}
@endsection

@section('content')
    @include('web.posts.partials.breadcrumb_new')

    <section class="main-content">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8">
                    <div class="single-post single-event" itemscope itemtype="http://schema.org/Event" >
                        @include('web.layout.widgets.ad_block', ['type' => 'POST_MOBILE_RE'])

                        <div class="post-header-area">
                            <h1 itemprop="name"
                                class="post-title title-lg"
                                title="{{ $event->title }}">{{ $event->title }}</h1>
                            <ul class="post-meta">
                                @if($event->is_free)
                                    <li><p class="post-cat free-event mb-0" title="Renginys nemokamas">Nemokamas</p></li>
                                @endif
                                <li><i class="fa fa-calendar-times-o"></i><span>{{ $event->date }}</span></li>
                                <li><i class="fa fa-clock-o"></i><span>{{ $event->start_time }}</span></li>
                                @if(!empty($event->website))
                                    <li><i class="fa fa-globe"></i><a href="{{ $event->website }}" rel="nofollow" target="_blank" title="Renginio internetinis puslapis">WWW</a></li>
                                @endif
                                @if(!empty($event->facebook_link))
                                    <li><i class="fa fa-facebook"></i><a href="{{ $event->facebook_link }}" rel="nofollow" target="_blank" title="Rentinio Facebook puslapis">Facebook</a></li>
                                @endif
                                @if(!empty($event->ticket_link))
                                    <li><i class="fa fa-ticket"></i><a itemprop="url" href="{{ $event->ticket_link }}" rel="nofollow" target="_blank" title="Nuoroda pirkti bilietus">Pirkti bilietus</a></li>
                                @endif
                                @if(!empty($event->location))
                                    <li><i class="fa fa-map"></i><span title="Adresas">{{ $event->location }}</span></li>
                                @endif
                                <li class="social-share">
                                    <i class="shareicon fa fa-share" title="Pasidalinkite"></i>
                                    <ul class="social-list">
                                        @php
                                            $share_link = url('renginiai/' . $category->slug . '/' . $event->slug);
                                            $share_title = $event->title;
                                        @endphp
                                        @include('web.layout.partials.share-list', ['type' => 'facebook'])
                                        @include('web.layout.partials.share-list', ['type' => 'messenger'])
                                        @include('web.layout.partials.share-list', ['type' => 'linkedin'])
                                        @include('web.layout.partials.share-list', ['type' => 'copy'])
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="post-content-area">
                            <div class="post-media mb-20">
                                <a href="{{ asset('storage_old/events/' . $event->image) }}"
                                   class="gallery-popup cboxElement"
                                   title="{{ $event->title }}">
                                    <img itemprop="image"
                                         src="{{ asset('storage_old/events/' . $event->image) }}"
                                         data-src="{{ asset('storage_old/events/' . $event->image) }}"
                                         class="img-fluid"
                                         alt="{{ $event->title }}"
                                         loading="lazy">
                                </a>
                            </div>

                            {!! $event->description !!}

                            @if( !$event->media->isEmpty() )
                                <div class="owl-carousel gallery" id="post-gallery">
                                    @foreach($event->media as $m)
                                        <div class="item" style="background-image:url({{ asset('storage_old/posts/' . $m->image) }})">
                                            <a href="{{ asset('storage_old/events/' . $m->image) }}" class="image-link gallery-popup">&nbsp;</a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="gap-30"></div>
                        <div class="post-footer">
                            <div class="related-post">
                                <h2 class="block-title">
                                    <span class="title-angle-shap"> Panašūs renginiai</span>
                                </h2>
                                <div class="row">
                                    @foreach($simEvents as $s_event)
                                        <div class="col-md-4">
                                            <div class="post-block-style">
                                                <div class="post-thumb">
                                                    <a href="{{ url('renginiai/' . $category->slug . '/' . $s_event->slug) }}">
                                                        @if (!empty($s_event->image))
                                                            <img
                                                                    class="img-fluid lazyload"
                                                                    src="{{ asset('storage_old/events/' . $s_event->image) }}"
                                                                    data-src="{{ asset('storage_old/events/' . $s_event->image) }}"
                                                                    alt="{{ $s_event->title }}"
                                                                    loading="lazy">
                                                        @else
                                                            <img
                                                                    class="img-fluid lazyload"
                                                                    src="{{ asset('dist/images/web/default_logo.png') }}"
                                                                    data-src="{{ asset('dist/images/web/default_logo.png') }}"
                                                                    loading="lazy">
                                                        @endif
                                                    </a>
                                                    <div class="grid-cat">
                                                        <span class="post-cat" title="Renginių kategorija: {{ $category->name }}">{{ $category->name }}</span>
                                                    </div>
                                                </div>

                                                <div class="post-content">
                                                    <h2 class="post-title">
                                                        <a href="{{ url('renginiai/' . $category->slug . '/' . $s_event->slug) }}"
                                                           title="Žiūrėti renginio informaciją, {{ $s_event->title }}">{{ $s_event->title }}</a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div><!-- row end -->
                            </div>
                        </div>
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
                </div>
            </div>
        </div>
    </section>
@endsection
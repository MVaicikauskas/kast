@extends('web.layout.app')

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

<!-- open graph stuff-->
@section('facebook_share_title'){{$event->title}}
@endsection
@section('facebook_share_url'){{trim(Request::url())}}
@endsection
@section('facebook_share_image'){{asset('storage_old/events/' . $event->image)}}
@endsection
@section('facebook_share_description'){{ strip_tags($event->description)}}
@endsection
<!-- end open graph stuff-->

@section('styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('dist/dashboard/icons/font-awesome/css/font-awesome.min.css') }}">
@endsection

@section('content')
    <section class="no-m-t event_page">
        <div class="section-content">
            <div itemscope itemtype="http://schema.org/Event" class="inner-page block-shadow">
                <div class="info-container">
                    <a href="{{ route('events.page') }}">Grįžti</a>
                    <div class="title-container">
                        <h1 itemprop="name" class="title" title="{{ $event->title }}">{{ $event->title }}</h1>
                    </div>
                    <div class="details">
                        @if(!empty( $event->image))
                            <div class="poster">
                                <img itemprop="image"
                                     class="lazyload"
                                     src="{{ asset('storage_old/events/' . $event->image) }}"
                                     data-src="{{ asset('storage_old/events/' . $event->image) }}"
                                     alt="Renginio nuotrauka, {{ $event->title }}">
                            </div>
                        @endif
                        <div class="details-info">
                            <h2 class="category info" title="Renginio kategorija" style="color: #45ada8;text-transform: uppercase;font-weight: 600;">
                                <i class="fa fa-tags"></i> {{ $event->category->name }}
                            </h2>
                            <span class="info" title="Renginio data">
                                <i class="fa fa-calendar"></i> <span itemprop="startDate" content="{{ $event->date }}">{{ $event->date }}</span>
                            </span>
                            <span class="info" title="Renginio laikas">
                                <i class="fa fa-clock-o"></i> {{ $event->start_time }}
                                @if(!empty($event->end_time)) - {{ $event->end_time }} val. @else val. @endif
                            </span>
                            @if(!empty($event->location))
                                <span itemprop="location" itemscope itemtype="http://schema.org/Place" class="info" title="Renginio vieta">
                                    <i class="fa fa-map-marker"></i> <span itemprop="name">{{ $event->location }}</span>
                                </span>
                            @endif

                            @if(!empty($event->website))
                                <span class="info" title="Renginio internetinis puslapis">
					                <i class="fa fa-link"></i> <a itemprop="url" href="{{ $event->website }}" target="_blank" rel="nofollow">Internetinis puslapis</a>
                                </span>
                            @endif

                            @if(!empty($event->facebook_link))
                                <span class="info" title="Renginio facebook puslapis">
                                    <i class="fa fa-facebook"></i> <a href="{{ $event->facebook_link }}" target="_blank" rel="nofollow">Facebook puslapis</a>
                                </span>
                            @endif

                            @if(!empty($event->ticket_link))
                                <span class="info">
                                    <a itemprop="url" href="{{ $event->ticket_link }}" class="tickets" target="_blank" rel="nofollow">Pirkti bilietus</a>
                                </span>
                            @endif

                            @if($event->is_free)
                                <span class="info" title="Renginys nemokamas">
                                    <i class="fa fa-ticket"></i> Nemokamas
                                </span>
                            @endif

                            @if (count($event->alternativeDate))
                                <div class="info" title="Kitos datos">
                                    <span>Kitos datos:</span>
                                    @foreach($event->alternativeDate as $altDate)
                                        <div>
                                            <span>{{ $altDate->date }}</span>
                                            <span>{{ $altDate->start_time }}</span>
                                            <span>{{ $altDate->end_time }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div itemprop="description" class="description">
                        <h3 style="font-size: 1.2em;"><strong>Renginio aprašymas</strong></h3>
                        <p>{!! $event->description !!}</p>
                    </div>

                    <div class="gallery-container">

                        @foreach($event->media as $m)
                            <div class="image">
                                <a data-fancybox="gallery" href="{{ asset('storage_old/events/' . $m->name) }}">
                                    <img src="{{ asset('storage_old/events/' . $m->name) }}">
                                </a>
                            </div>
                        @endforeach

                    </div>

                    <!-- google ads -->
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-8503410126696629"
                         data-ad-slot="8495923530"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                    <!-- end of google ads	 -->

                    <div>
                        <div class="sharethis-inline-share-buttons"></div>
                    </div>
                </div>
            </div>

            @if(count($simEvents) > 0)
                <div class="similar-events-container">
                    <h3>Panašūs renginiai</h3>
                    <div class="similar-events">
                        @foreach($simEvents as $se)
                            <a href='{{ url('renginiai/' . $se->category->slug . '/' . $se->slug) }}' class="s-item">
                                <img class="lazyload" data-src="{{ asset('storage_old/events/' . $se->image) }}"
                                     alt="{{ $se->title }}">
                                <h4>{{ $se->title }}</h4>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
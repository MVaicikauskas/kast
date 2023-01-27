@extends('web.layout.app_new')

@section('title') 
  <title>Foto ir Video galerija | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
  <meta name="description" content="Aukščiausios kokybės fotografijos iš Vakarų Lietuvos –  tai top Klaipėdos krašto nuotraukų ir video hub‘as. Čia vaizdais dalinasi profesionaliausi fotografai ir filmuotojai.">
@endsection

@section('content')
    @include('web.posts.partials.breadcrumb_new')

    <section class="main-content">
        <div class="container">
            <div class="row ts-gutter-30">
                <div class="col-lg-8">
                    <div class="gallery row">
                    @foreach($images as $image)
                        <div class="col-12 col-md-6 mb-20">
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
                        </div>
                    @endforeach
                    </div>
                    {{--
                    <div class="owl-carousel gallery" id="gallery-slider">
                        <div class="gallery-container">
                        @php $cycle = 0 @endphp
                        @foreach($images as $image)
                            @php $cycle = $cycle + 1 @endphp
                            @if ($image->image != null)
                                <div class="post-overaly-style post-lg" style="background-image:url({{ asset('storage_old/gallery/' . $image->image) }})">
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
                                    <a href="{{ asset('storage/gallery/' . $image->video) }}" class="image-link popup">&nbsp;</a>
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
                            @if( $cycle == 8 )
                                </div><div class="gallery-container">
                                @php $cycle = 0 @endphp
                            @endif
                        @endforeach
                        </div>
                    </div>
                    --}}
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

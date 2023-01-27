@extends('web.layout.app')

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
    <section class="no-m-t posts_page">
        <div class="section-content">
            <div class="inner-page block-shadow">
                <div itemscope itemtype="http://schema.org/Article" class="info-container">
					<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
						<meta itemprop="name" content="Klaipėda, aš su tavim">
					</span>
					<meta itemprop="url" content="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}">
                    <a href="{{ route('news.page') }}">Grįžti į naujienas</a>
                    <div class="description">
                        @if ($assignedAds0)
                            @foreach ($ads0 as $ad)
                                <div class="set_adds_posts">
                                    <a href="{{ $ad->link }}" target="_blank">
                                        <img class="lazyload"
                                             src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}"
                                             data-src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}">
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p>
                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <ins class="adsbygoogle"
                                     style="display:inline-block;width:336px;height:280px"
                                     data-ad-client="ca-pub-8503410126696629"
                                     data-ad-slot="3096551682"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </p>
                        @endif
                    </div>
                    <div class="title-container">
                        <h1 itemprop="headline name" class="title" title="{{ $post->title }}" style="display: inline">{{ $post->title }}</h1>
                        <a href="{{ url('naujienos/' . $post->category->slug) }}" style="display: inline">#{{ $post->category->name }}</a>
                    </div>
                    <div class="details">
                        <div class="poster">
                            @if ($post->youtube_main && $post->youtube_url)
                                <iframe width="560" height="315" src="{{ $post->youtube_url }}" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            @else
                                <img itemprop="image"
									 class="lazyload"
									src="{{ asset('storage_old/posts/' . $post->image) }}"
									data-src="{{ asset('storage_old/posts/' . $post->image) }}"
									alt="{{ $post->title }}"
                                    title="{{ $post->title }}">
                            @endif
                        </div>
                        <div class="details-info">
							<span class="info" title="Data">
								<span>Data</span> <br>
								<span itemprop="datePublished" content="{{ date('Y-m-d', strtotime($post->created_at)) }}">{{ date('Y-m-d', strtotime($post->created_at)) }}</span>
							</span>
                            <span class="info" title="Autorius">
								<span>Autorius</span> <br>
								<span itemprop="author" itemscope itemtype="http://schema.org/Organization"><span itemprop="name">{{ $post->author ?? 'Klaipėda aš su Tavim' }}</span></span>
							</span>
                            <span class="info hideTo768" title="Kategorija"><span>Kategorija</span> <br><a
                                        href="{{ url('naujienos/' . $post->category->slug) }}"
                                        style="display: inline">{{ $post->category->name }}</a></span>
                            @if( !empty(json_decode($post->post_tag)) )
                                <span class="info hideTo768" title="Žymos"><span>Žymos</span> <br>
						@foreach(json_decode($post->post_tag) as $tag)
                                        <a href="{{ url('zyma/' . $tag->slug) }}"
                                           style="display: inline">{{ $tag->title }}</a>
                                        @if(!$loop->last) | @endif
                                    @endforeach
						</span>
                            @endif
                            <span class="info hideTo768" title="Dalintis"><span>Dalintis</span> <br>
					<a href="https://www.facebook.com/share.php?u={{ url()->current() }}&quote=Straipsnis kurį perskaičiau Klaipėda Aš su Tavim!"
                       target="_blank">Facebook</a> |
					<a href="mailto:?subject='Noriu%20pasidalinti%20naujiena!'&body='Straipsnis%20kurį%20perskaičiau%20Klaipėda%20Aš%20su%20Tavim: {{ url()->current() }}'">El.paštu</a>
				</span>
                        </div>
                    </div>
                    <div class="description" itemprop="articleBody">
                        {!! $post->description !!}

                        @if (!$post->youtube_main && $post->youtube_url)
                            <iframe
                                    src='{{ $post->youtube_url }}'
                            ></iframe>
                        @endif

                        @if ($assignedAds)


                            @foreach ($ads as $ad)
                                <div class="set_adds_posts">
                                    <a href="{{ $ad->link }}" target="_blank">
                                        <img class="lazyload"
                                             src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}"
                                             data-src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}">
                                    </a>
                                </div>
                            @endforeach

                            {!! $post->description2 !!}
                        @elseif ( $post->description2)
                            <p>
                                <!-- Straipsniai horizontalus vidinis 1 -->
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-8503410126696629"
                                     data-ad-slot="7901332057"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                                {!! $post->description2 !!}
                            </p>
                        @endif

                        @if ($assignedAds2)

                            @foreach ($ads2 as $ad)
                                <div class="set_adds_posts">
                                    <a href="{{ $ad->link }}" target="_blank">
                                        <img class="lazyload"
                                             src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}"
                                             data-src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}">
                                    </a>
                                </div>
                            @endforeach
                            {!! $post->description3 !!}
                        @elseif ( $post->description3)
                        <!-- Skelbimu vidinis horizontalus 2 -->
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-8503410126696629"
                                 data-ad-slot="4425406883"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                            <p>
                                {!! $post->description3 !!}
                            </p>
                        @endif
                    </div>
                    <div class="gallery-container" width="100%">
                        @foreach($post->media as $m)
                            <div class="image">
                                <a data-fancybox="gallery" href="{{ asset('storage_old/posts/' . $m->name) }}">
                                    <img src="{{ asset('storage_old/posts/' . $m->name) }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="sharethis-inline-share-buttons"></div>
                        <br><br>
                        @section('styles')
                            <style>
                                .tags-list h2 {
                                    display: inline;
                                }

                                .tags-list a.tag-item {
                                    border: 1px solid #e8e8e8;
                                    text-decoration: none;
                                    color: #000 !important;
                                    padding: 5px 15px;
                                    display: inline-block;
                                    margin-bottom: 5px !important;
                                }

                                .tags-list a.tag-item:hover {
                                    background-color: #45ada8;
                                    color: #fff !important;
                                }
                            </style>
                        @endsection
                    </div>
                    @if( !empty(json_decode($post->post_tag)) )
                        <div class="similar-events-container">
                            <h5>Žymos</h5>
                            <div class="tags-list">
                                @foreach(json_decode($post->post_tag) as $tag)
                                    <h2><a href='{{ url('zyma/' . $tag->slug) }}' class="tag-item">{{ $tag->title }}</a>
                                    </h2>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(count($similar_posts) > 0)
                        <div class="similar-events-container">
                            <h5>Taip pat skaitykite</h5>
                            <div class="similar-events">
                                @foreach($similar_posts as $se)
                                    <a href='{{ url('naujienos/' . $se->category->slug . '/' . $se->slug) }}'
                                       class="s-item">
                                        <img class="lazyload" data-src="{{ asset('storage_old/posts/' . $se->image) }}"
                                             alt="{{ $se->title }}">
                                        <h3>{{ $se->title }}</h3>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($assignedAds3)

                        @foreach ($ads3 as $ad)
                            <div class="set_adds_posts">
                                <a href="{{ $ad->link }}" target="_blank">
                                    <img class="lazyload"
                                         src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}"
                                         data-src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}">
                                </a>
                            </div>
                        @endforeach
                    @else
                    <!-- google ads -->
                        <!-- Straipsniai Horizontalus 1 -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8503410126696629"
                             data-ad-slot="3039563242"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        <!-- end of google ads	 -->
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

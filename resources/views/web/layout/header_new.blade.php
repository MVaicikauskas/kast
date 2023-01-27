{{-- Trending --}}
<div class="trending-bar trending-light d-none d-sm-block">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 text-left">
                @if( $topheader_news->isNotEmpty() )
                    <p class="trending-title"><i class="tsicon fa fa-bolt"></i> Svarbu</p>
                    <div id="trending-slide" class="owl-carousel owl-theme trending-slide">
                        @foreach($topheader_news as $trending_post)
                            @php
                                $link = url('naujienos/' . $trending_post->category->slug . '/' . $trending_post->slug)
                            @endphp
                            <div class="item">
                                <div class="post-content">
                                    <p class="post-title title-small">
                                        <a href="{{ $link }}">{{ $trending_post->title }}</a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <a href="{{ route('aboutUs') }}" class="header-top-about">Apie mus</a>
                @endif
            </div>
            <div class="col-3 no-padding text-right">
                <div class="ts-date d-none d-lg-inline-block pr-lg-2">
                    <i class="fa fa-calendar-check-o"></i>{{ $current_date }}
                </div>
                <div class="ts-date d-inline-block pr-0">
                    @if($current_temp_klaipeda['icon'])
                        <img src="{{ $current_temp_klaipeda['icon'] }}" alt="Orai, Klaipėda, ikona" style="max-width: 20px" loading="lazy">
                    @else
                        <i class="fa fa-sun-o"></i>
                    @endif
                    Klaipėda {{ $current_temp_klaipeda['temp'] }}°C
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Header start --}}
<header id="header" class="header d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center justify-content-center justify-content-lg-between">
            <div class="col-md-3 col-sm-12">
                <div class="logo">
                    <a href="/" title="Nuoroda į pradinį puslapį">
                        <img src="{{ asset('assets/images/logos/kast-logo-tamsus-300.png') }}"
                             alt="Klaipėda Aš Su Tavim Logotipas"
                             title="Klaipėda Aš Su Tavim Logotipas"
                             loading="lazy"
                             width="250px">
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 header-right">
                @include('web.layout.widgets.ad_block', ['type'=>'HEADER_RE'])
            </div>
        </div>
    </div>
</header>

{{-- Main menu--}}
@include('web.layout.partials.menu_new')
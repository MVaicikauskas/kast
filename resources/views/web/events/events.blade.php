@extends('web.layout.app')

@section('title')
    <title>Renginiai Klaipėdoje | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
    <meta name="description"
          content="Laikas - pinigai! Greitai ir lengvai rask viską ką veikti Klaipėdoje ir aplink ją vienoje vietoje! TOP renginiai, nemokami, vakarėliai, koncertai, šeimai, sporto varžybos, spektakliai, kinas. Renginių kalendoriuje rasi renginius pagal datą. Sužinok kas vyksta šiandien, rytoj, savaitgalį, ar kas mėnesį.">
@endsection


@section('content')
    @include('web.events.partials.filter-bar')

    <section class="section__padding">
        <div class="section-content" id="eventsSection">
            <div class="section-title">
                <h1>Renginiai</h1>
            </div>
            <div class="events-block">
                @if(count($events) > 0)
                    <div class="events-list">
                        @include('web.events.partials.events-list')
                        {{ $events->links() }}
                    </div>
                @endif

                @if ($googleAds)
                    <div class="ad-list column column--right bordered_ad">
                        <div class="advert_logo">REKLAMA</div>
                        <div class="item">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- Renginiai 1 -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:250px"
                                 data-ad-client="ca-pub-8503410126696629"
                                 data-ad-slot="9035454948"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                        <div class="item">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- Renginiai 2 -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:250px"
                                 data-ad-client="ca-pub-8503410126696629"
                                 data-ad-slot="1226969880"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                        <div class="item">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- Renginiai 3 -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:300px;height:250px"
                                 data-ad-client="ca-pub-8503410126696629"
                                 data-ad-slot="1324485883"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>

                    </div>
                @elseif (sizeof($ads) >= 2)
                    @include('web.advertisements.index', array('ads' => $ads->slice(0, 2)))
                @endif
            </div>
        </div>
    </section>
@endsection
@extends('web.layout.app')

@section('title') 
  <title>Būreliai | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
  <meta name="description" content="Mes surinkome virš 400 būrelių vaikams ir suaugusiems, esančių Klaipėdoje ir Klaipėdos rajone. Čia lengvai ir greitai rasi ką veikti!">
@endsection

@section('content')
<section class="section__padding">
  <div class="section-title">
    <h1>Būreliai, studijos, kursai</h1>
  </div>

  <div class="section-content">

    <div class="activities-block">

      <div class="activities-list column column--left">

        
          <div class="activity">

            <a class="blockLink" href="{{ route('activities.forChildren') }}"> </a>
            <div class="activity__image">
              <img
                class="lazyload"
                src="./dist/images/web/kids-2.jpg"
                data-src="./dist/images/web/kids-2.jpg"
                alt="Fono paveikslėlis, vaikas, burbulai">
            </div>

            <div class="activity__details">
              <h3 class="details__title">Vaikams ir jaunimui</h3>
              <p class="details__description">
              Čia rasite visus būrelius ir užsiėmimus vaikams bei jaunimui Klaipėdoje ir Klaipėdos rajone. Atraskite naujus užsiėmimus savo mieste!            </p>
              <span  class="button">Visi būreliai</span>
            </div>
            
          </div>
        


        <div class="activity">

          <a class="blockLink" href="{{ route('activities.forAdults') }}"> </a> 
          <div class="activity__image">
            <img
              class="lazyload"
              src="./dist/images/web/Adults.jpg"
              data-src="./dist/images/web/Adults.jpg"
              alt="Fono paveikslėlis, suaugęs, burbulai">
          </div>

          <div class="activity__details">
              <h3 class="details__title">Suaugusiems</h3>
              <p class="details__description">
              Čia rasite visus užsiėmimus suaugusiems Klaipėdoje ir Klaipėdos rajone. Atraskite įdomią veiklą kursuose, studijose ar būreliuose!              </p>
              <span  class="button">Visi užsiėmimai</span>
          </div>
        </div>
         
      </div>

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

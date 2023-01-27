<section class="section__padding">
  <div class="section-title">
    <h2>Būreliai</h2>
  </div>
  <div class="section-content">
    <div class="activities-block">
      <div class="activities-list column column--left">
        <div class="activity">

          <div class="activity__image">
            <img
              class="lazyload"
              src="./dist/images/web/kids-2.jpg"
              data-src="./dist/images/web/kids-2.jpg"
              alt="burbulai, vaikams, jaunimui, būreliai">
          </div>

          <div class="activity__details">
            <h4 class="details__title">Vaikams ir jaunimui</h4>
            <p class="details__description">
            Čia rasite visus būrelius ir užsiėmimus vaikams bei jaunimui Klaipėdoje ir Klaipėdos rajone. Atraskite naujus užsiėmimus savo mieste!            </p>
            <a href="{{ route('activities.forChildren') }}" class="button">Visi būreliai</a>
          </div>
        </div>

        <div class="activity">
          <div class="activity__image">
            <img
              class="lazyload"
              src="./dist/images/web/Adults.jpg"
              data-src="./dist/images/web/Adults.jpg"
              alt="burbulai, užsiėmimai, suaugusiems">
          </div>

          <div class="activity__details">
              <h4 class="details__title">Suaugusiems</h4>
              <p class="details__description">
              Čia rasite visus užsiėmimus suaugusiems Klaipėdoje ir Klaipėdos rajone. Atraskite įdomią veiklą kursuose, studijose ar būreliuose!              </p>
              <a href="{{ route('activities.forAdults') }}" class="button">Visi užsiėmimai</a>
          </div>
        </div>
      </div>

      @if ($googleAds)
      <!-- <div class="ad-list column column--right bordered_ad">
              <div class="advert_logo">REKLAMA</div>
              <div class="item">
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    
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
                    
                    <ins class="adsbygoogle"
                        style="display:inline-block;width:300px;height:250px"
                        data-ad-client="ca-pub-8503410126696629"
                        data-ad-slot="1226969880"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>


          </div> -->
      @elseif (sizeof($ads) > 3)
        @include('web.advertisements.index', array('ads' => $ads->slice(3, 5)))
      @elseif (sizeof($ads) >= 3)
        @include('web.advertisements.index', array('ads' => $ads->slice(0, 2)))
      @endif
    </div>
  </div>
</section>
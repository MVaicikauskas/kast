<section class="events-section section__padding" id="scroll-to">
  <div class="section-title">
    <h2>Artėjantys renginiai</h2>
  </div>
  <div class="section-content">
    <div class="events-block">
      <div class="events-list column column--left">
        {{-- Events --}}

        @foreach($events as $event)
          <div class="event">
            <div class="event__image">
              @if($event->is_free)
              <div class="event--free"><span>Nemokamas Renginys</span></div>
              @endif
              <a href="{{ url('renginiai/' . $event->category->slug . '/' . $event->slug) }}">
                <img class="lazyload"
                  src="{{ asset('storage_old/events/' . $event->image) }}"
                  data-src="{{ asset('storage_old/events/' . $event->image) }}"
                  alt="{{ $event->title }}">
              </a>
            </div>
            
            <div class="event__details">
              <a href="{{ url('renginiai/' . $event->category->slug . '/' . $event->slug) }}" class="details__title">{{ $event->title }}</a>
              <div class="details">
                <div class="details__location">
                  <span>{{ $event->date }}, {{ $event->location }}</span>
                </div>
                <div class="details__start-time">
                  <span>{{ $event->start_time }}</span>
                </div>
              </div>
            </div>
          </div>
        @endforeach

        <div class="event-buttons">
          <a href="{{ route('user.add-event') }}" class="button button--upload">+ Įkelkite renginį nemokamai</a>
          <a href="{{ route('events.page') }}" class="button button--all">Visi renginiai</a>
        </div>
      </div>

      @if ($googleAds)
          <div class="ads-column">
          <div class="advert_logo">REKLAMA</div>
            <div class="ad-list bordered_ad">
              <div class="item hideTo768">
                    <!-- Renginiai 1 -->
                    <ins class="adsbygoogle"
                        style="display:inline-block;width:300px;height:250px"
                        data-ad-client="ca-pub-8503410126696629"
                        data-ad-slot="9035454948"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="item add-event">
                    <a href="/ikelti-rengini">Įkelkite renginį nemokamai</a>
                </div>
                <div class="item">
                    <!-- Renginiai 2 -->
                    <ins class="adsbygoogle"
                        style="display:inline-block;width:300px;height:250px"
                        data-ad-client="ca-pub-8503410126696629"
                        data-ad-slot="1226969880"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
          </div>
      @elseif (sizeof($ads) >= 2)
        @include('web.advertisements.index', array('ads' => $ads->slice(0, 2)))
      @endif
	  
	  
    </div>
  </div>
</section>
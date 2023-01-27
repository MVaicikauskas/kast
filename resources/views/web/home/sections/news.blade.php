<section class="posts-section">
  <div class="events-calendar__container">

    {{-- Box for text and icon --}}
    <div id="eventsContainer" class="events__calendar">
      <h2 class="title">Renginių kalendorius</h2>
      <span class="icon">
        <img src="{{ asset('dist/images/web/icons/calendar.svg') }}" alt="Ikona, renginių kalendorius">
      </span>
    </div>

    <div class="calendar_wrapper">
      <div id="calendarContainer" class="calendar__container">
        @include('web.home.partials.calendar')
      </div>
    </div>

  </div>
  <div class="section-title">
    <h2>Naujienos ir įvykiai</h2>
  </div>
  <div class="section-content">
    <div class="posts owl-carousel posts-carousel">
      
        @foreach($posts as $post)
          <article class="post-container">

            <div class="post-image">
              <img class="owl-lazy"
                src="{{ asset('storage_old/posts/' . $post->image) }}"
                data-src="{{ asset('storage_old/posts/' . $post->image) }}"
                alt="{{ $post->title }}">
            </div>
            <div class="post-details">
              <div class="middle-row">
                <h3 class="title"><a href="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}">{{ $post->title }}</a></h3>
              </div>
              <div class="bottom-row">
                <a href="{{ url('naujienos/' . $post->category->slug . '/') }}" class="post-category">#{{ $post->category->name }}</a>
                <a href="{{ url('naujienos/' . $post->category->slug . '/' . $post->slug) }}" class="post-link">Skaityti <img src="././dist/images/web/arrow-read.png" alt="Skaityti straipsnį"></a>
              </div>
            </div>

          </article>
        @endforeach
    </div>

    <div class="button-container">
      <h4><a href="{{ route('news.page') }}" class="button button--all">Visos naujienos</a></h4>
    </div>


    <div class="hideFrom768" style="margin-top: 25px;text-align: center">
      <div class="advert_logo">REKLAMA</div>
      <div class="ad-list">
          <div class="item">
            @if($homepage_mobile_news_enable)
            <a href="{{ $homepage_mobile_news_ad_url }}" target="_blank">
              <img class="lazyload"
                   src="{{ asset('/storage_old/ad-folder/' . $homepage_mobile_news_ad_image) }}"
                   data-src="{{ asset('/storage_old/ad-folder/' . $homepage_mobile_news_ad_image) }}" alt="Klaipėda Aš Su Tavim, reklama">
            </a>
            @else
              <ins class="adsbygoogle"
                   style="display:inline-block;width:300px;height:250px"
                   data-ad-client="ca-pub-8503410126696629"
                   data-ad-slot="9035454948"></ins>
              <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            @endif
          </div>
      </div>
    </div>

  </div>
</section>
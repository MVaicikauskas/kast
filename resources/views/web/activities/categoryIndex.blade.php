@extends('web.layout.app')

@section('title') 
  <title>Būreliai | Klaipėda aš su Tavim!</title>
@endsection

@section('content')
@include('web.activities.partials.filter-bar')

<section class="section__padding">
  <div class="section-title">
    <h1>
      Būreliai
    </h1>
  </div>

  <div class="section-content">

    <div class="activities-block">

		<!--<div class="infinite-scroll">-->
		<div class="activities-list column column--left infinite-scroll">
				@include('web.activities.partials.list')

				{{ $activities->links() }}
		</div>
		<!--</div>-->

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
    <div class="ad-list column column--right bordered_ad">
      <div class="advert_logo">REKLAMA</div>
      @foreach ($ads as $ad)
        <div class="item">
          <a href="{{ $ad->link }}" target="_blank">
            <img class="lazyload"
              src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}"
              data-src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}">
          </a>
        </div>
      @endforeach
    </div>
@endif
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
  $('.filter__news a[data-category]').on('click', function(e) {
    e.preventDefault()

    const categoryID = $(this).data('category')
    const cat = window.location.pathname.split('/')[2]
    const url = '/bureliu-paieska/' + cat + '/' + categoryID + ''

    $.ajax({
      url: url,
      type: 'GET',
      success: function (data) {
        const html = $(data)
        $('.activities-list').hide().html(html).fadeIn()
        //$('script.reload-on-ajax').remove()//.appendTo('html')// added on 10/10/2019 Kestutis
        window.scrollTo(0, 0);
      }
    })

  })
</script>
@endsection
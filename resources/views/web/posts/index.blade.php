@extends('web.layout.app')

@section('title')
    @if( isset($heading) )
        <title>Naujienos - {{ $heading }} | Klaipėda aš su Tavim!</title>
    @else
        <title>Naujienos | Klaipėda aš su Tavim!</title>
    @endif
@endsection

@section('meta')
    @if( isset($heading) )
        <meta name="description" content="{{ $heading }}. Aktualiausios Vakarų Lietuvos naujienos iš Klaipėdos, Klaipėdos rajono, Palangos, Neringos, Šilutės, Kretingos ir jų rajonų.">
    @else
        <meta name="description" content="Aktualiausios Vakarų Lietuvos naujienos iš Klaipėdos, Klaipėdos rajono, Palangos, Neringos, Šilutės, Kretingos ir jų rajonų.">
    @endif
    <link rel="canonical" href="{{ url()->current() }}" />
@endsection

@section('content')

<button class="catsCollapse">Kategorijos</button>
<ul class="subCats">
    @foreach ($categories as $category)
        <li class="{{ Request::is('naujienos/' . $category->slug) ? 'active' : '' }}"><a class="category__news" href="{{ url('naujienos/' . $category->slug) }}" data-category="{{ $category->id }}">{{ $category->name }}</a></li>
    @endforeach
</ul>
@section('scripts')
<script>
    var coll = document.getElementsByClassName("catsCollapse");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
</script>
@endsection

<section class="section__padding">
  <div class="section-title">
    <h1>
        @if( isset($heading) )
            {{ $heading }}
        @else
            Naujienos
        @endif
    </h1>
  </div>
  <div class="section-content">
    <div class="posts-block">
      <div class="posts-list column column--left">
        @include('web.posts.partials.list')

        {{ $posts->links() }}
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
      @elseif (sizeof($ads) >= 1)
        @include('web.advertisements.index', array('ads' => $ads->slice(0, 3)))
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
    const url = 'naujienu-paieska/' + categoryID

    $.ajax({
      url: url,
      type: 'GET',
      success: function (data) {
        const html = $(data)
        $('.posts-list').hide().html(html).fadeIn()
      }
    })
  })
</script>
@endsection
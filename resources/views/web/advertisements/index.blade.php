
<div class="ad-list column column--right bordered_ad">
  <div class="advert_logo">REKLAMA</div>
  @foreach ($ads as $ad)
    <div class="item">
      <a href="{{ $ad->link }}" target="_blank">
        <img class="lazyload"
          src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}"
          data-src="{{ asset('/storage_old/ad-folder/' . $ad->image) }}"
          alt="Reklama">
      </a>
    </div>
    @if ($loop->first)
      <div class="item add-event hideTo768">
        <a href="/ikelti-rengini">Įkelkite renginį nemokamai</a>
      </div>
    @endif
  @endforeach
</div>
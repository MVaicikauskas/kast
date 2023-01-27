<section class="landing-gallery">
  <div class="section-title">
    <h2>Galerija</h2>
  </div>
  <div class="section-content">
    <div class="gallery block-shadow">
      <div class="grid">

          @foreach($images as $image)
                      @if ($image->image != null) 
                          <a class="grid__item" href="{{ asset('storage_old/gallery/' . $image->image) }}" data-fancybox="gallery" data-caption="Autorius {{ $image->author }}">
                            <div class="item__details">
                              <span>Autorius</span>
                              <h3 class="author">
                                {{ $image->author }}
                              </h3>
                            </div>
                            <img
                              class="lazyload"
                              src="{{ asset('storage_old/gallery/' . $image->image) }}"
                              data-src="{{ asset('storage_old/gallery/' . $image->image) }}"
                              alt="{{ $image->author }} nuotrauka">
                          </a>
                      @endif
                      @if ($image->video != null) 
                          <a class="grid__item" href="{{ asset('storage/gallery/' . $image->video) }}" data-fancybox="gallery" data-caption="Autorius {{ $image->author }}">
                            <div class="item__details">
                              <span>Autorius</span>
                              <h3 class="author">
                                {{ $image->author }}
                              </h3>
                            </div>
                            <div class="video_watermark"></div>
                                <video
                                  class="lazyload"
                                  src="{{ asset('storage/gallery/' . $image->video) }}"
                                  data-src="{{ asset('storage/gallery/' . $image->video) }}"></video>
                          </a>
                      @endif
            @endforeach

      </div>

      <div class="w3-container" style="width: auto; text-align: center;"><a href="/galerija" class="w3-btn w3-ripple w3-teal w3-round">Pamatyti daugiau</a></div>

    </div>
  </div>
</section>

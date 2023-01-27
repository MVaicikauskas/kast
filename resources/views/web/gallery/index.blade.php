@extends('web.layout.app')

@section('title') 
  <title>Foto ir Video galerija | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
  <meta name="description" content="Aukščiausios kokybės fotografijos iš Vakarų Lietuvos –  tai top Klaipėdos krašto nuotraukų ir video hub‘as. Čia vaizdais dalinasi profesionaliausi fotografai ir filmuotojai.">
@endsection

@section('content')
<section class="section_gallery">
   <div class="section-title">
      <h1 style="text-align: center">Galerija</h1>
   </div>
  <div class="section-content">
    <div class="gallery block-shadow">
      <div class="grid">

        {{--<a class="grid__item" href='#'>--}}
        {{--<video loop="" muted="" playsinline="" autoplay="" poster="" src="http://klaipedaassutavim.lt/storage/page/f03dfac6a2adcf5f09d2bdce69f38e7d.mp4"></video>--}}
        {{--</a>--}}
                 
          @foreach($images as $image)
              @if ($image->image != null)
                  <a class="grid__item" href="{{ asset('storage_old/gallery/' . $image->image) }}"
                     data-fancybox="gallery" data-caption="Autorius {{ $image->author }}">
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
                              alt="{{ $image->author }}">
                  </a>
              @endif
              @if ($image->video != null)
                  <a class="grid__item" href="{{ asset('storage/gallery/' . $image->video) }}"
                     data-fancybox="gallery" data-caption="Autorius {{ $image->author }}">
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
    </div>
  </div>
</section>
@endsection

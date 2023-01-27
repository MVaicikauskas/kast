@extends('web.layout.app')

@section('title') 
  <title>Reklama | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
  <meta name="description" content="Permesk savo konkurentus per šoną! Standartinės ir individualiai pritaikytos reklamos paslaugos už geriausią kainą. Malonus ir greitas bendravimas. Pradėk jau šiandien!">
@endsection

@section('content')
<section class="inner-privacy">

  <div class="section-content">
    <div class="inner-page block-shadow">
      <div class="info-container advertisement_page">

          <div class="title-container">
              <h1 class="title">{{ $advertisementPageSettings->Title }}</h1>
          </div>

          
                
                {!! $advertisementPageSettings->Text !!}

          <!-- Image stuff -->
          <div class="row m-b-30">
                     
                      <div class="adverts_image-container">
                        @if(!empty($advertisementPageSettings['Photo']))
                          <span class="delete-item delete-favicon" data-id="{{ $advertisementPageSettings->id }}">
                            
                          </span>
                          <img src="{{ asset('storage_old/adverts/' . $advertisementPageSettings['Photo']) }}" width="100%">
                        @endif
                      </div>
                 
            </div>
          
  

		</div>
    </div>
  </div>
</section>
@endsection

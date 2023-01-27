@extends('web.layout.app')

@section('title') 
  <title>Apie Mus | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
  <meta name="description" content="Ar mes pažįstami? Susipažinkime! Mes laikome „Klaipėda, aš su tavim“ projekto vairą ir spaudžiame “gazą“. Draugaukime!">
@endsection

@section('content')
<section class="about real_about">

  <div class="section-content">
     
        <!-- Padaryti koreguojamą tekstą -->
          <!--<span>KLAIPĖDA AŠ SU TAVIM</span>-->
          <h1>{{ $about_us->Title }}</h1>
          

          <div class="about_us_image-container">
                            @if(!empty($about_us['Photo']))
                              <img src="{{ asset('storage_old/aboutus/' . $about_us['Photo']) }}" width="100%" alt="Klaipėda, aš su tavim komanda, Darius, Monika">
                            @endif
          </div>
          <p>{!! $about_us->Text !!}</p>

         <!-- <span class="follow">Sekite mus:</span> 
            <p></p>
            

            <div class="fb-page" data-href="https://www.facebook.com/Klaipedaassutavim/" data-tabs="" data-width="" data-height="" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">
                <blockquote cite="https://www.facebook.com/Klaipedaassutavim/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Klaipedaassutavim/">Klaipėda, aš su tavim</a></blockquote>
            </div>

            <div class="messenger">
              <a href="http://m.me/Klaipedaassutavim" target="_blank"><img src="{{ asset('storage_old/page/facebook_messenger_782621.png') }}"></a>
            </div>
          -->
          
  </div>

	<!--<div class="section-title block-shadow">
		<h4>
			Susisiekite
    </h4>
    <p>Turite klausimų ar pastebėjimų? <br> Susisiekite išsiųsdami užklausą arba el. paštu <a href="mailto:info@klaipedaassutavim.lt">info@klaipedaassutavim.lt</a></p>
  </div>-->
  


  
</section>
@endsection

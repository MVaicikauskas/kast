@extends('web.layout.app')

@section('title') 
  <title>Kontaktai | Klaipėda aš su Tavim!</title>
@endsection

@section('meta')
  <meta name="description" content="Parašyk mums! Turi idėją, komentarą, problemą ar norėtum pasikalbėti? Pataikei būtent čia! Nekantraujame iš tavęs sulaukti žinutės!">
@endsection

@section('content')
<section class="about section__padding">

  <div class="section-content">
     
            <p>{!! $contact_us->Text !!}</p>

            <span class="follow">Mus galite sekti čia:</span> 
            <p></p>
            

            <div class="fb-page" data-href="https://www.facebook.com/Klaipedaassutavim/" data-tabs="" data-width="" data-height="" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">
                <blockquote cite="https://www.facebook.com/Klaipedaassutavim/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Klaipedaassutavim/">Klaipėda, aš su tavim</a></blockquote>
            </div>

            <div class="messenger">
              <a href="http://m.me/Klaipedaassutavim" target="_blank"><img src="{{ asset('storage_old/page/facebook_messenger_782621.png') }}"></a>
            </div>

           
  </div>

	<div class="section-title block-shadow">
		<h4>
			Susisiekite
    </h4>
    <p>Turite klausimų ar pastebėjimų? <br> Susisiekite išsiųsdami užklausą arba el. paštu <a href="mailto:info@klaipedaassutavim.lt">{{ $contact_us->Email }}</a></p>
    
    <!-- Padaryti veikiančią formą -->
    <div class="row contact_form">
      <!-- @if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
      @endif -->
      
      @if (Session::has('flash_message'))
        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
      @endif

      {{ Form::open(['route' => 'contactForm', 'method' => 'POST']) }}
        <div class="form-group">
          {!! Form::text('fullname', null, array('class' => 'form-control', 'placeholder' => 'Jūsų vardas')) !!}

          @if ($errors->has('fullname'))
            <small class="form-text invalid-feedback alert-danger">*{{ $errors->first('fullname')}}</small>
          @endif

        </div>
        <div class="form-group">
          {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'El. pašto adresas')) !!}

          @if ($errors->has('email'))
            <small class="form-text invalid-feedback alert-danger">*{{ $errors->first('email')}}</small>
          @endif

        </div>
        <div class="form-group">
          {!! Form::text('subject', null, array('class' => 'form-control', 'placeholder' => 'Žinutės tema')) !!}

          @if ($errors->has('subject'))
            <small class="form-text invalid-feedback alert-danger">*{{ $errors->first('subject')}}</small>
          @endif

        </div>
        <div class="form-group">
          <textarea name="message" class="form-control" placeholder="Žinutė"></textarea>

          @if ($errors->has('message'))
            <small class="form-text invalid-feedback alert-danger">*{{ $errors->first('message')}}</small>
          @endif

        </div>

        

        <div class="form-check">
          <input name='accept' class="form-check-input" type="checkbox" value="yes" id="defaultCheck">
          <label class="form-check-label" for="defaultCheck">
          Sutinku, kad nurodytais kontaktai su manimi susisiektų <span>Klaipėda aš su tavim</span> atstovas.
          </label>
        </div>

        <div class="form-group contact_capctha">
					{!! app('captcha')->display($attributes = [], $options = ['lang'=> 'lt']) !!}
        </div>
        
        @if ($errors->has('g-recaptcha-response'))
            <small class="form-text invalid-feedback alert-danger">* Nepamirškite pažymėti, jog esate ne robotas :) </small>
        @endif

				


        <button type="submit" class="btn btn-primary">Siųsti žinutę</button>
      {{ Form::close() }}
    </div>


  </div>
  


  
</section>
@endsection

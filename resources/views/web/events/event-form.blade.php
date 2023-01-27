@extends('web.layout.app')

@section('styles')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/icons/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">


	<link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/css/lib/datepicker/bootstrap-datepicker3.min.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/css/lib/html5-editor/bootstrap-wysihtml5.css') }}">

	<style>
		.textarea_editor {
			height:450px !important;
		}

	</style>

@endsection

@section('content')

<section class="no-m-t">

<div class="section-content">
	<div class="inner-page block-shadow">
		<div class="section-title form-title">
			
			<h1>
				Naujo renginio forma
			</h1>
		</div>

		<div class="event-form">
			 <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
                @endforeach
            </div> 
			@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
			@endif
			{{ Form::open(['route' => 'user.store-event', 'method' => 'POST', 'files' => true]) }}

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('title', 'Renginio pavadinimas') !!} <span class="text-danger">*</span>
						{!! Form::text('title', null, array('class' => 'form-control input-default', 'placeholder' => 'Renginio pavadinimas')) !!}
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('region', 'Regionas') !!} <span class="text-danger">*</span>
						<select name="region_id" class="form-control input-default">
							<option>Pasirinkite regioną</option>
							@foreach($regions as $reg)
								<option value="{{ $reg->id }}">{{ $reg->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('category', 'Kategorija') !!} <span class="text-danger">*</span>
						<select name="category_id" class="form-control input-default">
								<option>Pasirinkite kategoriją</option>
							@foreach($categories as $cat)
								<option value="{{ $cat->id }}">{{ $cat->name }}</option>
							@endforeach
								<option value="15">Kiti</option>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group"> 
					{!! Form::label('date', 'Renginio data') !!} <span class="text-danger">*</span>
							{!! Form::text('date', null, array('class' => 'form-control input-default event-date datepicker', 'placeholder' => 'pasirinkite datą', 'autocomplete' => 'off')) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('start_time', 'Renginio pradžia') !!} <span class="text-danger">*</span>
						{!! Form::text('start_time', null, array('class' => 'form-control input-default start-time', 'placeholder' => 'pasirinkite laiką', 'autocomplete' => 'off')) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('end_time', 'Renginio pabaiga') !!}
						{!! Form::text('end_time', null, array('class' => 'form-control input-default end-time', 'autocomplete' => 'off')) !!}
						<p class="text-muted">
							Neprivalomas laukas.
						</p>
					</div>
				</div>
			</div>

			<!--<div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('alternative_dates', 'Ar renginys turi papildomų datų?') !!}
                  <select id="hasAlternativeDates" name="has_alternative_dates" class="form-control input-default">
                    <option value="no">Ne</option>
                    <option value="yes">Taip</option>
                  </select>
                </div>
              </div>
            </div>-->

           <!-- <div class="alternative-dates">
                <hr>

                <p>#1</p>

				<div class="row">
					<div class="col-md-4">
					<div class="form-group"> 
					{!! Form::label('alt_date_1', 'Renginio data') !!} <span class="text-danger">*</span>
						{!! Form::text('alt_date_1', null, array('class' => 'form-control input-default event-date datepicker', 'autocomplete' => "off")) !!}
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('alt_start_time_1', 'Renginio pradžia') !!} <span class="text-danger">*</span>
						{!! Form::text('alt_start_time_1', null, array('class' => 'form-control input-default start-time', 'autocomplete' => "off")) !!}
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('alt_end_time_1', 'Renginio pabaiga') !!}
						{!! Form::text('alt_end_time_1', null, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
					</div>
					</div>
					<hr>
				</div>

              <hr>

                <p>#2</p>
				<div class="row">
						<div class="col-md-4">
						<div class="form-group"> 
						{!! Form::label('alt_date_2', 'Renginio data') !!} <span class="text-danger">*</span>
							{!! Form::text('alt_date_2', null, array('class' => 'form-control input-default event-date datepicker', 'autocomplete' => "off")) !!}
						</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
							{!! Form::label('alt_start_time_2', 'Renginio pradžia') !!} <span class="text-danger">*</span>
							{!! Form::text('alt_start_time_2', null, array('class' => 'form-control input-default start-time', 'autocomplete' => "off")) !!}
						</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
							{!! Form::label('alt_end_time_2', 'Renginio pabaiga') !!}
							{!! Form::text('alt_end_time_2', null, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
						</div>
						</div>
                
              	</div>

              <hr>
                <p>#3</p>
            <div class="row">
					<div class="col-md-4">
						<div class="form-group"> 
						{!! Form::label('alt_date_3', 'Renginio data') !!} <span class="text-danger">*</span>
							{!! Form::text('alt_date_3', null, array('class' => 'form-control input-default event-date datepicker', 'autocomplete' => "off")) !!}
						</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
							{!! Form::label('alt_start_time_3', 'Renginio pradžia') !!} <span class="text-danger">*</span>
							{!! Form::text('alt_start_time_3', null, array('class' => 'form-control input-default start-time', 'autocomplete' => "off")) !!}
						</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
							{!! Form::label('alt_end_time_3', 'Renginio pabaiga') !!}
							{!! Form::text('alt_end_time_3', null, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
						</div>
						</div>
					</div>
              <hr>
            </div>-->





			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('is_free', 'Nemokamas') !!}
						<select name="is_free" class="form-control input-default">
						<option value="no">Mokamas</option>
						<option value="yes">Nemokamas</option>
						</select>
					</div>
				</div>
				<!--<div class="col-md-8">
					<div class="form-group">
						{!! Form::label('excerpt', 'Trumpas aprašymas') !!} <span class="text-danger">*</span>
						{!! Form::text('excerpt', '', array('class' => 'form-control input-default', 'placeholder' => 'Trumpas renginio aprašymas(min. 5 simboliai)')) !!}
					</div>
				</div>-->
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group" >

						{!! Form::label('description', 'Pilnas renginio aprašymas') !!}
						<textarea name="description" class="form-control textarea_editor" rows="15" ></textarea>
					</div>
				</div>
			</div>

			

			<div class="row">
				<div class="col-md-4">
					<div class="form-group image_holder">
						<label>Paveikslėlis</label>

						<label for="image" class="form-control input-default file-container">
							Įkelti paveikslėlį
							{!! Form::file('image', array('class' => 'form-control input-default event_image')) !!}
						</label>


						<p class="text-muted">
							Rekomenduojamas foto dydis 430x285px. Max. dydis 2MB.
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('location', 'Vieta') !!}
						{!! Form::text('location', null, array('class' => 'form-control input-default', 'placeholder' => 'Adresas')) !!}
						<p class="text-muted">
							Neprivalomas laukas.
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('website', 'Nuoroda į renginį') !!}
						{!! Form::text('website', null, array('class' => 'form-control input-default', 'placeholder' => '')) !!}
						<p class="text-muted font-12">
							Neprivalomas laukas. Jei renginys turi savo internetinį puslapį, galite jį nurodyti čia.
						</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('ticket_link', 'Nuoroda, kur  nusipirkti bilietus') !!}
						{!! Form::text('ticket_link', null, array('class' => 'form-control input-default', 'placeholder' => '')) !!}
						<p class="text-muted font-12">
							Neprivalomas laukas. Jei renginys mokamas, nurodykite kur galima nusipirkti bilietus.
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('facebook_link', 'Facebook nuoroda') !!}
						{!! Form::text('facebook_link', null, array('class' => 'form-control input-default', 'placeholder' => '')) !!}
						<p class="text-muted font-12">
							Neprivalomas laukas. Nuoroda į renginio Facebook puslapį.
						</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('user_email', 'El. paštas') !!} <span class="text-danger">*</span>
						{!! Form::text('user_email', null, array('class' => 'form-control input-default', 'placeholder' => 'El. pašto adresas')) !!}
						<p class="text-muted font-12">
							Reikalingas, norint susisiekti su Jumis, kilus neaiškumams dėl renginio. Viešai skelbiamas nebus.
						</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<!--{!! Form::captcha() !!}-->
					{!! app('captcha')->display($attributes = [], $options = ['lang'=> 'lt']) !!}
				</div>
			</div>
			
			<div class="row m-t-20">
				<div class="col-md-12">
					<button type="submit" class="create"><i class="fa fa-check"></i>&nbsp;Įkelti</button>
					<button type="reset" class="reset">Išvalyti</button>
				</div>
			</div>

			@csrf
			{{ Form::close() }}

			<p class="form-message">
				Kilus neaiškumams, prašome susisiekti: <a href="mailto:renginiai@klaipedaassutavim.lt">INFO@KLAIPEDAASSUTAVIM.LT</a>
			</p>
		</div>
	</div>
</div>
</section>

@endsection

@section('scripts')
 	<script src="{{ asset('dist/dashboard/js/lib/bootstrap/popper.min.js') }}"></script>
	<script src="{{ asset('dist/dashboard/js/lib/bootstrap/bootstrap.min.js') }}"></script>
	 
	<script src="{{ asset('dist/dashboard/js/lib/datepicker/bootstrap-datepicker.min.js') }}"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<script src="{{ asset('dist/dashboard/js/lib/html5-editor/wysihtml5-0.3.0.js') }}"></script>
	<script src="{{ asset('dist/dashboard/js/lib/html5-editor/bootstrap-wysihtml5.js') }}"></script>
	<script src="{{ asset('dist/dashboard/js/lib/html5-editor/wysihtml5-init.js') }}"></script>

	<script>
		$(function() {

			$('.event-date').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
			});

			$('.start-time, .end-time').timepicker({
				timeFormat: 'HH:mm',
				dynamic: false,
			});

		});
	</script>
	<script>
			$("input").change(function(e) {

				if (e.originalEvent != null && e.originalEvent.srcElement.files != null){
						for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
							
							var file = e.originalEvent.srcElement.files[i];
							
							var img = document.createElement("img");
							var reader = new FileReader();
							reader.onloadend = function() {
								img.src = reader.result;
							}
							reader.readAsDataURL(file);
							$(".file-container").after(img);
						}
				}
			}); 
	</script>

<script>
    $(function() {
      $('#hasAlternativeDates').change(function() {
        var that = $(this)
        var hasAlternativeDates = that.val()

        var alternativeDateRows = $('.alternative-dates')

        if (hasAlternativeDates === 'yes') {
          alternativeDateRows.show()
        } else {
          alternativeDateRows.hide()
        }
      })
    })
  </script>

@endsection
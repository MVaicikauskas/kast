@extends('web.layout.app_new')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/css/lib/datepicker/bootstrap-datepicker3.min.css') }}">
@endsection

@section('content')
	@include('web.posts.partials.breadcrumb_new')

	<section class="main-content">
		<div class="container">
			<div class="row ts-gutter-30">
				<div class="col-lg-8">
					<h1>Naujo renginio forma</h1>
					<div class="event-form">
						<div class="flash-message">
							@foreach (['danger', 'warning', 'success', 'info'] as $msg)
								@if(Session::has('alert-' . $msg))
									<p class="alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg)  !!}
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									</p>
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
									{!! Form::text('title', null, array('class' => 'form-control input-default', 'placeholder' => 'renginio pavadinimas')) !!}
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('region', 'Regionas') !!} <span class="text-danger">*</span>
									<select name="region_id" class="form-control input-default">
										<option value="">pasirinkite regioną</option>
										@foreach($regions as $reg)
											@if( $reg->id == old('region_id') )
												<option value="{{ $reg->id }}" selected>{{ $reg->name }}</option>
											@else
												<option value="{{ $reg->id }}">{{ $reg->name }}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('category', 'Kategorija') !!} <span class="text-danger">*</span>
									<select name="category_id" class="form-control input-default">
										<option value="">pasirinkite kategoriją</option>
										@foreach($categories as $cat)
											@if( $cat->id == old('category_id') )
												<option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
											@else
												<option value="{{ $cat->id }}">{{ $cat->name }}</option>
											@endif
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
									{!! Form::text('date', null, array('class' => 'form-control input-default event-date datepicker', 'placeholder' => 'pasirinkite datą YYYY-MM-DD', 'autocomplete' => 'off', 'pattern' => '\d{4}-\d{2}-\d{2}')) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('start_time', 'Renginio pradžia') !!} <span class="text-danger">*</span>
									{!! Form::text('start_time', null, array('class' => 'form-control input-default start-time', 'placeholder' => 'pasirinkite laiką', 'autocomplete' => 'off', 'pattern' => '\d{1,2}:\d{1,2}')) !!}
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

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									{!! Form::label('description', 'Pilnas renginio aprašymas') !!}
									{!! Form::textarea('description', old('description', ''), array('class' => 'form-control', 'id' => 'eventDescription', 'rows' => 20)) !!}
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
										Rekomenduojamas dydis 730x400px. Max. svoris 2MB.
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
									{!! Form::url('website', null, array('class' => 'form-control input-default', 'placeholder' => 'https://')) !!}
									<p class="text-muted font-12">
										Neprivalomas laukas. Jei renginys turi savo internetinį puslapį, galite jį nurodyti čia. <strong>Įvesti su https://</strong>
									</p>
								</div>
							</div>
						</div>

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

							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('ticket_link', 'Nuoroda, kur  nusipirkti bilietus') !!}
									{!! Form::url('ticket_link', null, array('class' => 'form-control input-default', 'placeholder' => 'https://')) !!}
									<p class="text-muted font-12">
										Neprivalomas laukas. Jei renginys mokamas, nurodykite kur galima nusipirkti bilietus. <strong>Įvesti su https://</strong>
									</p>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('facebook_link', 'Facebook nuoroda') !!}
									{!! Form::url('facebook_link', null, array('class' => 'form-control input-default', 'placeholder' => 'https://')) !!}
									<p class="text-muted font-12">
										Neprivalomas laukas. Nuoroda į renginio Facebook puslapį. <strong>Įvesti su https://</strong>
									</p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('user_email', 'El. paštas') !!} <span class="text-danger">*</span>
									{!! Form::email('user_email', null, array('class' => 'form-control input-default', 'placeholder' => 'El. pašto adresas')) !!}
									<p class="text-muted font-12">
										Reikalingas, norint susisiekti su Jumis, kilus neaiškumams dėl renginio. Viešai
										skelbiamas nebus.
									</p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 text-center">
								{!! app('captcha')->display($attributes = [], $options = ['lang'=> 'lt']) !!}
							</div>
						</div>

						<div class="row mt-20">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary create"><i class="fa fa-check"></i>&nbsp;Įkelti</button>
								<button type="reset" class="btn btn-dark reset">Išvalyti</button>
							</div>
						</div>

						@csrf
						{{ Form::close() }}

						<p class="form-message text-center mt-20">
							Kilus neaiškumams, prašome susisiekti: <a href="mailto:info@klaipedaassutavim.lt?Subject=Dėl reklamos">info@klaipedaassutavim.lt</a>
						</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="sidebar">
						@include('web.layout.widgets.socials')

						<div class="sidebar-widget">
							@include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE_EVENTS'])
						</div>

						@include('web.layout.widgets.news_sidebar')

						@include('web.layout.widgets.tag_sidebar')
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
    <script src="{{ asset('dist/dashboard/js/lib/datepicker/bootstrap-datepicker.min.js') }}" async></script>
    <script src="{{ asset('assets/js/jquery.timepicker.min.js') }}" async></script>
	<script src="{{ asset('dist/ckeditor/ckeditor.js') }}" defer></script>
    <script>
		$(window).on("load", function (e) {
			CKEDITOR.replace('eventDescription', {
				toolbar: [
					[ 'Format', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Blockquote', 'CopyFormatting', 'RemoveFormat',
						'-', 'NumberedList', 'BulletedList', 'Outdent', 'Indent',
						'-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord',
						'-', 'Undo', 'Redo' ],
				]
			});

			!function(a){a.fn.datepicker.dates.lt={days:["Sekmadienis","Pirmadienis","Antradienis","Trečiadienis","Ketvirtadienis","Penktadienis","Šeštadienis"],daysShort:["S","Pr","A","T","K","Pn","Š"],daysMin:["Sk","Pr","An","Tr","Ke","Pn","Št"],months:["Sausis","Vasaris","Kovas","Balandis","Gegužė","Birželis","Liepa","Rugpjūtis","Rugsėjis","Spalis","Lapkritis","Gruodis"],monthsShort:["Sau","Vas","Kov","Bal","Geg","Bir","Lie","Rugp","Rugs","Spa","Lap","Gru"],today:"Šiandien",monthsTitle:"Mėnesiai",clear:"Išvalyti",weekStart:1,format:"yyyy-mm-dd"}}(jQuery);
			const m = new Date();
			const dateString = m.getUTCFullYear() +"-"+ (m.getUTCMonth()+1) +"-"+ m.getUTCDate();

			$('.event-date').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
				language: 'lt',
				startDate: dateString
			});

			$('.start-time, .end-time').timepicker({
				timeFormat: 'HH:mm',
				dynamic: false,
			});
		})
    </script>
    <script>
        $("input").change(function (e) {

            if (e.originalEvent != null && e.originalEvent.srcElement.files != null) {
                for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

                    var file = e.originalEvent.srcElement.files[i];

                    var img = document.createElement("img");
                    var reader = new FileReader();
                    reader.onloadend = function () {
                        img.src = reader.result;
                    }
                    reader.readAsDataURL(file);
                    $(".file-container").after(img);
                }
            }
        });
    </script>
@endsection
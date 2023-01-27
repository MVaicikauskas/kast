@extends('admin.layout.app-admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('dist/dashboard/css/lib/datepicker/bootstrap-datepicker3.min.css') }}">
    <style>
        .alternative-dates {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">New Event</h3></div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">New Event</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-title">
                        <a href="{{ route('events.index') }}" class="btn btn-info m-t-10 m-b-20">
                            Go back
                        </a>

                        <hr>
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))

                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#"
                                                                                                             class="close"
                                                                                                             data-dismiss="alert"
                                                                                                             aria-label="close">&times;</a>
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
                    </div>
                    <div class="card-body">
                        <div class="basic-form">

                            {!! Form::open(['route' => 'events.store', 'method' => 'POST', 'files' => TRUE]) !!}

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('title', 'Title') !!} <span class="text-danger">*</span>
                                        {!! Form::text('title', NULL, array('class' => 'form-control input-default')) !!}
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('category', 'Category') !!} <span class="text-danger">*</span>
                                        <select name="category_id" class="form-control input-default">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('region', 'Region') !!} <span class="text-danger">*</span>
                                        <select name="region_id" class="form-control input-default">
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('date', 'Date') !!} <span class="text-danger">*</span>
                                        {!! Form::text('date', NULL, array('class' => 'form-control input-default event-date', 'autocomplete' => "off", 'pattern' => '\d{4}-\d{2}-\d{2}')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('start_time', 'Start time') !!} <span class="text-danger">*</span>
                                        {!! Form::text('start_time', NULL, array('class' => 'form-control input-default start-time', 'autocomplete' => "off", 'pattern' => '\d{1,2}:\d{1,2}')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('end_time', 'End time') !!}
                                        {!! Form::text('end_time', NULL, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('is_free', 'Free Event') !!}
                                        <select name="is_free" class="form-control input-default">
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('alternative_dates', 'Event has alternative dates?') !!}
                                        <select id="hasAlternativeDates" name="has_alternative_dates"
                                                class="form-control input-default">
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="alternative-dates">
                                <hr>
                                <p>#1</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('alt_date_1', 'Date') !!} <span class="text-danger">*</span>
                                            {!! Form::text('alt_date_1', NULL, array('class' => 'form-control input-default event-date datepicker', 'autocomplete' => "off")) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('alt_start_time_1', 'Start time') !!} <span
                                                    class="text-danger">*</span>
                                            {!! Form::text('alt_start_time_1', NULL, array('class' => 'form-control input-default start-time', 'autocomplete' => "off")) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('alt_end_time_1', 'End time') !!}
                                            {!! Form::text('alt_end_time_1', NULL, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <hr>
                                <p>#2</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('alt_date_2', 'Date') !!} <span class="text-danger">*</span>
                                            {!! Form::text('alt_date_2', NULL, array('class' => 'form-control input-default event-date datepicker', 'autocomplete' => "off")) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('alt_start_time_2', 'Start time') !!} <span
                                                    class="text-danger">*</span>
                                            {!! Form::text('alt_start_time_2', NULL, array('class' => 'form-control input-default start-time', 'autocomplete' => "off")) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('alt_end_time_2', 'End time') !!}
                                            {!! Form::text('alt_end_time_2', NULL, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
                                        </div>
                                    </div>

                                </div>

                                <hr>
                                <p>#3</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('alt_date_3', 'Date') !!} <span class="text-danger">*</span>
                                            {!! Form::text('alt_date_3', NULL, array('class' => 'form-control input-default event-date datepicker', 'autocomplete' => "off")) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('alt_start_time_3', 'Start time') !!} <span
                                                    class="text-danger">*</span>
                                            {!! Form::text('alt_start_time_3', NULL, array('class' => 'form-control input-default start-time', 'autocomplete' => "off")) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('alt_end_time_3', 'End time') !!}
                                            {!! Form::text('alt_end_time_3', NULL, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('description', 'Full description') !!}
                                        {!! Form::textarea('description', old('description', ''), array('class' => 'form-control', 'id' => 'eventDescription', 'rows' => 20)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('image', 'Poster') !!} <span class="text-danger">*</span>
                                        {!! Form::file('image', array('class' => 'form-control input-default')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('media', 'Additional Media (Only Images)') !!}
                                        <span class="text-info file-notice">Can Select Multiple files at once</span>
                                        {!! Form::file('media[]', array('multiple' => TRUE, 'class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('location', 'Location') !!} <span class="text-danger">*</span>
                                        {!! Form::text('location', NULL, array('class' => 'form-control input-default')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('website', 'Website link') !!}
                                        {!! Form::text('website', NULL, array('class' => 'form-control input-default', 'placeholder' => 'http://website.lt')) !!}
                                        <p class="text-muted font-12">
                                            Link to external event website, if it has one.
                                            <br> If not, leave blank
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('ticket_link', 'Link to buy tickets') !!}
                                        {!! Form::text('ticket_link', NULL, array('class' => 'form-control input-default', 'placeholder' => 'http://tiketa.lt')) !!}
                                        <p class="text-muted font-12">
                                            Link to ticket website, if event is paid
                                            <br> If not, leave blank
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('facebook_link', 'Facebook link') !!}
                                        {!! Form::text('facebook_link', NULL, array('class' => 'form-control input-default', 'placeholder' => 'https://facebook.com/')) !!}
                                        <p class="text-muted font-12">
                                            Link to facebook post/page, if it has one.
                                            <br> If not, leave blank
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;Create
                                    </button>
                                    <a href="{{ route('events.index') }}" class="btn btn-info">
                                        Go back
                                    </a>
                                </div>
                            </div>


                            @csrf
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('dist/dashboard/js/lib/datepicker/bootstrap-datepicker.min.js') }}" async></script>
    <script src="{{ asset('assets/js/jquery.timepicker.min.js') }}" async></script>
    <script src="{{ asset('dist/ckeditor/ckeditor.js') }}" defer></script>
    <script>
        $(window).on("load", function (e) {
            CKEDITOR.replace('eventDescription', {
                toolbar: [
                    ['Format', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Blockquote', 'CopyFormatting', 'RemoveFormat',
                        '-', 'NumberedList', 'BulletedList', 'Outdent', 'Indent',
                        '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord',
                        '-', 'Undo', 'Redo'],
                ]
            });

	        !function(a){a.fn.datepicker.dates.lt={days:["Sekmadienis","Pirmadienis","Antradienis","Trečiadienis","Ketvirtadienis","Penktadienis","Šeštadienis"],daysShort:["S","Pr","A","T","K","Pn","Š"],daysMin:["Sk","Pr","An","Tr","Ke","Pn","Št"],months:["Sausis","Vasaris","Kovas","Balandis","Gegužė","Birželis","Liepa","Rugpjūtis","Rugsėjis","Spalis","Lapkritis","Gruodis"],monthsShort:["Sau","Vas","Kov","Bal","Geg","Bir","Lie","Rugp","Rugs","Spa","Lap","Gru"],today:"Šiandien",monthsTitle:"Mėnesiai",clear:"Išvalyti",weekStart:1,format:"yyyy-mm-dd"}}(jQuery);
	        const m = new Date();
	        const dateString = m.getUTCFullYear() +"-"+ (m.getUTCMonth()+1) +"-"+ m.getUTCDate();

	        $('.event-date').datepicker({
		        autoclose: 1,
		        language: 'lt',
		        startDate: dateString
	        });

	        $('.start-time, .end-time').timepicker({
		        timeFormat: 'HH:mm',
		        scrollbar: true,
		        startTime: '12:00',
		        dynamic: false,
	        });
        });
    </script>

    <script>
        $(function () {
            $('#hasAlternativeDates').change(function () {
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
    <script>
        $(function () {
            $('#hasAlternativeCategories').change(function () {
                var that = $(this)
                var hasAlternativeCategories = that.val()

                var alternativeCategoriesRows = $('.alternative-categories')

                if (hasAlternativeCategories === 'yes') {
                    alternativeCategoriesRows.show()
                } else {
                    alternativeCategoriesRows.hide()
                }
            })
        })
    </script>
@endsection
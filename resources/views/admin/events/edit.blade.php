@extends('admin.layout.app-admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('dist/dashboard/css/lib/datepicker/bootstrap-datepicker3.min.css') }}">
    <style>
        .alternative-dates {
            display: none;
        }

        .multiple-files {
            width: 100%;
            height: 150px;

            object-fit: contain;
            border: 1px solid #ccc;
        }

        .file-container {
            position: relative;
        }

        .delete-item {
            position: absolute;
            top: 5px;
            right: 20px;
            cursor: pointer;

            padding: 2px 7px;
            border-radius: 2px;
            background-color: #fff;
            border: 1px solid $ light-grey;

            z-index: 5;
        }
    </style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Update Event</h3></div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Update Event</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-title">
                        <a href="{{ route('events.index') }}" class="btn btn-info">
                            Go back
                        </a>
                        <hr>

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

                            @if(!empty($event->image))
                                <div class="row m-b-20 m-t-20">
                                    <div class="col-md-3">
                                        <h4>Event poster:</h4>
                                        <img src="{{ asset('storage_old/events/' . $event->image) }}" width="100%">
                                    </div>
                                </div>
                            @endif

                            {!! Form::open(['route' => ['events.update', $event->id], 'method' => 'PUT', 'files' => TRUE]) !!}

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('title', 'Name') !!} <span class="text-danger">*</span>
                                        {!! Form::text('title', $event->title, array('class' => 'form-control input-default', 'placeholder' => 'Event title')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('category', 'Category') !!} <span class="text-danger">*</span>
                                        <select name="category_id" class="form-control input-default">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }} "
                                                @if ($event->category_id === $cat->id)
                                                    {{'selected="selected"'}}
                                                        @endif>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('region', 'Region') !!} <span class="text-danger">*</span>
                                        <select name="region_id" class="form-control input-default">
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}"
                                                @if ($event->region_id === $region->id)
                                                    {{'selected="selected"'}}
                                                        @endif
                                                >{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('date', 'Date') !!} <span class="text-danger">*</span>
                                        {!! Form::text('date', $event->date, array('class' => 'form-control input-default event-date', 'placeholder' => '2018-01-01', 'pattern' => '\d{4}-\d{2}-\d{2}')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('start_time', 'Start time') !!} <span class="text-danger">*</span>
                                        {!! Form::text('start_time', $event->start_time, array('class' => 'form-control input-default start-time', 'placeholder' => '12:00', 'pattern' => '\d{1,2}:\d{1,2}')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('end_time', 'End time') !!}
                                        {!! Form::text('end_time', $event->end_time, array('class' => 'form-control input-default end-time')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('is_free', 'Free Event') !!}
                                        <select name="is_free" class="form-control input-default">
                                            <option value="no">No</option>
                                            <option value="yes"
                                                    @if($event->is_free == 1)
                                                    selected="selected"
                                                    @endif>Yes
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('alternative_dates', 'Event has alternative dates?') !!}
                                        <select id="hasAlternativeDates" name="has_alternative_dates"
                                                class="form-control input-default">
                                            <option value="no">No</option>
                                            <option value="yes"
                                                    @if(count($event->alternativeDate) >= 1)
                                                    selected="selected"
                                                    @endif
                                            >Yes
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="alternative-dates">
                                @foreach($event->alternativeDate as $altDate)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('alt_date_' . $loop->iteration, 'Date') !!} <span
                                                        class="text-danger">*</span>
                                                {!! Form::text('alt_date_' . $loop->iteration, $altDate->date, array('class' => 'form-control input-default event-date datepicker', 'autocomplete' => "off")) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('alt_start_time_' . $loop->iteration, 'Start time') !!}
                                                <span class="text-danger">*</span>
                                                {!! Form::text('alt_start_time_' . $loop->iteration, $altDate->start_time, array('class' => 'form-control input-default start-time', 'autocomplete' => "off")) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('alt_end_time_' . $loop->iteration, 'End time') !!}
                                                {!! Form::text('alt_end_time_' . $loop->iteration, $altDate->end_time, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach

                                @if (count($event->alternativeDate) < 3 && count($event->alternativeDate) !== 0)
                                    @for($i = count($event->alternativeDate) + 1; $i <= 4 - count($event->alternativeDate) + 1; $i++)
                                        @php
                                            if ($i === 4) {
                                              break;
                                            }
                                        @endphp

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::label('alt_date_' . $i, 'Date') !!} <span
                                                            class="text-danger">*</span>
                                                    {!! Form::text('alt_date_' . $i, NULL, array('class' => 'form-control input-default event-date datepicker', 'autocomplete' => "off")) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::label('alt_start_time_' . $i, 'Start time') !!} <span
                                                            class="text-danger">*</span>
                                                    {!! Form::text('alt_start_time_' . $i, NULL, array('class' => 'form-control input-default start-time', 'autocomplete' => "off")) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::label('alt_end_time_' . $i, 'End time') !!}
                                                    {!! Form::text('alt_end_time_' . $i, NULL, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endfor
                                @elseif (count($event->alternativeDate) === 0)
                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::label('alt_date_' . $i, 'Date') !!} <span
                                                            class="text-danger">*</span>
                                                    {!! Form::text('alt_date_' . $i, NULL, array('class' => 'form-control input-default event-date datepicker', 'autocomplete' => "off")) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::label('alt_start_time_' . $i, 'Start time') !!} <span
                                                            class="text-danger">*</span>
                                                    {!! Form::text('alt_start_time_' . $i, NULL, array('class' => 'form-control input-default start-time', 'autocomplete' => "off")) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {!! Form::label('alt_end_time_' . $i, 'End time') !!}
                                                    {!! Form::text('alt_end_time_' . $i, NULL, array('class' => 'form-control input-default end-time', 'autocomplete' => "off")) !!}
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endfor
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('description', 'Full description') !!}
                                        {!! Form::textarea('description', old('description', $event->description), array('class' => 'form-control', 'id' => 'eventDescription', 'rows' => 20)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('image', 'Change poster') !!}
                                        {!! Form::file('image', array('class' => 'form-control input-default')) !!}
                                        <p class="text-muted font-12">
                                            Poster will be shown in calendar and in event page
                                            <br> If not provided with any image, will be shown default box.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('location', 'Location') !!}
                                        {!! Form::text('location', $event->location, array('class' => 'form-control input-default', 'placeholder' => 'Event Location')) !!}
                                        <p class="text-muted font-12">
                                            Event location, if it has one
                                            <br> If not, leave blank
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('website', 'Website link') !!}
                                        {!! Form::text('website', $event->website, array('class' => 'form-control input-default', 'placeholder' => 'http://website.lt')) !!}
                                        <p class="text-muted font-12">
                                            Link to external event website, if it has one.
                                            <br> If not, leave blank
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('media', 'Additional Media (Images)') !!}
                                        <span class="text-info file-notice">Can Select Multiple files at once</span>
                                        {!! Form::file('media[]', array('multiple' => TRUE, 'class' => 'form-control')) !!}
                                    </div>
                                </div>
                                @foreach($event->media as $file)
                                    <div class="col-md-2 file-container">
                  <span class="delete-item delete-file" data-id="{{ $file->id }}">
                    <i class="fa fa-trash"></i>
                  </span>
                                        @if(strpos('jpeg,png,jpg,gif,svg', $file->extension))
                                            <img src="{{ asset('storage_old/events/' . $file->name) }}"
                                                 class="multiple-files">
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('ticket_link', 'Link to buy tickets') !!}
                                        {!! Form::text('ticket_link', $event->ticket_link, array('class' => 'form-control input-default', 'placeholder' => 'http://tiketa.lt')) !!}
                                        <p class="text-muted font-12">
                                            Link to ticket website, if event is paid
                                            <br> If not, leave blank
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('facebook_link', 'Facebook link') !!}
                                        {!! Form::text('facebook_link', $event->facebook_link, array('class' => 'form-control input-default', 'placeholder' => 'https://facebook.com/')) !!}
                                        <p class="text-muted font-12">
                                            Link to facebook post/page, if it has one.
                                            <br> If not, leave blank
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-check"></i>&nbsp;Update
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-info">
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

            if ($('#hasAlternativeDates').val() === 'yes') {
                $('.alternative-dates').show()
            }

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
        $('.delete-file').on('click', function () {
            const url = `/admin/events/delete-file/`
            const id = $(this).data('id')

            const item = $(this).closest('.file-container')

            sendDeleteRequest(url, id, item)
        })

        function sendDeleteRequest(url, id, item) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url + id,
                type: 'DELETE',
                data: {
                    'id': id
                }
            })
                .done(() => {
                    item.hide()
                })
        }
    </script>
@endsection
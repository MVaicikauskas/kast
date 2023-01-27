@extends('admin.layout.app-admin')

@section('content')
<div class="row page-titles">
  <div class="col-md-5 align-self-center">
    <h3 class="text-primary">Edit Ad</h3>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
      <li class="breadcrumb-item active">Edit Ad</li>
    </ol>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-title">
          <a href="{{ route('ads.index') }}" class="btn btn-info m-t-10 m-b-20">
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

            {!! Form::open(['route' => ['ads.update', $ad->id], 'method' => 'PUT', 'files' => true]) !!}

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('title', 'Pavadinimas') !!}
                  {!! Form::text('title', $ad->title, array('class' => 'form-control input-default disabled', 'disabled')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group ">
                  @php
                    $status_class_list = 'form-control input-default status-' . $ad->status
                  @endphp
                  {!! Form::label('status', 'Būsena') !!}
                  {!! Form::select(
                                'status',
                                array('0' => 'Off', '1' => 'On'),
                                $ad->status,
                                array('class' => $status_class_list, 'id' => 'ad-status')
                                ) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('type', 'Tipas') !!}
                  {!! Form::select(
                            'type',
                            array('image' => 'Paveikslėlis su nuoroda', 'google' => 'Google Ads', 'custom' => 'Individualus HTML' ),
                            $ad->type,
                            array('class' => 'form-control input-default', 'id' => 'type-select')
                  ) !!}
                </div>
              </div>
            </div>

            <div class="row ad-type" id="ad-image">
              <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('link', 'Tipas: Paveikslėlis su nuoroda') !!}
                    {!! Form::text('link', $ad->link, array('class' => 'form-control input-default')) !!}
                  </div>
                </div>
              <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('image', 'Paveikslėlis') !!}
                    {!! Form::file('image', array('class' => 'form-control')) !!}
                  </div>
                  <a id="ad-images-list-open" class="btn btn-outline-info btn-sm">Pasirinkti iš galerijos</a>
                  <div class="ad-images-list" style="display:none; max-height: 200px; overflow-y: scroll; border-bottom: 1px solid; margin-bottom: 10px">
                  <ul style="padding-left: 1.2em;">
                    @foreach(File::glob(public_path('storage_old/ad-folder/').'/*') as $path)
                      <li style="font-size: 0.8em; margin-bottom: 3px; cursor: pointer; list-style: circle" id="ad-image-loop-{{ $loop->index }}">
                        <img src="{{ str_replace(public_path(), '', $path) }}" style="width: 150px;" loading="lazy" onclick="setImage('{{pathinfo($path, PATHINFO_BASENAME)}}')">
                        <p style="display: inline">{{ pathinfo($path, PATHINFO_BASENAME) }} <i class="fa fa-times" style="color:red" onclick="deleteFile('{{pathinfo($path, PATHINFO_BASENAME)}}', {{ $loop->index }})"></i></p>
                      </li>
                    @endforeach
                  </ul>
                  <input type="hidden" name="old_image" id="old_image_value">
                </div>

                  @if(!empty($ad->image))
                    <div class="row m-b-20 m-t-20">
                      <div class="col-12" style="overflow: auto; max-height: 1000px;max-width: 1000px">
                        <p id="ad-list-selected-image-name">{{ asset('storage_old/ad-folder/' . $ad->image) }}</p>
                        <img id="ad-list-selected-image" src="{{ asset('storage_old/ad-folder/' . $ad->image) }}" style="width: auto; height: auto">
                      </div>
                    </div>
                  @endif
                </div>
            </div>

            <div class="row ad-type" id="ad-google">
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('google', 'Tipas: Google Ads') !!}
                  {!! Form::textarea('google', $ad->google, array( 'class' => 'form-control input-default', 'rows' => 5, 'style' => 'height:auto')) !!}
                </div>
              </div>
            </div>

            <div class="row ad-type" id="ad-custom">
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('custom', 'Tipas: Individualus HTML kodas') !!}
                  {!! Form::textarea('custom', $ad->custom, array( 'class' => 'form-control input-default', 'rows' => 5, 'style' => 'height:auto')) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('comments', 'Privatūs komentarai') !!}
                  {!! Form::textarea('comments', $ad->comments, array( 'class' => 'form-control input-default', 'rows' => 2, 'style' => 'height:auto')) !!}
                </div>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-4">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </div>
            @csrf
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-title">
          <h3>Google Ads reklamų kodai</h3>
        </div>
        <div class="card-body">
          <h4>Viršus (fiksuota 728x90px, HEADER_RE)</h4>
          <xmp>
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-8503410126696629"
                 data-ad-slot="4818881794"></ins>
          </xmp>
          <h4>Straipsnių viršuje (tik mobiliame, prisitaikantis, POST_MOBILE_RE)</h4>
          <xmp>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-8503410126696629"
                 data-ad-slot="4455919718"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
          </xmp>
          <h4>Straipsnių viduje (didelis, POST_*_RE)</h4>
          <xmp>
            <ins class="adsbygoogle" style="display:block; text-align:center;"
                    data-ad-layout="in-article"
                    data-ad-format="fluid"
                    data-ad-client="ca-pub-8503410126696629"
                    data-ad-slot="5497538644"></ins>
          </xmp>
          <h4>Po straipsniu / kategorijoje (didelis, priderintas pagal turinį, CATEGORY_RE)</h4>
          <xmp>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-format="autorelaxed"
                 data-ad-client="ca-pub-8503410126696629"
                 data-ad-slot="1825886946"></ins>
          </xmp>
          <h4>Pradinis po renginiais (didelis, prisitaikantis HOME_LEADERBORD_RE)</h4>
          <xmp>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-8503410126696629"
                 data-ad-slot="6974271844"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
          </xmp>
          <h4>Pradinis mobiliame (fiksuotas 300x250px HOME_MOBILE_RE)</h4>
          <xmp>
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:250px"
                 data-ad-client="ca-pub-8503410126696629"
                 data-ad-slot="9567456222"></ins>
          </xmp>
          <h4>Šoninė juosta (fiksuotas 300x250px SIDEBAR_RE)</h4>
          <xmp>
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:250px"
                 data-ad-client="ca-pub-8503410126696629"
                 data-ad-slot="8399034151"></ins>
          </xmp>
          <h4>Puslapio apačioje (prisitaikantis FOOTER_RE)</h4>
          <xmp>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-8503410126696629"
                 data-ad-slot="7930940920"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
          </xmp>
          <h4>Puslapio apačioje prilipęs (fiksuotas dydis 300x50px, pavadinimas BOTTOM_FIXED, matomas tik telefonuose iki 768px)</h4>
          <xmp>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-8503410126696629"
                 data-ad-slot="2890180853"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
          </xmp>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('styles')
  <style>
    .status-0 {
      background-color: #f17272;
    }
    .status-1 {
      background-color: #60e560;
    }
  </style>
@endsection
@section('scripts')
  <script>
    const ad_list_block_btn = $('#ad-images-list-open');
    const ad_list_block = $('.ad-images-list');

    ad_list_block_btn.on('click', function (){ ad_list_block.toggle(); })

    function setImage(imageName) {
      $('#old_image_value').val(imageName);
      $('#ad-list-selected-image').attr('src', '/storage_old/ad-folder/'+imageName);
      $('#ad-list-selected-image-name').text(imageName);

      ad_list_block.slideUp();
    }

    function deleteFile(imageName, index) {
      let confirm_result = confirm('Ar tikrai visam laikui pašalinti failą '+ imageName +' iš serverio?');
      let url = '{{ route("ads.fileDelete", ":filename") }}';
      url = url.replace(':filename', imageName);

      if(confirm_result) {
        $.get( url, function( data ) {
          if(data === "OK") {
            $('#ad-image-loop-' + index).remove();
          }else {
            console.error(data);
          }
        });
      }
    }

    $("#ad-status").on('change', function() {
      let value = $("#ad-status option:selected").val();
      $(this).removeClass('status-0').removeClass('status-1').addClass('status-'+value);
    });
  </script>
@endsection
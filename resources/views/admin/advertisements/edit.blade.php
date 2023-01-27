@extends('admin.layout.app-admin')

@section('content')
<div class="row page-titles">
  <div class="col-md-5 align-self-center">
    <h3 class="text-primary">Edit Advertisement</h3>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
      <li class="breadcrumb-item active">Edit Advertisement</li>
    </ol>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-title">
          <a href="{{ route('advertisements.index') }}" class="btn btn-info m-t-10 m-b-20">
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
            <h4>Advertisement</h4>

            {!! Form::open(['route' => ['advertisements.update', $ad->id], 'method' => 'PUT', 'files' => true]) !!}

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('client', 'Client') !!} <span class="text-danger">*</span>
                  {!! Form::text('client', $ad->client, array('class' => 'form-control input-default')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('link', 'Link') !!} <span class="text-danger">*</span>
                  {!! Form::text('link', $ad->link, array('class' => 'form-control input-default')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('image', 'Image') !!} <span class="text-danger">*</span>
                  {!! Form::file('image', array('class' => 'form-control')) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('paid', 'Paid') !!}
                  {!! Form::text('paid', $ad->paid, array('class' => 'form-control input-default')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('expire_date', 'Expire Date') !!} <span class="text-danger">*</span>
                  {!! Form::date('expire_date', $ad->expire_date, array('class' => 'form-control input-default')) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                {!! Form::label('category_id', 'Assigned to Page') !!}
                <select name="category_id" class="form-control input-default">
                  @foreach($categories as $cat)
                    <option
                      value="{{ $cat->id }}"
                      @if($cat->id === $ad->category_id)
                        selected="selected"
                      @endif
                    >{{ $cat->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            @if(!empty($ad->image))
            <div class="row m-b-20 m-t-20">
              <div class="col-md-2">
                <h4>Image:</h4>
                <img src="{{ asset('storage_old/ad-folder/' . $ad->image) }}" width="100%">
              </div>
            </div> 
            @endif

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
</div>
@endsection
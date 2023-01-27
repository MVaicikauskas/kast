@extends('admin.layout.app-admin')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">New category</h3></div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Posts</li>
                <li class="breadcrumb-item">Categories</li>
                <li class="breadcrumb-item active">Add new</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-title">
                        <a href="{{ route('categories.index') }}" class="btn btn-info m-t-10 m-b-20">
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

                            {!! Form::open(['route' =>'categories.store', 'method' => 'POST']) !!}

                            <div class='row'>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!} <span class="text-danger">*</span>
                                        {!! Form::text('name', null, array('class' => 'form-control input-default')) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('slug', 'Slug / nuoroda, tarpai bus pakeisti į brūkšnelį (-), vėliau keisti nebus galima!') !!}
                                        <span class="text-danger">*</span>
                                        {!! Form::text('slug', null, array('class' => 'form-control input-default')) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::label('excerpt', 'Excerpt') !!}
                                        {!! Form::textarea('excerpt', null, array('class' => 'form-control input-default', 'rows' => 5, 'style' => 'height:auto')) !!}
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Save</button>
                            @csrf
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
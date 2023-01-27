@extends('admin.layout.app-admin')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Edit tag</h3></div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Posts</li>
                <li class="breadcrumb-item">Tags</li>
                <li class="breadcrumb-item">Edit tag</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-title">
                        <a href="{{ route('tags.index') }}" class="btn btn-info m-t-10 m-b-20">
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

                            {!! Form::open(['route' => ['tags.update', $tag->id], 'method' => 'POST']) !!}

                            <div class='row'>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('title', 'Title') !!} <span class="text-danger">*</span>
                                        {!! Form::text('title', $tag->title, array('class' => 'form-control input-default')) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('slug', 'Slug / nuoroda, keisti negalima!') !!}
                                        <span class="text-danger">*</span>
                                        {!! Form::text('', $tag->slug, array('class' => 'form-control input-default disabled', 'disabled')) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::label('short_description', 'Short description, 300-500 or more symbols') !!}
                                        {!! Form::textarea('short_description', $tag->short_description, array('class' => 'form-control input-default', 'rows' => 5, 'style' => 'height:auto')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('seo_title', 'SEO title, recommended 30-65 characters') !!}
                                        {!! Form::text('seo_title', $tag->seo_title, array('class' => 'form-control input-default')) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('seo_description', 'SEO description, recommended 120 - 320 characters') !!}
                                        {!! Form::textarea('seo_description', $tag->seo_description, array('class' => 'form-control input-default', 'rows' => 3, 'style' => 'height:auto')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::label('comments', 'Comments') !!}
                                        {!! Form::text('comments', $tag->comments, array('class' => 'form-control input-default')) !!}
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Save</button>
                            @method('put')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
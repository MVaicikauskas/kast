@extends('admin.layout.app-admin')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Privacy page info</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Privacy</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Privacy information</h4>

                        <hr>

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
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => ['privacy.update'], 'method' => 'PUT']) !!}

                            <div class="form-group">
                                {!! Form::label('title', 'Privacy title') !!} <span class="text-danger">*</span>
                                {!! Form::text('title', $privacy['title'], array('class' => 'form-control input-default')) !!}
                            </div>

                            <div class='row'>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('about_us', 'Privacy content') !!} <span class="text-danger">*</span>
                                        {!! Form::textarea('about_us', $privacy->about_us, array('class' => 'form-control','id' => 'about_us', 'rows' => 15)) !!}
                                        <p class="text-muted m-b-15 font-12">No images allowed.</p>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning btn-md">Save</button>
                            @csrf
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    //CKeditor
    document.addEventListener("DOMContentLoaded", function(event) {
        CKEDITOR.replace('about_us');
    });
</script>
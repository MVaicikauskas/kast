@extends('admin.layout.app-admin')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/css/lib/html5-editor/bootstrap-wysihtml5.css') }}">

	<style>
		.textarea_editor {
			height:450px !important;
		}
	</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">New Image</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">New Image</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-title">				
				<a href="{{ route('gallery.index') }}" class="btn btn-info m-t-10 m-b-20">
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
					<h4>Image</h4>
					<br>
					{!! Form::open(['route' =>'gallery.store', 'method' => 'POST', 'files' => true]) !!}

						<div class="form-group">
							{!! Form::label('author', 'Author') !!} <span class="text-danger">*</span>
							{!! Form::text('author', null, array('class' => 'form-control input-default')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('image', 'Image') !!} 
							{!! Form::file('image', array('class' => 'form-control')) !!}
						</div>

						<div class="form-group">
									{!! Form::label('video', 'Video') !!} 
									{!! Form::file('video', array('class' => 'form-control input-default')) !!}
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
@extends('admin.layout.app-admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Edit category</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Edit category</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-title">
				<h4>Edit category</h4>
				
				<br>
				<a href="{{ route('event-category.index') }}" class="btn btn-info m-t-10 m-b-20">
					Go back
				</a>


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
					
					{!! Form::open(['route' => ['event-category.update', $cat->id], 'method' => 'PUT']) !!}

						<div class="form-group">
							{!! Form::label('name', 'Name') !!} <span class="text-danger">*</span>
							{!! Form::text('name', $cat->name, array('class' => 'form-control input-default')) !!}
						</div>


						<div class="form-group">
							{!! Form::label('excerpt', 'Excerpt') !!}
							{!! Form::text('excerpt', $cat->excerpt , array('class' => 'form-control input-default')) !!}
						</div>


						 <button type="submit" class="btn btn-warning">Update</button>
						 @csrf
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
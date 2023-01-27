@extends('admin.layout.app-admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Social Media</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Social</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-title">
				<h4>Statistics</h4>
				<hr>
				@if(Session::has('alert-success'))
				<div class="flash-message">
					<p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
				</div>
				@endif

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
					<p class="text-muted m-b-15 font-12">Enter newest stats of social media account, this info is stored in CACHE for 14 days, after that time values from these database fields are taken again.<br>
						If you save this form, then cache for stats is cleared.<br>
						Values are rounded to thousands ex.: 13 tūkst.
					</p>
					{!! Form::open(['route' => ['social.update', $social['id']], 'method' => 'PUT']) !!}

						<div class="form-group">
							{!! Form::label('facebook', 'Facebook') !!}
							{!! Form::number('facebook', $social['facebook'], array('class' => 'form-control input-default')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('instagram', 'Instagram') !!}
							{!! Form::number('instagram', $social['instagram'], array('class' => 'form-control input-default')) !!}
						</div>

{{--						<div class="form-group">--}}
{{--							{!! Form::label('youtube', 'YouTube') !!}--}}
{{--							{!! Form::number('youtube', $social['youtube'], array('class' => 'form-control input-default')) !!}--}}
{{--						</div>--}}

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
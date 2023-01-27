@extends('admin.layout.app-admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">New Category</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">New Category</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-title">
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
					
					{!! Form::open(['route' =>'event-category.store', 'method' => 'POST']) !!}

						<div class="form-group">
							{!! Form::label('name', 'Name') !!} <span class="text-danger">*</span>
							{!! Form::text('name', null, array('class' => 'form-control input-default')) !!}
						</div>


						<div class="form-group">
							{!! Form::label('excerpt', 'Excerpt') !!}
							{!! Form::text('excerpt', null, array('class' => 'form-control input-default')) !!}
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-success">Insert</button>
									 <a href="{{ route('event-category.index') }}" class="btn btn-info">
										Go back
									</a>
								</div>
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
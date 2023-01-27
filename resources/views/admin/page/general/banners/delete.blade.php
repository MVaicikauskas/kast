@extends('admin.layout.app-admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Delete banner</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Delete banner</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-title">
					
					<h4>Are you sure you want to delete <strong>{{ $banner->name }}</strong></h4>

				</div>

				<div class="card-body">
					{{ Form::open([
						'route' => ['banner.destroy', $banner->id],
						'method' => 'DELETE',
						'style' => 'display:inline-block'
						]) }}
						<button class="btn btn-danger">I'm sure</button>
					{{ Form::close() }}
					<a href="{{ route('banner.index') }}" class="btn btn-info">No, go back</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
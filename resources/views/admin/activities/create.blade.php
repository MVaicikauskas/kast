@extends('admin.layout.app-admin')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/css/lib/html5-editor/bootstrap-wysihtml5.css') }}">

	<style>
		.textarea_editor {
			height: 300px !important;
		}
    .file-notice {
      font-size: 12px;
    }
	</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">New Activity</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">New Activity</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-title">				
				<a href="{{ route('activities.index') }}" class="btn btn-info m-t-10 m-b-20">
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
					{!! Form::open(['route' =>'activities.store', 'method' => 'POST', 'files' => true]) !!}

						<div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('name', 'Name') !!} <span class="text-danger">*</span>
                  {!! Form::text('name', null, array('class' => 'form-control input-default')) !!}
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('category', 'Category') !!} <span class="text-danger">*</span>
									<select name="category_id" class="form-control input-default">
										@foreach($categories as $cat)
											<option value="{{ $cat->id }}">{{ $cat->name }}</option>
										@endforeach
									</select>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('subcategory', 'Subcategory') !!} <span class="text-danger">*</span>
									<select name="subcategory_id" class="form-control input-default">
										@foreach($subcategories as $subcat)
											<option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
										@endforeach
									</select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('region', 'Region') !!} <span class="text-danger">*</span>
									<select name="region_id" class="form-control input-default">
										@foreach($regions as $region)
											<option value="{{ $region->id }}">{{ $region->name }}</option>
										@endforeach
									</select>
                </div>
              </div>
            </div>

						<div class="form-group">
							{!! Form::label('excerpt', 'Excerpt') !!} <span class="text-danger">*</span>
							{!! Form::text('excerpt', null, array('class' => 'form-control input-default')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('description', 'Description') !!} <span class="text-danger">*</span>
							{!! Form::text('description', null, array('class' => 'form-control textarea_editor', 'rows' => 5)) !!}
            </div>

            <div class="form-group">
							{!! Form::label('image', 'Main Image') !!}
							{!! Form::file('image', array('class' => 'form-control')) !!}
            </div>
            
            <div class="form-group">
              {!! Form::label('media', 'Additional Media (Images, Video)') !!}
              <span class="text-info file-notice">Can Select Multiple files at once</span>
							{!! Form::file('media[]', array('multiple' => true, 'class' => 'form-control')) !!}
						</div>
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('address', 'Address') !!} <span class="text-danger">*</span>
                  {!! Form::text('address', null, array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('facebook_link', 'Facebook Link') !!}
                  {!! Form::text('facebook_link', null, array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('website', 'Website') !!}
                  {!! Form::text('website', null, array('class' => 'form-control')) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('email', 'Contact Email') !!} <span class="text-danger">*</span>
                  {!! Form::text('email', null, array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('phone', 'Contact Phone') !!} <span class="text-danger">*</span>
                  {!! Form::text('phone', null, array('class' => 'form-control')) !!}
                </div>
              </div>
            </div>

						<div class="row">
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

@section('scripts')
	<script src="{{ asset('dist/dashboard/js/lib/html5-editor/wysihtml5-0.3.0.js') }}"></script>
	<script src="{{ asset('dist/dashboard/js/lib/html5-editor/bootstrap-wysihtml5.js') }}"></script>
	<script src="{{ asset('dist/dashboard/js/lib/html5-editor/wysihtml5-init.js') }}"></script>
@endsection
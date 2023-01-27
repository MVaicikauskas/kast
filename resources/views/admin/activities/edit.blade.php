@extends('admin.layout.app-admin')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/css/lib/html5-editor/bootstrap-wysihtml5.css') }}">

	<style>
		.textarea_editor {
			height: 300px !important;
		}

    .multiple-files {
      width: 100%;
      height: 150px;

      object-fit: contain;
      border: 1px solid #ccc;
    }

    .file-container {
      position: relative;
    }

    .delete-item {
      position: absolute;
      top: 5px;
      right: 20px;
      cursor: pointer;

      padding: 2px 7px;
      border-radius: 2px;
      background-color: #fff;
      border: 1px solid $light-grey;

      z-index: 5;
    }

	</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Edit Activity</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Edit Activity</li>
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
					{!! Form::open(['route' => ['activities.update', $activity->id], 'method' => 'PUT', 'files' => true]) !!}

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('name', 'Name') !!} <span class="text-danger">*</span>
                  {!! Form::text('name', $activity->name, array('class' => 'form-control input-default')) !!}
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('category', 'Category') !!} <span class="text-danger">*</span>
                  <select name="category_id" class="form-control input-default">
                    @foreach($categories as $cat)
                      <option value="{{ $cat->id }}"
                        @if ($activity->category->id === $cat->id)
                          {{'selected="selected"'}}
                        @endif
                      >{{ $cat->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('subcategory', 'Subcategory') !!} <span class="text-danger">*</span>
                  <select name="subcategory_id" class="form-control input-default">
                    @foreach($subcategories as $subcat)
                      <option value="{{ $subcat->id }}"
                        @if ($activity->subcategory->id === $subcat->id)
                          {{'selected="selected"'}}
                        @endif
                        >{{ $subcat->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('region', 'Region') !!} <span class="text-danger">*</span>
                  <select name="region_id" class="form-control input-default">
                    @foreach($regions as $region)
                      <option value="{{ $region->id }}"
                        @if ($activity->region->id === $region->id)
                          {{'selected="selected"'}}
                        @endif
                        >{{ $region->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('excerpt', 'Excerpt') !!} <span class="text-danger">*</span>
                  {!! Form::text('excerpt', $activity->excerpt, array('class' => 'form-control input-default')) !!}
                </div>
              </div>
            </div>

						<div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('description', 'Description') !!} <span class="text-danger">*</span>
                  {!! Form::text('description', $activity->description, array('class' => 'form-control textarea_editor', 'rows' => 15)) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  @if(!empty($activity->image))
                    <img src="{{ asset('storage_old/activities/' . $activity->image) }}" width="100%">
                  @else
                    <p>No Image Added</p>
                  @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('image', 'Replace image') !!}
                  {!! Form::file('image', array('class' => 'form-control')) !!}
                </div>
              </div>
            </div>

            <div class="row mb-5">
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('media', 'Additional Media (Images, Video)') !!}
                  <span class="text-info file-notice">Can Select Multiple files at once</span>
                  {!! Form::file('media[]', array('multiple' => true, 'class' => 'form-control')) !!}
                </div>
              </div>
              @foreach($activity->media as $file)
                <div class="col-md-2 file-container">
                  <span class="delete-item delete-file" data-id="{{ $file->id }}">
                    <i class="fa fa-trash"></i>
                  </span>
                  @if(strpos('jpeg,png,jpg,gif,svg', $file->extension))
                    <img src="{{ asset('storage_old/activities/' . $file->name) }}" class="multiple-files">
                  @elseif (strpos('mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts', $file->extension))
                    <video src="{{ asset('storage_old/activities/' . $file->name) }}" class="multiple-files" controls></video>
                  @endif
                </div>
              @endforeach
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('address', 'Address') !!}
                  {!! Form::text('address', $activity->address, array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('facebook_link', 'Facebook Link') !!}
                  {!! Form::text('facebook_link', $activity->facebook_link, array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('website', 'Website') !!}
                  {!! Form::text('website', $activity->website, array('class' => 'form-control')) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('email', 'Contact Email') !!} <span class="text-danger">*</span>
                  {!! Form::text('email', $activity->email, array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('phone', 'Contact Phone') !!} <span class="text-danger">*</span>
                  {!! Form::text('phone', $activity->phone, array('class' => 'form-control')) !!}
                </div>
              </div>
            </div>

            <div class="row m-t-20">
							<div class="col-md-12">
								<button type="submit" class="btn btn-warning"><i class="fa fa-check"></i>&nbsp;Update</button>
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
  
  <script>
    $('.delete-file').on('click', function() {
      const url = `/admin/activities/delete-file/`
      const id = $(this).data('id')

      const item = $(this).closest('.file-container')

      sendDeleteRequest(url, id, item)
    })

    function sendDeleteRequest(url, id, item) {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        url: url + id,
        type: 'DELETE',
        data: {
          'id': id
        }
      })
        .done(() => {
          item.hide()
        })
    }
  </script>
@endsection
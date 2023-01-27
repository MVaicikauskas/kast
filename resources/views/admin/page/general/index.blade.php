@extends('admin.layout.app-admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">General page info</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">General</li>
        </ol>
    </div>
</div>

<div class="container-fluid">

<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-title">
				<h4>General information</h4>
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
					{!! Form::open(['route' => ['page.update', $page['id']], 'method' => 'PUT', 'files' => true, 'class' => '']) !!}

						<div class="form-group">
							{!! Form::label('title', 'Site title') !!} <span class="text-danger">*</span>
							{!! Form::text('title', $page['title'], array('class' => 'form-control input-default')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('description', 'Site description') !!} <span class="text-danger">*</span>
							<p class="text-muted m-b-15 font-12">Description should be basic keywords of the site. (Font size on web - 80px)</p>
							{!! Form::text('description', $page['description'], array('class' => 'form-control input-default')) !!}
            </div>
            
						<div class='row'>
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('about_us', 'About Us Text') !!}
                  <p class="text-muted m-b-15 font-12"></p>
                  <textarea name="about_us" class="form-control" style='height: 200px;' rows="10">{{ $page->about_us }}</textarea>
                </div>
              </div>
            </div>

						<div class="row m-b-30">
							<div class="col-sm-1">
								<div class="image-container">
                @if(!empty($page['logo']))
                  <span class="delete-item delete-logo" data-id="{{ $page->id }}">
                    <i class="fa fa-trash"></i>
                  </span>
								  <img src="{{ asset('storage_old/page/' . $page['logo']) }}" width="100%">
				@endif
								</div>
							</div>

							<div class="col-sm-11">
								<div class="form-group">
							
									{!! Form::label('logo', 'Site logo url') !!}
									{!! Form::file('logo', array('class' => 'form-control input-default')) !!}
									<p class="text-muted m-b-15 font-12">Max image size: 1MB</p>
								</div>
							</div>
						</div>

						<div class="row m-b-30">
							<div class="col-sm-1">
								<div class="image-container">
									@if(!empty($page['favicon']))
										<span class="delete-item delete-favicon" data-id="{{ $page->id }}">
											<i class="fa fa-trash"></i>
										</span>
										<img src="{{ asset('storage_old/page/' . $page['favicon']) }}" width="100%">
									@endif
								</div>
							</div>

							<div class="col-sm-11">
								<div class="form-group">
							
									{!! Form::label('favicon', 'Site favicon') !!}
									{!! Form::file('favicon', array('class' => 'form-control input-default')) !!}
								</div>
							</div>
						</div>

						<div class="row m-b-30">
							<div class="col-sm-2">
								<div class="image-container">
                @if(!empty($page['hero_image']))
                  <span class="delete-item delete-image" data-id="{{ $page->id }}">
                    <i class="fa fa-trash"></i>
                  </span>
									<img src="{{ asset('storage_old/page/' . $page['hero_image']) }}" width="100%">
								@endif
								</div>
							</div>

							<div class="col-sm-10">
								<div class="form-group">
							
									{!! Form::label('hero_image', 'Site hero image') !!}
									<p class="text-muted m-b-15 font-12">If no video, image will be shown. However, if using video, add image as fallback to mobile devices</p>
									{!! Form::file('hero_image', array('class' => 'form-control input-default')) !!}
								</div>
							</div>
						</div>
            
            <div class="row mt-5">
              <div class="col-sm-2">
                <div class="form-group">
                  {!! Form::label('show_video', 'Show/Hide Video') !!}
                  {!! Form::checkbox('show_video', 1, (bool)$page['show_video']) !!}
                </div>
              </div>
            </div>
						<div class="row m-b-30">
							<div class="col-sm-2">
								<div class="image-container">
                
								@if(!empty($page['hero_video']))
									<span class="delete-item delete-video" data-id="{{ $page->id }}">
										<i class="fa fa-trash"></i>
									</span>
									
									<video 
										autoplay 
										loop
										muted
										poster=""
										src="{{ asset('storage/page/' . $page['hero_video']) }}"
										width="100%">
									</video>
								@endif
								
								</div>
							</div>

							<div class="col-sm-10">
								<div class="form-group">
									{!! Form::label('hero_video', 'Site hero video') !!}
									<p class="text-muted m-b-15 font-12">Image shown on hero block if no video added</p>
									{!! Form::file('hero_video', array('class' => 'form-control input-default')) !!}
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

@section('scripts')
<script>
  $('.delete-logo').on('click', function() {
    const url = `/admin/page/delete-logo/`
    const id = $(this).data('id')

    sendDeleteRequest(url, id)
  })
  $('.delete-favicon').on('click', function() {
    const url = `/admin/page/delete-favicon/`
    const id = $(this).data('id')

    sendDeleteRequest(url, id)
  })
  $('.delete-image').on('click', function() {
    const url = `/admin/page/delete-image/`
    const id = $(this).data('id')

    sendDeleteRequest(url, id)
  })
  $('.delete-video').on('click', function() {
    const url = `/admin/page/delete-video/`
    const id = $(this).data('id')

    sendDeleteRequest(url, id)
  })

  function sendDeleteRequest(url, id) {
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
  }
</script>
@endsection
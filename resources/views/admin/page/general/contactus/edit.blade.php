@extends('admin.layout.app-admin')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/css/lib/html5-editor/bootstrap-wysihtml5.css') }}">

	<style>
		.textarea_editor {
			height:450px !important;
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
        <h3 class="text-primary">Edit Contact Us Page</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Contact Us Page</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-title">
				<h4>Page Details</h4>
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
					<p class="text-muted m-b-15 font-12">Edit the fields required and hit Save</p>
					

					{!! Form::open(['route' => ['contact_us.update', $contact_us['id']], 'method' => 'PUT']) !!}

						<div class="form-group">
							{!! Form::label('Email', 'Email') !!}
							{!! Form::text('Email', $contact_us['Email'], array('class' => 'form-control input-default')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('Phone', 'Phone') !!}
							{!! Form::text('Phone', $contact_us['Phone'], array('class' => 'form-control input-default')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('Address', 'Address') !!}
							{!! Form::text('Address', $contact_us['Address'], array('class' => 'form-control input-default')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('Text', 'Text') !!} <span class="text-danger">*</span>
							{!! Form::text('Text', $contact_us->Text, array('class' => 'form-control textarea_editor', 'rows' => 15)) !!}
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
	<script src="{{ asset('dist/dashboard/js/lib/html5-editor/wysihtml5-0.3.0.js') }}"></script>
	<script src="{{ asset('dist/dashboard/js/lib/html5-editor/bootstrap-wysihtml5.js') }}"></script>
  <script src="{{ asset('dist/dashboard/js/lib/html5-editor/wysihtml5-init.js') }}"></script>
  
  <script>
      $('.delete-file').on('click', function() {
        const url = `/admin/posts/delete-file/`
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
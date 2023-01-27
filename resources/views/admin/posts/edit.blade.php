@extends('admin.layout.app-admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/css/lib/select2/select2.min.css') }}">
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
        <h3 class="text-primary">Update Post</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Update Post</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-title">				
				<a href="{{ route('posts.index') }}" class="btn btn-info m-t-10 m-b-20">
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

					@if(!empty($post->image))
					<div class="row m-b-20 m-t-20">
						<div class="col-md-3">
							<h4>Post image:</h4>
							<img src="{{ asset('storage_old/posts/' . $post->image) }}" width="100%">
						</div>
					</div>
					@endif

					{!! Form::open(['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
          <div class='row'>
              <div class="col-md-12">
                  <div class="form-group">
                      {!! Form::label('title', 'Title') !!} <span class="text-danger">* <small>If changing Title, update Facebook <a href="https://developers.facebook.com/tools/debug/?q={{ route('post.view', [$post->category->slug, $post->slug]) }}" target="_blank">cache here (new window)</a></small></span>
                    {!! Form::text('title', $post->title, array('class' => 'form-control input-default')) !!}
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!} <span class="text-warning small">Be careful if editing, redirect needed.</span>
                    {!! Form::text('', $post->slug, array('class' => 'form-control input-default disabled', 'disabled' => 'disabled')) !!}
                  </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                {!! Form::label('author', 'Author') !!} <span class="text-danger">If not filled, default author will be used</span>
                {!! Form::text('author', $post->author, array('class' => 'form-control input-default')) !!}
              </div>
            </div>



            <div class="col-md-4">
              <div class="form-group">
                {!! Form::label('category_id', 'Category') !!} <span class="text-danger">*</span>
                <select name="category_id" class="form-control input-default">
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" 
                        @if ($post->category->id === $cat->id)
                              {{'selected="selected"'}}
                        @endif
                        >
                        
                      {{ $cat->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

              <div class="col-md-4">
                  <div class="form-group">
                      {!! Form::label('post_tags', 'Tags') !!}
                      <select name="post_tags[]" class="form-control input-default select2" multiple>
                          @foreach($tags as $id => $tag)
                              <option value="{{ $id }}" {{ (in_array($id, old('post_tags', [])) || $post->post_tag->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('excerpt', 'Excerpt') !!} <span class="text-danger">*</span>
                {!! Form::text('excerpt', $post->excerpt, array('class' => 'form-control input-default')) !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('image', 'Image') !!} <span class="text-danger">*</span>
                {!! Form::file('image', array('class' => 'form-control')) !!}
              </div>
            </div>
          </div>

          <div class="row mb-5">
            <div class="col-md-12">
              <div class="form-group">
                {!! Form::label('media', 'Additional Media (Images)') !!}
                <span class="text-info file-notice">Can Select Multiple files at once</span>
                {!! Form::file('media[]', array('multiple' => true, 'class' => 'form-control')) !!}
              </div>
            </div>
            @foreach($post->media as $file)
              <div class="col-md-2 file-container">
                <span class="delete-item delete-file" data-id="{{ $file->id }}">
                  <i class="fa fa-trash"></i>
                </span>
                @if(strpos('jpeg,png,jpg,gif,svg', $file->extension))
                  <img src="{{ asset('storage_old/posts/' . $file->name) }}" class="multiple-files">
                @endif
              </div>
            @endforeach
              <div class="col-12">
                  <input name="featured" type="checkbox" {{ $post->featured ? 'checked="checked"' : '' }}>
                  {!! Form::label('featured', 'Featured (showing in home page top, desktop only)') !!}
              </div>
              <div class="col-12">
                  <input name="trending" type="checkbox" {{  $post->trending ? 'checked="checked"' : '' }}>
                  {!! Form::label('trending', 'Trending (important news in top bar of every page, from 576px wide screens)') !!}
              </div>
          </div>
            <div class="form-group">
                {!! Form::label('description', 'First Part of the description') !!} <span class="text-danger">*</span>
                {!! Form::textarea('description',isset($post -> description) ? $post -> description : null, array('class' => 'form-control','id' => 'editor', 'rows' => 15)) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description2', 'Second Part of the description') !!}
                {!! Form::textarea('description2', isset($post -> description2) ? $post -> description2 : null, array('class' => 'form-control', 'id' => 'editor2', 'rows' => 15)) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description3', 'Third Part of the description') !!}
                {!! Form::textarea('description3', isset($post -> description3) ? $post -> description3 : null, array('class' => 'form-control', 'id' => 'editor3', 'rows' => 15)) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_description', 'Meta Description') !!}
                {!! Form::textarea('meta_description', isset($post -> meta_description) ? $post -> meta_description : null, array('class' => 'form-control', 'rows' => 2, 'style' => 'height:auto')) !!}
            </div>

            
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('youtube_url', 'Youtube URL') !!}
                    {!! Form::text('youtube_url', $post->youtube_url, array('class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('youtube_main', 'Make Youtube Video Main') !!}
                    <select name='youtube_main' class="form-control">
                      <option value='no'>No</option>
                      <option value='yes'
                        @if($post->youtube_main)
                          selected="selected"
                        @endif
                      >Yes</option>
                    </select>
                  </div>
                </div>
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

@section('scripts')
    <script src="{{ asset('dist/dashboard/js/lib/select2/select2.full.min.js') }}" defer></script>

    <script type="text/javascript">
        //Delete file request
        $('.delete-file').on('click', function () {
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

        //CKeditor
        document.addEventListener("DOMContentLoaded", function(event) {
            var settings = {
                filebrowserUploadUrl: "{{route('posts.storeCKEditorImages', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            };

            CKEDITOR.replace('editor', settings);
            CKEDITOR.replace('editor2', settings);
            CKEDITOR.replace('editor3', settings);
        });

        //Init Select2
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
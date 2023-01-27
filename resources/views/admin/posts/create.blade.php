@extends('admin.layout.app-admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/css/lib/select2/select2.min.css') }}">
	<style>
		.textarea_editor {
			height:450px !important;
		}
	</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">New post</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">New Post</li>
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

					{!! Form::open(['route' =>'posts.store', 'method' => 'POST', 'files' => true]) !!}

            <div class='row'>
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('title', 'Title') !!} <span class="text-danger">*</span>
                  {!! Form::text('title', null, array('class' => 'form-control input-default')) !!}
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('slug', 'Slug') !!} <span class="text-warning">Set your own, or it will be auto generated from title</span>
                  {!! Form::text('slug', null, array('class' => 'form-control input-default')) !!}
                </div>
              </div>
            </div>

						<div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('author', 'Author') !!} <span class="text-danger">If not filled, default author will be used</span>
                  {!! Form::text('author', null, array('class' => 'form-control input-default')) !!}
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('category_id', 'Category') !!} <span class="text-danger">*</span>
                  <select name="category_id" class="form-control input-default">
										@foreach($categories as $cat)
											<option value="{{ $cat->id }}">{{ $cat->name }}</option>
										@endforeach
									</select>
                </div>
              </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('post_tags', 'Tags') !!}
                        <select name="post_tags[]" class="form-control input-default select2" multiple>
                            @foreach($tags as $id => $tag)
                                <option value="{{ $id }}">{{ $tag }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

						<div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('excerpt', 'Excerpt') !!} <span class="text-danger">*</span>
                  {!! Form::text('excerpt', null, array('class' => 'form-control input-default')) !!}
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('image', 'Image') !!} <span class="text-danger">*</span>
                  {!! Form::file('image', array('class' => 'form-control')) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('media', 'Additional Media (Only Images)') !!}
                  <span class="text-info file-notice">Can Select Multiple files at once</span>
                  {!! Form::file('media[]', array('multiple' => true, 'class' => 'form-control')) !!}
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <input name="featured" type="checkbox">
                    {!! Form::label('featured', 'Featured (showing in home page top, from 992px wide scrrens, max showing 3)') !!}
                </div>
                <div class="col-12">
                    <input name="trending" type="checkbox">
                    {!! Form::label('trending', 'Trending (important news in top bar of every page, from 576px wide screens)') !!}
                </div>
            </div>

						<!--<div class="form-group">
							{!! Form::label('description', 'Description') !!} <span class="text-danger">*</span>
							{!! Form::text('description', null, array('class' => 'form-control textarea_editor', 'rows' => 15)) !!}
            </div>-->


            <div class="form-group">
							{!! Form::label('description', 'First Part of the description') !!} <span class="text-danger">*</span>
							{!! Form::textarea('description',null, array('class' => 'form-control', 'id' => 'editor', 'rows' => 15)) !!}
            </div>
            
            <!-- <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('advert_image_1', 'First advert') !!} <span>(970x250px)</span>
                  {!! Form::file('advert_image_1', array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('advert_link_1', 'Advert Link 1') !!} <span >(Example - https://test.com/)</span>
                    {!! Form::text('advert_link_1', null, array('class' => 'form-control input-default')) !!}
                  </div>
              </div>
            </div> -->

            <div class="form-group">
							{!! Form::label('description2', 'Second Part of the description') !!} 
              {!! Form::textarea('description2', null, array('class' => 'form-control', 'id' => 'editor2', 'rows' => 15)) !!} 
            </div>

            <!-- <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('advert_image_2', 'Second advert') !!} <span>(970x250px)</span>
                  {!! Form::file('advert_image_2', array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('advert_link_2', 'Advert Link 2') !!} <span >(Example - https://test.com/)</span>
                    {!! Form::text('advert_link_2', null, array('class' => 'form-control input-default')) !!}
                  </div>
              </div>
            </div> -->

            <div class="form-group">
							{!! Form::label('description3', 'Third Part of the description') !!} 
							{!! Form::textarea('description3', null, array('class' => 'form-control', 'id' => 'editor3', 'rows' => 15)) !!}
            </div>

            <!-- <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('advert_image_3', 'Third advert') !!} <span>(970x250px)</span>
                  {!! Form::file('advert_image_3', array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    {!! Form::label('advert_link_3', 'Advert Link 3') !!} <span >(Example - https://test.com/)</span>
                    {!! Form::text('advert_link_3', null, array('class' => 'form-control input-default')) !!}
                  </div>
              </div>
            </div> -->

            <div class="form-group">
							{!! Form::label('meta_description', 'Meta Description') !!} 
							{!! Form::textarea('meta_description', null, array('class' => 'form-control', 'rows' => 2, 'style' => 'height:auto')) !!}
            </div>


						<div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('youtube_url', 'Youtube URL') !!}
                  {!! Form::text('youtube_url', null, array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('youtube_main', 'Make Youtube Video Main') !!}
                  <select name='youtube_main' class="form-control">
                    <option value='no'>No</option>
                    <option value='yes'>Yes</option>
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
    <script>
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

        $(document).ready(function () {
            //check if slug empty, then generate
            $('input[name="title"]').on('keyup', function () {
                var title = $(this).val();
                title = title.toLowerCase();
                title = title.trim();
                title = title.replace(/['"“„ ]+/g,'-');
                $('input[name="slug"]').val(title);
            });

            //init select lib
            $('.select2').select2();
        });
    </script>

@endsection
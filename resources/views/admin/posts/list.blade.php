@extends('admin.layout.app-admin')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Posts</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Posts</li>
        </ol>
    </div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <a href="{{ route('posts.create') }}" class="btn btn-info m-b-20">Add post</a>
                </div>
                <div class="col-sm-8 text-right">
                    {!! Form::open(['route' => 'posts.index', 'method' => 'GET']) !!}
                    {!! Form::text('search', request()->input('search'), array('class' => 'form-control input-default d-inline', 'placeholder' => 'Paieška', 'style' => 'width:auto')) !!}
                    <button type="submit" class="btn btn-success">Ieškoti</button>
                    @csrf
                    {!! Form::close() !!}
                </div>
                <div class="col-12">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))

                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="table-responsive m-t-20">
                <table class="display nowrap table table-hover table-striped m-b-20" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
  
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->author ?? 'Klaipėda Aš su Tavim' }}</td>
                                <td>
                                    @if($post->featured)
                                        <i class="fa fa-star" title="Featured"></i>
                                    @endif
                                    @if($post->trending)
                                        <i class="fa fa-bolt" title="Trending"></i>
                                    @endif
                                    {{ $post->title }}
                                </td>
                                <td>{{ $post->excerpt }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    @foreach(json_decode($post->post_tag) as $tag)
                                        {{ $tag->title }}
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('post.view', [$post->category->slug, $post->slug]) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-link"></i></a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
            </div>

            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
		</div>
	</div>
</div>


@endsection
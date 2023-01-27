@extends('admin.layout.app-admin')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Posts Categories</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Posts</li>
            <li class="breadcrumb-item active">Categories</li>
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
                    <a href="{{ route('categories.create') }}" class="btn btn-info m-b-20">Add category</a>
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
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Excerpt</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
  
                        @foreach($categories as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->name }}</td>
                                <td>{{ $cat->slug }}</td>
                                <td>{{ $cat->excerpt }}</td>
                                <td>
                                    <a href="{{ route('categorie.view', [$cat->slug]) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-link"></i></a>
                                    <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                    <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Are you sure, delete is permanent?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
            </div>

            {{ $categories->links() }}
        </div>
    </div>
		</div>
	</div>
</div>


@endsection
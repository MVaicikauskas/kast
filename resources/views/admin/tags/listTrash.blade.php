@extends('admin.layout.app-admin')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Posts Tags Trash</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Posts</li>
            <li class="breadcrumb-item active">Tags Trash</li>
        </ol>
    </div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
        <div class="card-body">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
                @endforeach
            </div> 

            <div class="table-responsive m-t-20">
                <table class="display nowrap table table-hover table-striped m-b-20" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Title</th>
                            <th>Short description</th>
                            <th>Comments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
  
                        @foreach($tagstrash as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->title }} <br>({{ $tag->slug }})</td>
                                <td>{{ $tag->short_description }}</td>
                                <td>{{ $tag->comments }}</td>
                                <td>
                                    <a href="{{ route('tags.trash.restore', $tag->id) }}" class="btn btn-warning btn-sm" title="Restore"><i class="fa fa-caret-square-o-up"></i></a>
                                    <form action="{{ route('tags.trash.delete', $tag->id) }}" method="POST" onsubmit="return confirm('Are you sure, delete forever?');" style="display: inline-block;">
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

            {{ $tagstrash->links() }}
        </div>
    </div>
		</div>
	</div>
</div>


@endsection
@extends('admin.layout.app-admin')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Activities</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Activities</li>
        </ol>
    </div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">

                    <a href="{{ route('activities.create') }}" class="btn btn-info m-b-20">New Activity</a>

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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Excerpt</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($activities as $activity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $activity->name }}</td>
                                        <td>{{ $activity->category->name }}</td>
                                        <td>{{ $activity->subcategory->name }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($activity->excerpt, 100, '...') }}</td>
                                        <td>
                                            <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="{{ route('activities.show', $activity->id) }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    {{ $activities->links() }}
                </div>
            </div>
		</div>
	</div>
</div>


@endsection
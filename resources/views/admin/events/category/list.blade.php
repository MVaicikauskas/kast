@extends('admin.layout.app-admin')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Categories</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Categories</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">
                    <h4 class="card-title">Categories</h4>

                    <a href="{{ route('event-category.create') }}" class="btn btn-info">Add category</a>

                    <div class="flash-message m-t-30">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        @endforeach
                    </div>

                    <div class="table-responsive m-t-20">
                        <table class="display nowrap table table-hover table-striped table-bordered m-b-20" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th style="width: 120px; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th style="width: 120px; text-align: center;">Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($categories as $cat)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $cat->name }}</td>
                                    <td>{{ $cat->slug }}</td>
									<td style="text-align: center;">
										<a href="{{ route('event-category.edit', $cat->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
										<a href="{{ route('event-category.show', $cat->id) }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
								</tr>
                                @endforeach
                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

@endsection

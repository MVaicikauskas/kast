@extends('admin.layout.app-admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Banners</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Banners</li>
        </ol>
    </div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">
                    <h4 class="card-title">Banners</h4>

                    <a href="{{ route('banner.create') }}" class="btn btn-info m-b-20">Add banner</a>

                    <div class="table-responsive m-t-20">
                        <table class="display nowrap table table-hover table-striped m-b-20" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
          
                                @foreach($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $banner->name }}</td>
                                        <td>
                                            <a href="{{ $banner->link }}">
                                                <img src="{{ asset('storage/banners/' . $banner->banner) }}" width="80">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('banner.show', $banner->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
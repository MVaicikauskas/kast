@extends('admin.layout.app-admin')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Events</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Events</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">
                    <h4 class="card-title">Unapproved events</h4>

                     <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        @endforeach
                    </div> 

                    <div class="table-responsive m-t-20">
                        <table id="eventTable" class="display nowrap table table-hover table-striped table-bordered m-b-20" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Start time</th>
                                    <th>Location</th>
                                    <th>Recommend</th>
                                    <th>Approve</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Event</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Start time</th>
                                    <th>Location</th>
                                    <th>Recommend</th>
                                    <th>Approve</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                
                                @foreach($events as $e)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $e->title }}</td>
                                        <td>{{ $e->category->name }}</td>
                                        <td>{{ $e->date }}</td>
                                        <td>{{ $e->start_time }}</td>
                                        <td>{{ $e->location }}</td>
                                        <td style="text-align: center;"> 
                                            @if(!$e->recommended)
                                                {{ Form::open([
                                                    'route' => ['event-recommend', $e->id],
                                                    'method' => 'POST',
                                                    'style' => 'display:inline-block'
                                                    ]) }}
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-heart"></i></button>
                                                {{ Form::close() }}
                                            @else
                                                {{ Form::open([
                                                    'route' => ['event-unrecommend', $e->id],
                                                    'method' => 'POST',
                                                    'style' => 'display:inline-block'
                                                    ]) }}
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-heart-broken"></i></button>
                                                {{ Form::close() }}
                                            @endif
                                        </td>
                                        <td style="text-align: center;"> 
                                            {{ Form::open([
                                                'route' => ['event-approve', $e->id],
                                                'method' => 'POST',
                                                'style' => 'display:inline-block'
                                                ]) }}
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-check"></i></button>
                                            {{ Form::close() }}
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('events.edit', $e->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="{{ route('events.show', $e->id) }}" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
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

@section('scripts')
	
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
	$(document).ready( function () {
	    $('#eventTable').DataTable();
	} );
</script>
@endsection
@extends('admin.layout.app-admin')

@section('content')

<div class="row page-titles">
  <div class="col-md-5 align-self-center">
    <h3 class="text-primary">Advertisements</h3>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
      <li class="breadcrumb-item active">Advertisements</li>
    </ol>
  </div>
</div>


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">

          <!-- <a href="{{ route('advertisements.create') }}" class="btn btn-info m-b-20" >New Advertisement</a> -->

          <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close"
                data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
            @endforeach
          </div>

          <div class="table-responsive m-t-20">
            <table class="display nowrap table table-hover table-striped m-b-20" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Client</th>
                  <th>Link</th>
                  <th>Paid</th>
                  <th>Assigned To</th>
                  <th>Expire Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

                @foreach($ads as $ad)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $ad->client }}</td>
                  <td>{{ $ad->link }}</td>
                  <td>{{ $ad->paid }}</td>
                  <td>{{ $ad->categories->name }}</td>
                  <td>{{ $ad->expire_date }}</td>
                  <td>
                    <a href="{{ route('advertisements.edit', $ad->id) }}" class="btn btn-warning btn-sm"><i
                        class="fa fa-pencil-alt"></i></a>
                    <a href="{{ route('advertisements.show', $ad->id) }}" class="btn btn-default btn-sm"><i
                        class="fa fa-trash"></i></a>
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
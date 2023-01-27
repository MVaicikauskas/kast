@extends('admin.layout.app-admin')

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Ads list</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Ads</li>
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
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    </p>
                                @endif
                            @endforeach
                        </div>

                        <p>Reklamos plotų schema: <a href="{{ asset('assets/images/reklamos-plotu-schema.png') }}" target="_blank">reklamos-plotai.png</a></p>

                        <div class="table-responsive m-t-20">
                            <table class="display nowrap table table-hover table-striped m-b-20" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Pavadinimas</th>
                                    <th>Statusas</th>
                                    <th>Tipas</th>
                                    <th>Komentarai</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($ads as $ad)
                                    <tr>
                                        <td>{{ $ad->title }}</td>
                                        <td style="background-color: @if($ad->status) #60e560 @else #f17272 @endif">{{ $ad->status ? "On" : "Off" }}</td>
                                        <td>{{ $ad->type }}</td>
                                        <td>{{ $ad->comments }}</td>
                                        <td>
                                            <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
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
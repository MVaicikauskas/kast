@extends('admin.layout.app-admin')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Advertisement Settings</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Advertisement Settings</li>
        </ol>
    </div>
</div>

<div class="container-fluid">

<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-title">
				<h4>Advertisement Settings</h4>
				<hr>

				<div class="flash-message">
				    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
				    @if(Session::has('alert-' . $msg))

				    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
				    @endif
				    @endforeach
				</div> 

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
        <p class="text-muted">
          <ul>
            <li>All Ads - Will be showing all created ads</li>
            <li>Assigned Ads - Will be showing only Ads which has been assigned to Page</li>
            <li>Google Ads - Will be showing google Ads</li>
            <li>Disabled - No Ads at all will be showing</li>
          </ul>
        </p>
				<div class="basic-form">
					{!! Form::open(['route' => 'advertisement-settings.store', 'method' => 'POST', 'class' => '']) !!}

            {{-- Main Page --}}
            <div class="row">
              <div class="col-md-6">
                <p>Main Page:</p>
                <div class="form-input">
                  <select name='homepage' class="form-control">
                    @foreach ($settings as $setting)
                      @if ($setting->page === 'homepage')
                        <option value='1'
                          @if($setting->option === 1) {{'selected="selected"'}} @endif
                        >Show All Ads</option>
                        <option value='2'
                          @if($setting->option === 2) {{'selected="selected"'}} @endif
                        >Show Assigned Ads</option>
                        <option value='3'
                          @if($setting->option === 3) {{'selected="selected"'}} @endif
                        >Show Google Ads</option>
                        <option value='0'
                          @if($setting->option === 0) {{'selected="selected"'}} @endif
                        >Disable Ads</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            {{-- Events --}}
            <div class="row mt-5">
              <div class="col-md-6">
                <p>Events Page:</p>
                <div class="form-input">
                  <select name='events' class="form-control">
                    @foreach ($settings as $setting)
                      @if ($setting->page === 'events')
                        <option value='1'
                          @if($setting->option === 1) {{'selected="selected"'}} @endif
                        >Show All Ads</option>
                        <option value='2'
                          @if($setting->option === 2) {{'selected="selected"'}} @endif
                        >Show Assigned Ads</option>
                        <option value='3'
                          @if($setting->option === 3) {{'selected="selected"'}} @endif
                        >Show Google Ads</option>
                        <option value='0'
                          @if($setting->option === 0) {{'selected="selected"'}} @endif
                        >Disable Ads</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            {{-- Posts --}}
            <div class="row mt-5">
              <div class="col-md-6">
                <p>Posts Page:</p>
                <div class="form-input">
                  <select name='posts' class="form-control">
                    @foreach ($settings as $setting)
                      @if ($setting->page === 'posts')
                        <option value='1'
                          @if($setting->option === 1) {{'selected="selected"'}} @endif
                        >Show All Ads</option>
                        <option value='2'
                          @if($setting->option === 2) {{'selected="selected"'}} @endif
                        >Show Assigned Ads</option>
                        <option value='3'
                          @if($setting->option === 3) {{'selected="selected"'}} @endif
                        >Show Google Ads</option>
                        <option value='0'
                          @if($setting->option === 0) {{'selected="selected"'}} @endif
                        >Disable Ads</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            {{-- Activities --}}
            <div class="row mt-5">
              <div class="col-md-6">
                <p>Activities Page:</p>
                <div class="form-input">
                  <select name='activities' class="form-control">
                    @foreach ($settings as $setting)
                      @if ($setting->page === 'activities')
                        <option value='1'
                          @if($setting->option === 1) {{'selected="selected"'}} @endif
                        >Show All Ads</option>
                        <option value='2'
                          @if($setting->option === 2) {{'selected="selected"'}} @endif
                        >Show Assigned Ads</option>
                        <option value='3'
                          @if($setting->option === 3) {{'selected="selected"'}} @endif
                        >Show Google Ads</option>
                        <option value='0'
                          @if($setting->option === 0) {{'selected="selected"'}} @endif
                        >Disable Ads</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            {{-- Posts_Inner0 --}}
            <div class="row mt-5">
              <div class="col-md-6">
                <p>Posts Inside Page advert 0:</p>
                <div class="form-input">
                  <select name='posts_inner0' class="form-control">
                    @foreach ($settings as $setting)
                      @if ($setting->page === 'posts_inner0')
                        <option value='1'
                          @if($setting->option === 1) {{'selected="selected"'}} @endif
                        >Show All Ads</option>
                        <option value='2'
                          @if($setting->option === 2) {{'selected="selected"'}} @endif
                        >Show Assigned Ads</option>
                        <option value='3'
                          @if($setting->option === 3) {{'selected="selected"'}} @endif
                        >Show Google Ads</option>
                        <option value='0'
                          @if($setting->option === 0) {{'selected="selected"'}} @endif
                        >Disable Ads</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            {{-- Posts_Inner --}}
            <div class="row mt-5">
              <div class="col-md-6">
                <p>Posts Inside Page advert 1:</p>
                <div class="form-input">
                  <select name='posts_inner' class="form-control">
                    @foreach ($settings as $setting)
                      @if ($setting->page === 'posts_inner')
                        <option value='1'
                          @if($setting->option === 1) {{'selected="selected"'}} @endif
                        >Show All Ads</option>
                        <option value='2'
                          @if($setting->option === 2) {{'selected="selected"'}} @endif
                        >Show Assigned Ads</option>
                        <option value='3'
                          @if($setting->option === 3) {{'selected="selected"'}} @endif
                        >Show Google Ads</option>
                        <option value='0'
                          @if($setting->option === 0) {{'selected="selected"'}} @endif
                        >Disable Ads</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            {{-- Posts_Inner2 --}}
            <div class="row mt-5">
              <div class="col-md-6">
                <p>Posts Inside Page advert 2:</p>
                <div class="form-input">
                  <select name='posts_inner2' class="form-control">
                    @foreach ($settings as $setting)
                      @if ($setting->page === 'posts_inner2')
                        <option value='1'
                          @if($setting->option === 1) {{'selected="selected"'}} @endif
                        >Show All Ads</option>
                        <option value='2'
                          @if($setting->option === 2) {{'selected="selected"'}} @endif
                        >Show Assigned Ads</option>
                        <option value='3'
                          @if($setting->option === 3) {{'selected="selected"'}} @endif
                        >Show Google Ads</option>
                        <option value='0'
                          @if($setting->option === 0) {{'selected="selected"'}} @endif
                        >Disable Ads</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>


            {{-- Posts_Inner3 --}}
            <div class="row mt-5">
              <div class="col-md-6">
                <p>Posts Inside Page advert 3:</p>
                <div class="form-input">
                  <select name='posts_inner3' class="form-control">
                    @foreach ($settings as $setting)
                      @if ($setting->page === 'posts_inner3')
                        <option value='1'
                          @if($setting->option === 1) {{'selected="selected"'}} @endif
                        >Show All Ads</option>
                        <option value='2'
                          @if($setting->option === 2) {{'selected="selected"'}} @endif
                        >Show Assigned Ads</option>
                        <option value='3'
                          @if($setting->option === 3) {{'selected="selected"'}} @endif
                        >Show Google Ads</option>
                        <option value='0'
                          @if($setting->option === 0) {{'selected="selected"'}} @endif
                        >Disable Ads</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

						 <div class="row mt-3">
              <div class="col-md-12">
                <button type="submit" class="btn btn-warning btn-md">Save</button>
              </div>
             </div>

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
<script>
  $('.delete-logo').on('click', function() {
    const url = `/admin/page/delete-logo/`
    const id = $(this).data('id')

    sendDeleteRequest(url, id)
  })
  $('.delete-favicon').on('click', function() {
    const url = `/admin/page/delete-favicon/`
    const id = $(this).data('id')

    sendDeleteRequest(url, id)
  })
  $('.delete-image').on('click', function() {
    const url = `/admin/page/delete-image/`
    const id = $(this).data('id')

    sendDeleteRequest(url, id)
  })
  $('.delete-video').on('click', function() {
    const url = `/admin/page/delete-video/`
    const id = $(this).data('id')

    sendDeleteRequest(url, id)
  })

  function sendDeleteRequest(url, id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      url: url + id,
      type: 'DELETE',
      data: {
        'id': id
      }
    })
  }
</script>
@endsection
@extends('web.layout.app')

@section('title')
  <title>{{ \Illuminate\Support\Str::limit($activity->name, 45, '..') }} | Būreliai - {{ $activity->category->name }} - {{ $activity->subcategory->name }} </title>
@endsection

@section('meta')
  <meta name="description" content="{!! strip_tags(\Illuminate\Support\Str::limit($activity->description, $limit = 160, $end = '...')) !!}">
 
@endsection

<!-- open graph stuff-->
@section('facebook_share_title'){{$activity->name}}
@endsection
@section('facebook_share_url'){{trim(Request::url())}}
@endsection
@section('facebook_share_image'){{trim(asset('storage_old/activities/'.$activity->image))}}
@endsection
@section('facebook_share_description'){{strip_tags($activity->description)}}
@endsection
<!-- end open graph stuff-->

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/dashboard/icons/font-awesome/css/font-awesome.min.css') }}">
@endsection

@section('content')
<section class="no-m-t activity_page">
<div class="section-content">
	<div class="inner-page block-shadow">
		<div class="info-container">
		<!--<a href="{{ route('activities.page') }}">Grįžti</a>-->
		<a href="{{ URL::previous() }}">Grįžti</a>
		
			<div class="title-container">
					<a> {{ $activity->category->name }} / {{ $activity->subcategory->name }}</a>

					<h1 class="title" title="{{ $activity->name }}">
						{{ $activity->name }}
					</h1>
			</div>
			
			<div class="details">

			<div class="poster">
        <img
          class="lazyload"
          src="{{ asset('storage_old/activities/' . $activity->image) }}"
          data-src="{{ asset('storage_old/activities/' . $activity->image) }}"
          alt="{{ $activity->name }}"
        >
			</div>

			<div class="details-info">

				@if(!empty($activity->region))
						<span class="info region" title="Regionas">{{ $activity->region->name }}</span>
					@endif

					@if(!empty($activity->address))
						<span class="info" title="Adresas"><i class="fa fa-map-marker"></i> {{ $activity->address }}</span>
					@endif

					@if(!empty($activity->email))
						<span class="info" title="El. paštas"><i class="far fa-envelope"></i> {{ $activity->email }}</span>
					@endif

					@if(!empty($activity->phone))
						<span class="info" title="Telefonas"><i class="fas fa-mobile-alt"></i> {{ $activity->phone }}</span>
					@endif

				@if(!empty($activity->website))
					<span class="info" title="Būrelio internetinis puslapis">
						<i class="fa fa-link"></i>
						<a href="{{ $activity->website }}" target="_blank" rel="nofollow">
							Internetinis puslapis
						</a>
					</span>
				@endif

				@if(!empty($activity->facebook_link))
					<span class="info" title="Būrelio facebook puslapis">
						<i class="fa fa-facebook"></i>
						<a href="{{ $activity->facebook_link }}" target="_blank" rel="nofollow">
							Facebook puslapis
						</a>
					</span>
				@endif

			</div>
			</div>

			<div class="description">
				<strong>Aprašymas</strong>

				<p>
					{!! $activity->description !!}
				</p>
      </div>
      
      <div class="gallery-container" width="100%">
        @foreach($activity->media as $m)
			<div class="image">
				  <a data-fancybox="gallery" href="{{ asset('storage_old/activities/' . $m->name) }}">
					<img src="{{ asset('storage_old/activities/' . $m->name) }}">
				  </a>
			</div>
        @endforeach
	  </div>
	  
	  <!-- google ads -->
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Straipsniai Horizontalus 1 -->
			<ins class="adsbygoogle"
				style="display:block"
				data-ad-client="ca-pub-8503410126696629"
				data-ad-slot="3039563242"
				data-ad-format="auto"
				data-full-width-responsive="true"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		<!-- end of google ads	 -->
	  
	  <div>
		  
		  <!-- Facebook share -->
		  <!--<div class="fb-share-button" data-href="{{ url()->current() }}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2FKlaipedaassutavim%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><img src="{{ url('/') }}/dist/images/web/email_logo.png" alt="share icon">Dalintis</a></div>
		  -->
		  <!--<div class="facebook_share">
			<a href="https://www.facebook.com/share.php?u={{ url()->current() }}">
				<img src="{{ url('/') }}/dist/images/web/facebook_logo.png" alt="Email" />
			</a>
		  </div>
		 	  
		   Email share-->
		  <!--<div class="email_share">
			<a href="mailto:?subject=Noriu%20Pasidalinti&body={{ url()->current() }}">
				<img src="{{ url('/') }}/dist/images/web/email_logo.png" alt="Email" />
			</a>
		  </div>-->

		  <div class="sharethis-inline-share-buttons"></div>
	  </div>
	  
	  
	</div>
		
		
	</div>
</div>
</section>
@endsection
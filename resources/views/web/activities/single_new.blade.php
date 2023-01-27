@extends('web.layout.app_new')

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

@section('content')
	@include('web.posts.partials.breadcrumb_new')

	<section class="main-content">
		<div class="container">
			<div class="row ts-gutter-30">
				<div class="col-lg-8">
					<div class="single-post single-activity">
						@include('web.layout.widgets.ad_block', ['type' => 'POST_MOBILE_RE'])

						<div class="post-header-area">
							<h1 class="post-title title-lg" title="{{ $activity->name }}">{{ $activity->name }}</h1>
							<ul class="post-meta">
								<li>
									<a class="post-cat">{{ $activity->subcategory->name }}</a>
								</li>
								@if(!empty($activity->region))
									<li><i class="fa fa-map"></i><span title="Regionas">{{ $activity->region->name }}</span></li>
								@endif
								@if(!empty($activity->address))
									<li><i class="fa fa-home"></i><span title="Adresas">{{ $activity->address }}</span></li>
								@endif
								@if(!empty($activity->email))
									<li><i class="fa fa-envelope"></i><span title="El.paštas">{{ $activity->email }}</span></li>
								@endif
								@if(!empty($activity->phone))
									<li><i class="fa fa-phone"></i><span title="Telefonas">{{ $activity->phone }}</span></li>
								@endif
								@if(!empty($activity->website))
									<li><i class="fa fa-globe"></i><a href="{{ $activity->website }}" rel="nofollow" target="_blank" title="Būrelio internetinis puslapis">WWW</a></li>
								@endif
								@if(!empty($activity->facebook_link))
									<li><i class="fa fa-facebook"></i><a href="{{ $activity->facebook_link }}" rel="nofollow" target="_blank" title="Būrelio Facebook puslapis">Facebook</a></li>
								@endif
								<li class="social-share">
									<i class="shareicon fa fa-share" title="Pasidalinkite"></i>
									<ul class="social-list">
										@php
											$share_link = trim(Request::url());
                                            $share_title = $activity->title;
										@endphp
										@include('web.layout.partials.share-list', ['type' => 'facebook'])
										@include('web.layout.partials.share-list', ['type' => 'messenger'])
										@include('web.layout.partials.share-list', ['type' => 'linkedin'])
										@include('web.layout.partials.share-list', ['type' => 'copy'])
									</ul>
								</li>
							</ul>
						</div>

						<div class="post-content-area">
							<div class="post-media mb-20">
								<a href="{{ asset('storage_old/activities/' . $activity->image) }}"
								   class="gallery-popup cboxElement"
								   title="{{ $activity->name }}">
									<img itemprop="image"
										 src="{{ asset('storage_old/activities/' . $activity->image) }}"
										 data-src="{{ asset('storage_old/activities/' . $activity->image) }}"
										 class="img-fluid"
										 alt="{{ $activity->name }}"
										 loading="lazy">
								</a>
							</div>

							{!! $activity->description !!}

							@if( !$activity->media->isEmpty() )
								<div class="owl-carousel gallery" id="post-gallery">
									@foreach($activity->media as $m)
										<div class="item" style="background-image:url({{ asset('storage_old/activities/' . $m->name) }})">
											<a href="{{ asset('storage_old/activities/' . $m->name) }}" class="image-link gallery-popup">&nbsp;</a>
										</div>
									@endforeach
								</div>
							@endif
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="sidebar">
						@include('web.layout.widgets.socials')

						<div class="sidebar-widget">
							@include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE_ACTIVITIES'])
						</div>

						@include('web.layout.widgets.news_sidebar')

						@include('web.layout.widgets.tag_sidebar')
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
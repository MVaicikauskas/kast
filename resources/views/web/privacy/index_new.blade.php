@extends('web.layout.app_new')

@section('title')
    <title>Privatumo politika | Klaipėda aš su Tavim!</title>
@endsection

@section('content')
	@include('web.posts.partials.breadcrumb_new')

	<section class="main-content">
		<div class="container">
			<div class="row ts-gutter-30">
				<div class="col-lg-8 single-post post-content-area">
					<h1 class="title">{{ $heading }}</h1>
					{!! $content !!}
				</div>
				<div class="col-lg-4">
					<div class="sidebar">
						@include('web.layout.widgets.socials')

						<div class="sidebar-widget">
							@include('web.layout.widgets.ad_block', ['type' => 'SIDEBAR_RE'])
						</div>

						@include('web.layout.widgets.news_sidebar')

						@include('web.layout.widgets.tag_sidebar')
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

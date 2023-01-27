@if(Request::is('/'))
<div class="hero-block {{ Request::is('/') ? 'landing-page' : 'inner-page' }}">
	<!-- Custom header -->
	<div class="custom-header">
		{{-- If has video --}}
		@if((isset($page->show_video) && $page->show_video) && !empty($page['hero_video']))

			<div class="play-button">
				<img
						class="lazyload"
						src="{{ asset('dist/images/web/play-button.svg') }}"
						data-src="{{ asset('dist/images/web/play-button.svg') }}"
						id="playVideoButton">
			</div>
			<div class="custom-header-video">
				<video
						loop
						muted
						playsinline
						autoplay
						poster=""

						src="{{ asset('storage/page/' . $page['hero_video']) }}">


				</video>
				@if(!empty($page['hero_image']))
					<img src="{{ asset('storage_old/page/' . $page['hero_image']) }}" alt="">
				@endif
			</div>
			@section('scripts')
			<script type="text/javascript">
				var isPlaying = false

				function playVideo() {
					const video = document.querySelector('.custom-header-video > video')

					if (!isPlaying) {
						isPlaying = true
						video.play()
					} else {
						isPlaying = false
						video.pause()
					}
				}

				let playVideoBtn = document.querySelector('#playVideoButton').addEventListener('click', playVideo)
			</script>
			@endsection
		@else
		{{-- If no video --}}
			@if(!empty($page['hero_image']))
				<div class="custom-header-image desctop_hero_image">
					<img src="{{ asset('storage_old/page/' . $page['hero_image']) }}" alt="Klaipėda aš su tavim logotipas, naujienos, renginiai, būreliai">
				</div>
			@endif
		@endif
	</div>
	<!-- .custom header -->
</div>
@endif

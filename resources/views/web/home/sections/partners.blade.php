<section>
	<div class="section-title">
		<h4 class="partners-title">
			Partneriai
		</h4>
	</div>
	<div class="section-content">
		<div class="partners">
			<div class="controls left">
				<button class="stylish-button prev"></button>
			</div>

			<div class="controls right">
				<button class="stylish-button next"></button>
			</div>

			<div class="owl-carousel partners-carousel" id="owl_carousel">				
					@foreach($partners as $p)
						<div class="partner" title="{{ $p->name }}">
							<a href="{{ $p->link }}" target="_blank">
								<img
								class="owl-lazy"
								src="{{ asset('storage/partners/' . $p->logo) }}"
								data-src="{{ asset('storage/partners/' . $p->logo) }}"
								alt="{{ $p->name }}">
							</a>
						</div>
					@endforeach
			</div>

		</div>
	</div>


</section>


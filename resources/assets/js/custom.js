// Mobile burger click
$(function () {
	var burgerBtn = $('#burgerBtn')

	burgerBtn.on('click', function () {
		$(this).toggleClass('active')
		$(this).toggleClass('burger-open')
		$('#mobileNav').toggleClass('expand')
	})
})


$(window).on('scroll', function() {
	let body = document.body;
	let html = document.documentElement;

	var pageHeight = Math.max(body.scrollHeight, body.offsetHeight,
								html.clientHeight, html.scrollHeight, html.offsetHeight);

	if (window.pageYOffset > pageHeight / 15 ) {
		$('.header-container').addClass('block-shadow');
	} else {
		$('.header-container').removeClass('block-shadow');
	}
});

var owlEvents = $('.images-carousel');
var posts = $('.posts-carousel');
var partners = $('.partners-carousel');

$(function() {
	$('#newsBtns .stylish-button').on('click', function() {

		var owl = $('.news-carousel');
		var btn = $(this);

		controlSlider(owl, btn);
	});

	$('.partners .stylish-button').on('click', function() {

		var owl = $('.partners-carousel');
		var btn = $(this);

		controlSlider(owl, btn);
	});
});

function controlSlider(owl, btn) {
	if(btn.hasClass('prev')) {
		owl.trigger('prev.owl.carousel');
	}

	if(btn.hasClass('next')) {
		owl.trigger('next.owl.carousel');
	}
}

posts.owlCarousel({
	pagination:true,
	navigation:false,
	loop: true,
	autoplayHoverPause: true,
	items: 1,
	touchDrag: true,
	mouseDrag: false,
    lazyLoad: true,
    dots: true,
	responsive: {
		768: {
      items: 2,
      margin: 30,
			mouseDrag: true
		},
		1200: {
		items: 3,
      	margin: 30,
		},
		1450: {
			items: 4,
			margin: 30
		}
	}
});

partners.owlCarousel({
	loop: true,
	autoplayHoverPause: true,
	items: 5,
	lazyLoad: true,
	responsive: {
		990: {
			items: 5
		},
		768: {
			items: 3
		},
		500: {
			items: 2
		}
  }
});

$(window).on('resize', function() {
	owlEvents.trigger('refresh.owl.carousel');
})
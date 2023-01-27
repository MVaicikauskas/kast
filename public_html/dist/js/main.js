/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

(function webpackMissingModule() { throw new Error("Cannot find module \"D:\\wamp64\\www\\klaipedaassutavim.lt\\resources\\assets\\js\\main.js\""); }());
__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

// Mobile burger click
$(function () {
	var burgerBtn = $('#burgerBtn');

	burgerBtn.on('click', function () {
		$(this).toggleClass('active');
		$(this).toggleClass('burger-open');
		$('#mobileNav').toggleClass('expand');
	});
});

$(window).on('scroll', function () {
	var body = document.body;
	var html = document.documentElement;

	var pageHeight = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);

	if (window.pageYOffset > pageHeight / 15) {
		$('.header-container').addClass('block-shadow');
	} else {
		$('.header-container').removeClass('block-shadow');
	}
});

var owlEvents = $('.images-carousel');
var posts = $('.posts-carousel');
var partners = $('.partners-carousel');

$(function () {
	$('#newsBtns .stylish-button').on('click', function () {

		var owl = $('.news-carousel');
		var btn = $(this);

		controlSlider(owl, btn);
	});

	$('.partners .stylish-button').on('click', function () {

		var owl = $('.partners-carousel');
		var btn = $(this);

		controlSlider(owl, btn);
	});
});

function controlSlider(owl, btn) {
	if (btn.hasClass('prev')) {
		owl.trigger('prev.owl.carousel');
	}

	if (btn.hasClass('next')) {
		owl.trigger('next.owl.carousel');
	}
}

posts.owlCarousel({
	pagination: true,
	navigation: false,
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
			margin: 30
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

$(window).on('resize', function () {
	owlEvents.trigger('refresh.owl.carousel');
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);
/* Copy link */
const copyToClipboard = (str, button) => {
    let original_title = button.title;

    const el = document.createElement('textarea');
    el.value = str;
    el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);

    button.title = 'Nukopijuota';
    button.classList.add('copied');

    setTimeout(() => {
        button.title = original_title;
        button.classList.remove('copied');
    }, 1500);

    return false;
};

jQuery(function ($) {
    "use strict";

    /*  Mobile Menu
    /* ----------------------------------------------------------- */
    $('.navbar-nav .menu-dropdown').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).siblings().slideToggle();
    });
    $('.nav-tabs[data-toggle="tab-hover"] > li > a').hover(function () {
        $(this).tab('show');
    });

    /*  Fixed header
    /* ----------------------------------------------------------- */
    $(window).on('scroll', function () {

        /**Fixed header**/
        if ($(window).scrollTop() > 500) {
            $('.is-ts-sticky').addClass('sticky fade_down_effect');
        } else {
            $('.is-ts-sticky').removeClass('sticky fade_down_effect');
        }
    });

    /*  search popup
    /* -----------------------------------------------------------
    if ($('.xs-modal-popup').length > 0) {
        $('.xs-modal-popup').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: false,
            callbacks: {
                beforeOpen: function beforeOpen() {
                    this.st.mainClass = "my-mfp-slide-bottom xs-promo-popup";
                }
            }
        });
    }
    */

    // Trending slide
    $(".trending-slide").owlCarousel({

        loop: true,
        animateIn: 'fadeIn',
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,
        margin: 30,
        dots: false,
        mouseDrag: false,
        slideSpeed: 500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        items: 1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            }
        }

    });

    // Trending topics
    if ($('#trending-slider,#post-block-slider').length > 0) {
        $('#trending-slider,#post-block-slider').owlCarousel({
            nav: false,
            items: 4,
            margin: 30,
            reponsiveClass: true,
            dots: true,
            autoplayHoverPause: true,
            loop: true,
            responsive: {
                // breakpoint from 0 up
                0: {
                    items: 1,
                },
                // breakpoint from 480 up
                480: {
                    items: 2,
                },
                // breakpoint from 768 up
                768: {
                    items: 2,
                },
                // breakpoint from 768 up
                1200: {
                    items: 4,
                }
            }
        });
    }

    // Image gallery home
    if ($('#fullbox-slider').length > 0) {
        $('#fullbox-slider').owlCarousel({
            nav: false,
            items: 4,
            margin: 0,
            reponsiveClass: true,
            dots: false,
            autoplayHoverPause: true,
            loop: true,
            responsive: {
                // breakpoint from 0 up
                0: {
                    items: 1,
                },
                // breakpoint from 480 up
                480: {
                    items: 2,
                },
                // breakpoint from 768 up
                768: {
                    items: 2,
                },
                // breakpoint from 768 up
                1200: {
                    items: 4,
                }
            }
        });
    }

    // Partners slider
    if ($('#partners-slider').length > 0) {
        $('#partners-slider').owlCarousel({
            nav: false,
            items: 5,
            dots: true,
            loop: true,
            autoplay: 750,
            responsive: {
                // breakpoint from 0 up
                0: {
                    items: 2,
                },
                // breakpoint from 480 up
                480: {
                    items: 2,
                },
                // breakpoint from 768 up
                768: {
                    items: 3,
                },
                // breakpoint from 768 up
                1200: {
                    items: 5,
                }
            }
        });
    }

    // Posts gallery
    if ($('#post-gallery').length > 0) { //image gallery
        $('#post-gallery').owlCarousel({
            nav: true,
            items: 4,
            margin: 0,
            reponsiveClass: true,
            dots: false,
            autoplayHoverPause: true,
            loop: false,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
                // breakpoint from 0 up
                0: {
                    items: 1,
                },
                // breakpoint from 768 up
                420: {
                    items: 2,
                },
                // breakpoint from 768 up
                768: {
                    items: 4,
                }
            }
        });
    }

    // Post text size toggle
    $('.font-size').on('click', function (){
        let post_wrapper = $('.single-post');
        if(post_wrapper.hasClass('tl1')) {
            post_wrapper.removeClass('tl1');
            post_wrapper.addClass('tl2');
        }else if (post_wrapper.hasClass('tl2')) {
            post_wrapper.removeClass('tl2');
        }else {
            post_wrapper.addClass('tl1');
        }
    })

    /*  Popup
    /* ----------------------------------------------------------- */
    $(document).ready(function () {
        $.extend(true, $.magnificPopup.defaults, {
            tClose: 'Uždaryti (Esc)',
            tLoading: 'Kraunama...',
            gallery: {
                tPrev: 'Ankstesnis',
                tNext: 'Sekantis',
                tCounter: '%curr% iš %total%'
            }
        });

        //for image
        $('.gallery-popup').magnificPopup({
            type:'image',
            gallery: {
                enabled: true
            },
        });
        // $(".gallery-popup").colorbox({rel: 'gallery-popup', transition: "fade", photo: "true", current: "{current} iš {total}"});

        //for video
        $('.video-popup').magnificPopup({
            type:'iframe',
            iframe: {
                markup: '<div class="mfp-iframe-scaler">' +
                    '<div class="mfp-close"></div>' +
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                    '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
                srcAction: 'iframe_src'
            }
        });
        // $(".popup").colorbox({iframe: true, innerWidth: 600, innerHeight: 400});

        // Posts inside images
        let post_gallery_images = $('.post-content-area p > img');
        // let post_gallery_items = [];
        if (post_gallery_images.length > 0) {
            // post_gallery_images.each(function( index ) {
            //    let image_for_gallery = {};
            //    image_for_gallery.src = $( this ).attr('src');
            //    image_for_gallery.type = 'image';
            //
            //     post_gallery_items.push(image_for_gallery);
            // });

            $('.post-content-area p > img').magnificPopup({
                // items: post_gallery_items,
                type:'image',
                gallery: {
                    enabled: false
                },
                callbacks: {
                    elementParse: function(item) {
                        item.title = item.el[0].alt;
                        item.src = item.el[0].src;
                    }
                }
            });
        }
    });

    /*  Back to top
    /* ----------------------------------------------------------- */
    if( $(this).scrollTop() > 750 ){
        $('.backto').fadeIn();
    }
    $(window).scroll(function () {
        if ($(this).scrollTop() > 750) {
            $('.backto').fadeIn();
        } else {
            $('.backto').fadeOut();
        }
    });

    // scroll body to 0px on click
    $('.backto').on('click', function ()  {
        $('.backto').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    // bottom_fixed re
    if ($(window).width() < 768) {
        $('#CLOSE_BOTTOM_FIXED').delay(5000).fadeIn();
    }else {
        $('#BOTTOM_FIXED,#POST_MOBILE_RE').remove();
    }
    $('#CLOSE_BOTTOM_FIXED').on('click', function ()  {
        $('#BOTTOM_FIXED').remove();
    });

    //consent
    setInterval(function () { jQuery('.google-revocation-link-placeholder').remove(); }, 10000);
});
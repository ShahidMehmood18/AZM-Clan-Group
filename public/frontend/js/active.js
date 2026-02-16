/* =====================================
Template Name: Eshop
Author Name: Naimur Rahman
Author URI: http://www.wpthemesgrid.com/
Description: Eshop - eCommerce HTML5 Template.
Version:1.0
========================================*/
/*=======================================
[Start Activation Code]
=========================================
	01. Custom Mobile Menu Polyfill
	02. Sticky Header JS
	03. Search JS
...
*/

(function ($) {
	"use strict";

	// Custom lightweight polyfill for slicknav
	$.fn.slicknav = function (options) {
		var settings = $.extend({
			prependTo: 'body',
			closeOnClick: false
		}, options);

		return this.each(function () {
			var $this = $(this);
			var $mobileNav = $(settings.prependTo);

			// Create the slicknav structure
			var $slickMenu = $('<div class="slicknav_menu"></div>');
			var $slickBtn = $('<a href="#" class="slicknav_btn slicknav_collapsed"><span class="slicknav_menutxt"></span><span class="slicknav_icon"><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span></span></a>');
			var $slickNav = $('<ul class="slicknav_nav slicknav_hidden" style="display:none;" role="menu"></ul>');

			// Clone menu items
			$this.find('> li').each(function () {
				var $li = $(this).clone();
				// Find and handle dropdowns
				var $dropdown = $li.find('.dropdown');
				if ($dropdown.length > 0) {
					$li.addClass('slicknav_parent slicknav_collapsed');
					var $arrow = $('<span class="slicknav_arrow"><i class="ti-angle-right"></i></span>');
					$li.find('> a').append($arrow);
					$dropdown.addClass('slicknav_hidden').hide().attr('role', 'menu');

					$li.find('> a').on('click', function (e) {
						e.preventDefault();
						var $parentLi = $(this).parent();
						var $subUl = $parentLi.find('> ul');
						if ($parentLi.hasClass('slicknav_collapsed')) {
							$parentLi.removeClass('slicknav_collapsed').addClass('slicknav_open');
							$subUl.slideDown(300).removeClass('slicknav_hidden');
						} else {
							$parentLi.removeClass('slicknav_open').addClass('slicknav_collapsed');
							$subUl.slideUp(300).addClass('slicknav_hidden');
						}
					});
				}
				$slickNav.append($li);
			});

			// Toggle button logic
			$slickBtn.on('click', function (e) {
				e.preventDefault();
				if ($slickBtn.hasClass('slicknav_collapsed')) {
					$slickBtn.removeClass('slicknav_collapsed').addClass('slicknav_open');
					$slickNav.slideDown(400).removeClass('slicknav_hidden');
				} else {
					$slickBtn.removeClass('slicknav_open').addClass('slicknav_collapsed');
					$slickNav.slideUp(400).addClass('slicknav_hidden');
				}
			});

			if (settings.closeOnClick) {
				$slickNav.find('a').not('.slicknav_parent > a').on('click', function () {
					$slickBtn.click();
				});
			}

			$slickMenu.append($slickBtn).append($slickNav);
			$mobileNav.append($slickMenu);
		});
	};
	$(document).on('ready', function () {

		/*====================================
			Mobile Menu
		======================================*/
		$('.menu').slicknav({
			prependTo: ".mobile-nav",
			closeOnClick: true,
		});

		/*====================================
		03. Sticky Header JS
		======================================*/
		jQuery(window).on('scroll', function () {
			if ($(this).scrollTop() > 200) {
				$('.header').addClass("sticky");
			} else {
				$('.header').removeClass("sticky");
			}
		});

		/*=======================
		  Search JS JS
		=========================*/
		$('.top-search a').on("click", function () {
			$('.search-top').toggleClass('active');
		});

		/*=======================
		  Slider Range JS
		=========================*/
		$(function () {
			$("#slider-range").slider({
				range: true,
				min: 0,
				max: 500,
				values: [120, 250],
				slide: function (event, ui) {
					$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
				}
			});
			$("#amount").val("$" + $("#slider-range").slider("values", 0) +
				" - $" + $("#slider-range").slider("values", 1));
		});

		/*=======================
		  Home Slider JS
		=========================*/
		$('.home-slider').owlCarousel({
			items: 1,
			autoplay: true,
			autoplayTimeout: 5000,
			smartSpeed: 400,
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			autoplayHoverPause: true,
			loop: true,
			nav: true,
			merge: true,
			dots: false,
			navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
			responsive: {
				0: {
					items: 1,
				},
				300: {
					items: 1,
				},
				480: {
					items: 2,
				},
				768: {
					items: 3,
				},
				1170: {
					items: 4,
				},
			}
		});

		/*=======================
		  Popular Slider JS
		=========================*/
		$('.popular-slider').owlCarousel({
			items: 1,
			autoplay: true,
			autoplayTimeout: 5000,
			smartSpeed: 400,
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			autoplayHoverPause: true,
			loop: true,
			nav: true,
			merge: true,
			dots: false,
			navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
			responsive: {
				0: {
					items: 1,
				},
				300: {
					items: 1,
				},
				480: {
					items: 2,
				},
				768: {
					items: 3,
				},
				1170: {
					items: 4,
				},
			}
		});

		/*===========================
		  Quick View Slider JS
		=============================*/
		$('.quickview-slider-active').owlCarousel({
			items: 1,
			autoplay: true,
			autoplayTimeout: 5000,
			smartSpeed: 400,
			autoplayHoverPause: true,
			nav: true,
			loop: true,
			merge: true,
			dots: false,
			navText: ['<i class=" ti-arrow-left"></i>', '<i class=" ti-arrow-right"></i>'],
		});

		/*===========================
		  Home Slider 4 JS
		=============================*/
		$('.home-slider-4').owlCarousel({
			items: 1,
			autoplay: true,
			autoplayTimeout: 5000,
			smartSpeed: 400,
			autoplayHoverPause: true,
			nav: true,
			loop: true,
			merge: true,
			dots: false,
			navText: ['<i class=" ti-arrow-left"></i>', '<i class=" ti-arrow-right"></i>'],
		});

		/*====================================
		14. CountDown
		======================================*/
		$('[data-countdown]').each(function () {
			var $this = $(this),
				finalDate = $(this).data('countdown');
			$this.countdown(finalDate, function (event) {
				$this.html(event.strftime(
					'<div class="cdown"><span class="days"><strong>%-D</strong><p>Days.</p></span></div><div class="cdown"><span class="hour"><strong> %-H</strong><p>Hours.</p></span></div> <div class="cdown"><span class="minutes"><strong>%M</strong> <p>MINUTES.</p></span></div><div class="cdown"><span class="second"><strong> %S</strong><p>SECONDS.</p></span></div>'
				));
			});
		});

		/*====================================
		16. Flex Slider JS
		======================================*/
		(function ($) {
			'use strict';
			$('.flexslider-thumbnails').flexslider({
				animation: "slide",
				controlNav: "thumbnails",
			});
		})(jQuery);

		/*====================================
		  Cart Plus Minus Button
		======================================*/
		var CartPlusMinus = $('.cart-plus-minus');
		CartPlusMinus.prepend('<div class="dec qtybutton">-</div>');
		CartPlusMinus.append('<div class="inc qtybutton">+</div>');
		$(".qtybutton").on("click", function () {
			var $button = $(this);
			var oldValue = $button.parent().find("input").val();
			if ($button.text() === "+") {
				var newVal = parseFloat(oldValue) + 1;
			} else {
				// Don't allow decrementing below zero
				if (oldValue > 0) {
					var newVal = parseFloat(oldValue) - 1;
				} else {
					newVal = 1;
				}
			}
			$button.parent().find("input").val(newVal);
		});

		/*=======================
		  Extra Scroll JS
		=========================*/
		$('.scroll').on("click", function (e) {
			var anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $(anchor.attr('href')).offset().top - 0
			}, 900);
			e.preventDefault();
		});

		/*===============================
		10. Checkbox JS
		=================================*/
		$('input[type="checkbox"]').change(function () {
			if ($(this).is(':checked')) {
				$(this).parent("label").addClass("checked");
			} else {
				$(this).parent("label").removeClass("checked");
			}
		});

		/*==================================
		 12. Product page Quantity Counter
		 ===================================*/
		$('.qty-box .quantity-right-plus').on('click', function () {
			var $qty = $('.qty-box .input-number');
			var currentVal = parseInt($qty.val(), 10);
			if (!isNaN(currentVal)) {
				$qty.val(currentVal + 1);
			}
		});
		$('.qty-box .quantity-left-minus').on('click', function () {
			var $qty = $('.qty-box .input-number');
			var currentVal = parseInt($qty.val(), 10);
			if (!isNaN(currentVal) && currentVal > 1) {
				$qty.val(currentVal - 1);
			}
		});

		/*=====================================
		15.  Video Popup JS
		======================================*/
		$('.video-popup').magnificPopup({
			type: 'iframe',
			removalDelay: 300,
			mainClass: 'mfp-fade'
		});

		/*====================================
			Scroll Up JS
		======================================*/
		$.scrollUp({
			scrollText: '<span><i class="fa fa-angle-up"></i></span>',
			easingType: 'easeInOutExpo',
			scrollSpeed: 900,
			animation: 'fade'
		});

	});

	/*====================================
	18. Nice Select JS
	======================================*/
	$('select').niceSelect();

	/*=====================================
	 Others JS
	======================================*/
	$(function () {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 500,
			values: [0, 500],
			slide: function (event, ui) {
				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount").val("$" + $("#slider-range").slider("values", 0) +
			" - $" + $("#slider-range").slider("values", 1));
	});

	/*=====================================
	  Preloader JS
	======================================*/
	//After 2s preloader is fadeOut
	$('.preloader').delay(2000).fadeOut('slow');
	setTimeout(function () {
		//After 2s, the no-scroll class of the body will be removed
		$('body').removeClass('no-scroll');
	}, 2000); //Here you can change preloader time

})(jQuery);

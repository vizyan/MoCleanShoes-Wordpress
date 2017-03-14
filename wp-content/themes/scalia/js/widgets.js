(function ($) {
		$(function () {
				$('.sc-teams-items-carousel').each(function () {
						var $teamsElement = $(this);
						var $teams = $('.sc-teams-item', $teamsElement);
						var $teamsWrap = $('<div class="sc-teams-item-wrap"/>')
								.appendTo($teamsElement);
						var $teamsCarousel = $('<div class="carousel-2-carousel"/>')
								.appendTo($teamsWrap);
						$teams.appendTo($teamsCarousel);
						$teams.each(function (index) {
								$(this).data('gallery-item-num', index);
						});
				});
				$('body').updateteamsCarousel();
		});
		$.fn.updateteamsCarousel = function () {
				$('.sc-teams-items-carousel', this).add($(this).filter('.sc-teams-items-carousel')).each(function () {
								var $teamsElement = $(this);
								var $teamsCarousel = $('.carousel-2-carousel', $teamsElement);
								var $autoscroll_teams = $teamsElement.data('autoscroll') > 0 ? $teamsElement.data('autoscroll') : false;
								$teamsElement.scaliaPreloader(function () {
										var $teamsView = $teamsCarousel.carouFredSel({
												auto: $autoscroll_teams,
												circular: true,
												infinite: true,
												width: '100%',
												items: 1,
												responsive: true,
												scroll: {
														fx: 'crossfade'
												}

										});
								})
						}
				)
		};
})(jQuery);

(function ($) {
		$(function () {
				$('.testimonials-carousel-style-1').each(function () {
						var $testimonialsElement = $(this);
						var $testimonials = $('.testimonials-style-1-item', $testimonialsElement);
						var $testimonialsWrap = $('<div class="sc-testimonials-carousel-wrap"/>')
								.appendTo($testimonialsElement);
						var $testimonialsCarousel = $('<div class="carousel-2-carousel"/>')
								.appendTo($testimonialsWrap);
						var $testimonialsNavigation = $('<div class="sc-widget-testimonials-navigation-style-1"/>')
								.appendTo($testimonialsWrap);
						var $testimonialsPrev = $('<a href="#" class="sc-widget-testimonials-prev-style-1 sc-prev"/></a>')
								.appendTo($testimonialsNavigation);
						var $testimonialsNext = $('<a href="#" class="sc-widget-testimonials-next-style-1 sc-next"/></a>')
								.appendTo($testimonialsNavigation);
						$testimonials.appendTo($testimonialsCarousel);
						$testimonials.each(function (index) {
								$(this).data('gallery-item-num', index);

						});
				});
				$('body').updateTestimonialsCarousel_style_1();
		});
		$.fn.updateTestimonialsCarousel_style_1 = function () {
				$('.testimonials-carousel-style-1', this).add($(this).filter('.testimonials-carousel-style-1')).each(function () {
								var $testimonialsElement = $(this);
								var $testimonialsCarousel = $('.carousel-2-carousel', $testimonialsElement);
								var $testimonialsPrev = $('.sc-widget-testimonials-prev-style-1.sc-prev');
								var $testimonialsNext = $('.sc-widget-testimonials-next-style-1.sc-next');
								var $testimonialsNavigation = $('.sc-widget-testimonials-navigation-style-1')
								var $autoscroll_testimonials = $testimonialsElement.data('autoscroll') > 0 ? $testimonialsElement.data('autoscroll') : false;
								$testimonialsElement.scaliaPreloader(function () {
										var $testimonialsView = $testimonialsCarousel.carouFredSel({
												auto: $autoscroll_testimonials,
												circular: true,
												infinite: true,
												width: '100%',
												items: 1,
												responsive: true,
												prev: $testimonialsPrev,
												next: $testimonialsNext,
												scroll: {
														fx: 'scroll',
														easing: 'easeInOutCubic',
														duration: 500,
														onBefore: function(data) {
																data.items.old.css({
																		opacity: 1
																}).animate({
																		opacity: 0
																}, 500, 'linear');

																data.items.visible.css({
																		opacity: 0
																}).animate({
																		opacity: 1
																}, 500, 'linear');
														},
														onAfter: function (data) {
																$testimonialsNavigation.appendTo($('.testimonials-style-1-image', data.items.visible.first()));
														}
												},
												onCreate: function (data) {
														$testimonialsNavigation.appendTo($('.testimonials-style-1-image', data.items.first()));
												}
										});
								})
						}
				)
		};
})(jQuery);



(function ($) {
		$(function () {

				$('.testimonials-carousel-style-2').each(function () {
						var $testimonialsElement = $(this);
						var $testimonials = $('.testimonials-style-2-item', $testimonialsElement);
						var $testimonialsWrap = $('<div class="sc-testimonials-carousel-wrap"/>')
								.appendTo($testimonialsElement);
						var $testimonialsCarousel = $('<div class="carousel-2-carousel"/>')
								.appendTo($testimonialsWrap);
						var $testimonialsNavigation = $('<div class="sc-widget-testimonials-navigation-style-2"/>')
								.appendTo($testimonialsWrap);
						var $testimonialsPrev = $('<a href="#" class="sc-widget-testimonials-prev-style-2 sc-prev"/></a>')
								.appendTo($testimonialsNavigation);
						var $testimonialsNext = $('<a href="#" class="sc-widget-testimonials-next-style-2 sc-next"/></a>')
								.appendTo($testimonialsNavigation);
						$testimonials.appendTo($testimonialsCarousel);
						$testimonials.each(function (index) {
								$(this).data('gallery-item-num', index);
						});
				});
				$('body').updateTestimonialsCarousel_style_2();
		});
		$.fn.updateTestimonialsCarousel_style_2 = function () {
				$('.testimonials-carousel-style-2', this).add($(this).filter('.testimonials-carousel-style-2')).each(function () {
								var $testimonialsElement = $(this);
								var $testimonialsCarousel = $('.carousel-2-carousel', $testimonialsElement);
								var $testimonialsPrev = $('.sc-widget-testimonials-prev-style-2.sc-prev');
								var $testimonialsNext = $('.sc-widget-testimonials-next-style-2.sc-next');
								var $testimonialsNavigation = $('.sc-widget-testimonials-navigation-style-2')
								var $autoscroll_testimonials = $testimonialsElement.data('autoscroll') > 0 ? $testimonialsElement.data('autoscroll') : false;
								$testimonialsElement.scaliaPreloader(function () {

										var $testimonialsView = $testimonialsCarousel.carouFredSel({
												auto: $autoscroll_testimonials,
												circular: true,
												infinite: true,
												width: '100%',
												height: 'auto',
												items: 1,

												align: 'center',
												responsive: true,
												prev: $testimonialsPrev,
												next: $testimonialsNext,
												scroll: {
														fx: 'scroll',
														easing: 'easeInOutCubic',
														duration: 500,
														onBefore: function(data) {
																data.items.old.css({
																		opacity: 1
																}).animate({
																		opacity: 0
																}, 500, 'linear');

																data.items.visible.css({
																		opacity: 0
																}).animate({
																		opacity: 1
																}, 500, 'linear');
														},
														onAfter: function (data) {
																$testimonialsNavigation.appendTo($('.testimonials-style-2-image', data.items.visible.first()));
														}
												},
												onCreate: function (data) {
														$testimonialsNavigation.appendTo($('.testimonials-style-2-image', data.items.first()));
												}
										});
								})
						}
				)
		};
})(jQuery);
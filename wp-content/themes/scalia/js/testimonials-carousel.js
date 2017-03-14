(function($) {
	$(function() {

		$('.sc-testimonials').each(function() {

			var $testimonialsElement = $(this);

			var $testimonials = $('.sc-testimonial-item', $testimonialsElement);

			var $testimonialsWrap = $('<div class="sc-testimonials-carousel-wrap"/>')
				.appendTo($testimonialsElement);
			var $testimonialsCarousel = $('<div class="sc-testimonials-carousel"/>')
				.appendTo($testimonialsWrap);
			if($testimonialsElement.hasClass('fullwidth-block')) {
				$testimonialsCarousel.wrap('<div class="container" />');
			}
			var $testimonialsNavigation = $('<div class="sc-testimonials-navigation"/>')
				.appendTo($testimonialsWrap);
			var $testimonialsPrev = $('<a href="#" class="sc-prev sc-testimonials-prev"/></a>')
				.appendTo($testimonialsNavigation);
			var $testimonialsNext = $('<a href="#" class="sc-next sc-testimonials-next"/></a>')
				.appendTo($testimonialsNavigation);
			$testimonials.appendTo($testimonialsCarousel);

		});

		$('body').updateTestimonialsCarousel();
		$('.fullwidth-block').each(function() {
			$(this).on('updateTestimonialsCarousel', function() {
				$(this).updateTestimonialsCarousel();
			});
		});
		$('.sc_tab').on('tab-update', function() {
			$(this).updateTestimonialsCarousel();
		});
		$(document).on('show.vc.tab', '[data-vc-tabs]', function() {
			$(this).data('vc.tabs').getTarget().updateTestimonialsCarousel();;
		});
		$('.sc_accordion_content').on('accordion-update', function() {
			$(this).updateTestimonialsCarousel();
		});

	});

	$.fn.updateTestimonialsCarousel = function() {
		$('.sc-testimonials', this).add($(this).filter('.sc-testimonials')).each(function() {
			var $testimonialsElement = $(this);

			var $testimonialsCarousel = $('.sc-testimonials-carousel', $testimonialsElement);
			var $testimonials = $('.sc-testimonial-item', $testimonialsCarousel);
			var $testimonialsPrev = $('.sc-testimonials-prev', $testimonialsElement);
			var $testimonialsNext = $('.sc-testimonials-next', $testimonialsElement);

			$testimonialsElement.scaliaPreloader(function() {

				var $testimonialsView = $testimonialsCarousel.carouFredSel({
					auto: 10000,
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
						duration: 1000,
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
							}, 1000, 'linear');
						}
					}
				});

			});
		});
	}

})(jQuery);
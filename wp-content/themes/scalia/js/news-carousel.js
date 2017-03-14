(function($) {
	$(function() {

		$('.sc-news-type-carousel').each(function() {

			var $newsCarouselElement = $(this);

			var $newsItems = $('.sc-news-item', $newsCarouselElement);

			var $newsItemsWrap = $('<div class="sc-news-carousel-wrap"/>')
				.appendTo($newsCarouselElement);
			var $newsItemsCarousel = $('<div class="sc-news-carousel"/>')
				.appendTo($newsItemsWrap);
			var $newsItemsPagination = $('<div class="sc-news-pagination sc-mini-pagination"/>')
				.appendTo($newsItemsWrap);
			$newsItems.appendTo($newsItemsCarousel);

		});

		$('body').updateNews();

	});

	$.fn.updateNews = function() {
		$('.sc-news-type-carousel', this).each(function() {
			var $newsCarouselElement = $(this);

			var $newsItemsCarousel = $('.sc-news-carousel', $newsCarouselElement);
			var $newsItems = $('.sc-news-item', $newsItemsCarousel);
			var $newsItemsPagination = $('.sc-mini-pagination', $newsCarouselElement);

			$newsCarouselElement.scaliaPreloader(function() {

				var $newsCarousel = $newsItemsCarousel.carouFredSel({
					auto: 10000,
					circular: false,
					infinite: true,
					width: '100%',
					height: 'variable',
					align: 'center',
					pagination: $newsItemsPagination
				});

			});
		});
	}

})(jQuery);
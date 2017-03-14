(function($) {
	$(function() {

		$('.sc-clients-type-carousel-grid').each(function() {

			var $clientsCarouselElement = $(this);

			var $clientsItems = $('.sc-clients-slide', $clientsCarouselElement);

			var $clientsItemsWrap = $('<div class="sc-clients-grid-carousel-wrap"/>')
				.appendTo($clientsCarouselElement);
			var $clientsItemsCarousel = $('<div class="sc-clients-grid-carousel"/>')
				.appendTo($clientsItemsWrap);
			var $clientsItemsPagination = $('<div class="sc-clients-grid-pagination sc-mini-pagination"/>')
				.appendTo($clientsItemsWrap);
			$clientsItems.appendTo($clientsItemsCarousel);

		});


		$('.sc_client_carousel-items').each(function () {

			var $clientsElement = $(this);

			var $clients = $('.sc-client-item', $clientsElement);

			var $clientsWrap = $('<div class="sc-client-carousel-item-wrap"/>')
				.appendTo($clientsElement);
			var $clientsCarousel = $('<div class="sc-client-carousel"/>')
				.appendTo($clientsWrap);
			var $clientsNavigation = $('<div class="sc-client-carousel-navigation"/>')
				.appendTo($clientsWrap);
			var $clientsPrev = $('<a href="#" class="sc-prev sc-client-prev"/></a>')
				.appendTo($clientsNavigation);
			var $clientsNext = $('<a href="#" class="sc-next sc-client-next"/></a>')
				.appendTo($clientsNavigation);
			$clients.appendTo($clientsCarousel);

		});

		$('body').updateClientsGrid();
		$('body').updateClientsCarousel();
		$('.fullwidth-block').each(function() {
			$(this).on('updateClientsCarousel', function() {
				$(this).updateClientsCarousel();
			});
		});
		$('.sc_tab').on('tab-update', function() {
			$(this).updateClientsGrid();
		});
		$(document).on('show.vc.tab', '[data-vc-tabs]', function() {
			$(this).data('vc.tabs').getTarget().updateClientsGrid();;
		});
		$('.sc_accordion_content').on('accordion-update', function() {
			$(this).updateClientsGrid();
		});

	});

	$.fn.updateClientsGrid = function() {
		$('.sc-clients-type-carousel-grid', this).each(function() {
			var $clientsCarouselElement = $(this);

			var $clientsItemsCarousel = $('.sc-clients-grid-carousel', $clientsCarouselElement);
			var $clientsItemsPagination = $('.sc-mini-pagination', $clientsCarouselElement);

			var autoscroll = $clientsCarouselElement.data('autoscroll') > 0 ? $clientsCarouselElement.data('autoscroll') : false;

			$clientsCarouselElement.scaliaPreloader(function() {

				var $clientsGridCarousel = $clientsItemsCarousel.carouFredSel({
					auto: autoscroll,
					circular: false,
					infinite: true,
					width: '100%',
					items: 1,
					responsive: true,
					height: 'auto',
					align: 'center',
					pagination: $clientsItemsPagination,
				});

			});
		});
	}

	$.fn.updateClientsCarousel = function() {
		$('.sc_client_carousel-items', this).each(function() {
			var $clientsElement = $(this);

			var $clientsCarousel = $('.sc-client-carousel', $clientsElement);
			var $clientsPrev = $('.sc-client-prev', $clientsElement);
			var $clientsNext = $('.sc-client-next', $clientsElement);

			var autoscroll = $clientsElement.data('autoscroll') > 0 ? $clientsElement.data('autoscroll') : false;

			$clientsElement.scaliaPreloader(function() {

				var $clientsView = $clientsCarousel.carouFredSel({
					auto: autoscroll,
					circular: true,
					infinite: false,
					scroll: {
						items: 1
					},
					width: '100%',
					responsive: false,
					height: 'auto',
					align: 'center',
					prev: $clientsPrev,
					next: $clientsNext
				});

			});
		});
	}

})(jQuery);
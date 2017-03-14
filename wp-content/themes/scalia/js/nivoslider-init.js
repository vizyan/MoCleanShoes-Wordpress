(function($) {
	$(document).ready(function() {

		$('.sc-nivoslider').each(function() {
			var $slider = $(this);
			$slider.scaliaPreloader(function() {

				$slider.nivoSlider({
					effect: nivoslider_options.effect,
					slices: parseInt(nivoslider_options.slices),
					boxCols: parseInt(nivoslider_options.boxCols),
					boxRows: parseInt(nivoslider_options.boxRows),
					animSpeed: parseInt(nivoslider_options.animSpeed),
					pauseTime: parseInt(nivoslider_options.pauseTime),
					directionNav: nivoslider_options.directionNav,
					controlNav: nivoslider_options.controlNav,
					beforeChange: function(){
						$('.nivo-caption', $slider).animate({ opacity: 'hide' }, 500);
					},
					afterChange: function(){
						var data = $slider.data('nivo:vars');
						var index = data.currentSlide;
						if($('.sc-nivoslider-slide:eq('+index+') .sc-nivoslider-caption', $slider).length) {
							$('.nivo-caption', $slider).html($('.sc-nivoslider-slide:eq('+index+') .sc-nivoslider-caption', $slider).html());
							$('.nivo-caption', $slider).animate({ opacity: 'show' }, 500);
						} else {
							$('.nivo-caption', $slider).html('');
						}
					},
					afterLoad: function(){
						$slider.next('.nivo-controlNav').appendTo($slider).addClass('sc-mini-pagination');
						$('.nivo-directionNav .nivo-prevNav', $slider).addClass('sc-prev');
						$('.nivo-directionNav .nivo-nextNav', $slider).addClass('sc-next');
						if($('.sc-nivoslider-slide:eq(0) .sc-nivoslider-caption', $slider).length) {
							$('.nivo-caption', $slider).html($('.sc-nivoslider-slide:eq(0) .sc-nivoslider-caption', $slider).html());
							$('.nivo-caption', $slider).show();
						}
					}
				});

			});
		});

	});
})(jQuery);
(function($) {
	$(function() {
		$('.quickfinder-item-effect-border-reverse .sc-icon, .quickfinder-item-effect-background-reverse .sc-icon').prepend('<div class="quickfinder-animation"/>');
		$('.quickfinder-item-effect-background-reverse').each(function() {
			var $quickfinderItem = $(this);
			var icon_half_1_color = $('.sc-icon-half-1', $quickfinderItem).css('color');
			var icon_half_2_color = $('.sc-icon-half-2', $quickfinderItem).css('color');
			var background_color = $('.sc-icon', $quickfinderItem).css('backgroundColor');
			$('a', $quickfinderItem).hover(
				function() {
					$quickfinderItem.addClass('hover');
					$('.sc-icon-half-1, .sc-icon-half-2', $quickfinderItem).stop(true).animate({ color: background_color });
				},
				function() {
					$quickfinderItem.removeClass('hover');
					$('.sc-icon-half-1', $quickfinderItem).stop(true).animate({ color: icon_half_1_color });
					$('.sc-icon-half-2', $quickfinderItem).stop(true).animate({ color: icon_half_2_color });
				}
			);
		});
		$('.quickfinder-item-effect-border-reverse').each(function() {
			var $quickfinderItem = $(this);
			var icon_half_1_color = $('.sc-icon-half-1', $quickfinderItem).css('color');
			var icon_half_2_color = $('.sc-icon-half-2', $quickfinderItem).css('color');
			var border_color = $('.sc-icon', $quickfinderItem).css('borderTopColor');
			$('.sc-icon', $quickfinderItem).css({ backgroundColor: border_color });
			$('a', $quickfinderItem).hover(
				function() {
					$quickfinderItem.addClass('hover');
					$('.sc-icon-half-1, .sc-icon-half-2', $quickfinderItem).stop(true).animate({ color: '#ffffff' });
				},
				function() {
					$quickfinderItem.removeClass('hover');
					$('.sc-icon-half-1', $quickfinderItem).stop(true).animate({ color: icon_half_1_color });
					$('.sc-icon-half-2', $quickfinderItem).stop(true).animate({ color: icon_half_2_color });
				}
			);
		});
	});
})(jQuery);
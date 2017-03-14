function scalia_show_digram_line_element(queue, first) {
	var $skill = queue.shift();
	if ($skill == null || $skill == undefined) {
		setTimeout(function() {
			scalia_show_digram_line_element(queue, first);
		}, 1000);
		return;
	}

	if (first)
		var delay = 1;
	else
		var delay = 150;

	setTimeout(function() {
		var $progress = $skill.find('.skill-line div');
		var amount = parseFloat($progress.data('amount'));
		jQuery({countNum: 0}).animate({countNum: amount}, {
			duration: 1600,
			easing:'easeOutQuart',
			step: function() {
				var count = parseFloat(this.countNum);
				var pct = Math.ceil(count) + '%';
				$progress.width(count + '%');
				$skill.find('.skill-amount').html(pct);
			}
		});
		scalia_show_digram_line_element(queue, false);
	}, delay);
}

function scalia_show_diagram_line_mobile($box) {
	jQuery('.skill-element', $box).each(function () {
		jQuery('.skill-line div', this).width(jQuery('.skill-line div', this).data('amount') + '%');
	});
}

function scalia_start_line_digram(element) {
	jQuery(element).scalia_start_line_digram();
}

jQuery.fn.scalia_start_line_digram = function() {
	var $box = jQuery(this.get(0));
	if (!$box.hasClass('digram-line-box'))
		return;
	if (jQuery(window).width() < 800) {
		scalia_show_diagram_line_mobile($box);
	} else {
		var diagram_lines_queue = [];
		jQuery('.skill-element', $box).each(function () {
			diagram_lines_queue.push(jQuery(this));
		});
		scalia_show_digram_line_element(diagram_lines_queue, true);
	}
}

jQuery('.digram-line-box').each(function () {
	if (!jQuery(this).hasClass('lazy-loading-item') || jQuery('body').hasClass('lazy-disabled') || jQuery(window).width() < 800)
		jQuery(this).scalia_start_line_digram();
});

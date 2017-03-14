(function($) {

	function getElementPosition(elem) {
		var w = elem.offsetWidth;
		var h = elem.offsetHeight;

		var l = 0;
		var t = 0;

		while (elem && !$(elem).hasClass('overlay'))
		{
			l += elem.offsetLeft;
			t += elem.offsetTop;
			elem = elem.offsetParent;
		}

		return {"left":l, "top":t, "width": w, "height":h};
	}

	function hover_default(item, hover) {
		var $title = $('.overlay .title', item);
		var $subtitle = $('.overlay .subtitle', item);
		var $info = $('.overlay .info', item);
		var $icons = $('.overlay .icon', item);
		var show_title = $title.size() > 0 && $title.css('display') != 'none';
		var show_subtitle = $subtitle.size() > 0 && $subtitle.css('display') != 'none';
		var show_info = $info.size() > 0 && $info.css('display') != 'none';
		var $image_box = $('.image-inner', item);
		var $image = $('.image-inner img', item);
		if (hover) {
			$('.overlay', item).stop(true, true).hide().fadeIn(400);
			var icons_pos = [];

			if (show_title)
				$title.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			if (show_subtitle)
				$subtitle.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			if (show_info)
				$info.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			$icons.stop(true, true).css({
				position: 'static',
				opacity: 1
			});

			if (show_title)
				var title_pos = getElementPosition($title[0]);
			if (show_subtitle)
				var subtitle_pos = getElementPosition($subtitle[0]);
			if (show_info)
				var info_pos = getElementPosition($info[0]);
			$icons.each(function() {
				icons_pos.push(getElementPosition(this));
			});

			$image.stop(true, true).css({
				position: 'relative',
				transform: 'scale(1)'
			}).animate({
				transform: 'scale(1.15)'
			}, 400);

			$icons.each(function(index) {
				var $icon = $(this);
				var icon_pos = icons_pos[index];
				$icon.css({
					position: 'absolute',
					left: icon_pos.left,
					top: -icon_pos.height
				});
			});
			if (show_info)
				$info.css({
					position: 'absolute',
					width: info_pos.width,
					left: info_pos.left,
					top: (info_pos.top - 200),
					opacity: 0
				}).animate({
					opacity: 1,
					top: info_pos.top
				}, 300);
			if (show_subtitle)
				setTimeout(function() {
					$subtitle.css({
						position: 'absolute',
						width: subtitle_pos.width,
						left: subtitle_pos.left,
						top: (subtitle_pos.top - 200),
						opacity: 0
					}).animate({
						opacity: 1,
						top: subtitle_pos.top
					}, 300);
				}, 30);
			if (show_title)
				setTimeout(function() {
					$title.css({
						position: 'absolute',
						width: title_pos.width,
						left: title_pos.left,
						top: (title_pos.top - 200),
						opacity: 0
					}).animate({
						opacity: 1,
						top: title_pos.top
					}, 300);
				}, 60);
			$icons.each(function(index) {
				var $icon = $(this);
				var icon_pos = icons_pos[index];
				setTimeout(function() {
					$icon.animate({
						top: icon_pos.top
					}, 300);
				}, 80 + index*40);
			});
		} else {
			$icons.stop(true, true).animate({
				top: -70
			}, 400);
			if (show_title)
				setTimeout(function() {
					$title.animate({
						opacity: 0,
						top: (parseInt($title.css('top')) - 150)
					}, 400);
				}, 70);
			if (show_subtitle)
				setTimeout(function() {
					$subtitle.animate({
						opacity: 0,
						top: (parseInt($subtitle.css('top')) - 150)
					}, 400);
				}, 140);
			if (show_info)
				setTimeout(function() {
					$info.animate({
						opacity: 0,
						top: (parseInt($info.css('top')) - 150)
					}, 400);
				}, 210);
			setTimeout(function() {
				$image.stop(true, true).animate({
					transform: 'scale(1)'
				}, 300);
			}, 100);
			setTimeout(function() {
				$('.overlay', item).stop(true, true).fadeOut(400);
			}, 200);
		}
	}

	function hover_zooming_blur(item, hover) {
		var $title = $('.overlay .title', item);
		var $subtitle = $('.overlay .subtitle', item);
		var $info = $('.overlay .info', item);
		var $icons = $('.overlay .icon', item);
		var show_title = $title.size() > 0 && $title.css('display') != 'none';
		var show_subtitle = $subtitle.size() > 0 && $subtitle.css('display') != 'none';
		var show_info = $info.size() > 0 && $info.css('display') != 'none';
		var $image_box = $('.image-inner', item);
		var $image = $('.image-inner img', item);
		if (hover) {
			$('.overlay', item).stop(true, true).hide().fadeIn(400);
			var icons_pos = [];

			if (show_title)
				$title.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			if (show_subtitle)
				$subtitle.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			if (show_info)
				$info.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			$icons.stop(true, true).css({
				position: 'static',
				opacity: 1
			});

			if (show_title)
				var title_pos = getElementPosition($title[0]);
			if (show_subtitle)
				var subtitle_pos = getElementPosition($subtitle[0]);
			if (show_info)
				var info_pos = getElementPosition($info[0]);
			$icons.each(function() {
				icons_pos.push(getElementPosition(this));
			});

			if (show_title)
				$title.css({
					position: 'absolute',
					width: title_pos.width,
					left: title_pos.left,
					top: title_pos.top,
					bottom: 'auto',
					transform: 'scale(0)'
				});

			if (show_subtitle)
				$subtitle.css({
					position: 'absolute',
					width: subtitle_pos.width,
					left: subtitle_pos.left,
					top: subtitle_pos.top,
					bottom: 'auto',
					transform: 'scale(0)'
				});

			if (show_info)
				$info.css({
					position: 'absolute',
					width: info_pos.width,
					left: info_pos.left,
					top: info_pos.top,
					bottom: 'auto',
					transform: 'scale(0)'
				});

			$icons.each(function(index) {
				var $icon = $(this);
				var icon_pos = icons_pos[index];
				$icon.css({
					position: 'absolute',
					left: icon_pos.left,
					top: icon_pos.top,
					transform: 'scale(0)'
				});
			});

			$image.stop(true, true).removeClass('zoom').css({
				position: 'relative'
			}).addClass('zoom');

			$icons.each(function(index) {
				var $icon = $(this);
				var icon_pos = icons_pos[index];
				setTimeout(function() {
					$icon.animate({
						transform: 'scale(1)'
					}, 200);
				}, 1 + index*40);
			});

			if (show_title)
				setTimeout(function() {
					$title.animate({
						transform: 'scale(1)'
					}, 300);
				}, 30);

			if (show_subtitle)
				setTimeout(function() {
					$subtitle.animate({
						transform: 'scale(1)'
					}, 300);
				}, 60);

			if (show_info)
				setTimeout(function() {
					$info.animate({
						transform: 'scale(1)'
					}, 300);
				}, 90);
		} else {
			var delay = 0
			if (show_info)
				$info.stop(true, true).animate({
					opacity: 0,
					top: (parseInt($info.css('top')) + 200)
				}, 400);
			if (show_subtitle)
				$subtitle.stop(true, true).animate({
					opacity: 0,
					top: (parseInt($subtitle.css('top')) + 200)
				}, 400);
			if (show_info || show_subtitle)
				delay += 70;
			if (show_title) {
				setTimeout(function() {
					$title.stop(true, true).animate({
						opacity: 0,
						top: (parseInt($title.css('top')) + 200)
					}, 400);
				}, delay);
				delay += 70;
			}
			setTimeout(function() {
				var t = parseInt($icons.first().css('top')) + 200;
				$icons.stop(true, true).animate({
					opacity: 0,
					top: t
				}, 400);
			}, delay);
			setTimeout(function() {
				$image.stop(true, true).removeClass('zoom');
			}, 100);
			setTimeout(function() {
				$('.overlay', item).stop(true, true).fadeOut(400);
			}, delay + 160);
		}
	}

	function hover_horizontal_sliding(item, hover) {
		var $title = $('.overlay .title', item);
		var $line = $('.overlay .overlay-line', item);
		var $subtitle = $('.overlay .subtitle', item);
		var $info = $('.overlay .info', item);
		var $icons = $('.overlay .icon', item);
		$('.overlay .links', item).css('text-align', 'left');
		var show_title = $title.size() > 0 && $title.css('display') != 'none';
		var show_subtitle = $subtitle.size() > 0 && $subtitle.css('display') != 'none';
		var show_info = $info.size() > 0 && $info.css('display') != 'none';
		var show_line = $line.size() > 0 && $line.css('display') != 'none';
		var $image_box = $('.image-inner', item);
		var $image = $('.image-inner img', item);
		if (hover) {
			$('.overlay', item).stop(true, true).hide().fadeIn(400);
			var icons_pos = [];

			if (show_title)
				$title.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			if (show_subtitle)
				$subtitle.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			if (show_info)
				$info.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			if (show_line)
				$line.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			$icons.stop(true, true).css({
				position: 'static',
				opacity: 1,
				marginTop: 0
			});

			if (show_title)
				var title_pos = getElementPosition($title[0]);
			if (show_subtitle)
				var subtitle_pos = getElementPosition($subtitle[0]);
			if (show_info)
				var info_pos = getElementPosition($info[0]);
			if (show_line)
				var line_pos = getElementPosition($line[0]);
			$icons.each(function() {
				icons_pos.push(getElementPosition(this));
			});

			var only_icons = false;
			if (!show_title && !show_subtitle && !show_info && !show_line)
				only_icons = true;

			$icons.each(function(index) {
				var $icon = $(this);
				var icon_pos = icons_pos[index];
				if (only_icons)
					$icon.css({
						position: 'absolute',
						left: -icon_pos.width,
						top: '50%',
						marginTop: -icon_pos.height / 2,
						opacity: 0
					});
				else
					$icon.css({
						position: 'absolute',
						left: -icon_pos.width,
						top: icon_pos.top,
						opacity: 0
					});
			});
			icons_pos = icons_pos.reverse();

			if (show_title)
				$title.css({
					position: 'absolute',
					width: title_pos.width,
					left: (title_pos.left - 300),
					top: title_pos.top,
					opacity: 0
				});
			if (show_subtitle)
				$subtitle.css({
					position: 'absolute',
					width: subtitle_pos.width,
					left: (subtitle_pos.left - 300),
					top: subtitle_pos.top,
					opacity: 0
				});
			if (show_info)
				$info.css({
					position: 'absolute',
					width: info_pos.width,
					left: (info_pos.left - 300),
					top: info_pos.top,
					opacity: 0
				});
			if (show_line)
				$line.css({
					position: 'absolute',
					width: 0,
					left: line_pos.left,
					top: (line_pos.top - parseInt($line.css('margin-top')))
				});

			if ($image.width() > $image_box.width()) {
				var left = $image.width() - $image_box.width();
				$image.stop(true, true).css({
					position: 'relative',
					left: 0
				}).animate({
					left: -left
				}, 400);
			}

			var delay = 0;

			$($icons.get().reverse()).each(function(index) {
				var $icon = $(this);
				var icon_pos = icons_pos[index];
				setTimeout(function() {
					$icon.animate({
						left: icon_pos.left,
						opacity: 1
					}, 300);
				}, 1 + index*40);
			});
			delay += 60;

			if (show_title || show_line) {
				setTimeout(function() {
					if (show_title)
						$title.animate({
							left: title_pos.left,
							opacity: 1
						}, 300);

					if (show_line)
						$line.animate({
							width: line_pos.width
						}, 300);
				}, delay);
				delay += 60;
			}

			if (show_subtitle) {
				setTimeout(function() {
					if (show_subtitle)
						$subtitle.animate({
							left: subtitle_pos.left,
							opacity: 1
						}, 300);
				}, delay);
				delay += 60;
			}

			if (show_info)
				setTimeout(function() {
					$info.animate({
						left: info_pos.left,
						opacity: 1
					}, 300);
				}, delay);
		} else {
			var delay = 0;

			$icons.each(function(index) {
				var $icon = $(this);
				setTimeout(function() {
					$icon.animate({
						left: (parseInt($icon.css('left')) - 300),
						opacity: 0
					}, 300);
				}, 1 + index*40);
			});
			$line.animate({
				width: 0
			}, 300);
			delay += 60;

			if (show_title) {
				setTimeout(function() {
					$title.animate({
						left: (parseInt($title.css('left')) - 300),
						opacity: 0
					}, 300);
				}, delay);
				delay += 60;
			}

			if (show_subtitle) {
				setTimeout(function() {
					if (show_subtitle)
						$subtitle.animate({
							left: (parseInt($subtitle.css('left')) - 300),
							opacity: 0
						}, 300);
				}, delay);
				delay += 60;
			}

			if (show_info)
				setTimeout(function() {
					$info.animate({
						left: (parseInt($info.css('left')) - 300),
						opacity: 0
					}, 300);
				}, delay);
			setTimeout(function() {
				if ($image.width() > $image_box.width()) {
					$image.stop(true, true).animate({
						left: 0
					}, 300);
				}
			}, 100);
			setTimeout(function() {
				$('.overlay', item).stop(true, true).fadeOut(400);
			}, 200);
		}
	}

	function hover_vertical_sliding(item, hover) {
		var $title = $('.overlay .title', item);
		var $subtitle = $('.overlay .subtitle', item);
		var $info = $('.overlay .info', item);
		var $line = $('.overlay .overlay-line', item);
		var $icons = $('.overlay .icon', item);
		var $description = $('.overlay .description', item);
		var show_title = $title.size() > 0 && $title.css('display') != 'none';
		var show_subtitle = $subtitle.size() > 0 && $subtitle.css('display') != 'none';
		var show_info = $info.size() > 0 && $info.css('display') != 'none';
		var $image_box = $('.image-inner', item);
		var $image = $('.image-inner img', item);
		if (hover) {
			$('.overlay', item).stop(true, true).hide().fadeIn(400);
			var icons_pos = [];

			if (show_title)
				$title.stop(true, true).css({
					position: 'static',
					opacity: 1,
					width: 'auto'
				});
			if (show_subtitle)
				$subtitle.stop(true, true).css({
					position: 'static',
					opacity: 1
				});
			if (show_info)
				$info.stop(true, true).css({
					position: 'static',
					opacity: 1
				});
			$line.stop(true, true).css({
				position: 'static',
				opacity: 1,
				width: 'auto'
			});
			$icons.stop(true, true).css({
				position: 'static',
				opacity: 1
			});

			$description.css({
				position: 'absolute',
			});

			if (show_title)
				var title_pos = getElementPosition($title[0]);
			if (show_subtitle)
				var subtitle_pos = getElementPosition($subtitle[0]);
			if (show_info)
				var info_pos = getElementPosition($info[0]);
			var line_pos = getElementPosition($line[0]);
			$icons.each(function() {
				icons_pos.push(getElementPosition(this));
			});

			$icons.each(function(index) {
				var $icon = $(this);
				var icon_pos = icons_pos[index];
				$icon.css({
					position: 'absolute',
					left: icon_pos.left,
					top: (icon_pos.top + 200),
					opacity: 0
				});
			});
			icons_pos = icons_pos.reverse();

			if (show_title)
				$title.css({
					position: 'absolute',
					width: title_pos.width,
					top: (title_pos.top + 200),
					opacity: 0
				});
			if (show_subtitle)
				$subtitle.css({
					position: 'absolute',
					width: subtitle_pos.width,
					left: subtitle_pos.left,
					top: (subtitle_pos.top - 20),
					opacity: 0
				});
			if (show_info)
				$info.css({
					position: 'absolute',
					width: info_pos.width,
					left: info_pos.left,
					top: (info_pos.top - 20),
					opacity: 0
				});
			$line.css({
				position: 'absolute',
				width: 0,
				left: line_pos.left,
				top: (line_pos.top - 16)
			});

			$description.css({
				position: 'static',
			});

			$image.stop(true, true).css({
				position: 'relative',
				transform: 'scale(1)'
			}).animate({
				transform: 'scale(1.15)'
			}, 400);

			$($icons.get().reverse()).each(function(index) {
				var $icon = $(this);
				var icon_pos = icons_pos[index];
				setTimeout(function() {
					$icon.animate({
						top: icon_pos.top,
						opacity: 1
					}, 300);
				}, 1 + index*40);
			});

			if (show_title)
				setTimeout(function() {
					$title.animate({
						top: title_pos.top,
						opacity: 1
					}, 300);
				}, 60);

			setTimeout(function() {
				if (show_subtitle)
					$subtitle.animate({
						top: subtitle_pos.top,
						opacity: 1
					}, 200);

				$line.animate({
					width: line_pos.width
				}, 200);
			}, 300);

			if (show_info)
				setTimeout(function() {
					$info.animate({
						top: info_pos.top,
						opacity: 1
					}, 200);
				}, 360);
		} else {
			var delay = 0
			if (show_info) {
				$info.animate({
					opacity: 0,
					top: (parseInt($info.css('top')) + 200)
				}, 300);
				delay += 60;
			}

			if (show_subtitle) {
				setTimeout(function() {
					$subtitle.animate({
						opacity: 0,
						top: (parseInt($subtitle.css('top')) + 200)
					}, 300);
				}, 60);
				delay += 60;
			}

			setTimeout(function() {
				if (show_title)
					$title.animate({
						opacity: 0,
						top: (parseInt($title.css('top')) + 200)
					}, 300);

				$line.animate({
					width: 0
				}, 300);
			}, delay);
			delay += 60;

			$($icons.get().reverse()).each(function(index) {
				var $icon = $(this);
				setTimeout(function() {
					$icon.animate({
						top: (parseInt($icon.css('top')) + 200),
						opacity: 0
					}, 300);
				}, delay + index*40);
			});
			setTimeout(function() {
				$image.stop(true, true).animate({
					transform: 'scale(1)'
				}, 300);
			}, 100);
			setTimeout(function() {
				$('.overlay', item).stop(true, true).fadeOut(400);
			}, 200);
		}
	}

	var portfolio_hovers = {
		'default': hover_default,
		'zooming-blur': hover_zooming_blur,
		'horizontal-sliding': hover_horizontal_sliding,
		'vertical-sliding': hover_vertical_sliding
	};

	function init_prev_next_navigator_buttons ($portfolio) {
		var current_page = $portfolio.data('current-page');
		var pages_count = $portfolio.data('pages-count');
		if (current_page <= 1)
			$('.portfolio-navigator a.prev', $portfolio).css('visibility', 'hidden');
		else
			$('.portfolio-navigator a.prev', $portfolio).css('visibility', 'visible');

		if (current_page >= pages_count)
			$('.portfolio-navigator a.next', $portfolio).css('visibility', 'hidden');
		else
			$('.portfolio-navigator a.next', $portfolio).css('visibility', 'visible');
	}

	function init_portfolio_pages($portfolio) {
		var count = $('.portfolio-set .portfolio-item', $portfolio).size();
		var default_per_page = $portfolio.data('per-page') || count;

		if ($('.portfolio-count select', $portfolio).size() > 0)
			var per_page = $('.portfolio-count select', $portfolio).val();
		else
			var per_page = default_per_page;

		var pages_count = Math.ceil(count / per_page);
		var current_page = 1;

		$portfolio.data('per-page', per_page);
		$portfolio.data('pages-count', pages_count);
		$portfolio.data('current-page', current_page);

		if ($('.portfolio-navigator', $portfolio).size() > 0 && pages_count > 1) {
			var pagenavigator = '<a href="#" class="prev">&#xe603;</a>';
			for (var i = 0; i < pages_count; i++)
				pagenavigator += '<a href="#" data-page="' + (i + 1) + '">' + (i + 1) + '</a>';
			pagenavigator += '<a href="#" class="next">&#xe601;</a>';
			$('.portfolio-navigator', $portfolio).html(pagenavigator).show();
			$('.portfolio-set', $portfolio).css('margin-bottom', '');
			$('.portfolio-navigator a[data-page="' + current_page + '"]', $portfolio).addClass('current')
			init_prev_next_navigator_buttons($portfolio);
		} else {
			$('.portfolio-navigator', $portfolio).html('').hide();
			$('.portfolio-set', $portfolio).css('margin-bottom', 0);
		}

		$('.portfolio-set .portfolio-item', $portfolio).removeClass(function(index, class_name) {
			return  (class_name.match (/\bpaginator-page-\S+/g) || []).join(' ');
		});
		$('.portfolio-set .portfolio-item', $portfolio).each(function(i) {
			var page = Math.ceil((i + 1) / per_page);
			$(this).addClass('paginator-page-' + page);
		});

		$('.portfolio-navigator', $portfolio).on('click', 'a', function() {
			if ($(this).hasClass('current'))
				return false;
			var current_page = $(this).siblings('.current:first').data('page');
			if ($(this).hasClass('prev')) {
				var page = current_page - 1;
			} else if ($(this).hasClass('next')) {
				var page = current_page + 1
			} else {
				var page = $(this).data('page');
			}
			if (page < 1)
				page = 1;
			if (page > pages_count)
				page = pages_count;
			$(this).siblings('a').removeClass('current');
			$(this).parent().find('a[data-page="' + page + '"]').addClass('current');
			$portfolio.data('current-page', page);
			init_prev_next_navigator_buttons($portfolio);
			var filterValue = '';
			if ($('.portfolio-filters a.active', $portfolio).size() > 0) {
				filterValue += $('.portfolio-filters a.active', $portfolio).data('filter');
			}
			filterValue += '.paginator-page-' + page;
			$('.portfolio-set', $portfolio).isotope({ filter: filterValue });
			$("html, body").animate({ scrollTop: $portfolio.offset().top - 200 }, 600);
			return false;
		});
	}

	function init_portfolio_count($portfolio) {
		if ($('.portfolio-count select', $portfolio).size() == 0)
			return false;
		$('.portfolio-count select', $portfolio).on('change', function() {
			init_portfolio_pages($portfolio);
			if ($('.portfolio-filters', $portfolio).size() > 0) {
				$('.portfolio-filters a', $portfolio).removeClass('active');
				$('.portfolio-filters a[data-filter="*"]', $portfolio).addClass('active');
			}
			var current_page = $portfolio.data('current-page');
			$('.portfolio-set', $portfolio).isotope({
				filter: '.paginator-page-' + current_page
			});
		});
	}

	function init_items_share() {
		$('.portfolio-item .share').not('.active').hide();
		$('.portfolio-item .button').off('click');
		$('.portfolio-item .button').on('click', function() {
			$(this).closest('.portfolio-item').find('.share').toggleClass('active').animate({height: 'toggle'});
			$(this).toggleClass('active');
		});

		function share_mouseover() {
			var timeout = $(this).parent().find('.share').data('share-timeout') || false;
			if (timeout) {
				clearTimeout(timeout);
				$(this).parent().find('.share').data('share-timeout', timeout);
			}
		}

		function share_mouseout() {
			var self = this;
			var timeout = $(this).parent().find('.share').data('share-timeout') || false;
			if (timeout)
				clearTimeout(timeout);
			if ($(this).parent().find('.button').hasClass('active')) {
				timeout = setTimeout(function() {
					if ($(self).parent().find('.button').hasClass('active'))
						$(self).parent().find('.button').click();
				}, 2000);
				$(this).parent().find('.share').data('share-timeout', timeout);
			}
		}

		$('.portfolio-item .share, .portfolio-item .button').on('mouseover', share_mouseover).on('mouseout', share_mouseout);
	}

	function init_items_last_icon() {
		$('.portfolio-item').each(function() {
			$('.links .icon:last', this).css('margin-right', '0');
		});
	}

	function init_items_hover() {
		$('.portfolio-item .image').unbind('hover');
		$('.portfolio-item .image').hover(
			function() {
				var $item = $(this).closest('.portfolio-item');
				if (true) {
					var hover_effect = $item.closest('.portfolio').data('hover');
					if (portfolio_hovers[hover_effect] != undefined && portfolio_hovers[hover_effect] != null)
						portfolio_hovers[hover_effect]($item, true);
				} else {
					$('.overlay', $item).show();
				}
				$(this).addClass('hover-active');
			},
			function() {
				var $item = $(this).closest('.portfolio-item');
				if (true) {
					var hover_effect = $item.closest('.portfolio').data('hover');
					if (portfolio_hovers[hover_effect] != undefined && portfolio_hovers[hover_effect] != null)
						portfolio_hovers[hover_effect]($item, false);
				} else {
					$('.overlay', $item).hide();
				}
				$(this).removeClass('hover-active');
			}
		);

		$('.portfolio-item .image .links a').unbind('hover');
		$('.portfolio-item .image .links a').hover(
			function() {
				$(this).stop(true, true).css({
					transform: 'scale(1)'
				}).animate({
					transform: 'scale(1.2)'
				}, 100)
			},
			function() {
				$(this).stop(true, true).animate({
					transform: 'scale(1)'
				}, 100)
			}
		);
	}

	function portfolio_load_core_request($portfolio) {
		var $set = $('.portfolio-set', $portfolio);
		var uid = $portfolio.data('portfolio-uid');
		var is_processing_request = $set.data('request-process') || false;
		if (is_processing_request)
			return false;
		$set.data('request-process', true);
		var data = $.extend(true, {}, window['portfolio_ajax_' + uid]);
		data['action'] = 'portfolio_load_more';
		if ($('.portfolio-count select', $portfolio).size() > 0)
			data['data']['more_count'] = $('.portfolio-count select', $portfolio).val();
		data['data']['more_page'] = $portfolio.data('next-page') || 1;
		if (data['data']['more_page'] == 0)
			return false;
		if ($('.portfolio-filters', $portfolio).size() > 0) {
			data['data']['portfolio'] = $portfolio.data('more-filter') || data['data']['portfolio'];
		}

		$('.portfolio-load-more .sc-button', $portfolio).before('<div class="loading"></div>');

		$.ajax({
			type: 'post',
			dataType: 'json',
			url: data.url,
			data: data,
			success: function(response) {
				if (response.status == 'success') {
					var minZIndex = $('.portfolio-item:last', $set).css('z-index') - 1;
					var $newItems = $(response.html);
					$('.portfolio-item', $newItems).addClass('paginator-page-1')
					$('.portfolio-item', $newItems).each(function() {
						$(this).css('z-index', minZIndex--);
					});
					var current_page = $newItems.data('page');
					var next_page = $newItems.data('next-page');
					if (current_page == 1) {
						$set.isotope('remove', $('.portfolio-item', $set));
					}
					var $inserted_data = $($newItems.html());
					$inserted_data.imagesLoaded(function() {
						$set.isotope('insert', $inserted_data);

						$('.portfolio-load-more .loading', $portfolio).remove();
						$portfolio.data('next-page', next_page);
						if (next_page > 0) {
							$('.portfolio-load-more', $portfolio).show();
						} else {
							$('.portfolio-load-more', $portfolio).hide();
						}

						init_items_share();
						init_items_last_icon();
						init_items_hover();
						$set.data('request-process', false);
					});
				} else {
					alert(response.message);
					$('.portfolio-load-more .sc-button .loading', $portfolio).remove();
				}
			}
		});
	}

	function init_portfolio_more_count($portfolio) {
		if ($('.portfolio-count select', $portfolio).size() == 0)
			return false;
		$('.portfolio-count select', $portfolio).on('change', function() {
			$portfolio.data('next-page', 1);
			portfolio_load_core_request($portfolio);
		});
	}

	$('.portfolio-count select').combobox();


	init_items_share();
	init_items_last_icon();
	init_items_hover();

	function fix_images_height($set) {
		return false;
		var zIndex = 100;
		$('.portfolio-item:visible', $set).each(function() {
			$('.image-inner img', this).css('height', 'auto');
			$('.image-inner img', this).css('height', $('.image-inner', this).outerHeight() + 'px');
			$(this).css('z-index', zIndex--);
		});
	}

	$(window).resize(function() {
		$('.portfolio').not('.portfolio-slider').each(function() {
			var $set = $('.portfolio-set', this);
			fix_images_height($set);
			if ($set.data('isotope')) {
				$set.isotope('layout');
			}
		});
	});

	$('.portfolio').not('.portfolio-slider').each(function() {
		var $portfolio = $(this);
		var $set = $('.portfolio-set', this);
		if ($('.portfolio-load-more', $portfolio).size() == 0) {
			init_portfolio_count($portfolio);
			init_portfolio_pages($portfolio);
			var current_page = $portfolio.data('current-page');
		} else {
			var current_page = 1;
			$('.portfolio-set .portfolio-item', $portfolio).addClass('paginator-page-1');
			init_portfolio_more_count($portfolio);
		}
		$set.imagesLoaded( function() {
			$portfolio.closest('.portfolio-preloader-wrapper').prev('.preloader').remove();
			fix_images_height($set);
			$set.isotope({
				itemSelector: '.portfolio-item',
				layoutMode: 'masonry',
				masonry: {
					columnWidth: '.portfolio-item:not(.double-item)'
				},
				filter: '.paginator-page-' + current_page
			}).on( 'arrangeComplete', function( event, filteredItems ) {
				if ($set.closest('.fullwidth-block').size() > 0) {
					$set.closest('.fullwidth-block').bind('fullwidthUpdate', function() {
						fix_images_height($set);
						if ($set.data('isotope')) {
							$set.isotope('layout');
						}
					});
				}
			});

			if (!$('body').hasClass('lazy-disabled')) {
				var elems = $('.portfolio-item:visible', $set);
				var items = [];
				for (var i = 0; i < elems.length; i++)
					items.push($set.isotope('getItem', elems[i]));
				$set.isotope('reveal', items);
			}

			if ($set.closest('.sc_tab').size() > 0) {
				$set.closest('.sc_tab').bind('tab-update', function() {
					fix_images_height($set);
					if ($set.data('isotope')) {
						$set.isotope('layout');
					}
				});
			}

			$(document).on('show.vc.tab', '[data-vc-tabs]', function() {
				var $tab = $(this).data('vc.tabs').getTarget();
				if($tab.find($set).length) {
					fix_images_height($set);
					if ($set.data('isotope')) {
						$set.isotope('layout');
					}
				}
			});

			if ($set.closest('.sc_accordion_content').size() > 0) {
				$set.closest('.sc_accordion_content').bind('accordion-update', function() {
					fix_images_height($set);
					if ($set.data('isotope')) {
						$set.isotope('layout');
					}
				});
			}


			if ($('.portfolio-filters', $portfolio).size() > 0) {
				$('.portfolio-filters, .portfolio-filters-resp ul li', $portfolio).on('click', 'a', function() {
					if ($('.portfolio-load-more', $portfolio).size() == 0) {
						var current_page = $portfolio.data('current-page');
						var filterValue = $(this).data('filter') || '';
						filterValue += '.paginator-page-' + current_page;
						$(this).siblings('a').removeClass('active');
						$(this).addClass('active');
						$('.portfolio-set', $portfolio).isotope({
							filter: filterValue
						});
						if ($('.portfolio-filters-resp', $portfolio).size() > 0)
							$('.portfolio-filters-resp', $portfolio).dlmenu('closeMenu');
					} else {
						var filterValue = $(this).data('filter') || '';
						$(this).siblings('a').removeClass('active');
						$(this).addClass('active');
						$portfolio.data('more-filter', filterValue.substr(1));
						$portfolio.data('next-page', 1);
						portfolio_load_core_request($portfolio);
					}
					return false;
				});
			}
			$('.info', $portfolio).on('click', 'a', function() {
				var slug = $(this).data('slug') || '';
				$('.portfolio-filters a[data-filter=".' + slug + '"]').click();
				return false;
			});
			$('.portfolio-load-more', $portfolio).on('click', function() {
				portfolio_load_core_request($portfolio);
			});
		});
		$('.portfolio-filters-resp', $portfolio).dlmenu({
			animationClasses: {
				classin : 'dl-animate-in',
				classout : 'dl-animate-out'
			}
		});
	});

	$(window).resize(function() {
		$('.portfolio.portfolio-slider').each(function() {
			var $portfolio = $(this);
			var first_item_height = $('.portfolio-item:first .image-inner', $portfolio).outerHeight();
			var button_height = $('.portolio-slider-prev span', $portfolio).outerHeight();
			$('.portolio-slider-prev', $portfolio).css('padding-top', (first_item_height - button_height) / 2);
			$('.portolio-slider-next', $portfolio).css('padding-top', (first_item_height - button_height) / 2);
		});
	});

	$('.portfolio.portfolio-slider').each(function() {
		var $portfolio = $(this);
		var $set = $('.portfolio-set', this);
		$prev = $('.portolio-slider-prev span', $portfolio);
		$next = $('.portolio-slider-next span', $portfolio);
		var data = {
			element: '.portfolio-item',
			prevButton: $prev,
			nextButton: $next,
			afterInit: function() {
				$portfolio.prev('.preloader').remove();
			}
		};
		$set.imagesLoaded( function() {
			$set.juraSlider(data);
			$(window).trigger('resize');
		});
	});
})(jQuery);

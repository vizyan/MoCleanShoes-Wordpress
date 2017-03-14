(function($) {
	$(function() {

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
			var $icons = $('.overlay .icon', item);
			var show_title = $title.size() > 0 && $title.css('display') != 'none';
			var show_subtitle = $subtitle.size() > 0 && $subtitle.css('display') != 'none';
			var $image_box = $('.image-wrap', item);
			var $image = $('.image-wrap img', item);
			$('.overlay-content-inner', item).width($('.overlay', item).width() - 30);
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
				$icons.stop(true, true).css({
					position: 'static',
					opacity: 1
				});

				if (show_title)
					var title_pos = getElementPosition($title[0]);
				if (show_subtitle)
					var subtitle_pos = getElementPosition($subtitle[0]);
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
				if (show_subtitle)
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
					}, 30);
				$icons.each(function(index) {
					var $icon = $(this);
					var icon_pos = icons_pos[index];
					setTimeout(function() {
						$icon.animate({
							top: icon_pos.top
						}, 300);
					}, 50 + index*40);
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
			var $icons = $('.overlay .icon', item);
			var show_title = $title.size() > 0 && $title.css('display') != 'none';
			var show_subtitle = $subtitle.size() > 0 && $subtitle.css('display') != 'none';
			var $image_box = $('.image-wrap', item);
			var $image = $('.image-wrap img', item);
			$('.overlay-content-inner', item).width($('.overlay', item).width() - 30);
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
				$icons.stop(true, true).css({
					position: 'static',
					opacity: 1
				});

				if (show_title)
					var title_pos = getElementPosition($title[0]);
				if (show_subtitle)
					var subtitle_pos = getElementPosition($subtitle[0]);
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

				$image.stop(true, true).css({
					position: 'relative',
					transform: 'scale(1)'
				}).animate({
					transform: 'scale(1.15)'
				}, 400);

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
			} else {
				var delay = 0
				if (show_subtitle) {
					$subtitle.stop(true, true).animate({
						opacity: 0,
						top: (parseInt($subtitle.css('top')) + 200)
					}, 400);
					delay += 70;
				}
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
					$image.stop(true, true).animate({
						transform: 'scale(1)'
					}, 300);
				}, 100);
				setTimeout(function() {
					$('.overlay', item).stop(true, true).fadeOut(400);
				}, delay + 160);
			}
		}

		var gallery_hovers = {
			'default': hover_default,
			'zooming-blur': hover_zooming_blur
		};

		function init_items_hover() {
			$('.gallery-item .wrap').unbind('hover').hover(
				function() {
					var $item = $(this).closest('.gallery-item');
					var hover_effect = $item.closest('.sc-gallery-grid').data('hover');

					if (gallery_hovers[hover_effect] != undefined && gallery_hovers[hover_effect] != null)
						gallery_hovers[hover_effect]($item, true);
				},
				function() {
					var $item = $(this).closest('.gallery-item');
					var hover_effect = $item.closest('.sc-gallery-grid').data('hover');
					if (gallery_hovers[hover_effect] != undefined && gallery_hovers[hover_effect] != null)
						gallery_hovers[hover_effect]($item, false);
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

		init_items_hover();

		function build_collage_gallery($gallery, $set) {
			var padding = 0;
			if (!$gallery.hasClass('without-padding'))
				padding = 10;
			$set.removeWhitespace().collagePlus({
				fadeSpeed: 1000,
				targetHeight: 300,
				allowPartialLastRow: true,
				padding: padding
			});
		}

		$('.sc-gallery-grid').not('.gallery-slider').each(function() {
			var $gallery = $(this);
			var $set = $('.gallery-set', this);
			if (!$gallery.hasClass('metro')) {
				$set.imagesLoaded( function() {
					$gallery.closest('.gallery-preloader-wrapper').prev('.preloader').remove();
					$set.isotope({
						itemSelector: '.gallery-item',
						layoutMode: 'masonry',
						masonry: {
							columnWidth: '.gallery-item:not(.double-item)'
						}
					});
				});

				if ($set.closest('.sc_tab').size() > 0) {
					$set.closest('.sc_tab').bind('tab-update', function() {
						$set.isotope('layout');
					});
				}
				$(document).on('show.vc.tab', '[data-vc-tabs]', function() {
					var $tab = $(this).data('vc.tabs').getTarget();
					if($tab.find($set).length) {
						$set.isotope('layout');
					}
				});
				if ($set.closest('.sc_accordion_content').size() > 0) {
					$set.closest('.sc_accordion_content').bind('accordion-update', function() {
						$set.isotope('layout');
					});
				}
			}
		});

		var resizeTimer = null;
		$('.sc-gallery-grid.metro').not('.gallery-slider').each(function() {
			var $gallery = $(this);
			var $set = $('.gallery-set', this);
			$set.imagesLoaded( function() {
				$gallery.closest('.gallery-preloader-wrapper').prev('.preloader').remove();
				build_collage_gallery($gallery, $set);
				$(window).bind('resize', function() {
					var resize_timer = $gallery.data('resize-timer') || '';
					if (resize_timer) clearTimeout(resize_timer);
					resize_timer = setTimeout(function() {
						build_collage_gallery($gallery, $set);
					}, 200);
					$gallery.data('resize-timer', resize_timer);
				});
				if ($set.closest('.sc_tab').size() > 0) {
					$set.closest('.sc_tab').bind('tab-update', function() {
						build_collage_gallery($gallery, $set);
					});
				}
				$(document).on('show.vc.tab', '[data-vc-tabs]', function() {
					var $tab = $(this).data('vc.tabs').getTarget();
					if($tab.find($set).length) {
						build_collage_gallery($gallery, $set);
					}
				});
				if ($set.closest('.sc_accordion_content').size() > 0) {
					$set.closest('.sc_accordion_content').bind('accordion-update', function() {
						build_collage_gallery($gallery, $set);
					});
				}
			});
		});

		$('.gallery-slider').each(function() {
			var $gallery = $(this);
			var $set = $('.gallery-set', this);
			var $items = $('.gallery-item', $set);

			// update images list
			$set.wrap('<div class="sc-gallery-preview-carousel-wrap clearfix"/>');
			var $galleryPreviewWrap = $('.sc-gallery-preview-carousel-wrap', this);
			$galleryPreviewWrap.wrap('<div class="sc-gallery-preview-carousel-padding clearfix"/>');
			var $galleryPreviewNavigation = $('<div class="sc-gallery-preview-navigation"/>')
				.appendTo($galleryPreviewWrap);
			var $galleryPreviewPrev = $('<a href="#" class="sc-prev sc-gallery-preview-prev"/></a>')
				.appendTo($galleryPreviewNavigation);
			var $galleryPreviewNext = $('<a href="#" class="sc-next sc-gallery-preview-next"/></a>')
				.appendTo($galleryPreviewNavigation);

			// create thumbs list
			var $galleryThumbsWrap = $('<div class="sc-gallery-thumbs-carousel-wrap col-lg-12 col-md-12 col-sm-12 clearfix" style="opacity: 0"/>')
				.appendTo($gallery);
			var $galleryThumbsCarousel = $('<ul class="sc-gallery-thumbs-carousel"/>')
				.appendTo($galleryThumbsWrap);
			var $galleryThumbsNavigation = $('<div class="sc-gallery-thumbs-navigation"/>')
				.appendTo($galleryThumbsWrap);
			var $galleryThumbsPrev = $('<a href="#" class="sc-prev sc-gallery-thumbs-prev"/></a>')
				.appendTo($galleryThumbsNavigation);
			var $galleryThumbsNext = $('<a href="#" class="sc-next sc-gallery-thumbs-next"/></a>')
				.appendTo($galleryThumbsNavigation);
			var thumbItems = '';
			$items.each(function() {
				thumbItems += '<li><span><img src="' + $('.image-wrap img', this).data('thumb-url') + '" alt="" /></span></li>';
			});
			var $thumbItems = $(thumbItems);
			$thumbItems.appendTo($galleryThumbsCarousel);
			$thumbItems.each(function(index) {
				$(this).data('gallery-item-num', index);
			});

			var $galleryPreview = $set.carouFredSel({
				auto: false,
				circular: false,
				infinite: false,
				responsive: true,
				width: '100%',
				height: '100%',
				items: 1,
				align: 'center',
				prev: $galleryPreviewPrev,
				next: $galleryPreviewNext,
				scroll: {
					items: 1,
					onBefore: function(data) {
						var current = $(this).triggerHandler('currentPage');
						var thumbCurrent = $galleryThumbs.triggerHandler('slice', [current, current+1]);
						var thumbsVisible = $galleryThumbs.triggerHandler('currentVisible');
						$thumbItems.filter('.active').removeClass('active');
						if(thumbsVisible.index(thumbCurrent) === -1) {
							$galleryThumbs.trigger('slideTo', current);
						}
						$('span', thumbCurrent).trigger('click');
					}
				}
			});

			var $galleryThumbs = null;
			$galleryThumbsCarousel.imagesLoaded( function() {
				$galleryThumbs = $galleryThumbsCarousel.carouFredSel({
					auto: false,
					circular: false,
					infinite: false,
					width: '100%',
					height: 'variable',
					align: 'center',
					prev: $galleryThumbsPrev,
					next: $galleryThumbsNext,
					onCreate: function(data) {
						$('span', $thumbItems).click(function(e) {
							e.preventDefault();
							$thumbItems.filter('.active').removeClass('active');
							$(this).closest('li').addClass('active');
							$galleryPreview.trigger('slideTo', $(this).closest('li').data('gallery-item-num'));
						});
						$thumbItems.eq(0).addClass('active');
					}
				});
				$galleryThumbsWrap.animate({opacity: 1}, 400);
			});
		});

		$('.sc-gallery').each(function() {

			var $galleryElement = $(this);

			var $thumbItems = $('.sc-gallery-item', $galleryElement);

			var $galleryPreviewWrap = $('<div class="sc-gallery-preview-carousel-wrap"/>')
				.appendTo($galleryElement);
			var $galleryPreviewCarousel = $('<div class="sc-gallery-preview-carousel"/>')
				.appendTo($galleryPreviewWrap);
			var $galleryPreviewNavigation = $('<div class="sc-gallery-preview-navigation"/>')
				.appendTo($galleryPreviewWrap);
			var $galleryPreviewPrev = $('<a href="#" class="sc-prev sc-gallery-preview-prev"/></a>')
				.appendTo($galleryPreviewNavigation);
			var $galleryPreviewNext = $('<a href="#" class="sc-next sc-gallery-preview-next"/></a>')
				.appendTo($galleryPreviewNavigation);
			var $previewItems = $thumbItems.clone(true, true);
			$previewItems.appendTo($galleryPreviewCarousel);
			$previewItems.each(function() {
				$('img', this).attr('src', $('a', this).attr('href'));
				$('a', this).attr('href', $('a', this).data('full-image-url'));
			});
			$('a', $galleryPreviewCarousel).click(function(e) {
				e.preventDefault();
				$.fancybox($(this));
			});

			var $galleryThumbsWrap = $('<div class="sc-gallery-thumbs-carousel-wrap"/>')
				.appendTo($galleryElement);
			var $galleryThumbsCarousel = $('<div class="sc-gallery-thumbs-carousel"/>')
				.appendTo($galleryThumbsWrap);
			var $galleryThumbsNavigation = $('<div class="sc-gallery-thumbs-navigation"/>')
				.appendTo($galleryThumbsWrap);
			var $galleryThumbsPrev = $('<a href="#" class="sc-prev sc-gallery-thumbs-prev"/></a>')
				.appendTo($galleryThumbsNavigation);
			var $galleryThumbsNext = $('<a href="#" class="sc-next sc-gallery-thumbs-next"/></a>')
				.appendTo($galleryThumbsNavigation);
			$thumbItems.appendTo($galleryThumbsCarousel);
			$thumbItems.each(function(index) {
				$(this).data('gallery-item-num', index);
			});

		});

		$('body').updateGalleries();
		$('.sc_tab').on('tab-update', function() {
			$(this).updateGalleries();
		});
		$(document).on('show.vc.tab', '[data-vc-tabs]', function() {
			$(this).data('vc.tabs').getTarget().updateGalleries();
		});
		$('.sc_accordion_content').on('accordion-update', function() {
			$(this).updateGalleries();
		});

	});

	$.fn.updateGalleries = function() {
		$('.sc-gallery', this).each(function() {
			var $galleryElement = $(this);

			var $galleryPreviewCarousel = $('.sc-gallery-preview-carousel', $galleryElement);
			var $galleryThumbsCarousel = $('.sc-gallery-thumbs-carousel', $galleryElement);
			var $thumbItems = $('.sc-gallery-item', $galleryThumbsCarousel);
			var $galleryPreviewPrev = $('.sc-gallery-preview-prev', $galleryElement);
			var $galleryPreviewNext = $('.sc-gallery-preview-next', $galleryElement);
			var $galleryThumbsPrev = $('.sc-gallery-thumbs-prev', $galleryElement);
			var $galleryThumbsNext = $('.sc-gallery-thumbs-next', $galleryElement);

			$galleryElement.scaliaPreloader(function() {

				var $galleryPreview = $galleryPreviewCarousel.carouFredSel({
					auto: false,
					circular: false,
					infinite: false,
					responsive: true,
					width: '100%',
					height: 'auto',
					items: 1,
					align: 'center',
					prev: $galleryPreviewPrev,
					next: $galleryPreviewNext,
					scroll: {
						items: 1,
						onBefore: function(data) {
							var current = $(this).triggerHandler('currentPage');
							var thumbCurrent = $galleryThumbs.triggerHandler('slice', [current, current+1]);
							var thumbsVisible = $galleryThumbs.triggerHandler('currentVisible');
							$thumbItems.filter('.active').removeClass('active');
							if(thumbsVisible.index(thumbCurrent) === -1) {
								$galleryThumbs.trigger('slideTo', current);
							}
							$('a', thumbCurrent).trigger('click');
						}
					},
					onCreate: function () {
						$(window).on('resize', function () {
							$galleryPreviewCarousel.parent().add($galleryPreviewCarousel).height($galleryPreviewCarousel.children().first().height());
						}).trigger('resize');
					}
				});

				var $galleryThumbs = $galleryThumbsCarousel.carouFredSel({
					auto: false,
					circular: false,
					infinite: false,
					width: '100%',
					height: 'variable',
					align: 'center',
					prev: $galleryThumbsPrev,
					next: $galleryThumbsNext,
					onCreate: function(data) {
						$('a', $thumbItems).click(function(e) {
							e.preventDefault();
							$thumbItems.filter('.active').removeClass('active');
							$(this).closest('.sc-gallery-item').addClass('active');
							$galleryPreview.trigger('slideTo', $(this).closest('.sc-gallery-item').data('gallery-item-num'));
						});
						$thumbItems.eq(0).addClass('active');
					}
				});

			});
		});
	}

})(jQuery);

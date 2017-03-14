(function($) {

	var ua = navigator.userAgent.toLowerCase(),
	platform = navigator.platform.toLowerCase(),
	UA = ua.match(/(opera|ie|firefox|chrome|version)[\s\/:]([\w\d\.]+)?.*?(safari|version[\s\/:]([\w\d\.]+)|$)/) || [null, 'unknown', 0],
	mode = UA[1] == 'ie' && document.documentMode;

	var Browser = {
		name: (UA[1] == 'version') ? UA[3] : UA[1],
		Platform: {
			name: ua.match(/ip(?:ad|od|hone)/) ? 'ios' : (ua.match(/(?:webos|android)/) || platform.match(/mac|win|linux/) || ['other'])[0]
		},
	};

	function getOffset(elem) {
		if (elem.getBoundingClientRect && Browser.Platform.name != 'ios'){
			var bound = elem.getBoundingClientRect(),
				html = elem.ownerDocument.documentElement,
				htmlScroll = getScroll(html),
				elemScrolls = getScrolls(elem),
				isFixed = (styleString(elem, 'position') == 'fixed');
			return {
				x: parseInt(bound.left) + elemScrolls.x + ((isFixed) ? 0 : htmlScroll.x) - html.clientLeft,
				y: parseInt(bound.top)  + elemScrolls.y + ((isFixed) ? 0 : htmlScroll.y) - html.clientTop
			};
		}

		var element = elem, position = {x: 0, y: 0};
		if (isBody(elem)) return position;

		while (element && !isBody(element)){
			position.x += element.offsetLeft;
			position.y += element.offsetTop;

			if (Browser.name == 'firefox'){
				if (!borderBox(element)){
					position.x += leftBorder(element);
					position.y += topBorder(element);
				}
				var parent = element.parentNode;
				if (parent && styleString(parent, 'overflow') != 'visible'){
					position.x += leftBorder(parent);
					position.y += topBorder(parent);
				}
			} else if (element != elem && Browser.name == 'safari'){
				position.x += leftBorder(element);
				position.y += topBorder(element);
			}

			element = element.offsetParent;
		}
		if (Browser.name == 'firefox' && !borderBox(elem)){
			position.x -= leftBorder(elem);
			position.y -= topBorder(elem);
		}
		return position;
	};

	function getScroll(elem){
		return {x: window.pageXOffset || document.documentElement.scrollLeft, y: window.pageYOffset || document.documentElement.scrollTop};
	};

	function getScrolls(elem){
		var element = elem.parentNode, position = {x: 0, y: 0};
		while (element && !isBody(element)){
			position.x += element.scrollLeft;
			position.y += element.scrollTop;
			element = element.parentNode;
		}
		return position;
	};

	function styleString(element, style) {
		return $(element).css(style);
	};

	function styleNumber(element, style){
		return parseInt(styleString(element, style)) || 0;
	};

	function borderBox(element){
		return styleString(element, '-moz-box-sizing') == 'border-box';
	};

	function topBorder(element){
		return styleNumber(element, 'border-top-width');
	};

	function leftBorder(element){
		return styleNumber(element, 'border-left-width');
	};

	function isBody(element){
		return (/^(?:body|html)$/i).test(element.tagName);
	};

	$('#site-header.animated-header').headerAnimation();

	if(Modernizr.touch) {
		jQuery('body').addClass('lazy-disabled');
	}

	if(!$('body').hasClass('lazy-disabled')) {
		if($.support.opacity) {
			if($(window).width() > 800) {
				$('.wpb_text_column.wpb_animate_when_almost_visible.wpb_fade').each(function() {
					$(this).wrap('<div class="lazy-loading"></div>').addClass('lazy-loading-item').data('ll-effect', 'fading');
				});

				$('.sc-list.lazy-loading').each(function() {
					$(this).data('ll-item-delay', '200');
					$('li', this).addClass('lazy-loading-item').data('ll-effect', 'slide-right');
				});

				$.lazyLoading();
			}
		}
	}

	function fix_megamenu_position() {
		$('#primary-menu > li.megamenu-enable').each(function() {
					var $item = $('> ul', this);
					if($item.length == 0) return;
					var self = $('> ul', this).get(0);
								$item.addClass('without-transition');
								$item.removeClass('megamenu-masonry-inited').removeClass('megamenu-fullwidth').css({
									left: 0,
									width: 'auto',
									height: 'auto'
								});
								$(' > li', $item).css({
									left: 0,
									top: 0
								}).each(function() {
									var old_width = $(this).data('old-width') || -1;
									if (old_width != -1)
										$(this).width(old_width).data('old-width', -1);
								});

								if ($('#primary-navigation .menu-toggle').is(':visible'))
									return;

								var $container = $item.closest('.container');
								var container_width = $container.width();
								var container_padding_left = parseInt($container.css('padding-left'));
								var container_padding_right = parseInt($container.css('padding-right'));
								var megamenu_width = $item.outerWidth();
								var parent_width = $item.parent().outerWidth();

								if (megamenu_width > container_width) {
									megamenu_width = container_width;
									var new_megamenu_width = container_width - parseInt($item.css('padding-left')) - parseInt($item.css('padding-right'));
									$item.addClass('megamenu-fullwidth').width(new_megamenu_width);
									var columns = $item.data('megamenu-columns') || 4;
									var column_width = (new_megamenu_width - (columns - 1) * parseInt($(' > li:first', $item).css('margin-left'))) / columns;
									$(' > li', $item).each(function() {
										$(this).data('old-width', $(this).width()).width(column_width);
									});
								}

								if (megamenu_width > parent_width)
									var left = -(megamenu_width - parent_width) / 2;
								else
									var left = 0;

								var container_offset = getOffset($container[0]);
								var megamenu_offset = getOffset(self);

								if ((megamenu_offset.x - container_offset.x - container_padding_left + left) < 0)
									left = -(megamenu_offset.x - container_offset.x - container_padding_left);

								if ((megamenu_offset.x + megamenu_width + left) > (container_offset.x + $container.outerWidth() - container_padding_right)) {
									left -= (megamenu_offset.x + megamenu_width + left) - (container_offset.x + $container.outerWidth() - container_padding_right);
								}

								$item.css('left', left).css('left');

								if ($item.hasClass('megamenu-masonry')) {
									var positions = {};
									var max_bottom = 0;
									$item.width($item.width());
									var new_row_height = $('.megamenu-new-row', $item).outerHeight() + parseInt($('.megamenu-new-row', $item).css('margin-bottom'));
									$('> li.menu-item', $item).each(function() {
										var pos = $(this).position();
										if (positions[pos.left] != null && positions[pos.left] != undefined) {
											var top_position = positions[pos.left];
										} else {
											var top_position = pos.top;
										}
										positions[pos.left] = top_position + $(this).outerHeight() + new_row_height;
										if (positions[pos.left] > max_bottom)
											max_bottom = positions[pos.left];
										$(this).css({
											left: pos.left,
											top: top_position
										})
									});
									$item.height(max_bottom - new_row_height - parseInt($item.css('padding-top')));
									$item.addClass('megamenu-masonry-inited');
								}

								$item.removeClass('without-transition');
		});
	}

	fix_megamenu_position();

	$.fn.updateTabs = function() {

		jQuery('.sc-tabs', this).each(function(index) {
			var $tabs = $(this);
			$tabs.scaliaPreloader(function() {
				$tabs.easyResponsiveTabs({
					type: 'default',
					width: 'auto',
					fit: false,
					activate: function(currentTab, e) {
						var $tab = $(currentTab.target);
						var controls = $tab.attr('aria-controls');
						$tab.closest('.ui-tabs').find('.sc_tab[aria-labelledby="' + controls + '"]').trigger('tab-update');
					}
				});
			});
		});

		jQuery('.sc-tour', this).each(function(index) {
			var $tabs = $(this);
			$tabs.scaliaPreloader(function() {
				$tabs.easyResponsiveTabs({
					type: 'vertical',
					width: 'auto',
					fit: false,
					activate: function(currentTab, e) {
						var $tab = $(currentTab.target);
						var controls = $tab.attr('aria-controls');
						$tab.closest('.ui-tabs').find('.sc_tab[aria-labelledby="' + controls + '"]').trigger('tab-update');
					}
				});
			});
		});

	}

	$(function() {

		/* PRIMARY MENU */

		$('#primary-navigation .submenu-languages').addClass('dl-submenu');
		$('#primary-navigation > ul> li.menu-item-language').addClass('menu-item-parent');

		$('#primary-navigation').dlmenu({
			animationClasses: {
				classin : 'dl-animate-in',
				classout : 'dl-animate-out'
			},
			onLevelClick: function (el, name) {
				$('html, body').animate({ scrollTop : 0 });
			}
		});

		$(window).resize(function() {
			if($('#primary-navigation .menu-toggle').is(':visible')) {
				$('#primary-navigation .dl-submenu-disabled').addClass('dl-submenu').removeClass('dl-submenu-disabled');
				$('#primary-menu').removeClass('no-responsive');
				$('#primary-navigation').addClass('responsive');
				fix_megamenu_position();
			} else {
				$('#primary-navigation .dl-submenu').addClass('dl-submenu-disabled').removeClass('dl-submenu');
				$('#primary-menu').addClass('no-responsive');
				$('#primary-navigation').removeClass('responsive');
				fix_megamenu_position();
				
				$('#primary-menu ul:not(.minicart ul), #primary-menu .minicart').each(function() {
					var $item = $(this);
					var self = this;
					$item.removeClass('invert');
					if ($item.closest('.megamenu-enable').size() == 0) {
						if($item.offset().left - $('#page').offset().left + $item.outerWidth() > $('#page').width()) {
							$item.addClass('invert');
						}
					}
				});
				
			}
		});

		$('#primary-navigation a').click(function(e) {
			var $item = $(this);
			if($('#primary-menu').hasClass('no-responsive') && Modernizr.touch && $item.next('ul').length) {
				e.preventDefault();
			}
		});

		/* FULLWIDTH BLOCK */
		$('.fullwidth-block').each(function() {
			var $item = $(this);
			$(window).resize(function() {
				$item.offset({
					left: $('#page').offset().left,
					top: $item.offset().top
				});
				$item.outerWidth($('#page').outerWidth());
				$item.trigger('updateTestimonialsCarousel');
				$item.trigger('updateClientsCarousel');
				$item.trigger('fullwidthUpdate');
			});
		});

		jQuery('.sc-combobox, .widget_archive select, .widget_product_categories select, .widget_layered_nav select, .widget_categories select').each(function(index) {
			$(this).combobox();
		});

		jQuery('.sc-checkbox').checkbox();

		jQuery('.sc-table-responsive').each(function(index) {
			$('> table', this).ReStable({
				maxWidth: 768,
				rowHeaders : $(this).hasClass('row-headers')
			});
		});

		jQuery('.fancybox').each(function() {
			$(this).fancybox();
		});

		jQuery('iframe').not('.sc-video-background iframe').each(function() {
			$(this).scaliaPreloader(function() {});
		});

		jQuery('.sc-video-background').each(function() {
			var $videoBG = $(this);
			var $videoContainer = $('.sc-video-background-inner', this);
			var ratio = $videoBG.data('aspect-ratio') ? $videoBG.data('aspect-ratio') : '16:9';
			var regexp = /(\d+):(\d+)/;
			ratio = regexp.exec(ratio);
			if(!ratio || parseInt(ratio[1]) == 0 || parseInt(ratio[2]) == 0) {
				ratio = 16/9;
			} else {
				ratio = parseInt(ratio[1])/parseInt(ratio[2]);
			}
			$(window).resize(function() {
				$videoContainer.removeAttr('style');
				if($videoContainer.width() / $videoContainer.height() > ratio) {
					$videoContainer.css({
						height: ($videoContainer.width() / ratio) + 'px',
						marginTop: -($videoContainer.width() / ratio - $videoBG.height()) / 2 + 'px'
					});
				} else {
					$videoContainer.css({
						width: ($videoContainer.height() * ratio) + 'px',
						marginLeft: -($videoContainer.height() * ratio - $videoBG.width()) / 2 + 'px'
					});
				}
			});
		});

		jQuery('.sc-slideshow').each(function() {
			var $slideshow = $(this);
			$slideshow.scaliaPreloader(function() {});
		});

		function init_odometer(el) {
			if (jQuery('.sc-counter-odometer', el).size() == 0)
				return;
			var odometer = jQuery('.sc-counter-odometer', el).get(0);
			var od = new Odometer({
				el: odometer,
				value: $(odometer).text(),
				format: '( ddd).ddd'
				//format: '( ddd),ddd'
				//format: '(,ddd).ddd'
			});
			od.update($(odometer).data('to'));
		}
		window['scalia_init_odometer'] = init_odometer;

		jQuery('.sc-counter').each(function(index) {
			if ($(window).width() > 800 && jQuery(this).closest('.sc-counter-box').size() > 0 && jQuery(this).closest('.sc-counter-box').hasClass('lazy-loading') && !jQuery('body').hasClass('lazy-disabled')) {
				jQuery(this).addClass('lazy-loading-item').data('ll-effect', 'action').data('item-delay', '0').data('ll-action-func', 'scalia_init_odometer');
				jQuery('.sc-icon', this).addClass('lazy-loading-item').data('ll-effect', 'fading').data('item-delay', '0');
				jQuery('.sc-counter-text', this).addClass('lazy-loading-item').data('ll-effect', 'fading').data('item-delay', '0');
				return;
			}
			init_odometer(this);
		});

		jQuery('.panel-sidebar-sticky > .sidebar').scSticky();

		jQuery('iframe + .map-locker').each(function() {
			var $locker = $(this);
			$locker.click(function(e) {
				e.preventDefault();
				if($locker.hasClass('disabled')) {
					$locker.prev('iframe').css({ 'pointer-events' : 'none' });
				} else {
					$locker.prev('iframe').css({ 'pointer-events' : 'auto' });
				}
				$locker.toggleClass('disabled');
			});
		});

		$('.primary-navigation a, .footer-navigation a, .scroll-top-button, .scroll-to-anchor, .sc-button').each(function() {
			var $anhor = $(this);
			var link = $anhor.attr('href');
			if(!link) return false;
			link = link.split('#');
			if($('#'+link[1]).length) {
				$anhor.closest('li').removeClass('menu-item-active current-menu-item');
				$(window).scroll(function() {
					var correction = $('#site-header').outerHeight() + $('#site-header').position().top;
					var target_top = $('#'+link[1]).offset().top - correction;
					if(getScrollY() >= target_top && getScrollY() <= target_top + $('#'+link[1]).outerHeight()) {
						$anhor.closest('li').addClass('menu-item-active');
					} else {
						$anhor.closest('li').removeClass('menu-item-active');
					}
				});
				$anhor.click(function(e) {
					e.preventDefault();
					var correction = 0;
					if($('#site-header.animated-header').length) {
						var shrink = $('#site-header').hasClass('shrink');
						$('#site-header').addClass('scroll-counting');
						$('#site-header').addClass('fixed shrink');
						correction = $('#site-header').outerHeight() + $('#site-header').position().top;
						if(!shrink) {
							$('#site-header').removeClass('fixed shrink');
						}
						$('#site-header').removeClass('scroll-counting');
					}
					var target_top = $('#'+link[1]).offset().top - correction + 1;
					$('html, body').stop(true, true).animate({scrollTop:target_top}, 1500, 'easeInOutQuint');
				});
			}
			$(window).load(function() {
				if(window.location.href == $anhor.attr('href')) {
					$anhor.click();
				}
			});
		});

		$(window).scroll(function() {
			if(getScrollY() > 0) {
				$('.scroll-top-button').addClass('visible');
			} else {
				$('.scroll-top-button').removeClass('visible');
			}
		}).scroll();

		function getScrollY(elem){
			return window.pageYOffset || document.documentElement.scrollTop;
		}

		$('a.hidden-email').each(function() {
			$(this).attr('href', 'mailto:'+$(this).data('name')+'@'+$(this).data('domain'));
		});

		$('body').updateTabs();

		$(window).trigger('resize');

		$(window).load(function() {
			$(window).trigger('resize');
		});

	});
})(jQuery);

(function($) {
	$.fn.scaliaPreloader = function(callback) {
		$(this).each(function() {
			var $el = $(this);
			if(!$el.prev('.preloader').length) {
				$('<div class="preloader">').insertBefore($el);
			}
			$el.data('scaliaPreloader', $('img, iframe', $el).add($el.filter('img, iframe')).length);
			if($el.data('scaliaPreloader') == 0) {
				$el.prev('.preloader').remove();
				callback();
			}
			$('img, iframe', $el).add($el.filter('img, iframe')).each(function() {
				var $obj = $('<img>');
				if($(this).prop('tagName').toLowerCase() == 'iframe') {
					$obj = $(this);
				}
				$obj.attr('src', $(this).attr('src'));
				$obj.on('load error', function() {
					$el.data('scaliaPreloader', $el.data('scaliaPreloader')-1);
					if($el.data('scaliaPreloader') == 0) {
						$el.prev('.preloader').remove();
						callback();
					}
				});
			});
		});
	}
})(jQuery);
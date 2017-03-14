(function($) {

	$(function() {
		$('.site-title a .logo-2x, .site-title a .logo-3x').each(function() {
			var $logo = $(this);
			$('img', $logo).each(function() {
				var $img = $(this);
				if($img.get(0).complete) {
					$img.width(parseInt($img.width()/($logo.hasClass('logo-2x') ? 2 : 3)));
					$img.css({ visibility : 'visible' });
					setMargin($img.parent().find('img.default'));
				} else {
					$img.load(function() {
						$img.width(parseInt($img.width()/2));
						$img.css({ visibility : 'visible' });
						setMargin($img.parent().find('img.default'));
					});
				}
			});
		});

		$('.site-title h1 .logo:visible img').load(function() {
			$('.site-title a .logo:visible img.small').show();
			$(this).closest('.site-title .logo:visible').width(Math.max($('.site-title a .logo:visible img.default').width(), $('.site-title a .logo:visible img.small').width()));
		});
	});

	function setMargin(img) {
		var w = $(img).width();
		$(img).siblings('img.small').show();
		if($(img).closest('.header-main.logo-position-right').length) {
			w = $(img).siblings('img.small').width();
		}
		if($(img).closest('.header-main.logo-position-center').length) {
			w = $(img).siblings('img.small').width() + ($(img).width() - $(img).siblings('img.small').width()) / 2;
			$(img).siblings('img.small').css('margin-right', ($(img).width() - $(img).siblings('img.small').width()) / 2 + 'px');
		}
		$(img).siblings('img.small').css('margin-left', '-' + w + 'px');
	}

	function HeaderAnimation(el, options) {
		this.el = el;
		this.$el = $(el);
		this.options = {
			startTop: 100
		};
		$.extend(this.options, options);
		this.initialize();
	}

	HeaderAnimation.prototype = {
		initialize: function() {
			var self = this;
			this.hasAnimation = false;
			this.originalMenuLinkPaddingTop = '';
			this.originalMenuLinkPaddingBottom = '';
			this.supportTransition = Modernizr.csstransitions;
			this.$el.wrap('<div id="site-header-wrapper"></div>');
			this.$wrapper = $('#site-header-wrapper');
			this.initializeHeight();
			if(this.$el.hasClass('header-on-slideshow') && $('#main-content > *').first().is('.sc-slideshow, .block-slideshow')) {
				this.$wrapper.addClass('header-on-slideshow');
			} else {
				this.$el.removeClass('header-on-slideshow');
			}
			if($('.page-title-block .sc-video-background').length && $('.page-title-block .sc-video-background').data('headerup')) {
				this.$el.addClass('header-on-slideshow');
				this.$wrapper.addClass('header-on-slideshow');
			}
			//this.$el.addClass('init');
			this.initializeStyles();
			this.updateTopOffset();
			if ($('#top-area').size() > 0)
				this.options.startTop = $('#top-area').outerHeight();
			$(window).scroll(function() {
				self.scrollHandler();
			});
			$(window).resize(function() {
				self.scrollHandler();
				setTimeout(function() {
					self.initializeHeight();
				}, 350);
			});
			$(document).ready(function() {
				self.scrollHandler();
			});

		},

		initializeStyles: function() {
			var self = this;
			if ($('.site-title a .logo:visible img.default', this.$el).size() > 0 && $('.site-title a .logo:visible img.default', this.$el)[0].complete) {
				setMargin($('.site-title a .logo:visible img.default', this.$el));
				self.initializeHeight();
			} else {
				$('.site-title a .logo:visible img.default', this.$el).on('load error', function() {
					setMargin(this);
					self.initializeHeight();
				});
			}

		},

		initializeHeight: function() {
			var shrink = this.$el.hasClass('shrink');
			var fixed = this.$el.hasClass('fixed');
			this.$el.removeClass('shrink fixed');
			this.updateTopOffset();
			if($('.page-title-block .sc-video-background').length && $('.page-title-block .sc-video-background').data('headerup')) {
				$('.page-title-block').css('paddingTop', '');
				$('.page-title-block').css({
					paddingTop: parseInt($('.page-title-block').css('paddingTop')) + this.$el.outerHeight() + 'px'
				});
			}
			if($('#primary-navigation .menu-toggle').is(':visible'))
				return false;
			this.$wrapper.height(this.$el.outerHeight());
			if(shrink) {
				this.$el.addClass('shrink');
			}
			if(fixed) {
				this.$el.addClass('fixed');
			}
		},

		updateTopOffset: function() {
			var offset = parseInt($('html').css('margin-top'));
			if (this.$wrapper.hasClass('header-on-slideshow') && !this.$el.hasClass('fixed'))
				offset = 0;
			var scroll = getScrollY();
			if ($('#top-area').size() > 0 && $('#top-area').is(':visible')) {
				var top_area_height = $('#top-area').outerHeight();
				if (scroll < top_area_height)
					offset += top_area_height - scroll;
			}
			this.$el.css('top', offset + 'px');
		},

		firstShrink: function() {
			this.$el.parent().css({
				position: 'static'
			});
			if(this.$el.hasClass('header-on-slideshow') && $('#main-content > *').first().is('.sc-slideshow, .block-slideshow')) {
				this.$wrapper.css({position: 'absolute'});
			}
			this.$el.addClass('fixed');
		},

		scrollHandler: function() {
			if (this.hasAnimation)
				return false;
			if($('#primary-navigation .menu-toggle').is(':visible'))
				return false;
			this.updateTopOffset();
			var scroll = getScrollY();
			if (scroll >= this.options.startTop) {
				//this.$el.removeClass('init');
				if (!this.$el.hasClass('shrink')) {
					this.firstShrink();
					this.shrink();
				}
			} else {
				if (this.$el.hasClass('shrink')) {
					this.expand();
				}
			}
		},

		expand: function() {
			var self = this;
			this.hasAnimation = true;
			this.$el.removeClass('shrink')
			if (!this.supportTransition) {
				if (this.originalMenuLinkPaddingTop || this.originalMenuLinkPaddingBottom)
					$('#primary-menu > li > a').animate({
						paddingTop: this.originalMenuLinkPaddingTop,
						paddingBottom: this.originalMenuLinkPaddingBottom
					}, 300, function() {
						self.hasAnimation = false;
					});
			} else {
				this.hasAnimation = false;
			}
		},

		shrink: function() {
			var self = this;
			this.hasAnimation = true;
			this.$el.addClass('shrink');
			if (!this.supportTransition) {
				this.originalMenuLinkPaddingTop = $('#primary-menu > li > a:first').css('padding-top');
				this.originalMenuLinkPaddingBottom = $('#primary-menu > li > a:first').css('padding-top');
				$('#primary-menu > li > a').animate({
					paddingTop: '28px',
					paddingBottom: '28px'
				}, 300, function () {
					self.hasAnimation = false;
				});
			} else {
				this.hasAnimation = false;
			}
		}
	};

	function getScrollY(elem){
		return window.pageYOffset || document.documentElement.scrollTop;
	};

	$.fn.headerAnimation = function(options) {
		options = options || {};
		return new HeaderAnimation(this.get(0), options);
	}
})(jQuery);

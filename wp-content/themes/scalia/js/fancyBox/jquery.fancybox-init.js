(function($) {
	$('a.fancy').fancybox();
    $('a.fancy-gallery').fancybox({
        helpers : {
            title: {
                type: 'over'
            }
        },
        wrapCSS: 'slideinfo',
        beforeLoad: function() {
            var clone = $(this.element).children('.slide-info').clone();

            if (clone.length) {
                this.title = clone.html();
            }
        }
    });

	$('.portfolio-item a.vimeo, .portfolio-item a.youtube, .blog article a.youtube, .blog article a.vimeo').fancybox({
		type: 'iframe'
	});
	$('.portfolio-item a.self_video').fancybox({
		width: '80%',
		height: '80%',
		autoSize: false,
		content: '<div id="fancybox-video"></div>',
		afterShow: function() {
			if(this.element.closest('.portfolio-item').find('.videoblock').html() != '') {
				this.inner.html(this.element.closest('.portfolio-item').find('.videoblock').html());
			} else {
				jwplayer('fancybox-video').setup({
					file: this.href,
					width: '100%',
					height: '100%',
					autostart: true
				});
			}
		},
		beforeClose: function() {
			if(this.element.next('.videoblock').html() == '') {
				jwplayer('fancybox-video').remove();
			}
		}
	});
})(jQuery);

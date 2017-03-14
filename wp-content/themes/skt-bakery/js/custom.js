jQuery(window).load(function() {
		if(jQuery('#slider') > 0) {
        jQuery('.nivoSlider').nivoSlider({
        	effect:'fade',
    });
		} else {
			jQuery('#slider').nivoSlider({
        	effect:'fade',
    });
		}
});
	
// navigation script for responsive
var skt_bakery_bowser_width = jQuery(window).width();
jQuery(document).ready(function() { 
	jQuery(".site-nav li a").each(function() {
		if (jQuery(this).next().length > 0) {
			jQuery(this).addClass("parent");
		};
	})
	jQuery(".mobile_nav a").click(function(e) { 
		e.preventDefault();
		jQuery(this).toggleClass("active");
		jQuery(".site-nav").slideToggle('fast');
	});
	adjustMenu();
})
// navigation orientation resize callbak
jQuery(window).bind('resize orientationchange', function() {
	ww = jQuery(window).width();
	adjustMenu();
});
// navigation function for responsive
var adjustMenu = function() {
	if (skt_bakery_bowser_width < 989) {
		jQuery(".mobile_nav a").css("display", "block");
		if (!jQuery(".mobile_nav a").hasClass("active")) {
			jQuery(".site-nav").hide();
		} else {
			jQuery(".site-nav").show();
		}
		jQuery(".site-nav li").unbind('mouseenter mouseleave');
	} else {
		jQuery(".mobile_nav a").css("display", "none");
		jQuery(".site-nav").show();
		jQuery(".site-nav li").removeClass("hover");
		jQuery(".site-nav li a").unbind('click');
		jQuery(".site-nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
			jQuery(this).toggleClass('hover');
		});
	}
}
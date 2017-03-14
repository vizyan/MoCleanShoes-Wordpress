function update_price_order_code(elem) {
	if ( jQuery( elem ).data( 'order_button_text' ) ) {
		jQuery( '#place_order' ).html( jQuery( elem ).data( 'order_button_text' ) );
	} else {
		jQuery( '#place_order' ).html( jQuery( '#place_order' ).data( 'value' ) );
	}
}

(function($) {
	jQuery('.woocommerce-button-next-step').click(function() {
		var tab_id = $(this).closest('.sc_tab').attr('id').replace('tab-', '');
		$(this).closest('.sc-tabs').find('.sc_tabs_nav li.' + tab_id + '_tab').next('li').click();
		return false;
	});
})(jQuery);

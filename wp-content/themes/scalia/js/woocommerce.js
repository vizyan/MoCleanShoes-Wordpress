(function($) {
	$('.variations_form').each(function() {
		$form = $(this)
			.on('change', '.variations select', function(event) {
				var $text = $(this).closest('.combobox-wrapper').find('.combobox-text');
				$text.text($('option:selected', $(this)).text());
			});
	});

	$('body').on('country_to_state_changed', function(e, country, wrap) {
		if($('select#calc_shipping_state', wrap).length) {
			$('select#calc_shipping_state', wrap).combobox();
		} else {
			$('#calc_shipping_state', wrap).insertBefore($('#calc_shipping_state', wrap).parent('.combobox-wrapper'));
			$('#calc_shipping_state', wrap).next('.combobox-wrapper').remove();
		}
	});
	$('body').on('updated_shipping_method', function() {
		$('select.shipping_method').combobox();
		$('input.shipping_method').checkbox();
	});
	$('body').on('updated_checkout', function() {
		$('input.sc-checkbox').checkbox();
	});

	$(function() {
		$('.price_slider_amount .button').addClass('sc-button');
	});

	// Quantity buttons
	$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<button type="button" class="plus" >+</button>' ).prepend( '<button type="button" class="minus" >-</button>' );

	$( document ).on( 'click', '.plus, .minus', function() {

		// Get values
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

	});

	$(function() {
		if(typeof wc_add_to_cart_variation_params !== 'undefined') {
			$('.variations_form').each( function() {
				$(this).on('show_variation', function(event, variation) {
					if(variation.image_link) {
						var $product_content = $(this).closest('.single-product-content');
						var $gallery = $product_content.find('.sc-gallery').eq(0);
						if($gallery.length) {
							var $gallery_item = $gallery.find('.sc-gallery-thumbs-carousel .sc-gallery-item a[data-full-image-url="'+variation.image_link+'"]');
							$gallery_item.trigger('click');
						}
					}
				});
			});
		}
	});

})(jQuery);
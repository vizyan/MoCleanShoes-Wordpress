<?php

function scalia_woocommerce_scripts() {
	if(scalia_is_plugin_active('woocommerce/woocommerce.php')) {
		wp_enqueue_style('scalia-woocommerce', get_template_directory_uri() . '/css/woocommerce.css');
		wp_enqueue_style('scalia-woocommerce1', get_template_directory_uri() . '/css/woocommerce1.css');
		wp_register_script('scalia-checkout', get_template_directory_uri() . '/js/checkout.js', array('jquery'));
		wp_register_script('scalia-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array('jquery'), '', true);
		wp_deregister_script('wc-country-select');
		wp_register_script('wc-country-select', get_template_directory_uri() . '/js/country-select.js');

		if(is_woocommerce()) {
			wp_enqueue_script('scalia-woocommerce');
		}
	}
}
add_action('wp_enqueue_scripts', 'scalia_woocommerce_scripts');

add_action('add_meta_boxes', 'scalia_add_product_settings_boxes');
function scalia_add_product_settings_boxes() {
	add_meta_box('scalia_product_description_meta_box', __('Product Description', 'scalia'), 'scalia_product_description_settings_box', 'product', 'normal', 'high');
}

function scalia_product_description_settings_box($post) {
	wp_nonce_field('scalia_product_description_settings_box', 'scalia_product_description_settings_box_nonce');
	$product_description = get_post_meta($post->ID, 'scalia_product_description', true);
?>
<div class="inside">
	<?php wp_editor(htmlspecialchars_decode($product_description), 'scalia_product_description', array(
			'textarea_name'	=> 'scalia_product_description',
			'quicktags' 	=> array('buttons' => 'em,strong,link'),
			'tinymce' 	=> array(
				'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
				'theme_advanced_buttons2' => '',
			),
			'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
		)); ?>
</div>
<?php
}

function scalia_save_product_data($post_id) {
	if(!isset($_POST['scalia_product_description_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['scalia_product_description_settings_box_nonce'], 'scalia_product_description_settings_box')) {
		return;
	}

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && $_POST['post_type'] == 'product') {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}
	if(!isset($_POST['scalia_product_description'])) {
		return;
	}

	update_post_meta($post_id, 'scalia_product_description', $_POST['scalia_product_description']);
}
add_action('save_post', 'scalia_save_product_data');

add_filter('woocommerce_enqueue_styles', '__return_false');

function scalia_loop_shop_columns($count) {
	$item_data = array(
		'sidebar_position' => '',
	);
	$item_data = scalia_get_post_data($item_data, 'page', wc_get_page_id('shop'));
	$sidebar_position = scalia_check_array_value(array('', 'left', 'right'), $item_data['sidebar_position'], '');
	if(is_active_sidebar('shop-sidebar') && $sidebar_position) {
		return 3;
	}
	return 4;
}
add_filter('loop_shop_columns', 'scalia_loop_shop_columns');

function scalia_woocommerce_single_product_gallery() {
	global $post, $product;
	wp_enqueue_script('scalia-gallery');
	$attachments_ids = $product->get_gallery_attachment_ids();
	if($product->is_type('variable')) {
		foreach($product->get_available_variations() as $variation) {
			if(has_post_thumbnail($variation['variation_id'])) {
				$thumbnail_id = get_post_thumbnail_id($variation['variation_id']);
				if(!in_array($thumbnail_id, $attachments_ids)) {
					$attachments_ids[] = $thumbnail_id;
				}
			}
		}
	}
	if(empty($attachments_ids) && has_post_thumbnail()) {
		$attachments_ids[] = get_post_thumbnail_id();
	}
	$args = array(
		'post_type' => 'attachment',
		'post_status'=>'inherit',
		'orderby' => 'post__in',
		'order' => 'ASC',
		'post__in' => $attachments_ids,
		'posts_per_page' => -1,
	);
	$gallery_items = new WP_Query($args);
	if($gallery_items->have_posts()) {
		echo '<div class="preloader"></div>';
		echo '<div class="sc-gallery sc-gallery-hover-default">';
			while($gallery_items->have_posts()) {
				$gallery_items->the_post();
				global $post;
				$thumb_image_url = wp_get_attachment_image_src(get_the_ID(), apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'));
				$preview_image_url = wp_get_attachment_image_src(get_the_ID(), apply_filters('single_product_large_thumbnail_size', 'shop_single'));
				$full_image_url = wp_get_attachment_image_src(get_the_ID(), 'full');
?>
<div class="sc-gallery-item">
	<div class="sc-gallery-item-image">
		<a href="<?php echo esc_url($preview_image_url[0]); ?>" data-full-image-url="<?php echo esc_url($full_image_url[0]); ?>">
			<img src="<?php echo esc_url($thumb_image_url[0]); ?>" alt="" class="img-responsive">
		</a>
	</div>
	<div class="sc-gallery-caption">
		<?php if($post->post_excerpt) : ?><div class="sc-gallery-item-title"><?php echo $post->post_excerpt; ?></div><?php endif; ?>
		<?php if($post->post_content) : ?><div class="sc-gallery-item-description"><?php echo $post->post_content; ?></div><?php endif; ?>
	</div>
</div>
<?php
			}
		echo '</div>';
	}
	wp_reset_postdata();
}

function scalia_woocommerce_single_product_page_content() {
	$vc_show_content = false;
	if(scalia_is_plugin_active('js_composer/js_composer.php')) {
		global $vc_manager;
		if($vc_manager->mode() == 'admin_frontend_editor' || $vc_manager->mode() == 'admin_page' || $vc_manager->mode()== 'page_editable') {
			$vc_show_content = true;
		}
	}
	if(get_the_content() || $vc_show_content) {
?>
<div class="product-content entry-content"><?php the_content(); ?></div>
<?php
	}
}

function scalia_woocommerce_output_related_products_args($args) {
	$args['posts_per_page'] = 8;
	$args['columns'] = 4;
	return $args;
}
add_filter('woocommerce_output_related_products_args', 'scalia_woocommerce_output_related_products_args');

function scalia_loop_shop_per_page() {
	global $data;

	parse_str($_SERVER['QUERY_STRING'], $params);

	if($data['woo_items']) {
		$per_page = $data['woo_items'];
	} else {
		$per_page = 12;
	}

	$pc = !empty($params['product_count']) ? $params['product_count'] : $per_page;

	return $pc;
}
add_filter('loop_shop_per_page', 'scalia_loop_shop_per_page');

function scalia_woocommerce_product_per_page_select() {
	$products_per_page_items = array(12,24,48);
	parse_str($_SERVER['QUERY_STRING'], $params);
	$pc = !empty($params['product_count']) ? $params['product_count'] : 12;
	$query_string = '?'.$_SERVER['QUERY_STRING'];
?>
<div class="woocommerce-select-count">
	<select id="products-per-page" name="products_per_page" class="sc-combobox" onchange="window.location.href=jQuery(this).val();">
		<?php foreach($products_per_page_items as $products_per_page_item) : ?>
			<option value="<?php echo scalia_addURLParameter($query_string, 'product_count', $products_per_page_item); ?>"<?php echo (($pc == $products_per_page_item) ? ' selected': ''); ?>><?php printf(__('Show %d On Page', 'scalia'), $products_per_page_item); ?></option>
		<?php endforeach; ?>
	</select>
</div>
<?php
}

/* URL */

function scalia_addURLParameter($url, $paramName, $paramValue) {
	$url_data = parse_url($url);
	if(!isset($url_data["query"]))
		$url_data["query"]="";

	$params = array();
	parse_str($url_data['query'], $params);
	$params[$paramName] = $paramValue;
	$url_data['query'] = http_build_query($params);
	return scalia_build_url($url_data);
}
function scalia_build_url($url_data) {
	$url="";
	if(isset($url_data['host'])) {
		$url .= $url_data['scheme'] . '://';
		if(isset($url_data['user'])) {
			$url .= $url_data['user'];
				if(isset($url_data['pass'])) {
					$url .= ':' . $url_data['pass'];
				}
			$url .= '@';
		}
		$url .= $url_data['host'];
		if(isset($url_data['port'])) {
			$url .= ':' . $url_data['port'];
		}
	}
	if(isset($url_data['path'])) {
		$url .= $url_data['path'];
	}
	if(isset($url_data['query'])) {
		$url .= '?' . $url_data['query'];
	}
	if(isset($url_data['fragment'])) {
		$url .= '#' . $url_data['fragment'];
	}
	return $url;
}

function scalia_woocommerce_before_shop_loop_start() {
	echo '<div class="before-products-list rounded-corners clearfix">';
}
function scalia_woocommerce_before_shop_loop_end() {
	echo '</div>';
}
function scalia_woocommerce_single_product_navigation() {
?>
<div class="block-navigation">
	<div class="block-navigation-prev"><?php previous_post_link('%link', __('Previous product', 'scalia')); ?></div>
	<div class="block-navigation-next"><?php next_post_link('%link', __('Next product', 'scalia')); ?></div>
</div>
<?php
}

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('woocommerce_before_shop_loop', 'scalia_woocommerce_before_shop_loop_start', 5);
add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
add_action('woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_shop_loop', 'scalia_woocommerce_product_per_page_select', 30);
add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 40);
add_action('woocommerce_before_shop_loop', 'scalia_woocommerce_before_shop_loop_end', 45);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15);

add_action('scalia_woocommerce_single_product_left', 'scalia_woocommerce_single_product_gallery', 5);
add_action('scalia_woocommerce_single_product_left', 'woocommerce_template_single_meta', 10);
add_action('scalia_woocommerce_single_product_left', 'scalia_socials_sharing', 15);

add_action('scalia_woocommerce_single_product_right', 'woocommerce_template_single_title', 5);
add_action('scalia_woocommerce_single_product_right', 'woocommerce_breadcrumb', 10);
add_action('scalia_woocommerce_single_product_right', 'woocommerce_template_single_rating', 15);
add_action('scalia_woocommerce_single_product_right', 'woocommerce_template_single_price', 20);
add_action('scalia_woocommerce_single_product_right', 'woocommerce_template_single_excerpt', 25);
add_action('scalia_woocommerce_single_product_right', 'woocommerce_template_single_add_to_cart', 30);


add_action('scalia_woocommerce_single_product_bottom', 'woocommerce_output_product_data_tabs', 5);
add_action('scalia_woocommerce_single_product_bottom', 'scalia_woocommerce_single_product_navigation', 10);
add_action('scalia_woocommerce_single_product_bottom', 'scalia_woocommerce_single_product_page_content', 15);

add_action('scalia_woocommerce_after_single_product', 'woocommerce_output_related_products', 5);

function scalia_cart_menu($items, $args) {
	if(scalia_is_plugin_active('woocommerce/woocommerce.php') && $args->theme_location == 'primary') {
		global $woocommerce;

		$count = WC()->cart->get_cart_contents_count();

		ob_start();
		woocommerce_mini_cart();
		$minicart = ob_get_clean();
		$items .= '<li class="menu-item menu-item-cart"><a href="'.get_permalink(wc_get_page_id('cart')).'">'.($count > 0 ? '<span class="minicart-item-count">'.$count.'</span>' : '').'</a><div class="minicart"><div class="widget_shopping_cart_content">'.$minicart.'</div></div></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'scalia_cart_menu', 10, 2);

function scalia_woocommerce_placeholder_img($val, $size, $dimensions) {
	return '<span class="product-dummy-wrapper" style="max-width: '.$dimensions['width'].'px;"><span class="product-dummy" style="padding-bottom: '.($dimensions['height']*100/$dimensions['width']).'%;"></span></span>';
}
add_filter('woocommerce_placeholder_img', 'scalia_woocommerce_placeholder_img', 10, 3);

function scalia_cart_short_info() {
	global $woocommerce;
	echo '<div class="cart-short-info">'.sprintf(__('You Have <span class="items-count">%d Items</span> In Your Cart', 'scalia'), $woocommerce->cart->cart_contents_count).'</div>';
}
add_action('woocommerce_before_cart', 'scalia_cart_short_info', 5);
add_action('woocommerce_before_cart', 'woocommerce_breadcrumb', 10);

function scalia_wc_add_to_cart_message($message, $product_id) {
	$titles = array();

	if ( is_array( $product_id ) ) {
		foreach ( $product_id as $id ) {
			$titles[] = get_the_title( $id );
		}
	} else {
		$titles[] = get_the_title( $product_id );
	}

	$titles = array_filter( $titles );
	$added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

	// Output success messages
	if(get_option('woocommerce_cart_redirect_after_add') == 'yes') :

		$return_to = apply_filters('woocommerce_continue_shopping_redirect', wp_get_referer() ? wp_get_referer() : home_url());

		$message = sprintf('<div class="cart-added"><div class="cart-added-text">%s</div><div class="cart-added-button"><a href="%s" class="sc-button button wc-forward">%s</a></div></div>', $added_text, $return_to, __('Continue Shopping', 'woocommerce'));

	else :

		$message = sprintf('<div class="cart-added"><div class="cart-added-text">%s</div><div class="cart-added-button"><a href="%s" class="sc-button button wc-forward">%s</a></div></div>', $added_text, get_permalink(wc_get_page_id('cart')), __('View Cart', 'woocommerce'));

	endif;

	return $message;
}
add_filter('wc_add_to_cart_message', 'scalia_wc_add_to_cart_message', 10, 2);

function scalia_product_add_page_settings_boxes() {
	add_meta_box('scalia_page_title', __('Page Title', 'scalia'), 'scalia_page_title_settings_box', 'product', 'normal', 'high');
	add_meta_box('scalia_page_sidebar', __('Page Sidebar', 'scalia'), 'scalia_page_sidebar_settings_box', 'product', 'normal', 'high');
}
add_action('add_meta_boxes', 'scalia_product_add_page_settings_boxes');

function scalia_save_product_page_data($post_id) {
	if(
		!isset($_POST['scalia_page_title_settings_box_nonce']) ||
		!isset($_POST['scalia_page_sidebar_settings_box_nonce'])
	) {
		return;
	}
	if(
		!wp_verify_nonce($_POST['scalia_page_title_settings_box_nonce'], 'scalia_page_title_settings_box') ||
		!wp_verify_nonce($_POST['scalia_page_sidebar_settings_box_nonce'], 'scalia_page_sidebar_settings_box')
	) {
		return;
	}

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && in_array($_POST['post_type'], array('product'))) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['scalia_page_data']) || !is_array($_POST['scalia_page_data'])) {
		return;
	}

	$page_data = array_merge(
		scalia_get_sanitize_page_title_data(0, $_POST['scalia_page_data']),
		scalia_get_sanitize_page_sidebar_data(0, $_POST['scalia_page_data'])
	);
	if($_POST['post_type'] == 'page') {
		$page_data = array_merge($page_data, scalia_get_sanitize_page_blog_data(0, $_POST['scalia_page_data']));
	}
	update_post_meta($post_id, 'scalia_page_data', $page_data);
}
add_action('save_post', 'scalia_save_product_page_data');


function scalia_product_tabs($tabs = array()) {
		global $product, $post;

		// Description tab - shows product content
		if (get_post_meta($post->ID, 'scalia_product_description', true)) {
			$tabs['description'] = array(
				'title'    => __( 'Description', 'scalia' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);
		} else {
			unset($tabs['description']);
		}

		return $tabs;
}
add_filter('woocommerce_product_tabs', 'scalia_product_tabs', 11);

function scalia_woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size = apply_filters( 'single_category_small_thumbnail_size', 'shop_catalog' );
	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true);
	$image = '';

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
		$image = $image[0];
	}

	if ( $image ) {
		$image = str_replace( ' ', '%20', $image );
		echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" class="img-responsive" />';
	} else {
		echo wc_placeholder_img($small_thumbnail_size);
	}
}
remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
add_action('woocommerce_before_subcategory_title', 'scalia_woocommerce_subcategory_thumbnail', 10);

function thegem_woocommerce_account_menu_item_classes($classes, $endpoint) {
	if(in_array('is-active', $classes)) {
		$classes[] = 'menu-item-active';
	}
	return $classes;
}
add_filter('woocommerce_account_menu_item_classes', 'thegem_woocommerce_account_menu_item_classes', 10, 2);
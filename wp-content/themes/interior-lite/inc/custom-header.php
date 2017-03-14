<?php
/**
 * @package SKT Interior Lite
 * Setup the WordPress core custom header feature.
 *
 * @uses interior_lite_header_style()
 * @uses interior_lite_admin_header_style()
 * @uses interior_lite_admin_header_image()
 */
function interior_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'interior_lite_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'fff',
		'width'                  => 1400,
		'height'                 => 126,
		'wp-head-callback'       => 'interior_lite_header_style',
		'admin-head-callback'    => 'interior_lite_admin_header_style',
		'admin-preview-callback' => 'interior_lite_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'interior_lite_custom_header_setup' );

if ( ! function_exists( 'interior_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see interior_lite_custom_header_setup().
 */
function interior_lite_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image = get_header_image();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		
		if ( ! empty( $header_image ) ) { 
	?>
		.header {
			background: url(<?php echo $header_image; ?>) repeat !important;
			background-position: left top;
		}
	<?php } // if ( ! empty( $header_image ) ) 
?>
	</style>
	<?php
}
endif; // interior_lite_header_style

if ( ! function_exists( 'interior_lite_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see interior_lite_custom_header_setup().
 */
function interior_lite_admin_header_style() {?>
	<style type="text/css">
	.appearance_page_custom-header #headimg { border: none; }
	</style><?php
}
endif; // interior_lite_admin_header_style


add_action( 'admin_head', 'interior_lite_admin_header_css' );
function interior_lite_admin_header_css(){ ?>
	<style>pre{white-space: pre-wrap;}</style><?php
}


if ( ! function_exists( 'interior_lite_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see interior_lite_custom_header_setup().
 */
function interior_lite_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php         
}
endif; // interior_lite_admin_header_image 
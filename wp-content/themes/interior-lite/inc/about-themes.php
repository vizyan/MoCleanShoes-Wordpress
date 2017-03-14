<?php
/**
 * SKT Interior Lite About Theme
 *
 * @package SKT Interior Lite
 */
 
//about theme info
add_action( 'admin_menu', 'interior_lite_abouttheme' );
function interior_lite_abouttheme() {    	
	add_theme_page( __('About Theme', 'interior-lite'), __('About Theme', 'interior-lite'), 'edit_theme_options', 'interior_lite_guide', 'interior_lite_mostrar_guide');   
} 

//guidline for about theme
function interior_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>

<style type="text/css">
@media screen and (min-width: 800px) {
.col-left {float:left; width: 65%; padding: 1%;}
.col-right {float:right; width: 30%; padding:1%; border-left:1px solid #DDDDDD; }
}
</style>

<div class="wrapper-info">
	<div class="col-left">
   		   <div style="font-size:16px; font-weight:bold; padding-bottom:5px; border-bottom:1px solid #ccc;">
			  <?php esc_attr_e('About Theme Info', 'interior-lite'); ?>
		   </div>
          <p><?php esc_attr_e('Interior lite is an interior design WordPress theme which can be used as responsive multipurpose WordPress theme that is simple and adaptable and flexible, and is fully translation ready with po file available as well as compatibility with qTranslate X plugin. Can be used for business, corporate, cafe and restaurant, personal, portfolio, Ecommerce, agency, consulting, real estate, photography and other industries. It is also compatible with various other contact form, SEO and Ecommerce plugins like WooCommerce and NextGen gallery.','interior-lite'); ?></p>
		  <a href="<?php echo SKT_PRO_THEME_URL; ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	
	<div class="col-right">			
			<div style="text-align:center; font-weight:bold;">
				<hr />
				<a href="<?php echo SKT_LIVE_DEMO; ?>" target="_blank"><?php esc_attr_e('Live Demo', 'interior-lite'); ?></a> | 
				<a href="<?php echo SKT_PRO_THEME_URL; ?>"><?php esc_attr_e('Buy Pro', 'interior-lite'); ?></a> | 
				<a href="<?php echo SKT_THEME_DOC; ?>" target="_blank"><?php esc_attr_e('Documentation', 'interior-lite'); ?></a>
                <div style="height:5px"></div>
				<hr />                
                <a href="<?php echo SKT_THEME_URL; ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>
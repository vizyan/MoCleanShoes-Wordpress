<?php
/**
 * @package Slider Responsive Slideshow Standard
 */
/*
Plugin Name: Slider Responsive Slideshow
Plugin URI: http://awplife.com/
Description: An Easy Simple Responsive Beautiful Powerful CSS & JS Based WordPress Slider Plugin
Version: 0.4.7
Author: A WP Life
Author URI: http://awplife.com/
License: GPLv2 or later
Text Domain: sr_txt_dm
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! class_exists( 'Slider_Responsive' ) ) {

	class Slider_Responsive {
		
		protected $protected_plugin_api;
		protected $ajax_plugin_nonce;
		
		public function __construct() {
			$this->_constants();
			$this->_hooks();
		}		
		
		protected function _constants() {
			/**
			 * Plugin Version
			 */
			define( 'SR_PLUGIN_VER', '0.3.6' );
			
			/**
			 * Plugin Text Domain
			 */
			define("sr_txt_dm","awl-responsive-slider" );

			/**
			 * Plugin Name
			 */
			define( 'SR_PLUGIN_NAME', __( 'Slider Responsive', 'sr_txt_dm' ) );

			/**
			 * Plugin Slug
			 */
			define( 'SR_PLUGIN_SLUG', 'slider_responsive' );

			/**
			 * Plugin Directory Path
			 */
			define( 'SR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

			/**
			 * Plugin Directory URL
			 */
			define( 'SR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

			/**
			 * Create a key for the .htaccess secure download link.
			 *
			 * @uses    NONCE_KEY     Defined in the WP root config.php
			 */
			define( 'SR_SECURE_KEY', md5( NONCE_KEY ) );
			
		} // end of constructor function
		
		
		/**
		 * Setup the default filters and actions
		 * @uses      add_action()  To add various actions
		 * @access    private
		 * @return    void
		 */
		protected function _hooks() {
			
			/**
			 * Load text domain
			 */
			add_action( 'plugins_loaded', array( $this, '_load_textdomain' ) );
			
			/**
			 * add gallery menu item, change menu filter for multisite
			 */
			add_action( 'admin_menu', array( $this, '_srgallery_menu' ), 101 );
			
			/**
			 * Create Slider Responsive Custom Post
			 */
			add_action( 'init', array( $this, '_Slider_Responsive' ));
			
			/**
		     * Add meta box to custom post
		     */
			 add_action( 'add_meta_boxes', array( $this, '_admin_add_meta_box' ) );
			 
			/**
		     * loaded during admin init 
		     */
			add_action( 'admin_init', array( $this, '_admin_add_meta_box' ) );
			
			add_action('wp_ajax_slide_responsive', array(&$this, '_ajax_slide_responsive'));
			
			add_action('save_post', array(&$this, '_sr_save_settings'));
			/**
		     * Shortcode Compatibility in Text Widgets
		     */
			add_filter('widget_text', 'do_shortcode');

		} // end of hook function
		
		
		/**
		 * Loads the text domain.
		 * @return    void
		 * @access    private
		 */
		public function _load_textdomain() {
			load_plugin_textdomain( 'sr_txt_dm', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}
		
		
		/**
		 * Adds the Slider menu item
		 * @access    private
		 * @return    void
		 */
		public function _srgallery_menu() {
			$help_menu = add_submenu_page( 'edit.php?post_type='.SR_PLUGIN_SLUG, __( 'Docs', 'sr_txt_dm' ), __( 'Docs', 'sr_txt_dm' ), 'administrator', 'sr-doc-page', array( $this, '_sr_doc_page') );
			$featured_plugin_menu = add_submenu_page( 'edit.php?post_type='.SR_PLUGIN_SLUG, __( 'Featured-Plugin', 'sr_txt_dm' ), __( 'Featured Plugin', 'sr_txt_dm' ), 'administrator', 'sr-featured-plugin-page', array( $this, '_featured_plugin_page') );
		}
		
		
		/**
		 * Slider Responsive Custom Post
		 * Create gallery post type in admin dashboard.
		 * @access    private
		 * @return    void      Return custom post type.
		 */
		public function _Slider_Responsive() {
			$labels = array(
				'name'                => _x( 'Slider Responsive Slideshow', 'Post Type General Name', 'sr_txt_dm' ),
				'singular_name'       => _x( 'Slider Responsive Slideshow', 'Post Type Singular Name', 'sr_txt_dm' ),
				'menu_name'           => __( 'Slider Responsive Slideshow', 'sr_txt_dm' ),
				'name_admin_bar'      => __( 'Slider Responsive Slideshow', 'sr_txt_dm' ),
				'parent_item_colon'   => __( 'Parent Item:', 'sr_txt_dm' ),
				'all_items'           => __( 'All Slider', 'sr_txt_dm' ),
				'add_new_item'        => __( 'Add New Slider', 'sr_txt_dm' ),
				'add_new'             => __( 'Add New Slider', 'sr_txt_dm' ),
				'new_item'            => __( 'New Slider', 'sr_txt_dm' ),
				'edit_item'           => __( 'Edit Slider', 'sr_txt_dm' ),
				'update_item'         => __( 'Update Slider', 'sr_txt_dm' ),
				'search_items'        => __( 'Search Slider', 'sr_txt_dm' ),
				'not_found'           => __( 'Slider Not found', 'sr_txt_dm' ),
				'not_found_in_trash'  => __( 'Slider Not found in Trash', 'sr_txt_dm' ),
			);
			$args = array(
				'label'               => __( 'Slider', 'sr_txt_dm' ),
				'description'         => __( 'Custom Post Type For Slider', 'sr_txt_dm' ),
				'labels'              => $labels,
				'supports'            => array( 'title'),
				'taxonomies'          => array(),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 65,
				'menu_icon'           => 'dashicons-images-alt2',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,		
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
			);
			register_post_type( 'slider_responsive', $args );
			
		} // end of post type function
		
		/**
		 * Adds Meta Boxes
		 * @access    private
		 * @return    void
		 */
		public function _admin_add_meta_box() {
			// Syntax: add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
			add_meta_box( '', __('Add Image Slides', sr_txt_dm), array(&$this, 'sr_upload_multiple_images'), 'slider_responsive', 'normal', 'default' );
		}
		
		public function sr_upload_multiple_images($post) { 
			wp_enqueue_script('media-upload');
			wp_enqueue_script('awl-sr-uploader.js', SR_PLUGIN_URL . 'js/awl-sr-uploader.js', array('jquery'));
			wp_enqueue_style('awl-sr-uploader-css', SR_PLUGIN_URL . 'css/awl-sr-uploader.css');
			wp_enqueue_media();
			?>
			<div id="slider-gallery">
				<input type="button" id="remove-all-slides" name="remove-all-slides" class="button button-large" rel="" value="<?php _e('Delete All Slide', sr_txt_dm); ?>">
				<ul id="remove-slides" class="sbox">
				<?php
				$allslidesetting = unserialize(base64_decode(get_post_meta( $post->ID, 'awl_sr_settings_'.$post->ID, true)));
				if(isset($allslidesetting['slide-ids'])) {
					$count = 0;
				foreach($allslidesetting['slide-ids'] as $id) {
					$thumbnail = wp_get_attachment_image_src($id, 'thumbnail', true);
					$attachment = get_post( $id );
					$slide_link =  $allslidesetting['slide-link'][$count];
					?>
					<li class="slide">
						<img class="new-slide" src="<?php echo $thumbnail[0]; ?>" alt="">
						<input type="hidden" id="slide-ids[]" name="slide-ids[]" value="<?php echo $id; ?>" />
						<!-- Slide Title, Caption, Alt Text, Description-->
						<input type="text" name="slide-title[]" id="slide-title[]" placeholder="Slide Title" value="<?php echo get_the_title($id); ?>">
						<textarea name="slide-desc[]" id="slide-desc[]" placeholder="Slide Description" style="height: 108px; width: 145px;"><?php echo $attachment->post_content; ?></textarea>
						<input type="text" name="slide-link[]" id="slide-link[]" placeholder="Slide Link URL" value="<?php echo $slide_link; ?>">
						<input type="button" name="remove-slide" id="remove-slide" class="button" value="Delete Slide">
					</li>
				<?php $count++; } // end of foreach
				} //end of if
				?>
				</ul>
			</div>
			
			<!--Add New Slide Button-->
			<div name="add-new-slider" id="add-new-slider" class="new-slider" style="height: 210px; width: 220px; border-radius: 8px;">	
			<div class="menu-icon dashicons dashicons-format-image"></div>
				<div class="add-text"><?php _e('New Slide', sr_txt_dm); ?></div>
			</div>
			<div style="clear:left;"></div>
			<br>
			<h1 style="font-family:dashicons; font-size: xx-large;"><?php _e('Slider Slideshow Settings', sr_txt_dm); ?></h1>
			<hr>
			<?php
			require_once('slider-settings.php');
		} // end of upload multiple image
		
		public function _sr_ajax_callback_function($id) {
			//wp_get_attachment_image_src ( int $attachment_id, string|array $size = 'thumbnail', bool $icon = false )
			//thumb, thumbnail, medium, large, post-thumbnail
			$thumbnail = wp_get_attachment_image_src($id, 'thumbnail', true);
			$attachment = get_post( $id ); // $id = attachment id
			?>
			<li class="slide">
				<img class="new-slide" src="<?php echo $thumbnail[0]; ?>" alt="">
				<input type="hidden" id="slide-ids[]" name="slide-ids[]" value="<?php echo $id; ?>" />
				<input type="text" name="slide-title[]" id="slide-title[]" placeholder="Slide Title" value="<?php echo get_the_title($id); ?>">
				<textarea name="slide-desc[]" id="slide-desc[]" placeholder="Slide Description" style="height: 108px; width: 145px;"><?php echo $attachment->post_content; ?></textarea>
				<input type="text" name="slide-link[]" id="slide-link[]" placeholder="Slide Link URL">
				<input type="button" name="remove-slide" id="remove-slide" class="button" value="Delete Slide">
			</li>
			<?php
		}
		
		public function _ajax_slide_responsive() {
			echo $this->_sr_ajax_callback_function($_POST['slideId']);
			die;
		}
		
		public function _sr_save_settings($post_id) {
			if ( isset( $_POST['sr-settings'] ) == "sr-save-settings" ) {
				//update image title & description
					$slide_ids = $_POST['slide-ids'];
					$slide_titles = $_POST['slide-title'];
					$slide_descs = $_POST['slide-desc'];
					$i = 0;
					foreach($slide_ids as $slide_id) {
						$single_slide_update = array(
							  'ID'           => $slide_id,
							  'post_title'   => $slide_titles[$i],
							  'post_content'   => $slide_descs[$i],
						);
						wp_update_post( $single_slide_update );
						$i++;
					}	

				$awl_slider_responsive_shortcode_setting = "awl_sr_settings_".$post_id;
				update_post_meta($post_id, $awl_slider_responsive_shortcode_setting, base64_encode(serialize($_POST)));
			}
		}// end save setting
		
		/**
		 * Slider Responsive Docs Page
		 * Create doc page to help user to setup plugin
		 * @access    private
		 * @return    void.
		 */
		public function _sr_doc_page() {
			require_once('docs.php');
		}
		
		public function _featured_plugin_page() {
			require_once('featured-plugins/featured-plugins.php');
		}
		
	} // end of class

	/**
	 * Instantiates the Class
	 * @global    object	$sr_gallery_object
	 */
	$sr_gallery_object = new Slider_Responsive();
	require_once('shortcode.php');
} // end of class exists
?>
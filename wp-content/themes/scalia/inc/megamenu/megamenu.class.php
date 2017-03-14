<?php
/**
 * Scalia Mega Menu class.
 *
*/

$Scalia_Mega_Menu_Columns_Values = array(
    1 => '1',
    2 => '2',
    3 => '3',
    4 => '4'
);

$Scalia_Mega_Menu_Image_Position_Values = array(
    'left top' => __( 'Left Top', 'scalia' ),
    'left center' => __( 'Left Center', 'scalia' ),
    'left bottom' => __( 'Left Bottom', 'scalia' ),
    'center top' => __( 'Center Top', 'scalia' ),
    'center bottom' => __( 'Center Bottom', 'scalia' ),
    'center center' => __( 'Center Center', 'scalia' ),
    'right top' => __( 'Right Top', 'scalia' ),
    'right center' => __( 'Right Center', 'scalia' ),
    'right bottom' => __( 'Right Bottom', 'scalia' )
);

$Scalia_Mega_Menu_Default = array(
    'icon' => '',
    'enable' => false,
    'masonry' => false,
    'columns' => 3,
    'image' => '',
    'image_position' => 'center center',
    'width' => 300,
    'not_link' => false,
    'not_show' => false,
    'new_row' => false,
    'label' => '',
    'padding_left' => '45px',
    'padding_top' => '29px',
    'padding_right' => '45px',
    'padding_bottom' => '50px',
);

class Scalia_Mega_Menu {

	public $fat_menu = false;
	public $fat_columns = 3;

	function __construct() {

		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'update_custom_nav_fields' ), 10, 3 );

		// replace menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'replace_walker_class' ), 90, 2 );

		// add admin css
		add_action( 'admin_print_styles-nav-menus.php', array( $this, 'add_admin_menu_inline_css' ), 15 );

		// add some javascript
		add_action( 'admin_print_footer_scripts', array( $this, 'javascript_magick' ), 99 );

		// add media uploader
		add_action( 'admin_enqueue_scripts', array( $this, 'uploader_scripts' ), 15 );
	}

	function add_custom_nav_fields( $menu_item ) {
        global $Scalia_Mega_Menu_Columns_Values, $Scalia_Mega_Menu_Image_Position_Values, $Scalia_Mega_Menu_Default;

        $data = get_post_meta( $menu_item->ID, '_menu_item_scalia_mega_menu', true );
        $menu_item->scalia_mega_menu = array_merge($Scalia_Mega_Menu_Default, (array) $data);

        $menu_item->scalia_mega_menu_columns_values = $Scalia_Mega_Menu_Columns_Values;
        $menu_item->scalia_mega_menu_image_position_values = $Scalia_Mega_Menu_Image_Position_Values;
        $menu_item->scalia_mega_menu_default = $Scalia_Mega_Menu_Default;

        $menu_item->scalia_mobile_clickable = get_post_meta( $menu_item->ID, '_menu_item_scalia_mobile_clickable', true );

		return $menu_item;
	}

	function update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
        global $Scalia_Mega_Menu_Columns_Values, $Scalia_Mega_Menu_Image_Position_Values, $Scalia_Mega_Menu_Default;

        $data = get_post_meta( $menu_item_db_id, '_menu_item_scalia_mega_menu', true );
        $menu_data = array_merge($Scalia_Mega_Menu_Default, (array) $data);

        if ( isset($_REQUEST['scalia_mega_menu_icon'], $_REQUEST['scalia_mega_menu_icon'][$menu_item_db_id]) )
            $menu_data['icon'] = $_REQUEST['scalia_mega_menu_icon'][$menu_item_db_id];

        $menu_data['enable'] = isset($_REQUEST['scalia_mega_menu_enable'], $_REQUEST['scalia_mega_menu_enable'][$menu_item_db_id]);
        $menu_data['masonry'] = isset($_REQUEST['scalia_mega_menu_masonry'], $_REQUEST['scalia_mega_menu_masonry'][$menu_item_db_id]);

        if ( isset($_REQUEST['scalia_mega_menu_columns'], $_REQUEST['scalia_mega_menu_columns'][$menu_item_db_id]) ) {
            $menu_data['columns'] = absint($_REQUEST['scalia_mega_menu_columns'][$menu_item_db_id]);
            $valid_values = array_keys($Scalia_Mega_Menu_Columns_Values);
            if (!in_array($menu_data['columns'], $valid_values))
                $menu_data['columns'] = $Scalia_Mega_Menu_Default['columns'];
        }

        if ( isset($_REQUEST['scalia_mega_menu_image'], $_REQUEST['scalia_mega_menu_image'][$menu_item_db_id]) )
            $menu_data['image'] = $_REQUEST['scalia_mega_menu_image'][$menu_item_db_id];

        if ( isset($_REQUEST['scalia_mega_menu_image_position'], $_REQUEST['scalia_mega_menu_image_position'][$menu_item_db_id]) ) {
            $menu_data['image_position'] = $_REQUEST['scalia_mega_menu_image_position'][$menu_item_db_id];
            $valid_values = array_keys($Scalia_Mega_Menu_Image_Position_Values);
            if (!in_array($menu_data['image_position'], $valid_values))
                $menu_data['image_position'] = $Scalia_Mega_Menu_Default['image_position'];
        }

        if ( isset($_REQUEST['scalia_mega_menu_width'], $_REQUEST['scalia_mega_menu_width'][$menu_item_db_id]) )
            $menu_data['width'] = absint($_REQUEST['scalia_mega_menu_width'][$menu_item_db_id]);

        $menu_data['not_link'] = isset($_REQUEST['scalia_mega_menu_not_link'], $_REQUEST['scalia_mega_menu_not_link'][$menu_item_db_id]);

        $menu_data['not_show'] = isset($_REQUEST['scalia_mega_menu_not_show'], $_REQUEST['scalia_mega_menu_not_show'][$menu_item_db_id]);

        $menu_data['new_row'] = isset($_REQUEST['scalia_mega_menu_new_row'], $_REQUEST['scalia_mega_menu_new_row'][$menu_item_db_id]);

        if ( isset($_REQUEST['scalia_mega_menu_label'], $_REQUEST['scalia_mega_menu_label'][$menu_item_db_id]) )
            $menu_data['label'] = $_REQUEST['scalia_mega_menu_label'][$menu_item_db_id];

        if ( isset($_REQUEST['scalia_mega_menu_padding_left'], $_REQUEST['scalia_mega_menu_padding_left'][$menu_item_db_id]) )
            $menu_data['padding_left'] = $_REQUEST['scalia_mega_menu_padding_left'][$menu_item_db_id];

        if ( isset($_REQUEST['scalia_mega_menu_padding_right'], $_REQUEST['scalia_mega_menu_padding_right'][$menu_item_db_id]) )
            $menu_data['padding_right'] = $_REQUEST['scalia_mega_menu_padding_right'][$menu_item_db_id];

        if ( isset($_REQUEST['scalia_mega_menu_padding_top'], $_REQUEST['scalia_mega_menu_padding_top'][$menu_item_db_id]) )
            $menu_data['padding_top'] = $_REQUEST['scalia_mega_menu_padding_top'][$menu_item_db_id];

        if ( isset($_REQUEST['scalia_mega_menu_padding_bottom'], $_REQUEST['scalia_mega_menu_padding_bottom'][$menu_item_db_id]) )
            $menu_data['padding_bottom'] = $_REQUEST['scalia_mega_menu_padding_bottom'][$menu_item_db_id];

        update_post_meta( $menu_item_db_id, '_menu_item_scalia_mega_menu', $menu_data );

        if (isset($_REQUEST['scalia_mobile_clickable'], $_REQUEST['scalia_mobile_clickable'][$menu_item_db_id]))
        	update_post_meta( $menu_item_db_id, '_menu_item_scalia_mobile_clickable', true );
        else
        	update_post_meta( $menu_item_db_id, '_menu_item_scalia_mobile_clickable', false );
	}

	function replace_walker_class( $walker, $menu_id ) {

		if ( 'Walker_Nav_Menu_Edit' == $walker ) {
			$walker = 'Scalia_Edit_Mega_Menu_Walker';
		}

		return $walker;
	}

	/**
	 * Add some beautiful inline css for admin menus.
	 *
	 */
	function add_admin_menu_inline_css() {
		$css = '
            .wrapper-scalia-mobile-clickable {
                padding-top: 10px;
            }

            .menu.ui-sortable .scalia-megamenu-fields .fieldset-scalia-megamenu-padding {
                border: 1px solid #dfdfdf;
            }

			.menu.ui-sortable .scalia-megamenu-fields p,
            .menu.ui-sortable .scalia-megamenu-fields .fieldset-scalia-megamenu-padding {
				display: none;
			}

            .menu.ui-sortable .scalia-megamenu-fields p select {
                width: 190px;
            }

			.menu.ui-sortable .menu-item-depth-0 .scalia-megamenu-fields .field-scalia-megamenu-enable,
			.menu.ui-sortable .menu-item-depth-0.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-masonry,
            .menu.ui-sortable .menu-item-depth-0.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-columns,
            .menu.ui-sortable .menu-item-depth-0.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-image,
            .menu.ui-sortable .menu-item-depth-0.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-image-position,
            .menu.ui-sortable .menu-item-depth-0.field-scalia-megamenu-enabled .scalia-megamenu-fields .fieldset-scalia-megamenu-padding,
            .menu.ui-sortable .menu-item-depth-0.field-scalia-megamenu-enabled .scalia-megamenu-fields .fieldset-scalia-megamenu-padding p {
				display: block;
			}

            .menu.ui-sortable .menu-item-depth-1.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-icon,
            .menu.ui-sortable .menu-item-depth-1.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-width,
            .menu.ui-sortable .menu-item-depth-1.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-not-link,
            .menu.ui-sortable .menu-item-depth-1.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-not-show,
            .menu.ui-sortable .menu-item-depth-1.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-new-row {
                display: block;
            }

            .menu.ui-sortable .menu-item-depth-2.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-icon,
            .menu.ui-sortable .menu-item-depth-2.field-scalia-megamenu-enabled .scalia-megamenu-fields .field-scalia-megamenu-label {
                display: block;
            }
		';
		wp_add_inline_style( 'wp-admin', $css );
	}

	/**
	 * Enqueue uploader scripts.
	 *
	 */
	function uploader_scripts() {
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
	}

	/**
	 * Javascript magick.
	 *
	 */
	function javascript_magick() {
		?>
		<SCRIPT TYPE="text/javascript">
			jQuery(function(){

				var scalia_mega_menu = {
					reTimeout: false,

					recalc : function() {
						$menuItems = jQuery('.menu-item', '#menu-to-edit');

						$menuItems.each( function(i) {
							var $item = jQuery(this),
								$checkbox = jQuery('.scalia-edit-menu-item-icon-enable', this);

							if ( !$item.is('.menu-item-depth-0') ) {

								var checkItem = $menuItems.filter(':eq('+(i-1)+')');
								if ( checkItem.is('.field-scalia-megamenu-enabled') ) {
									$item.addClass('field-scalia-megamenu-enabled');
									$checkbox.attr('checked','checked');
								} else {
									$item.removeClass('field-scalia-megamenu-enabled');
									$checkbox.attr('checked','');
								}
							}

						});

					},

					binds: function() {

						jQuery('#menu-to-edit').on('click', '.scalia-edit-menu-item-icon-enable', function(event) {
							var $checkbox = jQuery(this),
								$container = $checkbox.closest('.menu-item');

                            if ( $checkbox.is(':checked') ) {
								$container.addClass('field-scalia-megamenu-enabled');
							} else {
								$container.removeClass('field-scalia-megamenu-enabled');
							}

							scalia_mega_menu.recalc();

							return true;
						});

					},

					init: function() {
						scalia_mega_menu.binds();
						scalia_mega_menu.recalc();

						jQuery( ".menu-item-bar" ).live( "mouseup", function(event, ui) {
							if ( !jQuery(event.target).is('a') ) {
								clearTimeout(scalia_mega_menu.reTimeout);
								scalia_mega_menu.reTimeout = setTimeout(scalia_mega_menu.recalc, 700);
							}
						});
					},


				}

				scalia_mega_menu.init();
			});
		</SCRIPT>
		<?php
	}
}

if ( !class_exists('Dt_Edit_Menu_Walker') ) {
	include_once( dirname(__FILE__) . '/edit-megamenu-walker.class.php' );
}

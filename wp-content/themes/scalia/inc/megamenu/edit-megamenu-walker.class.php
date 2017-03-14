<?php
/**
 * Scalia Mega Menu Walker class.
 *
 */

/**
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Scalia_Edit_Mega_Menu_Walker extends Walker_Nav_Menu {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			if ( $original_object ) {
				$original_title = get_the_title( $original_object->ID );
			}
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)', 'scalia' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)', 'scalia'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		if (!isset($item->scalia_mega_menu))
			$item->scalia_mega_menu = $menu_item->scalia_mega_menu_default;

		$mega_menu_container_classes = array( 'scalia-megamenu-fields' );
		if ( $item->scalia_mega_menu['enable'] ) {
			$classes[] = 'field-scalia-megamenu-enabled';
		}

		$mega_menu_container_classes = implode( ' ', $mega_menu_container_classes );

		?>
		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item', 'scalia' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'scalia'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'scalia'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item', 'scalia'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item', 'scalia' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
							<?php _e( 'URL', 'scalia' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'Navigation Label', 'scalia' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'Title Attribute', 'scalia' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab', 'scalia' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'CSS Classes (optional)', 'scalia' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'Link Relationship (XFN)', 'scalia' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
						<?php _e( 'Description', 'scalia' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'scalia'); ?></span>
					</label>
				</p>

				<div class="wrapper-scalia-mobile-clickable" style="clear: both;">
					<p class="field-scalia-mobile-clickable">
						<label for="edit-scalia-mobile-clickable-<?php echo esc_attr($item_id); ?>">
							<input id="edit-scalia-mobile-clickable-<?php echo esc_attr($item_id); ?>" type="checkbox" class="scalia-edit-scalia-mobile-clickable" name="scalia_mobile_clickable[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->scalia_mobile_clickable ); ?>/>
							<?php _e( 'Make clickable on mobile', 'scalia' ); ?>
						</label>
					</p>
				</div>

				<!-- Scalia Mega Menu Start -->

				<div class="<?php echo esc_attr( $mega_menu_container_classes ); ?>" style="clear: both;">

                    <p class="field-scalia-megamenu-icon description">
                        <label for="edit-scalia_mega_menu_icon-<?php echo esc_attr($item_id); ?>">
                            <?php _e( 'Icon', 'scalia' ); ?><br />
                            <input id="edit-scalia_mega_menu_icon-<?php echo esc_attr($item_id); ?>" class="scalia-edit-menu-item-icon" type="text" name="scalia_mega_menu_icon[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->scalia_mega_menu['icon']); ?>"/><br />
                            <span class="description"><?php _e('Enter icon code', 'scalia'); ?>. <a href="<?php echo scalia_user_icons_info_link(); ?>" onclick="tb_show('<?php _e('Icons info', 'scalia'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'scalia'); ?></a></span>
                        </label>
                    </p>

					<!-- first level -->
					<p class="field-scalia-megamenu-enable">
						<label for="edit-scalia_mega_menu_enable-<?php echo esc_attr($item_id); ?>">
							<input id="edit-scalia_mega_menu_enable-<?php echo esc_attr($item_id); ?>" type="checkbox" class="scalia-edit-menu-item-icon-enable" name="scalia_mega_menu_enable[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->scalia_mega_menu['enable'] ); ?>/>
							<?php _e( 'Enable Mega Menu', 'scalia' ); ?>
						</label>
					</p>

					<p class="field-scalia-megamenu-masonry">
						<label for="edit-scalia_mega_menu_masonry-<?php echo esc_attr($item_id); ?>">
							<input id="edit-scalia_mega_menu_masonry-<?php echo esc_attr($item_id); ?>" type="checkbox" class="scalia-edit-menu-item-icon-mega-masonry" name="scalia_mega_menu_masonry[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->scalia_mega_menu['masonry'] ); ?>/>
							<?php _e( 'Mega Menu Masonry Style', 'scalia' ); ?>
						</label>
					</p>

                    <p class="field-scalia-megamenu-columns description">
                        <label for="edit-scalia_mega_menu_columns-<?php echo esc_attr($item_id); ?>">
    						<?php _e( 'Number of columns: ', 'scalia' ); ?><br />
    						<select name="scalia_mega_menu_columns[<?php echo esc_attr($item_id); ?>]" for="edit-scalia_mega_menu_columns-<?php echo esc_attr($item_id); ?>">
    							<?php foreach( $item->scalia_mega_menu_columns_values as $value=>$title): ?>
    								<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->scalia_mega_menu['columns']); ?>><?php echo esc_html($title); ?></option>
    							<?php endforeach; ?>
    						</select>
                        </label>
					</p>

					<p class="field-scalia-megamenu-image description">
						<label for="edit-scalia_mega_menu_image-<?php echo esc_attr($item_id); ?>">
							<?php _e( 'Background image', 'scalia' ); ?><br />
							<input id="edit-scalia_mega_menu_image-<?php echo esc_attr($item_id); ?>" class= "scalia-edit-menu-item-image picture-select" type="text" name="scalia_mega_menu_image[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->scalia_mega_menu['image'] ); ?>"/>
							<button class="picture-select-button"><?php _e( 'Select', 'scalia' ); ?></button>
						</label>
					</p>

                    <p class="field-scalia-megamenu-image-position description">
                        <label for="edit-scalia_mega_menu_image_position-<?php echo esc_attr($item_id); ?>">
                            <?php _e( 'Position: ', 'scalia' ); ?><br />
                            <select name="scalia_mega_menu_image_position[<?php echo esc_attr($item_id); ?>]" for="edit-scalia_mega_menu_image_position-<?php echo esc_attr($item_id); ?>">
                                <?php foreach( $item->scalia_mega_menu_image_position_values as $value=>$title): ?>
                                    <option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->scalia_mega_menu['image_position']); ?>><?php echo esc_html($title); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </p>

					<fieldset class="fieldset-scalia-megamenu-padding">
						<legend><?php _e( 'Padding: ', 'scalia' ); ?></legend>

						<p class="field-scalia-megamenu-padding-left description description-thin">
							<label for="edit-scalia_mega_menu_padding_left-<?php echo esc_attr($item_id); ?>">
								<?php _e( 'Left', 'scalia' ); ?><br />
								<input id="edit-scalia_mega_menu_padding_left-<?php echo esc_attr($item_id); ?>" class="scalia-edit-menu-item-padding-left" type="text" name="scalia_mega_menu_padding_left[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->scalia_mega_menu['padding_left'] ); ?>"/>
							</label>
						</p>

						<p class="field-scalia-megamenu-padding-right description description-thin">
							<label for="edit-scalia_mega_menu_padding_right-<?php echo esc_attr($item_id); ?>">
								<?php _e( 'Right', 'scalia' ); ?><br />
								<input id="edit-scalia_mega_menu_padding_right-<?php echo esc_attr($item_id); ?>" class="scalia-edit-menu-item-padding-right" type="text" name="scalia_mega_menu_padding_right[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->scalia_mega_menu['padding_right'] ); ?>"/>
							</label>
						</p>

						<p class="field-scalia-megamenu-padding-top description description-thin">
							<label for="edit-scalia_mega_menu_padding_top-<?php echo esc_attr($item_id); ?>">
								<?php _e( 'Top', 'scalia' ); ?><br />
								<input id="edit-scalia_mega_menu_padding_top-<?php echo esc_attr($item_id); ?>" class="scalia-edit-menu-item-padding-top" type="text" name="scalia_mega_menu_padding_top[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->scalia_mega_menu['padding_top'] ); ?>"/>
							</label>
						</p>

						<p class="field-scalia-megamenu-padding-bottom description description-thin">
							<label for="edit-scalia_mega_menu_padding_bottom-<?php echo esc_attr($item_id); ?>">
								<?php _e( 'Bottom', 'scalia' ); ?><br />
								<input id="edit-scalia_mega_menu_padding_bottom-<?php echo esc_attr($item_id); ?>" class="scalia-edit-menu-item-padding-bottom" type="text" name="scalia_mega_menu_padding_bottom[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->scalia_mega_menu['padding_bottom'] ); ?>"/>
							</label>
						</p>
						<br class="clear" />
					</fieldset>

					<!-- second level -->
                    <p class="field-scalia-megamenu-width description">
                        <label for="edit-scalia_mega_menu_width-<?php echo esc_attr($item_id); ?>">
                            <?php _e( 'Column width', 'scalia' ); ?><br />
                            <input id="edit-scalia_mega_menu_width-<?php echo esc_attr($item_id); ?>" class= "scalia-edit-menu-item-width" type="text" name="scalia_mega_menu_width[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->scalia_mega_menu['width'] ); ?>"/>
                        </label>
                    </p>

                    <p class="field-scalia-megamenu-not-link">
                        <label for="edit-scalia_mega_menu_not_link-<?php echo esc_attr($item_id); ?>">
                            <input id="edit-scalia_mega_menu_not_link-<?php echo esc_attr($item_id); ?>" type="checkbox" class="scalia-edit-menu-item-not-link" name="scalia_mega_menu_not_link[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->scalia_mega_menu['not_link'] ); ?>/>
                            <?php _e( 'Don\'t link', 'scalia' ); ?>
                        </label>
                    </p>

                    <p class="field-scalia-megamenu-not-show">
                        <label for="edit-scalia_mega_menu_not_show-<?php echo esc_attr($item_id); ?>">
                            <input id="edit-scalia_mega_menu_not_show-<?php echo esc_attr($item_id); ?>" type="checkbox" class="scalia-edit-menu-item-not-show" name="scalia_mega_menu_not_show[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->scalia_mega_menu['not_show'] ); ?>/>
                            <?php _e( 'Don\'t show', 'scalia' ); ?>
                        </label>
                    </p>

                    <p class="field-scalia-megamenu-new-row">
                        <label for="edit-scalia_mega_menu_new_row-<?php echo esc_attr($item_id); ?>">
                            <input id="edit-scalia_mega_menu_new_row-<?php echo esc_attr($item_id); ?>" type="checkbox" class="scalia-edit-menu-item-new-root" name="scalia_mega_menu_new_row[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->scalia_mega_menu['new_row'] ); ?>/>
                            <?php _e( 'This item should start a new row', 'scalia' ); ?>
                        </label>
                    </p>

					<!-- third level -->
                    <p class="field-scalia-megamenu-label description">
                        <label for="edit-scalia_mega_menu_label-<?php echo esc_attr($item_id); ?>">
                            <?php _e( 'Label', 'scalia' ); ?><br />
                            <input id="edit-scalia_mega_menu_label-<?php echo esc_attr($item_id); ?>" class= "scalia-edit-menu-item-label" type="text" name="scalia_mega_menu_label[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->scalia_mega_menu['label'] ); ?>"/>
                        </label>
                    </p>

				</div>

				<!-- Scalia Mega Menu End -->

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move', 'scalia' ); ?></span>
						<a href="#" class="menus-move-up"><?php _e( 'Up one', 'scalia' ); ?></a>
						<a href="#" class="menus-move-down"><?php _e( 'Down one', 'scalia' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php _e( 'To the top', 'scalia' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s', 'scalia'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e( 'Remove', 'scalia' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php _e('Cancel', 'scalia'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}

}

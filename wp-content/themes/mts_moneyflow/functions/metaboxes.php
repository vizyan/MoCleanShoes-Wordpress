<?php

/*-----------------------------------------------------------------------------------*/
/*	Sidebar Selection meta box
/*-----------------------------------------------------------------------------------*/
function mts_add_sidebar_metabox() {
    $screens = array('post', 'page');
    foreach ($screens as $screen) {
        add_meta_box(
            'mts_sidebar_metabox',                  // id
            __('Sidebar', 'mythemeshop'),    // title
            'mts_inner_sidebar_metabox',            // callback
            $screen,                                // post_type
            'side',                                 // context (normal, advanced, side)
            'high'                               // priority (high, core, default, low)
                                                    // callback args ($post passed by default)
        );
    }
}
add_action('add_meta_boxes', 'mts_add_sidebar_metabox');


/**
 * Print the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function mts_inner_sidebar_metabox($post) {
    global $wp_registered_sidebars;
    
    // Add an nonce field so we can check for it later.
    wp_nonce_field('mts_inner_sidebar_metabox', 'mts_inner_sidebar_metabox_nonce');
    
    /*
    * Use get_post_meta() to retrieve an existing value
    * from the database and use the value for the form.
    */
    $custom_sidebar = get_post_meta( $post->ID, '_mts_custom_sidebar', true );
    $sidebar_location = get_post_meta( $post->ID, '_mts_sidebar_location', true );

    // Select custom sidebar from dropdown
    echo '<select name="mts_custom_sidebar" id="mts_custom_sidebar" style="margin-bottom: 10px;">';
    echo '<option value="" '.selected('', $custom_sidebar).'>-- '.__('Default', 'mythemeshop').' --</option>';
    
    // Exclude built-in sidebars
    $hidden_sidebars = array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','shop-sidebar', 'product-sidebar');    
    
    foreach ($wp_registered_sidebars as $sidebar) {
        if (!in_array($sidebar['id'], $hidden_sidebars)) {
            echo '<option value="'.esc_attr($sidebar['id']).'" '.selected($sidebar['id'], $custom_sidebar, false).'>'.$sidebar['name'].'</option>';
        }
    }
    echo '<option value="mts_nosidebar" '.selected('mts_nosidebar', $custom_sidebar).'>-- '.__('No sidebar --', 'mythemeshop').'</option>';    
    echo '</select><br />';
    
    // Select single layout (left/right sidebar)
    echo '<div class="mts_sidebar_location_fields">';
    echo '<label for="mts_sidebar_location_default" style="display: inline-block; margin-right: 20px;"><input type="radio" name="mts_sidebar_location" id="mts_sidebar_location_default" value=""'.checked('', $sidebar_location, false).'>'.__('Default side', 'mythemeshop').'</label>';
    echo '<label for="mts_sidebar_location_left" style="display: inline-block; margin-right: 20px;"><input type="radio" name="mts_sidebar_location" id="mts_sidebar_location_left" value="left"'.checked('left', $sidebar_location, false).'>'.__('Left', 'mythemeshop').'</label>';
    echo '<label for="mts_sidebar_location_right" style="display: inline-block; margin-right: 20px;"><input type="radio" name="mts_sidebar_location" id="mts_sidebar_location_right" value="right"'.checked('right', $sidebar_location, false).'>'.__('Right', 'mythemeshop').'</label>';
    echo '</div>';
    
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            function mts_toggle_sidebar_location_fields() {
                $('.mts_sidebar_location_fields').toggle(($('#mts_custom_sidebar').val() != 'mts_nosidebar'));
            }
            mts_toggle_sidebar_location_fields();
            $('#mts_custom_sidebar').change(function() {
                mts_toggle_sidebar_location_fields();
            });
        });
    </script>
    <?php
    //debug
    //global $wp_meta_boxes;
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function mts_save_custom_sidebar( $post_id ) {
    
    /*
    * We need to verify this came from our screen and with proper authorization,
    * because save_post can be triggered at other times.
    */
    
    // Check if our nonce is set.
    if ( ! isset( $_POST['mts_inner_sidebar_metabox_nonce'] ) )
    return $post_id;
    
    $nonce = $_POST['mts_inner_sidebar_metabox_nonce'];
    
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'mts_inner_sidebar_metabox' ) )
      return $post_id;
    
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;
    
    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {
    
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
    
    } else {
    
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    }
    
    /* OK, its safe for us to save the data now. */
    
    // Sanitize user input.
    $sidebar_name = sanitize_text_field( $_POST['mts_custom_sidebar'] );
    $sidebar_location = sanitize_text_field( $_POST['mts_sidebar_location'] );
    
    // Update the meta field in the database.
    update_post_meta( $post_id, '_mts_custom_sidebar', $sidebar_name );
    update_post_meta( $post_id, '_mts_sidebar_location', $sidebar_location );
}
add_action( 'save_post', 'mts_save_custom_sidebar' );


/*-----------------------------------------------------------------------------------*/
/*  Post Template Selection meta box
/*-----------------------------------------------------------------------------------*/
function mts_add_posttemplate_metabox() {
    add_meta_box(
        'mts_posttemplate_metabox',         // id
        __('Template', 'mythemeshop'),      // title
        'mts_inner_posttemplate_metabox',   // callback
        'post',                             // post_type
        'side',                             // context (normal, advanced, side)
        'high'                              // priority (high, core, default, low)
    );
}
//add_action('add_meta_boxes', 'mts_add_posttemplate_metabox');


/**
 * Print the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function mts_inner_posttemplate_metabox($post) {
    
    // Add an nonce field so we can check for it later.
    wp_nonce_field('mts_inner_posttemplate_metabox', 'mts_inner_posttemplate_metabox_nonce');
    
    /*
    * Use get_post_meta() to retrieve an existing value
    * from the database and use the value for the form.
    */
    $posttemplate = get_post_meta( $post->ID, '_mts_posttemplate', true );

    // Select post template
    echo '<select name="mts_posttemplate" style="margin-bottom: 10px;">';
    echo '<option value="" '.selected('', $posttemplate).'>'.__('Default Post Template', 'mythemeshop').'</option>';
    echo '<option value="parallax" '.selected('parallax', $posttemplate).'>'.__('Parallax Template', 'mythemeshop').'</option>';
    echo '<option value="zoomout" '.selected('zoomout', $posttemplate).'>'.__('Zoom Out Effect Template', 'mythemeshop').'</option>';
    echo '</select><br />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function mts_save_posttemplate( $post_id ) {
    
    /*
    * We need to verify this came from our screen and with proper authorization,
    * because save_post can be triggered at other times.
    */
    
    // Check if our nonce is set.
    if ( ! isset( $_POST['mts_inner_posttemplate_metabox_nonce'] ) )
    return $post_id;
    
    $nonce = $_POST['mts_inner_posttemplate_metabox_nonce'];
    
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'mts_inner_posttemplate_metabox' ) )
      return $post_id;
    
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;
    
    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {
    
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
    
    } else {
    
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    }
    
    /* OK, its safe for us to save the data now. */
    
    // Sanitize user input.
    $posttemplate = sanitize_text_field( $_POST['mts_posttemplate'] );
    
    // Update the meta field in the database.
    update_post_meta( $post_id, '_mts_posttemplate', $posttemplate );
}
add_action( 'save_post', 'mts_save_posttemplate' );

// Related function: mts_get_posttemplate( $single_template ) in functions.php

/*-----------------------------------------------------------------------------------*/
/*  Page Header Animation Selection meta box
/*-----------------------------------------------------------------------------------*/
function mts_add_postheader_metabox() {
    $screens = array('post', 'page');
    foreach ($screens as $screen) {
        add_meta_box(
            'mts_postheader_metabox',                  // id
            __('Header Animation', 'mythemeshop'),    // title
            'mts_inner_postheader_metabox',            // callback
            $screen,                                // post_type
            'side',                                 // context (normal, advanced, side)
            'high'                               // priority (high, core, default, low)
                                                    // callback args ($post passed by default)
        );
    }
}
add_action('add_meta_boxes', 'mts_add_postheader_metabox');


/**
 * Print the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function mts_inner_postheader_metabox($post) {
    
    // Add an nonce field so we can check for it later.
    wp_nonce_field('mts_inner_postheader_metabox', 'mts_inner_postheader_metabox_nonce');
    
    /*
    * Use get_post_meta() to retrieve an existing value
    * from the database and use the value for the form.
    */
    $postheader = get_post_meta( $post->ID, '_mts_postheader', true );

    // Select post header effect
    echo '<select name="mts_postheader" style="margin-bottom: 10px;">';
    echo '<option value="" '.selected('', $postheader).'>'.__('None', 'mythemeshop').'</option>';
    echo '<option value="parallax" '.selected('parallax', $postheader).'>'.__('Parallax Effect', 'mythemeshop').'</option>';
    echo '<option value="zoomout" '.selected('zoomout', $postheader).'>'.__('Zoom Out Effect', 'mythemeshop').'</option>';
    echo '</select><br />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function mts_save_postheader( $post_id ) {
    
    /*
    * We need to verify this came from our screen and with proper authorization,
    * because save_post can be triggered at other times.
    */
    
    // Check if our nonce is set.
    if ( ! isset( $_POST['mts_inner_postheader_metabox_nonce'] ) )
    return $post_id;
    
    $nonce = $_POST['mts_inner_postheader_metabox_nonce'];
    
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'mts_inner_postheader_metabox' ) )
      return $post_id;
    
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;
    
    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {
    
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    
    } else {
    
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }
    
    /* OK, its safe for us to save the data now. */
    
    // Sanitize user input.
    $postheader = sanitize_text_field( $_POST['mts_postheader'] );
    
    // Update the meta field in the database.
    update_post_meta( $post_id, '_mts_postheader', $postheader );
}
add_action( 'save_post', 'mts_save_postheader' );
// Related function: mts_get_post_header_effect() in functions.php

// Add batch to Publish box
add_action( 'post_submitbox_misc_actions', 'mts_featured_post_field' );
function mts_featured_post_field()
{
    global $post;

    /* check if this is a post, if not then we won't add the custom field */
    /* change this post type to any type you want to add the custom field to */
    if (get_post_type($post) != 'post') return false;

    /* get the value corrent value of the custom field */
    $batch = get_post_meta($post->ID, 'batch', true);
    ?>
        <div class="misc-pub-section" id="mts_featured_field">
            <h3><?php _e('Post Batch:', 'mythemeshop'); ?></h2>
            <div class="hot-sec">
                <input type="radio" name="batch" id="featured" <?php if ($batch=="featured") echo "checked";?> value="featured"><label for="featured"><?php _e('Featured Post', 'mythemeshop'); ?></label>
            </div>
            <div class="hot-sec">
                <input type="radio" name="batch" id="hot" <?php if ($batch=="hot") echo "checked";?> value="hot"><label for="hot"><?php _e('Hot', 'mythemeshop'); ?></label>
            </div>
            <div class="hot-sec">
                <input type="radio" name="batch" id="buy" <?php if ($batch=="buy") echo "checked";?> value="buy"><label for="buy"><?php _e('Buy', 'mythemeshop'); ?></label>
            </div>
            <div class="hot-sec">
                <input type="radio" name="batch" id="new" <?php if ($batch=="new") echo "checked";?> value="new"><label for="new"><?php _e('New', 'mythemeshop'); ?></label>
            </div>
            <div class="hot-sec">
                <input type="radio" name="batch" id="win" <?php if ($batch=="win") echo "checked";?> value="win"><label for="win"><?php _e('Win', 'mythemeshop'); ?></label>
            </div>
            <div class="hot-sec">
                <input type="radio" name="batch" id="none" <?php if ($batch=="none" || $batch=="") echo "checked";?> value="none"><label for="none"><?php _e('None', 'mythemeshop'); ?></label>
            </div>
        </div>
        
    <?php
}

add_action( 'save_post', 'mts_save_featured_meta');
function mts_save_featured_meta($postid)
{
    /* check if this is an autosave */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return false;

    if ( !current_user_can( 'edit_page', $postid ) ) return false;

    // check if quick edit
    if (isset($_POST['_inline_edit']) && wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
      return;

    if(empty($postid) || (!empty($_POST['post_type']) && $_POST['post_type'] != 'post')  || (!empty($_GET['post_type']) && $_GET['post_type'] != 'post') ) return false;

    if(isset($_POST['batch'])){
        update_post_meta( $postid, 'batch', $_POST['batch'] );
    }
}

?>
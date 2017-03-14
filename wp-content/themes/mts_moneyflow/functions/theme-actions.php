<?php
$mts_options = get_option(MTS_THEME_NAME);
/*------------[ Meta ]-------------*/
if ( ! function_exists( 'mts_meta' ) ) {
    function mts_meta(){
    global $mts_options, $post;
?>
<?php if ( !empty( $mts_options['mts_favicon'] ) ) { ?>
<link rel="icon" href="<?php echo esc_url( $mts_options['mts_favicon'] ); ?>" type="image/x-icon" />
<?php } ?>
<?php if ( !empty( $mts_options['mts_metro_icon'] ) ) { ?>
    <!-- IE10 Tile.-->
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?php echo esc_attr( $mts_options['mts_metro_icon'] ); ?>">
<?php } ?>
<!--iOS/android/handheld specific -->
<?php if ( !empty( $mts_options['mts_touch_icon'] ) ) { ?>
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( $mts_options['mts_touch_icon'] ); ?>" />
<?php } ?>
<?php if ( ! empty( $mts_options['mts_responsive'] ) ) { ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php } ?>
<?php if($mts_options['mts_prefetching'] == '1') { ?>
<?php if (is_front_page()) { ?>
    <?php $my_query = new WP_Query('posts_per_page=1'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <link rel="prefetch" href="<?php the_permalink(); ?>">
    <link rel="prerender" href="<?php the_permalink(); ?>">
    <?php endwhile; wp_reset_postdata(); ?>
<?php } elseif (is_singular()) { ?>
    <link rel="prefetch" href="<?php echo esc_url( home_url() ); ?>">
    <link rel="prerender" href="<?php echo esc_url( home_url() ); ?>">
<?php } ?>
<?php } ?>
    <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
    <meta itemprop="url" content="<?php echo esc_attr( site_url() ); ?>" />
    <?php if ( is_singular() ) { ?>
    <meta itemprop="creator accountablePerson" content="<?php $user_info = get_userdata($post->post_author); echo $user_info->first_name.' '.$user_info->last_name; ?>" />
    <?php } ?>
<?php }
}

/*------------[ Head ]-------------*/
if ( ! function_exists( 'mts_head' ) ){
    function mts_head() {
    global $mts_options;
?>
<?php echo $mts_options['mts_header_code']; ?>
<?php }
}
add_action('wp_head', 'mts_head');

/*------------[ Copyrights ]-------------*/
if ( ! function_exists( 'mts_copyrights_credit' ) ) {
    function mts_copyrights_credit() { 
    global $mts_options
?>
<!--start copyrights-->
<div class="row" id="copyright-note">
<span>&copy; Copyright <?php echo date("Y") ?>.</span>
<div class="to-top"><?php echo $mts_options['mts_copyrights']; ?></div>
</div>
<!--end copyrights-->
<?php }
}

/*------------[ footer ]-------------*/
if ( ! function_exists( 'mts_footer' ) ) {
    function mts_footer() { 
    global $mts_options;
?>
<?php if ($mts_options['mts_analytics_code'] != '') { ?>
<!--start footer code-->
<?php echo $mts_options['mts_analytics_code']; ?>
<!--end footer code-->
<?php } ?>
<?php }
}

/*------------[ breadcrumb ]-------------*/
if (!function_exists('mts_the_breadcrumb')) {
    function mts_the_breadcrumb() {
        echo '<div><i class="fa fa-home"></i></div> <div typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
        echo home_url();
        echo '" rel="nofollow">'.sprintf( __( "Home","mythemeshop"));
        echo '</a></div><div class="icon-font"><i class="fa fa-angle-right"></i></div>';
        if (is_single()) {
            $categories = get_the_category();
            if ( $categories ) {
                $level = 0;
                $hierarchy_arr = array();
                foreach ( $categories as $cat ) {
                    $anc = get_ancestors( $cat->term_id, 'category' );
                    $count_anc = count( $anc );
                    if (  0 < $count_anc && $level < $count_anc ) {
                        $level = $count_anc;
                        $hierarchy_arr = array_reverse( $anc );
                        array_push( $hierarchy_arr, $cat->term_id );
                    }
                }
                if ( empty( $hierarchy_arr ) ) {
                    $category = $categories[0];
                    echo '<div typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></div><div class="icon-font"><i class="fa fa-angle-right"></i></div>';
                } else {
                    foreach ( $hierarchy_arr as $cat_id ) {
                        $category = get_term_by( 'id', $cat_id, 'category' );
                        echo '<div typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></div><div class="icon-font"><i class="fa fa-angle-right"></i></div>';
                    }
                }
            }
            echo "<div><span>";
            the_title();
            echo "</span></div>";
        } elseif (is_page()) {
            global $post;
            if ( $post->post_parent ) {
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ( $parent_id ) {
                    $page = get_page( $parent_id );
                    $breadcrumbs[] = '<div typeof="v:Breadcrumb"><a href="'.esc_url( get_permalink( $page->ID ) ).'" rel="v:url" property="v:title">'.esc_html( get_the_title($page->ID) ). '</a></div><div class="icon-font"><i class="fa fa-angle-right"></i></div>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse( $breadcrumbs );
                foreach ( $breadcrumbs as $crumb ) { echo $crumb; }
            }
            echo "<div><span>";
            the_title();
            echo "</span></div>";
        } elseif (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $this_cat_id = $cat_obj->term_id;
            $hierarchy_arr = get_ancestors( $this_cat_id, 'category' );
            if ( $hierarchy_arr ) {
                $hierarchy_arr = array_reverse( $hierarchy_arr );
                foreach ( $hierarchy_arr as $cat_id ) {
                    $category = get_term_by( 'id', $cat_id, 'category' );
                    echo '<div typeof="v:Breadcrumb"><a href="'.esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></div><div><i class="fa fa-caret-right"></i></div>';
                }
            }
            echo "<div><span>";
            single_cat_title();
            echo "</span></div>";
        } elseif (is_author()) {
            echo "<div><span>";
            if(get_query_var('author_name')) :
                $curauth = get_user_by('slug', get_query_var('author_name'));
            else :
                $curauth = get_userdata(get_query_var('author'));
            endif;
            echo esc_html( $curauth->nickname );
            echo "</span></div>";
        } elseif (is_search()) {
            echo "<div><span>";
            the_search_query();
            echo "</span></div>";
        } elseif (is_tag()) {
            echo "<div><span>";
            single_tag_title();
            echo "</span></div>";
        }
        elseif (is_shop()) {
            echo "<div><span>Shop</span></div>";
        }
    }
}

/*------------[ schema.org-enabled the_category() and the_tags() ]-------------*/
function mts_the_category( $separator = ', ' ) {
    $categories = get_the_category();
    $count = count($categories);
    foreach ( $categories as $i => $category ) {
        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( __( "View all posts in %s", 'mythemeshop' ), esc_attr( $category->name ) ) . '" ' . '>' . esc_html( $category->name ).'</a>';
        if ( $i < $count - 1 )
            echo $separator;
    }
}
function mts_the_tags($before = '', $sep = ', ', $after = '') {
    $before = '<div class="tags border-bottom">'.__('Tags: ', 'mythemeshop');
    $after = '</div>';

    $tags = get_the_tags();
    if (empty( $tags ) || is_wp_error( $tags ) ) {
        return;
    }
    $tag_links = array();
    foreach ($tags as $tag) {
        $link = get_tag_link($tag->term_id);
        $tag_links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $tag->name . '</a>';
    }
    echo $before.join($sep, $tag_links).$after;
}

/*------------[ pagination ]-------------*/
if (!function_exists('mts_pagination')) {
    function mts_pagination($pages = '', $range = 3) {
        $mts_options = get_option(MTS_THEME_NAME);
        if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { // numeric pagination
            $showitems = ($range * 3)+1;
            global $paged; if(empty($paged)) $paged = 1;
            if($pages == '') {
                global $wp_query; $pages = $wp_query->max_num_pages; 
                if(!$pages){ $pages = 1; } 
            }
            if(1 != $pages) { 
                echo '<div class="pagination pagination-numeric"><ul>';
                
                if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
                    echo "<li><a rel='nofollow' href='".esc_url( get_pagenum_link(1) )."'><i class='fa fa-angle-double-left'></i> ".__('First','mythemeshop')."</a></li>";
                if($paged > 1 && $showitems < $pages) 
                    echo "<li><a rel='nofollow' href='".esc_url( get_pagenum_link($paged - 1) )."' class='inactive'><i class='fa fa-angle-left'></i> ".__('Previous','mythemeshop')."</a></li>";
                for ($i=1; $i <= $pages; $i++){ 
                    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) { 
                        echo ($paged == $i)? "<li class='current'><span class='currenttext'>".$i."</span></li>":"<li><a rel='nofollow' href='".esc_url( get_pagenum_link($i) )."' class='inactive'>".$i."</a></li>";
                    } 
                } 
                if ($paged < $pages && $showitems < $pages) 
                    echo "<li><a rel='nofollow' href='".esc_url( get_pagenum_link($paged + 1) )."' class='inactive'>".__('Next','mythemeshop')." <i class='fa fa-angle-right'></i></a></li>";
                if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
                    echo "<li><a rel='nofollow' class='inactive' href='".esc_url( get_pagenum_link($pages) )."'>".__('Last','mythemeshop')." <i class='fa fa-angle-double-right'></i></a></li>";
                
                echo '</ul></div>';
            }
        } else { // traditional or ajax pagination
            ?>
            <div class="pagination pagination-previous-next">
            <ul>
                <li class="nav-previous"><?php next_posts_link( '<i class="fa fa-angle-left"></i> '. __( 'Previous', 'mythemeshop' ) ); ?></li>
                <li class="nav-next"><?php previous_posts_link( __( 'Next', 'mythemeshop' ).' <i class="fa fa-angle-right"></i>' ); ?></li>
            </ul>
            </div>
            <?php
        }
    }
}

/*------------[ Cart ]-------------*/
if ( ! function_exists( 'mts_cart' ) ) {
    function mts_cart() { 
       if (mts_isWooCommerce()) {
       global $mts_options;
?>
<div class="mts-cart">
    <?php global $woocommerce; ?>
    <span>
        <i class="fa fa-user"></i> 
        <?php if ( is_user_logged_in() ) { ?>
            <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('My Account','mythemeshop'); ?>"><?php _e('My Account','mythemeshop'); ?></a>
        <?php } 
        else { ?>
            <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('Login / Register','mythemeshop'); ?>"><?php _e('Login ','mythemeshop'); ?></a>
        <?php } ?>
    </span>
    <span>
        <i class="fa fa-shopping-cart"></i> <a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e('View your shopping cart', 'mythemeshop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'mythemeshop'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    </span>
</div>
<?php } 
    }
}

/*------------[ Related Posts ]-------------*/
if (!function_exists('mts_related_posts')) {
    function mts_related_posts() {
        global $post;
        $mts_options = get_option(MTS_THEME_NAME);
        //if(!empty($mts_options['mts_related_posts'])) { ?>    
            <!-- Start Related Posts -->
            <?php 
            $empty_taxonomy = false;
            if (empty($mts_options['mts_related_posts_taxonomy']) || $mts_options['mts_related_posts_taxonomy'] == 'tags') {
                // related posts based on tags
                $tags = get_the_tags($post->ID); 
                if (empty($tags)) { 
                    $empty_taxonomy = true;
                } else {
                    $tag_ids = array(); 
                    foreach($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id; 
                    }
                    $args = array( 'tag__in' => $tag_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' => $mts_options['mts_related_postsnum'], 
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             } else {
                // related posts based on categories
                $categories = get_the_category($post->ID); 
                if (empty($categories)) { 
                    $empty_taxonomy = true;
                } else {
                    $category_ids = array(); 
                    foreach($categories as $individual_category) 
                        $category_ids[] = $individual_category->term_id; 
                    $args = array( 'category__in' => $category_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' => $mts_options['mts_related_postsnum'],  
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             }
            if (!$empty_taxonomy) {
            $my_query = new WP_Query( $args ); if( $my_query->have_posts() ) {
                echo '<div class="related-posts">';
                echo '<h4>'.__('Related Posts','mythemeshop').'</h4>';
                echo '<div class="clear">';
                $posts_per_row = 3;
                $j = 0;
                while( $my_query->have_posts() ) { $my_query->the_post(); ?>
                <article class="latestPost excerpt  <?php echo (++$j % $posts_per_row == 0) ? 'last' : ''; ?>">
                    <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="nofollow" id="featured-thumbnail">
                        
                        <?php
                        $post_format = get_post_format();

                        if('' == $post_format ){
                            $icon_class = '';
                        }
                        else if('image' == $post_format ){
                            $icon_class = 'image';
                        }
                        else if('gallery' == $post_format ){
                            $icon_class = 'gallery';
                        }
                        else if('audio' == $post_format ){
                            $icon_class = 'music';
                        }
                        else if('video' == $post_format ){
                            $icon_class = 'video-camera';
                        }
                        else if('link' == $post_format ){
                            $icon_class = 'link';
                        }
                        else if('quote' == $post_format ){
                            $icon_class = 'quote-right';
                        }
                        else if('status' == $post_format ){
                            $icon_class = 'history';
                        }
                        else{
                            $icon_class = '';
                        }

                        if(!empty($icon_class)) { echo '<div class="post-format-icons"><i class="fa fa-'.$icon_class.'"></i></div>'; }

                        $thumb = array( 'width' => 370, 'height' => 250, 'crop' => true );
                        
                        if(has_post_thumbnail()) {
                            $image_id = get_post_thumbnail_id ();
                            $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
                            $thumb_src = bfi_thumb($image_thumb_url[0], $thumb );
                        } else {
                            $thumb_src = get_template_directory_uri().'/images/nothumb-featuredwithsidebar.png';
                        }
                        echo '<div class="featured-thumbnail"><img src="'.$thumb_src.'" width="'.$thumb['width'].'" height="'.$thumb['height'].'"></div>';
                        if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                    </a>
                    <div class="latestPost-content">
                        <header>
                            <h2 class="title front-view-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h2>
                        </header>
                        <div class="front-view-content">
                            <?php echo mts_excerpt(15); ?>
                        </div>
                        <?php mts_the_postinfo(); ?>
                        <?php mts_readmore(); ?>
                    </div>
                </article><!--.post.excerpt-->
                <?php } echo '</div></div>'; }} wp_reset_postdata(); ?>
            <!-- .related-posts -->
        <?php //}
    }
}


if ( ! function_exists('mts_the_postinfo' ) ) {
    function mts_the_postinfo( $section = 'home' ) {
        $mts_options = get_option( MTS_THEME_NAME );
        $opt_key = 'mts_'.$section.'_headline_meta_info';
        
        if ( isset( $mts_options[ $opt_key ] ) && is_array( $mts_options[ $opt_key ] ) && array_key_exists( 'enabled', $mts_options[ $opt_key ] ) ) {
            $headline_meta_info = $mts_options[ $opt_key ]['enabled'];
        } else {
            $headline_meta_info = array();
        }
        if ( ! empty( $headline_meta_info ) ) { ?>
            <div class="post-info">
                <?php foreach( $headline_meta_info as $key => $meta ) { mts_the_postinfo_item( $key ); } ?>
            </div>
        <?php }
    }
}
if ( ! function_exists('mts_the_postinfo_item' ) ) {
    function mts_the_postinfo_item( $item ) {
        switch ( $item ) {
            case 'author':
            ?>
                <span class="theauthor"><?php if(!is_home()){ ?><i class="fa fa-user"></i> <?php } ?><span><?php the_author_posts_link(); ?></span></span>
            <?php
            break;
            case 'date':
            ?>
                <span class="thetime updated"><?php if(!is_home()){ ?><i class="fa fa-clock-o"></i> <?php } ?><span><?php the_time( get_option( 'date_format' ) ); ?></span></span>
            <?php
            break;
            case 'category':
            ?>
                <span class="thecategory"><?php if(!is_home()){ ?><i class="fa fa-tags"></i> <?php } ?><?php mts_the_category(', ') ?></span>
            <?php
            break;
            case 'comment':
            ?>
                <span class="thecomment"><?php if(!is_home()){ ?><i class="fa fa-comments"></i> <?php } ?><a rel="nofollow" href="<?php echo esc_url( get_comments_link() ); ?>"><?php comments_number();?></a></span>
            <?php
            break;
        }
    }
}

if (!function_exists('mts_social_buttons')) {
    function mts_social_buttons() {
        $mts_options = get_option( MTS_THEME_NAME );

        if ( isset( $mts_options['mts_social_buttons'] ) && is_array( $mts_options['mts_social_buttons'] ) && array_key_exists( 'enabled', $mts_options['mts_social_buttons'] ) ) {
            $buttons = $mts_options['mts_social_buttons']['enabled'];
        } else {
            $buttons = array();
        }

        if ( ! empty( $buttons ) ) {
        ?>
            <!-- Start Share Buttons -->
            <div class="shareit <?php echo $mts_options['mts_social_button_position']; ?>">
                <?php foreach( $buttons as $key => $button ) { mts_social_button( $key ); } ?>
            </div>
            <!-- end Share Buttons -->
        <?php
        }
    }
}

if ( ! function_exists('mts_social_button' ) ) {
    function mts_social_button( $button ) {
        $mts_options = get_option( MTS_THEME_NAME );
        global $post;
        if( is_single() ){
            $imgUrl = $img = '';
            if ( has_post_thumbnail( $post->ID ) ){
                $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slider' );
                $imgUrl = $img[0];
            }
        }
        switch ( $button ) {
            case 'facebook':
            ?>
                <!-- Facebook -->
                <span class="share-item facebooksharebtn">
                    <a href="//www.facebook.com/share.php?m2w&s=100&p[url]=<?php echo urlencode(get_permalink()); ?>&p[images][0]=<?php echo $imgUrl; ?>&p[title]=<?php echo get_the_title(); ?>" class="single-social"><i class="fa fa-facebook"></i></a>

                </span>
            <?php
            break;
            case 'twitter':
            ?>
                <!-- Twitter -->
                <span class="share-item twitterbtn">
                    <?php 
                    $via = '';
                    if( $mts_options['mts_twitter_username'] ) {
                        $via = '&via='. $mts_options['mts_twitter_username'];
                    }
                    ?> 
                    <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(get_permalink()); ?>&text=<?php echo get_the_title(); ?>&url=<?php echo urlencode(get_permalink()); ?><?php echo $via; ?>" class="single-social"><i class="fa fa-twitter"></i></a>
                </span>
            <?php
            break;
            case 'gplus':
            ?>
                <!-- GPlus -->
                <span class="share-item gplusbtn">
                    <!-- <g:plusone size="medium"></g:plusone> -->
                    <a href="//plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" class="single-social"><i class="fa fa-google-plus"></i></a>
                </span>
            <?php
            break;
            case 'pinterest':
                global $post;
            ?>
                <!-- Pinterest -->
                <span class="share-item pinbtn">
                    <a href="//pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?> + '&media=<?php echo $imgUrl; ?>&description=<?php the_title(); ?>" class="single-social"><i class="fa fa-pinterest-p"></i></a>

                </span>
            <?php
            break;
            case 'linkedin':
            ?>
                <!--Linkedin -->
                <span class="share-item linkedinbtn">                 
                    <a href="//www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo get_the_title(); ?>&source=<?php echo 'url'; ?>" class="single-social"><i class="fa fa-linkedin"></i></a>
                </span>
            <?php
            break;
            case 'stumble':
            ?>
                <!-- Stumble -->
                <span class="share-item stumblebtn">                
                    <a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_permalink()); ?>&title=<?php the_title(); ?>" class="single-social"><i class="fa fa-stumbleupon"></i></a>
                </span>
            <?php
            break;
        }
    }
}

/*------------[ Class attribute for <article> element ]-------------*/
if ( ! function_exists( 'mts_article_class' ) ) {
    function mts_article_class() {
        $mts_options = get_option( MTS_THEME_NAME );
        $class = '';
        
        // sidebar or full width
        if ( mts_custom_sidebar() == 'mts_nosidebar' ) {
            $class = 'ss-full-width';
        } else {
            $class = 'article';
        }
        
        echo $class;
    }
}

/*------------[ Class attribute for #page element ]-------------*/
if ( ! function_exists( 'mts_single_page_class' ) ) {
    function mts_single_page_class() {
        $class = '';

        if ( is_single() || is_page() ) {

            $class = 'single';

            $header_animation = mts_get_post_header_effect();
            if ( !empty( $header_animation )) $class .= ' '.$header_animation;
        }

        echo $class;
    }
}

if ( ! function_exists( 'mts_archive_post' ) ) {
    function mts_archive_post( $layout = 'grid' ) {

        $mts_options = get_option(MTS_THEME_NAME);

        global $post_column, $post, $j;

        //Feature thumbnail class
        $sidebar_size = "";
        if( $layout == 'with-sidebar' ) {
            $sidebar_size = "withsidebar";
        }
        if($post_column == 'column3' && ($layout == 'grid' || $layout == 'title-with-grid')){
            $sidebar_size = "withsidebar";
        }

        //Set icon class for post fomat
        $post_format = get_post_format();

        if('' == $post_format ){
            $icon_class = '';
        }
        else if('image' == $post_format ){
            $icon_class = 'image';
        }
        else if('gallery' == $post_format ){
            $icon_class = 'image';
        }
        else if('audio' == $post_format ){
            $icon_class = 'music';
        }
        else if('video' == $post_format ){
            $icon_class = 'video-camera';
        }
        else if('link' == $post_format ){
            $icon_class = 'link';
        }
        else if('quote' == $post_format ){
            $icon_class = 'quote-right';
        }
        else if('status' == $post_format ){
            $icon_class = 'history';
        }
        else{
            $icon_class = '';
        }

        //Get batch from meta box
        $batch = get_post_meta($post->ID, 'batch', true);

        $batch_translations = array(
            'featured' => __( 'Featured', 'mythemeshop' ),
            'hot' =>  __( 'Hot', 'mythemeshop' ),
            'buy' =>  __( 'Buy', 'mythemeshop' ),
            'new' =>  __( 'New', 'mythemeshop' ),
            'win' =>  __( 'Win', 'mythemeshop' ),
        );

        ?>

        <?php switch ($layout) {
            //Select index page layout style: with-sidebar, grid, list-style, title with grid
            case 'with-sidebar': ?>
            <div class="latestPost excerpt">
                <div class="blogPost">
                    <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="nofollow" class="post-image post-image-left">
                        <?php if(has_post_thumbnail()){
                            $thumb = array( 'width' => 370, 'height' => 250, 'crop' => true );
                            $image_id = get_post_thumbnail_id ();
                            $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
                            $thumb_src = bfi_thumb($image_thumb_url[0], $thumb );
                        } else {
                            $thumb_src = get_template_directory_uri().'/images/nothumb-featuredwithsidebar.png';
                        }

                        if(!empty($batch) && $batch != "none") {
                            echo '<div class="batch '. $batch .'">'.$batch_translations[ $batch ].'</div>';
                        }
                        
                        if ( !empty($icon_class) ) {
                            echo '<div class="post-format-icons"><i class="fa fa-'.$icon_class.'"></i></div>';
                        }
                        echo '<div class="featured-thumbnail"><img src="'.$thumb_src.'" width="370" height="250"></div>';
                        if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                    </a>

                    <div class="latestPost-content">
                        <header>
                            <h2 class="title front-view-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo short_title('...', 10); ?></a></h2>
                        </header>
                        <?php if ( is_page_template( 'page-blog.php' ) ) { ?>
                            <div class="post-info">
                                <span class="thetime updated"><?php if(!is_home()){ ?><i class="fa fa-clock-o"></i> <?php } ?><span><?php the_time( get_option( 'date_format' ) ); ?></span></span>
                                <span class="theauthor"><?php if(!is_home()){ ?><i class="fa fa-user"></i> <?php } ?><span><?php the_author_posts_link(); ?></span></span>
                            </div>
                        <?php } ?>
                        <div class="front-view-content">
                            <?php echo mts_excerpt(15); ?>
                        </div>
                        <?php mts_the_postinfo(); ?>
                        <?php mts_readmore(); ?>
                    </div>
                </div>
            </div>
            <?php
                break;
                case 'grid': ?>
                <div class="latestPost excerpt">
                    <div class="blogPost">
                        <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="nofollow" class="post-image post-image-left">

                            <?php if(!empty($batch) && $batch != "none") {
                                echo '<div class="batch '. $batch .'">'.$batch_translations[ $batch ].'</div>';
                            }

                            if ( !empty($icon_class) ) {
                                echo '<div class="post-format-icons"><i class="fa fa-'.$icon_class.'"></i></div>';
                            }

                            if( $post_column == 'column3' ) {
                                $thumb = array( 'width' => 370, 'height' => 250, 'crop' => true );
                                $thumb_src = get_template_directory_uri().'/images/nothumb-featuredwithsidebar.png';
                            } else {
                                $thumb = array( 'width' => 270, 'height' => 190, 'crop' => true );
                                $thumb_src = get_template_directory_uri().'/images/nothumb-4grid.png';
                            }
                            if(has_post_thumbnail()) {
                                $image_id = get_post_thumbnail_id ();
                                $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
                                $thumb_src = bfi_thumb($image_thumb_url[0], $thumb );
                            }
                            echo '<div class="featured-thumbnail"><img src="'.$thumb_src.'" width="'.$thumb['width'].'" height="'.$thumb['height'].'"></div>';
                            if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                        </a>

                        <div class="latestPost-content">
                            <header>
                                <h2 class="title front-view-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo short_title('...', 10); ?></a></h2>
                            </header>
                            <?php if ( is_page_template( 'page-blog.php' ) ) { ?>
                                <div class="post-info">
                                    <span class="thetime updated"><?php if(!is_home()){ ?><i class="fa fa-clock-o"></i> <?php } ?><span><?php the_time( get_option( 'date_format' ) ); ?></span></span>
                                    <span class="theauthor"><?php if(!is_home()){ ?><i class="fa fa-user"></i> <?php } ?><span><?php the_author_posts_link(); ?></span></span>
                                </div>
                            <?php }
                            ?>
                            <div class="front-view-content">
                                <?php echo mts_excerpt(15); ?>
                            </div>
                            <?php mts_the_postinfo(); ?>
                            <?php mts_readmore(); ?>
                        </div>
                    </div>
                </div>
            <?php
                break;
                case 'list': 
                if($j>2){return;}?>
                <div class="latestPost excerpt">
                    <div class="blogPost">
                        <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="nofollow" class="post-image post-image-left">
                            <?php
                            $thumb = array( 'width' => 66, 'height' => 50, 'crop' => true );
                            if(has_post_thumbnail()) {
                                $image_id = get_post_thumbnail_id ();
                                $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
                                $thumb_src = bfi_thumb($image_thumb_url[0], $thumb );
                            } else {
                                $thumb_src = get_template_directory_uri().'/images/nothumb-widgetthumb.png';
                            }
                            echo '<div class="featured-thumbnail"><img src="'.$thumb_src.'" width="'.$thumb['width'].'" height="'.$thumb['height'].'"></div>'; ?>
                        </a>
                        <div class="latestPost-content">
                            <header>
                                <h2 class="title front-view-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo short_title('...', 10); ?></a></h2>
                            </header>
                            <?php mts_the_postinfo(); ?>
                        </div>
                    </div>
                </div>
            <?php
                break;
                case 'title-with-grid': ?>
                <div class="latestPost excerpt">
                    <div class="blogPost">
                        <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="nofollow" class="post-image post-image-left">
                            <?php if(!empty($batch) && $batch != "none") {
                                echo '<div class="batch '. $batch .'">'.$batch_translations[ $batch ].'</div>';
                            }
                            if ( !empty($icon_class) ) {
                                echo '<div class="post-format-icons"><i class="fa fa-'.$icon_class.'"></i></div>';
                            }
                            $thumb = array( 'width' => 270, 'height' => 190, 'crop' => true );
                            if(has_post_thumbnail()) {
                                $image_id = get_post_thumbnail_id ();
                                $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
                                $thumb_src = bfi_thumb($image_thumb_url[0], $thumb );
                            } else {
                                $thumb_src = get_template_directory_uri().'/images/nothumb-4grid.png';
                            }
                            echo '<div class="featured-thumbnail"><img src="'.$thumb_src.'" width="'.$thumb['width'].'" height="'.$thumb['height'].'"></div>'; ?>
                            <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                        </a>
                        <div class="latestPost-content">
                            <header>
                                <h2 class="title front-view-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo short_title('...', 10); ?></a></h2>
                            </header>
                            <?php if ( is_page_template( 'page-blog.php' ) ) { ?>
                                <div class="post-info">
                                    <span class="thetime updated"><?php if(!is_home()){ ?><i class="fa fa-clock-o"></i> <?php } ?><span><?php the_time( get_option( 'date_format' ) ); ?></span></span>
                                    <span class="theauthor"><?php if(!is_home()){ ?><i class="fa fa-user"></i> <?php } ?><span><?php the_author_posts_link(); ?></span></span>
                                </div>
                            <?php }
                            ?>
                            <div class="front-view-content">
                                <?php echo mts_excerpt(15); ?>
                            </div>
                            <?php mts_the_postinfo(); ?>
                            <?php mts_readmore(); ?>
                        </div>
                    </div>
                </div>
            <?php
                break;
        }?>

        <?php
    }
}

if(!function_exists('get_category_sidebar')){
    function get_category_sidebar($sidebar_name, $cat_name){
        echo '<aside id="sidebar" class="sidebar c-4-12" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">';
            if ( is_active_sidebar( $sidebar_name )){
                dynamic_sidebar( $sidebar_name );
            }
            else{
                echo '<p class="sidebar-info">'.__('Please add any widget on Post Layout Sidebar: '.$cat_name ,'mythemeshop').'</p>';
            }
        echo '</aside>';
    }    
}
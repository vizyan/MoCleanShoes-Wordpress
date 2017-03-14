<?php
/**
 * Template Name: Blog Page
 */
?>

<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div id="banner-bottom">
    <div class="container clearfix">
        <?php $header_dropdown_cat = isset($mts_options['mts_dropdown_cat']) ? $mts_options['mts_dropdown_cat'] : '' ;
        if(!empty($header_dropdown_cat)){ ?>
            <ul id="category-list">
                <?php
                //Get categories array
                $categories = get_categories();
                $post_per_page = get_option('posts_per_page');

                echo '<li class="active current-cat">';
                    echo '<a href="#latest" data-postnum="'.$post_per_page.'" data-id="0">';
                        echo '<i class="fa fa-clock-o"></i>';
                        echo __('Latest Posts' , 'mythemeshop');
                    echo '</a>';
                echo '</li>';                

                echo '<li id="sublist" style="display:none;">';
                    echo '<ul>';
                        foreach ($header_dropdown_cat as $key => $category) {

                            $category_id = $category['mts_cc_category'];
                            $icon_class = $category['mts_cc_icon'];

                            if($category_id != 'latest'){

                                $category_name = get_cat_name( $category_id );
                                $category_url = get_category_link( $category_id );
                                if(empty($icon_class)){
                                    $icon_class = 'clock-o';
                                }

                                echo '<li>';
                                echo '<a href="'.$category_url.'">';
                                echo '<i class="fa fa-'.$icon_class.'"></i>';
                                echo __(ucwords($category_name), 'mythemeshop');
                                echo '</a>';
                                echo '</li>';

                            }
                        }
                    echo '</ul>';
                echo '</li>'; ?>
            </ul>
        <?php } ?>

        <?php if($mts_options['mts_lower_menu_search']){ ?>
            <div class="searchTop"><?php echo get_search_form() ?></div>
        <?php } ?>

        <?php if ( !empty($mts_options['mts_header_social']) && is_array($mts_options['mts_header_social'])) { ?>
        <div class="header-social">
            <?php foreach( $mts_options['mts_header_social'] as $header_icons ) : ?>
                <?php if( ! empty( $header_icons['mts_header_icon'] ) && isset( $header_icons['mts_header_icon'] ) ) : ?>
                    <a href="<?php echo $header_icons['mts_header_icon_link'] ?>" class="header-<?php echo $header_icons['mts_header_icon'] ?>"><span class="fa fa-<?php echo $header_icons['mts_header_icon'] ?>"></span></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php } ?>

    </div>
</div>

<div id="page" class="clearfix">
    <div class="article">
        <div id="content_box">
            <?php $featured_categories = array();
            if ( !empty( $mts_options['mts_blog_featured_categories'] ) ) {
                foreach ( $mts_options['mts_blog_featured_categories'] as $section ) {
                    $category_id = $section['mts_blog_featured_category'];
                    $featured_categories[] = $category_id;
                    $posts_num = $section['mts_blog_featured_category_postsnum'];
                    $post_column = $section['mts_blog_post_layout_columns'];

                    $layout_type = isset($section['mts_blog_posts_layout_style']) ? $section['mts_blog_posts_layout_style'] : 'grid';
                    if($layout_type == 1){
                        $layout = 'with-sidebar';
                    }
                    else if($layout_type == 2){
                        $layout = 'grid';
                    }
                    else if($layout_type == 3){
                        $layout = 'list';
                    }
                    else if($layout_type == 4){
                        $layout = 'title-with-grid';
                    }

                    if ($layout == 'title-with-grid' && is_paged()) $layout = 'grid';
                    
                    echo '<div class="post-style '.$post_column.'">';
                        
                        if(!empty($layout)){
                            //Query arguements for latest and category posts
                            if ( 'latest' == $category_id ) {

                                echo '<div class="'.$layout.'">';

                                    //It will display the category title with background image, and it applies only for list and title-with-grid post layouts

                                    if($layout == 'list' || $layout == 'title-with-grid'){

                                        //Get category background color and image src
                                        $bg_color = mts_get_category_color( $category_id );
                                        $img = mts_get_category_color( $category_id, 'mts_cc_image' );

                                        $style = 'style="background: ';

                                        if(empty($img) && !empty($bg_color)){
                                            $style .= $bg_color;
                                        }

                                        if(!empty($img)){
                                            $style .= ' url('. $img .') no-repeat center center';
                                        }
                                        $style .= '";';

                                        echo '<div class="latestPost category-image" '.$style.'><div class="cat-img-content"><div class="cat-img-wrap"><div class="cat-img-inner">';
                                            echo '<h3 class="category-title">'.__('Latest Posts', 'mythemeshop').'</h3>';
                                        echo '</div></div></div></div>';
                                    }

                                    if($layout == 'list'){
                                        echo '<div class="list-right">';
                                        echo '<h3 class="list-title">'.__('Latest Post', 'mythemeshop').'</h3>';
                                        echo '<div class="latestPostWrapper">';
                                    }

                                    if(is_front_page()) {
                                        $paged = ( get_query_var('page') > 1 ) ? get_query_var('page') : 1;
                                    } else {
                                        $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
                                    }
                                    if($layout != 'list'){
                                        $number_of_posts = get_option( 'posts_per_page' );
                                    } else {
                                        $number_of_posts = '3';
                                    }
                                    $args = array(
                                        'post_type' => 'post',
                                        'post_status' => 'publish',
                                        'paged' => $paged,
                                        'posts_per_page' => $number_of_posts,
                                        'ignore_sticky_posts'=> 1,
                                        );
                                    $latest_posts = new WP_Query( $args );

                                    global $wp_query;
                                    // Put default query object in a temp variable
                                    $tmp_query = $wp_query;
                                    // Now wipe it out completely
                                    $wp_query = null;
                                    // Re-populate the global with our custom query
                                    $wp_query = $latest_posts;
                                        
                                    $j=0; if ( $latest_posts->have_posts() ) :
                                        while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
                                            mts_archive_post($layout);
                                        endwhile;
                                    endif;
                                    if($layout != 'list'){
                                        mts_pagination();
                                    }

                                    // Restore original query object
                                    $wp_query = $tmp_query;
                                    // Be kind; rewind 
                                        
                                    wp_reset_postdata();

                                    if($layout == 'list'){
                                        echo '</div>';
                                        echo '</div>';
                                    } 

                                echo '</div>';
                            } elseif (!is_paged()) {
                                //Category query arguement
                                $cat_query = new WP_Query('cat='.$category_id.'&posts_per_page='.$posts_num);

                                echo '<div class="'.$layout.'">';

                                    //It will display the category title with background image, and it applies only for list and title-with-grid post layouts

                                    if($layout == 'list' || $layout == 'title-with-grid'){

                                        //Get category background color and image src
                                        $bg_color = mts_get_category_color( $category_id );
                                        $img = mts_get_category_color( $category_id, 'mts_cc_image' );

                                        $style = 'style="background: ';

                                        if(empty($img) && !empty($bg_color)){
                                            $style .= $bg_color;
                                        }

                                        if(!empty($img)){
                                            $style .= ' url('. $img .') no-repeat center center';
                                        }
                                        $style .= '";';

                                        echo '<div class="latestPost category-image" '.$style.'><div class="cat-img-content"><div class="cat-img-wrap"><div class="cat-img-inner">';
                                            echo '<h3 class="category-title">'.esc_html( get_cat_name( $category_id ) ).'</h3>';
                                            echo '<a href="'.esc_url( get_category_link( $category_id ) ).'" title="'.esc_attr( get_cat_name( $category_id ) ).'" class="pri-btn">'.__('Explore Category', 'mythemeshop').'</a>';
                                        echo '</div></div></div></div>';
                                    }

                                    if($layout == 'list'){
                                        $cat_title = '';
                                        $cat_name = esc_html( get_cat_name( $category_id ) );

                                        $cat_title = 'Latest in '. $cat_name;

                                        echo '<div class="list-right">';
                                        echo '<h3 class="list-title">'.__($cat_title, 'mythemeshop').'</h3>';
                                        echo '<div class="latestPostWrapper">';
                                    }
                                    $j=0;      
                                    if ( $cat_query->have_posts() ) :
                                        while ( $cat_query->have_posts() ) : $cat_query->the_post();
                                                mts_archive_post($layout);
                                        endwhile;
                                    endif;
                                    wp_reset_postdata();

                                    if($layout == 'list'){
                                        echo '</div>';
                                        echo '</div>';
                                    } 

                                echo '</div>';
                            }

                            //sidebar for post layout with-sidebar
                            if($layout == 'with-sidebar'){
                                $cat_name = ucwords(get_cat_name( $category_id ));
                                
                                $sidebar_name = sanitize_title( strtolower( 'post-layout-'.$cat_name ));

                                if(empty($cat_name)){
                                    get_category_sidebar('sidebar', 'Sidebar');
                                } else {
                                    get_category_sidebar($sidebar_name, $cat_name);
                                }
                            }
                            
                        } else {
                            if ( is_user_logged_in() ) {
                                echo '<div><p>'.__('Please add any post layout in','mythemeshop').' <a href="'.admin_url('themes.php?page=theme_options&tab=3').'">'.__('Theme Options', 'mythemeshop').'</a></p></div>';
                            } else {
                                echo '<div><p>'.__('Site manager didn\'t add any post layout yet!!', 'mythemeshop').'</p></div>';
                            }
                        }
                    echo '</div>';
                }
            } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
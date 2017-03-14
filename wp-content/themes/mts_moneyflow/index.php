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
        <?php $feature_cat = isset($mts_options['mts_home_feature_cat']) ? $mts_options['mts_home_feature_cat'] : '';

        //Slider query arguement, if you won't select any categories it displays info message
        if(!empty($feature_cat) && !is_paged()){
            $cat = implode(', ', $feature_cat);
            $query = new WP_Query('cat='.$cat.'&posts_per_page=4');

            if ( $query->have_posts() ) :

                $post_count = $query->post_count;
                echo '<div class="recently-featured">';
                    //Initial assignment
                    $i = 1;
                    while ( $query->have_posts() ) : $query->the_post();

                        $thumb = array( 'width' => 66, 'height' => 50, 'crop' => true );
                        $full = array( 'width' => 480, 'height' => 280, 'crop' => true );

                        if(has_post_thumbnail()){
                            $image_id = get_post_thumbnail_id ();
                            $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
                            $thumb_src = bfi_thumb($image_thumb_url[0], $thumb );
                            $full_src = bfi_thumb($image_thumb_url[0], $full );
                        }
                        else{
                            $thumb_src = get_template_directory_uri().'/images/nothumb-widgetthumb.png';
                            $full_src = get_template_directory_uri().'/images/nothumb-featuredfull.png';
                        }

                        if(1 == $i ){
                            echo '<div class="list-left latestPost">';
                                echo '<div class="recently-featured-img"><a href="'.esc_url( get_the_permalink() ).'" rel="nofollow"><img src="'. $full_src . '" width="480" height="280"></a></div>';
                                echo '<div class="recently-featured-content">';
                                    echo '<span class="featured-tag batch">'.__('Featured' , 'mythemeshop').'</span><h3 class="title"><a href="'.esc_url( get_the_permalink() ).'">'.short_title('...', 7).'</a></h3>';
                                    echo mts_excerpt(33);
                                    mts_the_postinfo();
                                    echo '<div class="btn-wrap clearfix"><a class="button" href="'.esc_url( get_the_permalink() ).'" rel="nofollow">'.__('Read Full Article' , 'mythemeshop').'</a></div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        else{
                            if(2 == $i ){
                                echo '<div class="list-right">';
                                    echo '<h3 class="list-title">'.__('Featured Recently' , 'mythemeshop').'</h3>';
                                    echo '<div class="latestPostWrapper">';
                            }
                                
                                        echo '<div class="latestPost">';
                                            echo '<a href="'.esc_url( get_the_permalink() ).'" title="'.esc_attr( get_the_title() ).'" rel="nofollow" class="post-image post-image-left">';
                                                echo '<div class="featured-thumbnail"><img src="'.$thumb_src.'" width="66" height="50"></div>';
                                            echo '</a>';
                                            echo '<div class="latestPost-content">';
                                                echo '<header>';
                                                    echo '<h2 class="title front-view-title"><a href="'.esc_url( get_the_permalink() ).'" title="'.esc_attr( get_the_title() ).'">'.short_title('...', 6).'</a></h2>';
                                                echo '</header>';
                                                mts_the_postinfo();
                                            echo '</div>';
                                        echo '</div>';

                            if($i == $post_count){
                                echo '</div></div>';
                            }
                        }
                    $i++; endwhile;
                echo '</div>';
            endif;
        } ?>

        <div id="content_box" >
            <?php $featured_categories = array();
            if ( !empty( $mts_options['mts_featured_categories'] ) ) {
                foreach ( $mts_options['mts_featured_categories'] as $section ) {
                    $category_id = $section['mts_featured_category'];
                    $featured_categories[] = $category_id;
                    $posts_num = $section['mts_featured_category_postsnum'];
                    $post_column = $section['mts_post_layout_columns'];

                    global $layout;

                    $layout_type = isset($section['mts_index_posts_layout_style']) ? $section['mts_index_posts_layout_style'] : 'grid';
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

                                    $j=0; if ( have_posts() ) :
                                        while ( have_posts() ) : the_post();
                                            mts_archive_post($layout);
                                        $j++; endwhile;
                                    endif;
                                    if($layout != 'list'){
                                        mts_pagination();
                                    } 
                                    
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

                                        $cat_title = __('Latest in ','mythemeshop').$cat_name;

                                        echo '<div class="list-right">';
                                            echo '<h3 class="list-title">'.__($cat_title, 'mythemeshop').'</h3>';
                                            echo '<div class="latestPostWrapper">';
                                    }         
                                    $j=0;
                                    if ( $cat_query->have_posts() ) :
                                        while ( $cat_query->have_posts() ) : $cat_query->the_post();
                                                mts_archive_post($layout);
                                        $j++; endwhile;
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
                                echo '<div><p>'.__('Please add any post layout in','mythemeshop').' <a href="'.esc_url(admin_url('themes.php?page=theme_options&tab=3')).'">'.__('Theme Options', 'mythemeshop').'</a></p></div>';
                            } else {
                                echo '<div><p>'.__('Site manager didn\'t add any post layout yet.', 'mythemeshop').'</p></div>';
                            }
                        }
                    echo '</div>';  
                }
            } ?>
        </div>
    </div>
<?php get_footer(); ?>

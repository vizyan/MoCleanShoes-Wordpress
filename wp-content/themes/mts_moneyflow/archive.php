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
	<div id="content_box" class="column4">
		<div class="post-style">
			<div class="grid">
				<?php $j = 0; if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php mts_archive_post('grid'); ?>
				<?php $j++; endwhile; endif; ?>
				<?php mts_pagination(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
<?php
$block = $block_data[0];
$settings = $block_data[1];
$link_setting = empty($settings[0]) ? '' : $settings[0];
?>
<?php if($block === 'title'): ?>
<div class="sc-post-title " xmlns="http://www.w3.org/1999/html">
	<?php echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->title, $link_setting, 'link_title') : $post->title ?>
</div>
<?php elseif($block === 'image'):
	if(empty($post->thumbnail)) {
		echo '<div class="sc-dummy sc-post-thumb-sc-dummy"></div>';
	} else {
?>
<div class="sc-post-thumb">
	<?php echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->thumbnail, $link_setting, 'link_image') : $post->thumbnail ?>
</div>
<?php
	}
?>
<?php elseif($block === 'link'): ?>
	<a href="<?php echo esc_url($post->link); ?>" class="vc_read_more" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', "js_composer" ), $post->title_attribute ) ); ?>"<?php echo $this->link_target ?>><?php _e( 'Read more...', "js_composer" ) ?></a>
<?php endif; ?>
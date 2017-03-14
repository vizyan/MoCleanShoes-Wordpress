<?php
	$item_data = scalia_get_sanitize_team_person_data(get_the_ID());
	$link_start = '';
	$link_end = '';
	if($link = scalia_get_data($item_data, 'link')) {
		$link_start = '<a href="'.esc_url($link).'" target="'.esc_attr(scalia_get_data($item_data, 'link_target')).'">';
		$link_end = '</a>';
	}
	$grid_class = '';
	if($params['style'] == 'horizontal') {
		if($params['columns'] == '1') {
			$grid_class = 'col-xs-12';
		} elseif($params['columns'] == '2') {
			$grid_class = 'col-sm-6 col-xs-12';
		} elseif($params['columns'] == '3') {
			$grid_class = 'col-md-4 col-sm-6 col-xs-12';
		} else {
			$grid_class = 'col-md-3 col-sm-6 col-xs-12';
		}
	} else {
		if($params['columns'] == '1') {
			$grid_class = 'col-xs-12';
		} elseif($params['columns'] == '2') {
			$grid_class = 'col-xs-6';
		} elseif($params['columns'] == '3') {
			$grid_class = 'col-md-4 col-sm-4 col-xs-6';
		} else {
			$grid_class = 'col-md-3 col-sm-4 col-xs-6';
		}
	}
	$email_link = scalia_get_data($item_data, 'email', '', '<div class="team-person-email"><a href="mailto:', '">'.$item_data['email'].'</a></div>');
	if($item_data['hide_email']) {
		$email = explode('@', $item_data['email']);
		if(count($email) == 2) {
			$email_link = '<div class="team-person-email"><a href="#" class="hidden-email" data-name="'.$email[0].'" data-domain="'.$email[1].'">'.__('Send Message', 'scalia').'</a></div>';
		}
	}
?>

<div class="<?php echo esc_attr($grid_class); ?> inline-column">
	<div id="post-<?php the_ID(); ?>" <?php post_class(array('team-person')); ?>>
		<?php
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'scalia-post-thumb');
			if($params['style'] == 'rounded') {
				$image = scalia_generate_thumbnail_src(get_post_thumbnail_id(), 'scalia-person');
			}
			echo scalia_get_data($image, 0, '', '<div class="team-person-image">'.$link_start.'<img src="', '" alt="" class="img-circle img-responsive" >'.$link_end.'</div>');
		?>
		<div class="team-person-info">
			<?php echo scalia_get_data($item_data, 'name', '', '<div class="team-person-name">', '</div>'); ?>
			<?php echo scalia_get_data($item_data, 'position', '', '<div class="team-person-position">', '</div>'); ?>
			<?php echo scalia_get_data($item_data, 'phone', '', '<div class="team-person-phone'.($params['style'] != 'horizontal' ? ' sc-teams-phone' : '').'">', '</div>'); ?>

			<?php if($params['style'] == 'rounded' && get_the_content()) : ?>
				<div class="team-person-description"><?php the_content(); ?></div>
			<?php endif; ?>
			<?php echo $email_link; ?>
		</div>
	</div>
</div>

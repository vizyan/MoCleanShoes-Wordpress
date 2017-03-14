<?php
/*-----------------------------------------------------------------------------------*/
/*	Do not remove these lines, sky will fall on your head.
/*-----------------------------------------------------------------------------------*/
define( 'MTS_THEME_NAME', 'moneyflow' );
define( 'MTS_THEME_TEXTDOMAIN', 'mythemeshop' );
define( 'MTS_THEME_VERSION', '1.1.9' );
require_once( dirname( __FILE__ ) . '/theme-options.php' );
if ( ! isset( $content_width ) ) $content_width = 1060;

/*-----------------------------------------------------------------------------------*/
/*	Load Options
/*-----------------------------------------------------------------------------------*/
$mts_options = get_option( MTS_THEME_NAME );
add_theme_support( 'title-tag' );

/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/
load_theme_textdomain( 'mythemeshop', get_template_directory().'/lang' );

// Custom translations
if ( !empty( $mts_options['translate'] )) {
	$mts_translations = get_option( 'mts_translations_'.MTS_THEME_NAME );
	function mts_custom_translate( $translated_text, $text, $domain ) {
		if ( $domain == 'mythemeshop' || $domain == 'nhp-opts' ) {
			global $mts_translations;
			if ( !empty( $mts_translations[$text] )) {
				$translated_text = $mts_translations[$text];
			}
		}
		return $translated_text;
		
	}
	add_filter( 'gettext', 'mts_custom_translate', 20, 3 );
}

if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'automatic-feed-links' );

// Disable auto update
add_filter( 'auto_update_theme', '__return_false' );

/*-----------------------------------------------------------------------------------*/
/*  Disable Google Typography plugin
/*-----------------------------------------------------------------------------------*/
add_action( 'admin_init', 'mts_deactivate_google_typography_plugin' );
function mts_deactivate_google_typography_plugin() {
	if ( in_array( 'google-typography/google-typography.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		deactivate_plugins( 'google-typography/google-typography.php' );
	}
}

// a shortcut function
function mts_isWooCommerce(){
	if(is_multisite()){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		return is_plugin_active('woocommerce/woocommerce.php');
	}
	else{
		return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	}
}

/*------------------------------------------------------------------------------------------------------------*/
/*  Define MTS_ICONS constant containing all available icons for use in nav menus and icon select option
/*------------------------------------------------------------------------------------------------------------*/
$_mts_icons = array(
	'Misc Icons' => array(
		'glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'outdent', 'indent', 'video-camera', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'users', 'link', 'cloud', 'flask', 'scissors', 'files-o', 'paperclip', 'floppy-o', 'square', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'sort', 'sort-desc', 'sort-asc', 'envelope', 'linkedin', 'undo', 'gavel', 'tachometer', 'comment-o', 'comments-o', 'bolt', 'sitemap', 'umbrella', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'reply-all', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'caret-square-o-down', 'caret-square-o-up', 'caret-square-o-right', 'eur', 'gbp', 'usd', 'inr', 'jpy', 'rub', 'krw', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gratipay', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'university', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'car', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-image-o', 'file-archive-o', 'file-audio-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-ring', 'circle-o-notch', 'rebel', 'empire', 'git-square', 'git', 'hacker-news', 'tencent-weibo', 'qq', 'weixin', 'paper-plane', 'paper-plane-o', 'history', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb', 'futbol-o', 'tty', 'binoculars', 'plug', 'slideshare', 'twitch', 'yelp', 'newspaper-o', 'wifi', 'calculator', 'paypal', 'google-wallet', 'cc-visa', 'cc-mastercard', 'cc-discover', 'cc-amex', 'cc-paypal', 'cc-stripe', 'bell-slash', 'bell-slash-o', 'trash', 'copyright', 'at', 'eyedropper', 'paint-brush', 'birthday-cake', 'area-chart', 'pie-chart', 'line-chart', 'lastfm', 'lastfm-square', 'toggle-off', 'toggle-on', 'bicycle', 'bus', 'ioxhost', 'angellist', 'cc', 'ils', 'meanpath', 'buysellads', 'connectdevelop', 'dashcube', 'forumbee', 'leanpub', 'sellsy', 'shirtsinbulk', 'simplybuilt', 'skyatlas', 'cart-plus', 'cart-arrow-down', 'diamond', 'ship', 'user-secret', 'motorcycle', 'street-view', 'heartbeat', 'venus', 'mars', 'mercury', 'transgender', 'transgender-alt', 'venus-double', 'mars-double', 'venus-mars', 'mars-stroke', 'mars-stroke-v', 'mars-stroke-h', 'neuter', 'facebook-official', 'pinterest-p', 'whatsapp', 'server', 'user-plus', 'user-times', 'bed', 'viacoin', 'train', 'subway', 'medium'),
	'Web Application Icons' => array(
		'adjust', 'anchor', 'archive', 'area-chart', 'arrows', 'arrows-h', 'arrows-v', 'asterisk', 'at', 'ban', 'bar-chart', 'barcode', 'bars', 'bed', 'beer', 'bell', 'bell-o', 'bell-slash', 'bell-slash-o', 'bicycle', 'binoculars', 'birthday-cake', 'bolt', 'bomb', 'book', 'bookmark', 'bookmark-o', 'briefcase', 'bug', 'building', 'building-o', 'bullhorn', 'bullseye', 'bus', 'calculator', 'calendar', 'calendar-o', 'camera', 'camera-retro', 'car', 'caret-square-o-down', 'caret-square-o-left', 'caret-square-o-right', 'caret-square-o-up', 'cart-arrow-down', 'cart-plus', 'cc', 'certificate', 'check', 'check-circle', 'check-circle-o', 'check-square', 'check-square-o', 'child', 'circle', 'circle-o', 'circle-o-notch', 'circle-thin', 'clock-o', 'cloud', 'cloud-download', 'cloud-upload', 'code', 'code-fork', 'coffee', 'cog', 'cogs', 'comment', 'comment-o', 'comments', 'comments-o', 'compass', 'copyright', 'credit-card', 'crop', 'crosshairs', 'cube', 'cubes', 'cutlery', 'database', 'desktop', 'diamond', 'dot-circle-o', 'download', 'ellipsis-h', 'ellipsis-v', 'envelope', 'envelope-o', 'envelope-square', 'eraser', 'exchange', 'exclamation', 'exclamation-circle', 'exclamation-triangle', 'external-link', 'external-link-square', 'eye', 'eye-slash', 'eyedropper', 'fax', 'female', 'fighter-jet', 'file-archive-o', 'file-audio-o', 'file-code-o', 'file-excel-o', 'file-image-o', 'file-pdf-o', 'file-powerpoint-o', 'file-video-o', 'file-word-o', 'film', 'filter', 'fire', 'fire-extinguisher', 'flag', 'flag-checkered', 'flag-o', 'flask', 'folder', 'folder-o', 'folder-open', 'folder-open-o', 'frown-o', 'futbol-o', 'gamepad', 'gavel', 'gift', 'glass', 'globe', 'graduation-cap', 'hdd-o', 'headphones', 'heart', 'heart-o', 'heartbeat', 'history', 'home', 'inbox', 'info', 'info-circle', 'key', 'keyboard-o', 'language', 'laptop', 'leaf', 'lemon-o', 'level-down', 'level-up', 'life-ring', 'lightbulb-o', 'line-chart', 'location-arrow', 'lock', 'magic', 'magnet', 'male', 'map-marker', 'meh-o', 'microphone', 'microphone-slash', 'minus', 'minus-circle', 'minus-square', 'minus-square-o', 'mobile', 'money', 'moon-o', 'motorcycle', 'music', 'newspaper-o', 'paint-brush', 'paper-plane', 'paper-plane-o', 'paw', 'pencil', 'pencil-square', 'pencil-square-o', 'phone', 'phone-square', 'picture-o', 'pie-chart', 'plane', 'plug', 'plus', 'plus-circle', 'plus-square', 'plus-square-o', 'power-off', 'print', 'puzzle-piece', 'qrcode', 'question', 'question-circle', 'quote-left', 'quote-right', 'random', 'recycle', 'refresh', 'reply', 'reply-all', 'retweet', 'road', 'rocket', 'rss', 'rss-square', 'search', 'search-minus', 'search-plus', 'server', 'share', 'share-alt', 'share-alt-square', 'share-square', 'share-square-o', 'shield', 'ship', 'shopping-cart', 'sign-in', 'sign-out', 'signal', 'sitemap', 'sliders', 'smile-o', 'sort', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-asc', 'sort-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'space-shuttle', 'spinner', 'spoon', 'square', 'square-o', 'star', 'star-half', 'star-half-o', 'star-o', 'street-view', 'suitcase', 'sun-o', 'tablet', 'tachometer', 'tag', 'tags', 'tasks', 'taxi', 'terminal', 'thumb-tack', 'thumbs-down', 'thumbs-o-down', 'thumbs-o-up', 'thumbs-up', 'ticket', 'times', 'times-circle', 'times-circle-o', 'tint', 'toggle-off', 'toggle-on', 'trash', 'trash-o', 'tree', 'trophy', 'truck', 'tty', 'umbrella', 'university', 'unlock', 'unlock-alt', 'upload', 'user', 'user-plus', 'user-secret', 'user-times', 'users', 'video-camera', 'volume-down', 'volume-off', 'volume-up', 'wheelchair', 'wifi', 'wrench'),
	'Transportation Icons' => array(
		'ambulance', 'bicycle', 'bus', 'car', 'fighter-jet', 'motorcycle', 'plane', 'rocket', 'ship', 'space-shuttle', 'subway', 'taxi', 'train', 'truck', 'wheelchair', ),
	'Gender Icons' => array(
		'circle-thin', 'mars', 'mars-double', 'mars-stroke', 'mars-stroke-h', 'mars-stroke-v', 'mercury', 'neuter', 'transgender', 'transgender-alt', 'venus', 'venus-double', 'venus-mars', ),
	'File Type Icons' => array(
		'file', 'file-archive-o', 'file-audio-o', 'file-code-o', 'file-excel-o', 'file-image-o', 'file-o', 'file-pdf-o', 'file-powerpoint-o', 'file-text', 'file-text-o', 'file-video-o', 'file-word-o', ),
	'Spinner Icons' => array(
		'circle-o-notch', 'cog', 'refresh', 'spinner', ),
	'Form Control Icons' => array(
		'check-square', 'check-square-o', 'circle', 'circle-o', 'dot-circle-o', 'minus-square', 'minus-square-o', 'plus-square', 'plus-square-o', 'square', 'square-o', ),
	'Payment Icons' => array(
		'cc-amex', 'cc-discover', 'cc-mastercard', 'cc-paypal', 'cc-stripe', 'cc-visa', 'credit-card', 'google-wallet', 'paypal', ),
	'Chart Icons' => array(
		'area-chart', 'bar-chart', 'line-chart', 'pie-chart', ),
	'Currency Icons' => array(
		'btc', 'eur', 'gbp', 'ils', 'inr', 'jpy', 'krw', 'money', 'rub', 'try', 'usd', ),
	'Text Editor Icons' => array(
		'align-center', 'align-justify', 'align-left', 'align-right', 'bold', 'chain-broken', 'clipboard', 'columns', 'eraser', 'file', 'file-o', 'file-text', 'file-text-o', 'files-o', 'floppy-o', 'font', 'header', 'indent', 'italic', 'link', 'list', 'list-alt', 'list-ol', 'list-ul', 'outdent', 'paperclip', 'paragraph', 'repeat', 'scissors', 'strikethrough', 'subscript', 'superscript', 'table', 'text-height', 'text-width', 'th', 'th-large', 'th-list', 'underline', 'undo', ),
	'Directional Icons' => array(
		'angle-double-down', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-down', 'angle-left', 'angle-right', 'angle-up', 'arrow-circle-down', 'arrow-circle-left', 'arrow-circle-o-down', 'arrow-circle-o-left', 'arrow-circle-o-right', 'arrow-circle-o-up', 'arrow-circle-right', 'arrow-circle-up', 'arrow-down', 'arrow-left', 'arrow-right', 'arrow-up', 'arrows', 'arrows-alt', 'arrows-h', 'arrows-v', 'caret-down', 'caret-left', 'caret-right', 'caret-square-o-down', 'caret-square-o-left', 'caret-square-o-right', 'caret-square-o-up', 'caret-up', 'chevron-circle-down', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-up', 'hand-o-down', 'hand-o-left', 'hand-o-right', 'hand-o-up', 'long-arrow-down', 'long-arrow-left', 'long-arrow-right', 'long-arrow-up', ),
	'Video Player Icons' => array(
		'arrows-alt', 'backward', 'compress', 'eject', 'expand', 'fast-backward', 'fast-forward', 'forward', 'pause', 'play', 'play-circle', 'play-circle-o', 'step-backward', 'step-forward', 'stop', 'youtube-play', ),
	'Brand Icons' => array(
		'adn', 'android', 'angellist', 'apple', 'behance', 'behance-square', 'bitbucket', 'bitbucket-square', 'btc', 'buysellads', 'cc-amex', 'cc-discover', 'cc-mastercard', 'cc-paypal', 'cc-stripe', 'cc-visa', 'codepen', 'connectdevelop', 'css3', 'dashcube', 'delicious', 'deviantart', 'digg', 'dribbble', 'dropbox', 'drupal', 'empire', 'facebook', 'facebook-official', 'facebook-square', 'flickr', 'forumbee', 'foursquare', 'git', 'git-square', 'github', 'github-alt', 'github-square', 'google', 'google-plus', 'google-plus-square', 'google-wallet', 'gratipay', 'hacker-news', 'html5', 'instagram', 'ioxhost', 'joomla', 'jsfiddle', 'lastfm', 'lastfm-square', 'leanpub', 'linkedin', 'linkedin-square', 'linux', 'maxcdn', 'meanpath', 'medium', 'openid', 'pagelines', 'paypal', 'pied-piper', 'pied-piper-alt', 'pinterest', 'pinterest-p', 'pinterest-square', 'qq', 'rebel', 'reddit', 'reddit-square', 'renren', 'sellsy', 'share-alt', 'share-alt-square', 'shirtsinbulk', 'simplybuilt', 'skyatlas', 'skype', 'slack', 'slideshare', 'soundcloud', 'spotify', 'stack-exchange', 'stack-overflow', 'steam', 'steam-square', 'stumbleupon', 'stumbleupon-circle', 'tencent-weibo', 'trello', 'tumblr', 'tumblr-square', 'twitch', 'twitter', 'twitter-square', 'viacoin', 'vimeo-square', 'vine', 'vk', 'weibo', 'weixin', 'whatsapp', 'windows', 'wordpress', 'xing', 'xing-square', 'yahoo', 'yelp', 'youtube', 'youtube-play', 'youtube-square', ),
	'Medical Icons' => array(
		'ambulance', 'h-square', 'heart', 'heart-o', 'heartbeat', 'hospital-o', 'medkit', 'plus-square', 'stethoscope', 'user-md', 'wheelchair')
);

define ( 'MTS_ICONS', serialize( $_mts_icons ) ); // To use it - $mts_icons = unserialize( MTS_ICONS );

/*-----------------------------------------------------------------------------------*/
/*	Post Thumbnail Support
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) { 

    global $index_posts_layout_style;
        
	add_theme_support( 'post-thumbnails' );

	add_action( 'init', 'moneyflow_wp_review_thumb_size', 11 );
    function moneyflow_wp_review_thumb_size() {
        add_image_size( 'wp_review_small', 66, 55, true );
        add_image_size( 'wp_review_large', 330, 220, true ); 
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Post Format
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'post-formats',
	array(
		'gallery',           // gallery of images
		'link',              // quick link to other site
		'image',             // an image
		'quote',             // a quick quote
		'status',            // a Facebook like status update
		'video',             // video
		'audio',             // audio
	)
);

function mts_get_thumbnail_url( $size = 'full' ) {
	global $post;
	if (has_post_thumbnail( $post->ID ) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
		return $image[0];
	}
	
	// use first attached image
	$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
	if (!empty($images)) {
		$image = reset($images);
		$image_data = wp_get_attachment_image_src( $image->ID, $size );
		return $image_data[0];
	}
		
	// use no preview fallback
	if ( file_exists( get_template_directory().'/images/nothumb-'.$size.'.png' ) )
		return get_template_directory_uri().'/images/nothumb-'.$size.'.png';
	else
		return '';
}

/*-----------------------------------------------------------------------------------*/
/*  CREATE AND SHOW COLUMN FOR FEATURED IN PORTFOLIO ITEMS LIST ADMIN PAGE
/*-----------------------------------------------------------------------------------*/

//Get Featured image
function mts_get_featured_image($post_ID) {  
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);  
	if ($post_thumbnail_id) {  
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'wp_review_large');  
		return $post_thumbnail_img[0];  
	}  
} 
function mts_columns_head($defaults) {
	if (get_post_type() == 'post')
		$defaults['featured_image'] = __('Featured Image', 'mythemeshop');
	return $defaults;  
}  
function mts_columns_content($column_name, $post_ID) {  
	if ($column_name == 'featured_image') {  
		$post_featured_image = mts_get_featured_image($post_ID);  
		if ($post_featured_image) {  
			echo '<img width="150" height="100" src="' . esc_attr( $post_featured_image ) . '" />';  
		}  
	}  
} 
add_filter('manage_posts_columns', 'mts_columns_head');  
add_action('manage_posts_custom_column', 'mts_columns_content', 10, 2);

/*-----------------------------------------------------------------------------------*/
/*	Use first attached image as post thumbnail (fallback)
/*-----------------------------------------------------------------------------------*/
add_filter( 'post_thumbnail_html', 'mts_post_image_html', 10, 5 );
function mts_post_image_html( $html, $post_id, $post_image_id, $size, $attr ) {
	if ( has_post_thumbnail() || get_post_type( $post_id ) != 'post'  )
		return $html;
	
	// use first attached image
	$images = get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post_id );
	if (!empty($images)) {
		$image = reset($images);
		return wp_get_attachment_image( $image->ID, $size, false, $attr );
	}
		
	// use no preview fallback
	if ( file_exists( get_template_directory().'/images/nothumb-'.$size.'.png' ) ) {
		$placeholder_src = get_template_directory_uri().'/images/nothumb-'.$size.'.png';
		$placeholder_classs = 'attachment-'.$size.' wp-post-image';
		return '<img src="'.esc_attr( $placeholder_src ).'" class="'.esc_attr( $placeholder_classs ).'" alt="'.esc_attr( get_the_title() ).'">';
	} else {
		return '';
	}
	
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Menu Support
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'secondary-menu' => __( 'Navigation Menu', 'mythemeshop' )
		 )
	 );
}

/*-----------------------------------------------------------------------------------*/
/*	Enable Widgetized sidebar and Footer
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'register_sidebar' ) ) {   
	function mts_register_sidebars() {
		$mts_options = get_option( MTS_THEME_NAME );
		
		// Default sidebar
		register_sidebar( array(
			'name' => __('Sidebar','mythemeshop'),
			'description'   => __( 'Default sidebar.', 'mythemeshop' ),
			'id' => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		// Top level footer widget areas
		if ( !empty( $mts_options['mts_first_footer'] )) {
			if ( empty( $mts_options['mts_first_footer_num'] )) $mts_options['mts_first_footer_num'] = 4;
			register_sidebars( $mts_options['mts_first_footer_num'], array(
				'name' => __( 'Footer %d', 'mythemeshop' ),
				'description'   => __( 'Appears in the footer.', 'mythemeshop' ),
				'id' => 'footer-first',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}

		// Register post layout sidebar
        $layout_style = array();
		if(!empty($mts_options['mts_featured_categories'])){
			foreach ( $mts_options['mts_featured_categories'] as $post_sidebar ) {
				$index_posts_layout_style = isset($post_sidebar['mts_index_posts_layout_style']) ? $post_sidebar['mts_index_posts_layout_style'] : '';

				$category_id = $post_sidebar['mts_featured_category'];

				if ( 'latest' != $category_id ) {
					$featured_categories[] = $category_id;
					$cat_name = ucwords(get_cat_name( $category_id ));
					$layout_style[$cat_name] = $index_posts_layout_style;
				}
				
			}
		}
		
		if(!empty($layout_style)){
			foreach ($layout_style as $cat_name => $style) {
				if($style == 1){
					$style = 'with-sidebar';
				}
				else if($style == 2){
					$style = 'grid';
				}
				else if($style == 3){
					$style = 'list';
				}
				else if($style == 4){
					$style = 'title-with-grid';
				}
				if($style == 'with-sidebar'){
					register_sidebar( 
						array( 
							'name' => __('Post Layout Sidebar: ','mythemeshop').$cat_name,
							'id' => ''.sanitize_title( strtolower( 'post-layout-'.$cat_name )).'',
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget' => '</div>',
							'before_title' => '<h3>',
							'after_title' => '</h3>'
						)
					);
				}				
			}
		}

		$blog_layout_style = array();
		if(!empty($mts_options['mts_blog_featured_categories'])){
			foreach ( $mts_options['mts_blog_featured_categories'] as $post_sidebar ) {
				$index_posts_layout_style = isset($post_sidebar['mts_blog_posts_layout_style']) ? $post_sidebar['mts_blog_posts_layout_style'] : '';

				$category_id = $post_sidebar['mts_blog_featured_category'];
				if ( 'latest' != $category_id ) {
					$featured_categories[] = $category_id;
					$cat_name = ucwords(get_cat_name( $category_id ));
					$blog_layout_style[$cat_name] = $index_posts_layout_style;
				}
			}
		}

		if(!empty($blog_layout_style)){
			foreach ($blog_layout_style as $cat_name => $style) {
				if($style == 1){
					$style = 'with-sidebar';
				}
				else if($style == 2){
					$style = 'grid';
				}
				else if($style == 3){
					$style = 'list';
				}
				else if($style == 4){
					$style = 'title-with-grid';
				}
				if($style == 'with-sidebar'){
					register_sidebar( 
						array( 
							'name' => __('Post Layout Sidebar: ','mythemeshop').$cat_name,
							'id' => ''.sanitize_title( strtolower( 'post-layout-'.$cat_name )).'',
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget' => '</div>',
							'before_title' => '<h3>',
							'after_title' => '</h3>'
						)
					);
				}				
			}
		}
		
		// Custom sidebars
		if ( !empty( $mts_options['mts_custom_sidebars'] ) && is_array( $mts_options['mts_custom_sidebars'] )) {
			foreach( $mts_options['mts_custom_sidebars'] as $sidebar ) {
				if ( !empty( $sidebar['mts_custom_sidebar_id'] ) && !empty( $sidebar['mts_custom_sidebar_id'] ) && $sidebar['mts_custom_sidebar_id'] != 'sidebar-' ) {
					register_sidebar( array( 'name' => ''.$sidebar['mts_custom_sidebar_name'].'', 'id' => ''.sanitize_title( strtolower( $sidebar['mts_custom_sidebar_id'] )).'', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ));
				}
			}
		}

		if ( mts_isWooCommerce() ) {
			// Register WooCommerce Shop and Single Product Sidebar
			register_sidebar( array(
				'name' => __('Shop Page Sidebar', 'mythemeshop'),
				'description'   => __( 'Appears on Shop main page and product archive pages.', 'mythemeshop' ),
				'id' => 'shop-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
			register_sidebar( array(
				'name' => __('Single Product Sidebar', 'mythemeshop'),
				'description'   => __( 'Appears on single product pages.', 'mythemeshop' ),
				'id' => 'product-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}
	}
	
	add_action( 'widgets_init', 'mts_register_sidebars' );
}

function mts_custom_sidebar() {
	$mts_options = get_option( MTS_THEME_NAME );
	
	// Default sidebar
	$sidebar = 'sidebar';

	if ( is_home() && !empty( $mts_options['mts_sidebar_for_home'] )) $sidebar = $mts_options['mts_sidebar_for_home'];	
	if ( is_single() && !empty( $mts_options['mts_sidebar_for_post'] )) $sidebar = $mts_options['mts_sidebar_for_post'];
	if ( is_page() && !empty( $mts_options['mts_sidebar_for_page'] )) $sidebar = $mts_options['mts_sidebar_for_page'];
	
	// Archives
	if ( is_archive() && !empty( $mts_options['mts_sidebar_for_archive'] )) $sidebar = $mts_options['mts_sidebar_for_archive'];
	if ( is_category() && !empty( $mts_options['mts_sidebar_for_category'] )) $sidebar = $mts_options['mts_sidebar_for_category'];
	if ( is_tag() && !empty( $mts_options['mts_sidebar_for_tag'] )) $sidebar = $mts_options['mts_sidebar_for_tag'];
	if ( is_date() && !empty( $mts_options['mts_sidebar_for_date'] )) $sidebar = $mts_options['mts_sidebar_for_date'];
	if ( is_author() && !empty( $mts_options['mts_sidebar_for_author'] )) $sidebar = $mts_options['mts_sidebar_for_author'];
	
	// Other
	if ( is_search() && !empty( $mts_options['mts_sidebar_for_search'] )) $sidebar = $mts_options['mts_sidebar_for_search'];
	if ( is_404() && !empty( $mts_options['mts_sidebar_for_notfound'] )) $sidebar = $mts_options['mts_sidebar_for_notfound'];
	
	// Woo
	if ( mts_isWooCommerce() ) {
		if ( is_shop() || is_product_category() ) {
			if ( !empty( $mts_options['mts_sidebar_for_shop'] ))
				$sidebar = $mts_options['mts_sidebar_for_shop'];
			else
				$sidebar = 'shop-sidebar'; // default
		}
		if ( is_product() ) {
			if ( !empty( $mts_options['mts_sidebar_for_product'] ))
				$sidebar = $mts_options['mts_sidebar_for_product'];
			else
				$sidebar = 'product-sidebar'; // default
		}
	}
	
	// Page/post specific custom sidebar
	if ( is_page() || is_single() ) {
		wp_reset_postdata();
		global $post, $wp_registered_sidebars;
		$custom = get_post_meta( $post->ID, '_mts_custom_sidebar', true );
		if ( !empty( $custom ) && array_key_exists( $custom, $wp_registered_sidebars ) || 'mts_nosidebar' == $custom ) $sidebar = $custom;
	}

	return $sidebar;
}

/*-----------------------------------------------------------------------------------*/
/*  Load Widgets, Actions and Libraries
/*-----------------------------------------------------------------------------------*/

// Add the 125x125 Ad Block Custom Widget
include_once( "functions/widget-ad125.php" );

// Automatica Thumbnail generator
include_once( "functions/bfi-thumb.php" );

// Add the 336x280 Ad Block Custom Widget
include_once( "functions/widget-ad336.php" );

// Add the Latest Tweets Custom Widget
include_once( "functions/widget-tweets.php" );

// Add Recent Posts Widget
include_once( "functions/widget-recentposts.php" );

// Add Related Posts Widget
include_once( "functions/widget-relatedposts.php" );

// Add Author Posts Widget
include_once( "functions/widget-authorposts.php" );

// Add Popular Posts Widget
include_once( "functions/widget-popular.php" );

// Add Facebook Like box Widget
include_once( "functions/widget-fblikebox.php" );

// Add Social Profile Widget
include_once( "functions/widget-social.php" );

// Add Category Posts Widget
include_once( "functions/widget-catposts.php" );

// Add Welcome message
include_once( "functions/welcome-message.php" );

// Template Functions
include_once( "functions/theme-actions.php" );

// Post/page editor meta boxes
include_once( "functions/metaboxes.php" );

// TGM Plugin Activation
include_once( "functions/plugin-activation.php" );

// AJAX Contact Form - mts_contact_form()
include_once( 'functions/contact-form.php' );

// Custom menu walker
include_once( 'functions/nav-menu.php' );

/*-----------------------------------------------------------------------------------*/
/*	Javascript
/*-----------------------------------------------------------------------------------*/
function mts_nojs_js_class() {
	echo '<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace( /\bno-js\b/,\'js\' );</script>';
}
add_action( 'wp_head', 'mts_nojs_js_class', 1 );

function mts_add_scripts() {
	$mts_options = get_option( MTS_THEME_NAME );

	wp_enqueue_script( 'jquery' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_register_script( 'customscript', get_template_directory_uri() . '/js/customscript.js', true );
	if ( ! empty( $mts_options['mts_show_primary_nav'] ) && ! empty( $mts_options['mts_show_secondary_nav'] ) ) {
		$nav_menu = 'both';
	} else {
		if ( ! empty( $mts_options['mts_show_primary_nav'] ) ) {
			$nav_menu = 'primary';
		} elseif ( ! empty( $mts_options['mts_show_secondary_nav'] ) ) {
			$nav_menu = 'secondary';
		} else {
			$nav_menu = 'none';
		}
	}
	wp_localize_script(
        'customscript',
        'mts_customscript',
        array(
            'responsive' => ( empty( $mts_options['mts_responsive'] ) ? false : true ),
            'nav_menu' => $nav_menu,
            'ajax_url' => admin_url( 'admin-ajax.php' )
        )
    );
	wp_enqueue_script( 'customscript' );	
	
	// Slider
	wp_register_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js');
	if(!empty($mts_options['mts_custom_slider']) || is_page_template('page-blog.php')) {
        wp_enqueue_script ('owl-carousel');
    }
	
	// Animated single post/page header
	if ( is_singular() ) {
		$header_animation = mts_get_post_header_effect();
		if ( 'parallax' == $header_animation ) {
			wp_register_script ( 'jquery-parallax', get_template_directory_uri() . '/js/parallax.js' );
			wp_enqueue_script ( 'jquery-parallax' );
		} else if ( 'zoomout' == $header_animation ) {
			wp_register_script ( 'jquery-zoomout', get_template_directory_uri() . '/js/zoomout.js' );
			wp_enqueue_script ( 'jquery-zoomout' );
		}
	}

	global $is_IE;
	if ( $is_IE ) {
		wp_register_script ( 'html5shim', "http://html5shim.googlecode.com/svn/trunk/html5.js" );
		wp_enqueue_script ( 'html5shim' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'mts_add_scripts' );
   
function mts_load_footer_scripts() {  
	$mts_options = get_option( MTS_THEME_NAME );
	
	//Lightbox
	if ( ! empty( $mts_options['mts_lightbox'] ) ) {
		wp_register_script( 'magnificPopup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', true );
		wp_enqueue_script( 'magnificPopup' );
	}
	
	//Sticky Nav
	if ( ! empty( $mts_options['mts_sticky_nav'] ) ) {
		wp_register_script( 'StickyNav', get_template_directory_uri() . '/js/sticky.js', true );
		wp_enqueue_script( 'StickyNav' );
	}
	
	// Ajax Search Results
	wp_register_script( 'mts_ajax', get_template_directory_uri() . '/js/ajax.js', true );

	if ( ! empty( $mts_options['mts_ajax_search'] ) ) {
		wp_enqueue_script( 'mts_ajax' );
		wp_localize_script(
			'mts_ajax',
			'mts_ajax_search',
			array(
				'url' => admin_url( 'admin-ajax.php' ),
				'ajax_search' => '1'
			 )
		);
	}
	
}  
add_action( 'wp_footer', 'mts_load_footer_scripts' );  

if( !empty( $mts_options['mts_ajax_search'] )) {
	add_action( 'wp_ajax_mts_search', 'ajax_mts_search' );
	add_action( 'wp_ajax_nopriv_mts_search', 'ajax_mts_search' );
}

/*-----------------------------------------------------------------------------------*/
/* Enqueue CSS
/*-----------------------------------------------------------------------------------*/
function mts_enqueue_css() {
	$mts_options = get_option( MTS_THEME_NAME );

	wp_enqueue_style( 'stylesheet', get_stylesheet_directory_uri() . '/style.css', 'style' );
	
	// Slider
	// also enqueued in slider widget
	wp_register_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), null);
	if(!empty($mts_options['mts_custom_slider']) || is_page_template('page-blog.php')) {
		wp_enqueue_style('owl-carousel');
	}
	
	$handle = 'stylesheet';

	// WooCommerce
	if ( mts_isWooCommerce() ) {
		wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce2.css', 'style' );
		wp_enqueue_style( 'woocommerce' );
		$handle = 'woocommerce';
	}
	
	// Lightbox
	if ( ! empty( $mts_options['mts_lightbox'] ) ) {
		wp_register_style( 'magnificPopup', get_template_directory_uri() . '/css/magnific-popup.css', 'style' );
		wp_enqueue_style( 'magnificPopup' );
	}
	
	//Font Awesome
	wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', 'style' );
	wp_enqueue_style( 'fontawesome' );
	
	//Responsive
	if ( ! empty( $mts_options['mts_responsive'] ) ) {
		wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', 'style' );
	}

	isset($mts_bg_pattern_upload) ? $mts_bg_pattern_upload : array();
	$mts_bg = '';
	if ( !empty($mts_options['mts_bg_pattern_upload']) ) {
		$mts_bg = $mts_options['mts_bg_pattern_upload'];
	} else {
		if( !empty( $mts_options['mts_bg_pattern'] )) {
			$mts_bg = get_template_directory_uri().'/images/'.$mts_options['mts_bg_pattern'].'.png';
		}
	}
	
	$mts_sclayout = '';
	$mts_shareit_left = '';
	$mts_shareit_right = '';
	$mts_author = '';
	$mts_header_section = '';
	if ( is_page() || is_single() ) {
		$mts_sidebar_location = get_post_meta( get_the_ID(), '_mts_sidebar_location', true );
	} else {
		$mts_sidebar_location = '';
	}
	if ( $mts_sidebar_location != 'right' && ( $mts_options['mts_layout'] == 'sclayout' || $mts_sidebar_location == 'left' )) {
		$mts_sclayout = '.article { float: right;}
		.sidebar.c-4-12 { float: left; padding-right: 0; } .with-sidebar { float: right; }';
		if( isset( $mts_options['mts_social_button_position'] ) && $mts_options['mts_social_button_position'] == 'floating' ) {
			$mts_shareit_right = '.shareit.floating { margin: 0 745px 0; } .shareit { margin: 0 760px 0; border-left: 0; }';
		}
	}
	if ( empty( $mts_options['mts_header_section2'] ) ) {
		$mts_header_section = '.logo-wrap, .widget-header { display: none; } #secondary-navigation { float: left; }';
	}
	if ( isset( $mts_options['mts_social_button_position'] ) && $mts_options['mts_social_button_position'] == 'floating' ) {
		$mts_shareit_left = '.shareit { top: 282px; left: auto; margin: 0 0 0 -123px; width: 90px; position: fixed; padding: 5px; border:none; border-right: 0;} 
		.share-item {margin: 2px;}';
	}
	if ( ! empty( $mts_options['mts_author_comment'] ) ) {
		$mts_author = '.bypostauthor .fn:after { content: "'.__( 'Author', 'mythemeshop' ).'"; position: relative; padding: 1px 10px; background:'.$mts_options['mts_color_scheme'].'; color: #FFF; font-size: 14px; margin-left: 5px;}';
	}
    $dark_pri_color = mts_darken_color( $mts_options['mts_color_scheme'] );
    $dark_sec_color = mts_darken_color( $mts_options['mts_sec_color_scheme'] );
	$example_bg = mts_get_background_styles( 'mts_background' );

	$blog_banner_bg = mts_get_background_styles( 'mts_blog_banner_bg' );	

	$home_popular_categories = '';
    if( is_single() && $mts_options['mts_show_popular_category'] && !empty($mts_options['mts_popular_categories']) ){        
        foreach ( $mts_options['mts_popular_categories'] as $section ) {
            $category_id = $section['mts_cc_category'];
            //Color
            $bg_color = mts_get_category_color( $category_id );
            $rgb = mts_hextorgb($bg_color);
            //Image
            $thumb_src = mts_get_category_color( $category_id, 'mts_cc_image' );
            $thumb = array( 'width' => 270, 'height' => 190, 'crop' => true );
            $img = bfi_thumb($thumb_src, $thumb );

            if( $img ){
                $home_popular_categories .= 'li.home-popular-category-'.$category_id.' .title{ background-image: url('. $img .');  } ';
            }

            if( $bg_color ){
                $home_popular_categories .= 'li.home-popular-category-'.$category_id.' .title{ background-color:rgba( '. $rgb .' , 0.8)}';
            }
        }
    }

    if(is_page_template('page-blog.php') && !is_paged()){
    	$page_bg_color = $blog_banner_bg;
    }
    else{
    	$page_bg_color = 'background-color: '.$mts_options['mts_color_scheme'];
    }

	$custom_css = "
		body {{$example_bg}}		
		.pace .pace-progress, #mobile-menu-wrapper ul li a:hover { background: {$mts_options['mts_color_scheme']}; }
		.postauthor h5, .copyrights a, .single_post a, .textwidget a, .logo a, .pnavigation2 a, #sidebar a:hover, .copyrights a:hover, #site-footer .widget li a:hover, .related-posts a:hover, .reply a, .title a:hover, .post-info a:hover, #tabber .inside li a:hover, .readMore a, .fn a, a, a:hover, .navigation ul li:hover > a, .latestPost .title a:hover, .widget #wp-subscribe input.submit, .breadcrumb > div a:hover, .list-right .latestPost .title a:hover, .footerTop .header-social a:hover, .slider-nav.owl-carousel .slider-content .title a:hover, #header .navigation ul ul a:hover, #searchform:hover .fa-search, #category-list li a:hover, .slider-nav.owl-carousel .slider-content .title:hover, #copyright-note a:hover { color:{$mts_options['mts_color_scheme']}; }	
		
		.contactform #submit, #site-footer .tagcloud a:hover, .currenttext, .pagination a:hover, .pagination .nav-previous a, .pagination .nav-next a, #tabber ul.tabs li a.selected, .tagcloud a:hover, .navigation ul .sfHover a, .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce-page nav.woocommerce-pagination ul li a, .woocommerce #content nav.woocommerce-pagination ul li a, .woocommerce-page #content nav.woocommerce-pagination ul li a, .woocommerce .bypostauthor:after, #searchsubmit, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, .widget #wp-subscribe, blockquote:after, .post-format-icons i, .sticky-navigation-active, #load-posts a, .latestPost-review-wrapper, .post-image .review-type-circle.review-total-only, .post-image .review-type-circle.wp-review-show-total, .category-image, .widget .review-total-only.small-thumb, .widget .review-total-only.small-thumb.review-type-star, #site-footer .widget #wp-subscribe form input.submit { background-color:{$mts_options['mts_color_scheme']}; color: #fff!important; }
		
		.owl-prev:hover, .owl-next:hover { background-color:{$mts_options['mts_color_scheme']}!important; }

		#site-header{{$page_bg_color}}

		input#author:focus, input#email:focus, input#url:focus, .contact-form input:focus, .contact-form textarea:focus { border-color: {$mts_options['mts_color_scheme']}; }

		#move-to-top, #commentform input#submit, .pri-btn, .button, #commentform input#submit, .contact-form input[type='submit'], .bg-slider .slide-button { background-color:{$mts_options['mts_sec_color_scheme']}!important; }

		.pagination .nav-previous a:hover, .pagination .nav-next a:hover, #load-posts a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current { background-color: #{$dark_pri_color}!important; }

		#move-to-top:hover, #commentform input#submit:hover, .pri-btn:hover, .bg-slider .slide-button:hover, .button:hover, #commentform input#submit:hover, .contact-form input[type='submit']:hover { background-color: #{$dark_sec_color}!important; }
		#site-footer { background: {$mts_options['mts_footer_bg']}}
		{$mts_sclayout}
		{$mts_shareit_left}
		{$mts_shareit_right}
		{$mts_author}
		{$mts_header_section}
		{$mts_options['mts_custom_css']}
    	{$home_popular_categories}
			";
	wp_add_inline_style( $handle, $custom_css );
}
add_action( 'wp_enqueue_scripts', 'mts_enqueue_css', 99 );

/*-----------------------------------------------------------------------------------*/
/*  Wrap videos in .responsive-video div
/*-----------------------------------------------------------------------------------*/
function mts_responsive_video( $html, $url, $attr ) {

	// Only video embeds
	$video_providers = array(
		'youtube',
		'vimeo',
		'dailymotion',
		'wordpress.tv',
		'vine.co',
		'animoto',
		'blip.tv',
		'collegehumor.com',
		'funnyordie.com',
		'hulu.com',
		'revision3.com',
		'ted.com',
	);

	// Allow user to wrap other embeds
	$providers = apply_filters('mts_responsive_video', $video_providers );

	foreach ( $providers as $provider ) {
		if ( strstr($url, $provider) ) {
			$html = '<div class="flex-video flex-video-' . sanitize_html_class( $provider ) . '">' . $html . '</div>';
			break;// Break if video found
		}
	}

	return $html;
}
add_filter( 'embed_oembed_html', 'mts_responsive_video', 99, 3 );

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'the_content_rss', 'do_shortcode' );

/*-----------------------------------------------------------------------------------*/
/*	Custom Comments template
/*-----------------------------------------------------------------------------------*/
function mts_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; 
	$mts_options = get_option( MTS_THEME_NAME ); ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment->comment_author_email, 80 ); ?>
				<?php printf( '<span class="fn"><span>%s</span></span>', get_comment_author_link() ) ?> 
				<?php if ( ! empty( $mts_options['mts_comment_date'] ) ) { ?>
					<span class="ago"><i class="fa fa-clock-o"></i><?php comment_date( get_option( 'date_format' ) ); ?></span>
				<?php } ?>
				<span class="comment-meta">
					<?php edit_comment_link( __( '( Edit )', 'mythemeshop' ), '  ', '' ) ?>
				</span>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'mythemeshop' ) ?></em>
				<br />
			<?php endif; ?>
			<div class="commentmetadata">
				<div class="commenttext">
					<?php comment_text() ?>
				</div>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] )) ) ?>
				</div>
			</div>
		</div>
	</li>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Excerpt
/*-----------------------------------------------------------------------------------*/

// Increase max length
function mts_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'mts_excerpt_length', 20 );

// Remove [...] and shortcodes
function mts_custom_excerpt( $output ) {
  return preg_replace( '/\[[^\]]*]/', '', $output );
}
add_filter( 'get_the_excerpt', 'mts_custom_excerpt' );

// Truncate string to x letters/words
function mts_truncate( $str, $length = 40, $units = 'letters', $ellipsis = '&nbsp;&hellip;' ) {
	if ( $units == 'letters' ) {
		if ( mb_strlen( $str ) > $length ) {
			return mb_substr( $str, 0, $length ) . $ellipsis;
		} else {
			return $str;
		}
	} else {
		$words = explode( ' ', $str );
		if ( count( $words ) > $length ) {
			return implode( " ", array_slice( $words, 0, $length ) ) . $ellipsis;
		} else {
			return $str;
		}
	}
}

if ( ! function_exists( 'mts_excerpt' ) ) {
	function mts_excerpt( $limit = 40 ) {
	  return esc_html( mts_truncate( get_the_excerpt(), $limit, 'words' ) );
	}
}
	
function short_title($after = '', $length) {
	$mytitle = explode(' ', get_the_title(), $length);
	if (count($mytitle)>=$length) {
		array_pop($mytitle);
		$mytitle = implode(" ",$mytitle). $after;
	} else {
		$mytitle = implode(" ",$mytitle);
	}
	return $mytitle;
}

/*-----------------------------------------------------------------------------------*/
/*	Remove more link from the_content and use custom read more
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_content_more_link', 'mts_remove_more_link', 10, 2 );
function mts_remove_more_link( $more_link, $more_link_text ) {
	return '';
}
// shorthand function to check for more tag in post
function mts_post_has_moretag() {
	global $post;
	return strpos( $post->post_content, '<!--more-->' );
}

if ( ! function_exists( 'mts_readmore' ) ) {
	function mts_readmore() {
		?>
		<div class="readMore">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="nofollow">
				<?php _e( 'More', 'mythemeshop' ); ?> <i class="fa fa-caret-right"></i>
			</a>
		</div>
		<?php 
	}
}

/*-----------------------------------------------------------------------------------*/
/* nofollow to next/previous links
/*-----------------------------------------------------------------------------------*/
function mts_pagination_add_nofollow( $content ) {
	return 'rel="nofollow"';
}
add_filter( 'next_posts_link_attributes', 'mts_pagination_add_nofollow' );
add_filter( 'previous_posts_link_attributes', 'mts_pagination_add_nofollow' );

/*-----------------------------------------------------------------------------------*/
/* Nofollow to category links
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_category', 'mts_add_nofollow_cat' ); 
function mts_add_nofollow_cat( $text ) {
	$text = str_replace( 'rel="category tag"', 'rel="nofollow"', $text ); return $text;
}

/*-----------------------------------------------------------------------------------*/	
/* nofollow post author link
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_author_posts_link', 'mts_nofollow_the_author_posts_link' );
function mts_nofollow_the_author_posts_link ( $link ) {
	return str_replace( '<a href=', '<a rel="nofollow" href=', $link ); 
}

/*-----------------------------------------------------------------------------------*/	
/* nofollow to reply links
/*-----------------------------------------------------------------------------------*/
function mts_add_nofollow_to_reply_link( $link ) {
	return str_replace( '" )\'>', '" )\' rel=\'nofollow\'>', $link );
}
add_filter( 'comment_reply_link', 'mts_add_nofollow_to_reply_link' );

/*-----------------------------------------------------------------------------------*/
/* removes the WordPress version from your header for security
/*-----------------------------------------------------------------------------------*/
function mts_remove_wpversion() {
	return '<!--Theme by MyThemeShop.com-->';
}
add_filter( 'the_generator', 'mts_remove_wpversion' );
	
/*-----------------------------------------------------------------------------------*/
/* Removes Trackbacks from the comment count
/*-----------------------------------------------------------------------------------*/
add_filter( 'get_comments_number', 'mts_comment_count', 0 );
function mts_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

/*-----------------------------------------------------------------------------------*/
/* adds a class to the post if there is a thumbnail
/*-----------------------------------------------------------------------------------*/
function has_thumb_class( $classes ) {
	global $post;
	if( has_post_thumbnail( $post->ID ) ) { $classes[] = 'has_thumb'; }
		return $classes;
}
add_filter( 'post_class', 'has_thumb_class' );

/*-----------------------------------------------------------------------------------*/	
/* AJAX Search results
/*-----------------------------------------------------------------------------------*/
function ajax_mts_search() {
	$query = $_REQUEST['q']; // It goes through esc_sql() in WP_Query
	$search_query = new WP_Query( array( 's' => $query, 'posts_per_page' => 3, 'post_status' => 'publish' )); 
	$search_count = new WP_Query( array( 's' => $query, 'posts_per_page' => -1, 'post_status' => 'publish' ));
	$search_count = $search_count->post_count;
	if ( !empty( $query ) && $search_query->have_posts() ) : 
		//echo '<h5>Results for: '. $query.'</h5>';
		echo '<ul class="ajax-search-results">';
		while ( $search_query->have_posts() ) : $search_query->the_post();
			?><li>
				<a href="<?php echo esc_url( get_the_permalink() ); ?>">
					<?php $thumb = array( 'width' => 66, 'height' => 55, 'crop' => true );
                    if(has_post_thumbnail()) {
                        $image_id = get_post_thumbnail_id ();
                        $image_thumb_url = wp_get_attachment_image_src( $image_id, 'full');
                        $thumb_src = bfi_thumb($image_thumb_url[0], $thumb );
                    } else {
                        $thumb_src = get_template_directory_uri().'/images/nothumb-widgetthumb.png';
                    }
                    echo '<div class="featured-thumbnail"><img src="'.$thumb_src.'" width="'.$thumb['width'].'" height="'.$thumb['height'].'"></div>';
					the_title(); ?>
				</a>
			</li>	
			<?php
		endwhile;
		echo '</ul>';
		echo '<div class="ajax-search-meta"><span class="results-count">'.$search_count.' '.__( 'Results', 'mythemeshop' ).'</span><a href="'.esc_url( get_search_link( $query ) ).'" class="results-link">'.__('Show all results.', 'mythemeshop').'</a></div>';
	else:
		echo '<div class="no-results">'.__( 'No results found.', 'mythemeshop' ).'</div>';
	endif;
	wp_reset_postdata();
	exit; // required for AJAX in WP
}


/*-----------------------------------------------------------------------------------*/
/* Category Colors
/*-----------------------------------------------------------------------------------*/

// 1. restructure array for easier handling
function mts_category_colors_array( $field_id = 'mts_cc_color') {
    $mts_options = get_option(MTS_THEME_NAME);
    $return = array();
    if (!empty($mts_options['mts_category_colors'])) {
        foreach ($mts_options['mts_category_colors'] as $cc) {
            $return[$cc['mts_cc_category']] = $cc[$field_id];
        }
    }
    return $return;
}
// 2. Get category color for given post
function mts_get_category_color($cat_id = null, $custom = null) {
    $cat_id = $cat_id;
    if (empty($cat_id)) {
        $category = get_the_category();
        // prevent error if no category
        if (empty($category)) return false;
        $cat_id = $category[0]->term_id;
    }
    
    if($custom){
        $colors = mts_category_colors_array($custom);
    }else{
        $colors = mts_category_colors_array();
    }

    $return = false;
    if (!empty($colors[$cat_id])) {
        $return = $colors[$cat_id];
    }
    return $return;
}

/*-----------------------------------------------------------------------------------*/
/* Redirect feed to feedburner
/*-----------------------------------------------------------------------------------*/

if ( $mts_options['mts_feedburner'] != '' ) {
	function mts_rss_feed_redirect() {
		$mts_options = get_option( MTS_THEME_NAME );
		global $feed;
		$new_feed = $mts_options['mts_feedburner'];
		if ( !is_feed() ) {
				return;
		}
		if ( preg_match( '/feedburner/i', $_SERVER['HTTP_USER_AGENT'] )){
				return;
		}
		if ( $feed != 'comments-rss2' ) {
				if ( function_exists( 'status_header' )) status_header( 302 );
				header( "Location:" . $new_feed );
				header( "HTTP/1.1 302 Temporary Redirect" );
				exit();
		}
	}
	add_action( 'template_redirect', 'mts_rss_feed_redirect' );
}

/*-----------------------------------------------------------------------------------*/
/* Single Post Pagination - Numbers + Previous/Next
/*-----------------------------------------------------------------------------------*/
function mts_wp_link_pages_args( $args ) {
	global $page, $numpages, $more, $pagenow;
	if ( !$args['next_or_number'] == 'next_and_number' )
		return $args; 
	$args['next_or_number'] = 'number'; 
	if ( !$more )
		return $args; 
	if( $page-1 ) 
		$args['before'] .= _wp_link_page( $page-1 )
		. $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'
	;
	if ( $page<$numpages ) 
	
		$args['after'] = _wp_link_page( $page+1 )
		. $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
		. $args['after']
	;
	return $args;
}
add_filter( 'wp_link_pages_args', 'mts_wp_link_pages_args' );

/*-----------------------------------------------------------------------------------*/
/* WooCommerce
/*-----------------------------------------------------------------------------------*/
if ( mts_isWooCommerce() ) {
	add_theme_support( 'woocommerce' );
	
	// Change number or products per row to 3
	add_filter( 'loop_shop_columns', 'loop_columns' );
	if ( !function_exists( 'loop_columns' )) {
		function loop_columns() {
			return 3; // 3 products per row
		}
	}
	
	// Redefine woocommerce_output_related_products()
	function woocommerce_output_related_products() {
		$args = array(
			'posts_per_page' => 3,
			'columns' => 1,
		);
		woocommerce_related_products($args); // Display 3 products in rows of 1
	}
	
	/*** Hook in on activation */
	global $pagenow;
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'mythemeshop_woocommerce_image_dimensions', 1 );
	 
	/*** Define image sizes */
	function mythemeshop_woocommerce_image_dimensions() {
		$catalog = array(
			'width' 	=> '240',	// px
			'height'	=> '200',	// px
			'crop'		=> 1 		// true
		 );
		$single = array(
			'width' 	=> '350',	// px
			'height'	=> '470',	// px
			'crop'		=> 1 		// true
		 );
		$thumbnail = array(
			'width' 	=> '80',	// px
			'height'	=> '100',	// px
			'crop'		=> 0 		// false
		 ); 
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
	
	add_filter( 'woocommerce_product_thumbnails_columns', 'mts_thumb_cols' );
	function mts_thumb_cols() {
	 return 4; // .last class applied to every 4th thumbnail
	}
	
	add_filter( 'loop_shop_per_page', 'mts_products_per_page', 20 );
	function mts_products_per_page() {
		$mts_options = get_option( MTS_THEME_NAME );
		return $mts_options['mts_shop_products'];
	}
	
	// Ensure cart contents update when products are added to the cart via AJAX
	add_filter( 'add_to_cart_fragments', 'mts_header_add_to_cart_fragment' );
	function mts_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();	?>
		
		<a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'mythemeshop' ); ?>"><?php echo sprintf( _n( '%d item', '%d items', $woocommerce->cart->cart_contents_count, 'mythemeshop' ), $woocommerce->cart->cart_contents_count );?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
		
		<?php $fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
	
	/**
	 * Optimize WooCommerce Scripts
	 * Updated for WooCommerce 2.0+
	 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
	 */
	add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
	
	function child_manage_woocommerce_styles() {
		//remove generator meta tag
		remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	 
		//first check that woo exists to prevent fatal errors
		if ( function_exists( 'is_woocommerce' ) ) {
			//dequeue scripts and styles
			if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
				wp_dequeue_style( 'woocommerce-layout' );
				wp_dequeue_style( 'woocommerce-smallscreen' );
				wp_dequeue_style( 'woocommerce-general' );
				wp_dequeue_style( 'wc-bto-styles' ); //Composites Styles
				wp_dequeue_script( 'wc-add-to-cart' );
				wp_dequeue_script( 'wc-cart-fragments' );
				wp_dequeue_script( 'woocommerce' );
				wp_dequeue_script( 'jquery-blockui' );
				wp_dequeue_script( 'jquery-placeholder' );
			}
		}
	}
	 
	remove_action('wp_head', 'wc_generator_tag');
}

/*-----------------------------------------------------------------------------------*/
/* add <!-- next-page --> button to tinymce
/*-----------------------------------------------------------------------------------*/
add_filter( 'mce_buttons', 'wysiwyg_editor' );
function wysiwyg_editor( $mce_buttons ) {
   $pos = array_search( 'wp_more', $mce_buttons, true );
   if ( $pos !== false ) {
	   $tmp_buttons = array_slice( $mce_buttons, 0, $pos+1 );
	   $tmp_buttons[] = 'wp_page';
	   $mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos+1 ));
   }
   return $mce_buttons;
}

/*-----------------------------------------------------------------------------------*/
/*  Get Post header animation
/*-----------------------------------------------------------------------------------*/
function mts_get_post_header_effect() {
	global $post;
	$postheader_effect = get_post_meta( $post->ID, '_mts_postheader', true );
	
	return $postheader_effect;
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/
function mts_custom_gravatar( $avatar_defaults ) {
	$mts_avatar = get_template_directory_uri() . '/images/gravatar.png';
	$avatar_defaults[$mts_avatar] = 'Custom Gravatar ( /images/gravatar.png )';
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'mts_custom_gravatar' );

/*-----------------------------------------------------------------------------------*/
/*  WP Review Support
/*-----------------------------------------------------------------------------------*/

// Set default colors for new reviews
function new_default_review_colors( $colors ) {
	$colors = array(
		'color' => '#fff',
		'fontcolor' => '#fff',
		'bgcolor1' => '#966b9d',
		'bgcolor2' => '#966b9d',
		'bordercolor' => '#966b9d'
	);
  return $colors;
}
add_filter( 'wp_review_default_colors', 'new_default_review_colors' );
 
// Set default location for new reviews
function new_default_review_location( $position ) {
  $position = 'top';
  return $position;
}
add_filter( 'wp_review_default_location', 'new_default_review_location' );


/*-----------------------------------------------------------------------------------*/
/*  Thumbnail Upscale
/*  Enables upscaling of thumbnails for small media attachments, 
/*  to make sure it fits into it's supposed location.
/*  Cannot be used in conjunction with Retina Support.
/*-----------------------------------------------------------------------------------*/
if ( empty( $mts_options['mts_retina'] ) ) {
	function mts_image_crop_dimensions( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ) {
		if( !$crop )
			return null; // let the wordpress default function handle this
	
		$aspect_ratio = $orig_w / $orig_h;
		$size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );
	
		$crop_w = round( $new_w / $size_ratio );
		$crop_h = round( $new_h / $size_ratio );
	
		$s_x = floor( ( $orig_w - $crop_w ) / 2 );
		$s_y = floor( ( $orig_h - $crop_h ) / 2 );
	
		return array( 0, 0, ( int ) $s_x, ( int ) $s_y, ( int ) $new_w, ( int ) $new_h, ( int ) $crop_w, ( int ) $crop_h );
	}
	add_filter( 'image_resize_dimensions', 'mts_image_crop_dimensions', 10, 6 );
}


/*-----------------------------------------------------------------------------------*/
/* Post view count
/* AJAX is used to support caching plugins - it is possible to disable with filter
/* It is also possible to exclude admins with another filter
/*-----------------------------------------------------------------------------------*/
add_filter('the_content', 'mts_view_count_js'); // outputs JS for AJAX call on single
add_action('wp_ajax_mts_view_count', 'ajax_mts_view_count');
add_action('wp_ajax_nopriv_mts_view_count','ajax_mts_view_count');

function mts_view_count_js( $content ) {
	global $post;
	$id = $post->ID;
	$use_ajax = apply_filters( 'mts_view_count_cache_support', true );
	
	$exclude_admins = apply_filters( 'mts_view_count_exclude_admins', false ); // pass in true or a user capability
	if ($exclude_admins === true) $exclude_admins = 'edit_posts';
	if ($exclude_admins && current_user_can( $exclude_admins )) return $content; // do not count post views here

	if (is_single()) {
		if ($use_ajax) {
			// enqueue jquery
			wp_enqueue_script( 'jquery' );
			
			$url = admin_url( 'admin-ajax.php' );
			$content .= "
			<script type=\"text/javascript\">
			jQuery(document).ready(function($) {
				$.post('".esc_js($url)."', {action: 'mts_view_count', id: '".esc_js($id)."'});
			});
			</script>";
			
		}

		if (!$use_ajax) {
			mts_update_view_count($id);
		}
	} 

	return $content;
}

function ajax_mts_view_count() {
	// do count
	$post_id = $_POST['id'];
	mts_update_view_count( $post_id );
}
function mts_update_view_count( $post_id ) {
	$count = get_post_meta( $post_id, '_mts_view_count', true );
	update_post_meta( $post_id, '_mts_view_count', $count + 1 );
	
	do_action( 'mts_view_count_after_update', $post_id );
}

/*-----------------------------------------------------------------------------------*/
/*  Color manipulations
/*-----------------------------------------------------------------------------------*/
function mts_hex_to_hsl( $color ){

	// Sanity check
	$color = mts_check_hex_color($color);

	// Convert HEX to DEC
	$R = hexdec($color[0].$color[1]);
	$G = hexdec($color[2].$color[3]);
	$B = hexdec($color[4].$color[5]);

	$HSL = array();

	$var_R = ($R / 255);
	$var_G = ($G / 255);
	$var_B = ($B / 255);

	$var_Min = min($var_R, $var_G, $var_B);
	$var_Max = max($var_R, $var_G, $var_B);
	$del_Max = $var_Max - $var_Min;

	$L = ($var_Max + $var_Min)/2;

	if ($del_Max == 0) {
		$H = 0;
		$S = 0;
	} else {
		if ( $L < 0.5 ) $S = $del_Max / ( $var_Max + $var_Min );
		else            $S = $del_Max / ( 2 - $var_Max - $var_Min );

		$del_R = ( ( ( $var_Max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
		$del_G = ( ( ( $var_Max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
		$del_B = ( ( ( $var_Max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;

		if      ($var_R == $var_Max) $H = $del_B - $del_G;
		else if ($var_G == $var_Max) $H = ( 1 / 3 ) + $del_R - $del_B;
		else if ($var_B == $var_Max) $H = ( 2 / 3 ) + $del_G - $del_R;

		if ($H<0) $H++;
		if ($H>1) $H--;
	}

	$HSL['H'] = ($H*360);
	$HSL['S'] = $S;
	$HSL['L'] = $L;

	return $HSL;
}

function mts_hsl_to_hex( $hsl = array() ){

	list($H,$S,$L) = array( $hsl['H']/360,$hsl['S'],$hsl['L'] );

	if( $S == 0 ) {
		$r = $L * 255;
		$g = $L * 255;
		$b = $L * 255;
	} else {

		if($L<0.5) {
			$var_2 = $L*(1+$S);
		} else {
			$var_2 = ($L+$S) - ($S*$L);
		}

		$var_1 = 2 * $L - $var_2;

		$r = round(255 * mts_huetorgb( $var_1, $var_2, $H + (1/3) ));
		$g = round(255 * mts_huetorgb( $var_1, $var_2, $H ));
		$b = round(255 * mts_huetorgb( $var_1, $var_2, $H - (1/3) ));
	}

	// Convert to hex
	$r = dechex($r);
	$g = dechex($g);
	$b = dechex($b);

	// Make sure we get 2 digits for decimals
	$r = (strlen("".$r)===1) ? "0".$r:$r;
	$g = (strlen("".$g)===1) ? "0".$g:$g;
	$b = (strlen("".$b)===1) ? "0".$b:$b;

	return $r.$g.$b;
}

function mts_huetorgb( $v1,$v2,$vH ) {
	if( $vH < 0 ) {
		$vH += 1;
	}

	if( $vH > 1 ) {
		$vH -= 1;
	}

	if( (6*$vH) < 1 ) {
		   return ($v1 + ($v2 - $v1) * 6 * $vH);
	}

	if( (2*$vH) < 1 ) {
		return $v2;
	}

	if( (3*$vH) < 2 ) {
		return ($v1 + ($v2-$v1) * ( (2/3)-$vH ) * 6);
	}

	return $v1;

}

function mts_check_hex_color( $hex ) {
	// Strip # sign is present
	$color = str_replace("#", "", $hex);

	// Make sure it's 6 digits
	if( strlen($color) == 3 ) {
		$color = $color[0].$color[0].$color[1].$color[1].$color[2].$color[2];
	}

	return $color;
}



// convert hex to rgba
function mts_hextorgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
return implode(",", $rgb); // returns the rgb values separated by commas
//return $rgb; // returns an array with the rgb values
}

// Check if color is considered light or not
function mts_is_light_color( $color ){

	$color = mts_check_hex_color( $color );

	// Calculate straight from rbg
	$r = hexdec($color[0].$color[1]);
	$g = hexdec($color[2].$color[3]);
	$b = hexdec($color[4].$color[5]);

	return ( ( $r*299 + $g*587 + $b*114 )/1000 > 130 );
}

// Darken color by given amount in %
function mts_darken_color( $color, $amount = 10 ) {

	$hsl = mts_hex_to_hsl( $color );

	// Darken
	$hsl['L'] = ( $hsl['L'] * 100 ) - $amount;
	$hsl['L'] = ( $hsl['L'] < 0 ) ? 0 : $hsl['L']/100;

	// Return as HEX
	return mts_hsl_to_hex($hsl);
}

// Lighten color by given amount in %
function mts_lighten_color( $color, $amount = 10 ) {

	$hsl = mts_hex_to_hsl( $color );

	// Lighten
	$hsl['L'] = ( $hsl['L'] * 100 ) + $amount;
	$hsl['L'] = ( $hsl['L'] > 100 ) ? 1 : $hsl['L']/100;
	
	// Return as HEX
	return mts_hsl_to_hex($hsl);
}

/*-----------------------------------------------------------------------------------*/
/*  Generate css from background option
/*-----------------------------------------------------------------------------------*/
function mts_get_background_styles( $option_id ) {

	$mts_options = get_option( MTS_THEME_NAME );

	if ( ! isset( $mts_options[ $option_id ]) ) return;

	$background_option = $mts_options[ $option_id ];

	$output = '';

	$background_image_type = isset( $background_option['use'] ) ? $background_option['use'] : '';

	if ( isset( $background_option['color'] ) && !empty( $background_option['color'] ) && 'gradient' !== $background_image_type ) {
		$output .= 'background-color:'.$background_option['color'].';';
	}

	if ( !empty( $background_image_type ) ) {

		if ( 'upload' == $background_image_type ) {

			if ( isset( $background_option['image_upload'] ) && !empty( $background_option['image_upload'] ) ) {
				$output .= 'background-image:url('.$background_option['image_upload'].');';
			}
			if ( isset( $background_option['repeat'] ) && !empty( $background_option['repeat'] ) ) {
				$output .= 'background-repeat:'.$background_option['repeat'].';';
			}
			if ( isset( $background_option['attachment'] ) && !empty( $background_option['attachment'] ) ) {
				$output .= 'background-attachment:'.$background_option['attachment'].';';
			}
			if ( isset( $background_option['position'] ) && !empty( $background_option['position'] ) ) {
				$output .= 'background-position:'.$background_option['position'].';';
			}
			if ( isset( $background_option['size'] ) && !empty( $background_option['size'] ) ) {
				$output .= 'background-size:'.$background_option['size'].';';
			}

		} else if ( 'gradient' == $background_image_type ) {

			$from      = $background_option['gradient']['from'];
			$to        = $background_option['gradient']['to'];
			$direction = $background_option['gradient']['direction'];

			if ( !empty( $from ) && !empty( $to ) ) {

				$output .= 'background: '.$background_option['color'].';';

				if ( 'horizontal' == $direction ) {

					$output .= 'background: -moz-linear-gradient(left, '.$from.' 0%, '.$to.' 100%);';
					$output .= 'background: -webkit-gradient(linear, left top, right top, color-stop(0%,'.$from.'), color-stop(100%,'.$to.'));';
					$output .= 'background: -webkit-linear-gradient(left, '.$from.' 0%,'.$to.' 100%);';
					$output .= 'background: -o-linear-gradient(left, '.$from.' 0%,'.$to.' 100%);';
					$output .= 'background: -ms-linear-gradient(left, '.$from.' 0%,'.$to.' 100%);';
					$output .= 'background: linear-gradient(to right, '.$from.' 0%,'.$to.' 100%);';
					$output .= "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='".$from."', endColorstr='".$to."',GradientType=1 );";

				} else {

					$output .= 'background: -moz-linear-gradient(top, '.$from.' 0%, '.$to.' 100%);';
					$output .= 'background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$from.'), color-stop(100%,'.$to.'));';
					$output .= 'background: -webkit-linear-gradient(top, '.$from.' 0%,'.$to.' 100%);';
					$output .= 'background: -o-linear-gradient(top, '.$from.' 0%,'.$to.' 100%);';
					$output .= 'background: -ms-linear-gradient(top, '.$from.' 0%,'.$to.' 100%);';
					$output .= 'background: linear-gradient(to bottom, '.$from.' 0%,'.$to.' 100%);';
					$output .= "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='".$from."', endColorstr='".$to."',GradientType=0 );";
				}
			}

		} else if ( 'pattern' == $background_image_type ) {

			$output .= 'background-image:url('.get_template_directory_uri().'/images/'.$background_option['image_pattern'].'.png'.');';
		}
	}

	return $output;
}

// Map categories and images in group field after demo content import
add_filter( 'mts_correct_single_import_option', 'mts_correct_homepage_sections_import', 10, 3 );
function mts_correct_homepage_sections_import( $item, $key, $data ) {

	if ( !in_array( $key, array( 'mts_dropdown_cat', 'mts_custom_slider', 'mts_featured_categories', 'mts_category_colors', 'mts_blog_featured_categories', 'mts_popular_categories' ) ) ) return $item;

    $new_item = $item;

    if ( 'mts_dropdown_cat' === $key || 'mts_popular_categories' === $key ) {

    	foreach( $item as $i => $category ) {

            $cat_id = $category['mts_cc_category'];

            if ( is_numeric( $cat_id ) && array_key_exists( $cat_id, $data['terms']['category'] ) ) {

                $new_item[ $i ]['mts_cc_category'] = $data['terms']['category'][ $cat_id ];
            }
        }

    } else if ( 'mts_custom_slider' === $key ) {

        foreach( $item as $i => $image ) {

            $img = $image['mts_custom_slider_image'];
            if ( is_numeric( $img ) ) {

                if ( array_key_exists( $img, $data['posts'] ) ) {

                    $new_item[ $i ]['mts_custom_slider_image'] = $data['posts'][ $img ];
                }

            } else {

                if ( array_key_exists( $img, $data['image_urls'] ) ) {

                    $new_item[ $i ]['mts_custom_slider_image'] = $data['image_urls'][ $img ];
                }
            }
        }

    } else if ( 'mts_category_colors' === $key ) {

        foreach( $item as $i => $image ) {

            $img = $image['mts_cc_image'];
            if ( is_numeric( $img ) ) {

                if ( array_key_exists( $img, $data['posts'] ) ) {

                    $new_item[ $i ]['mts_cc_image'] = $data['posts'][ $img ];
                }

            } else {

                if ( array_key_exists( $img, $data['image_urls'] ) ) {

                    $new_item[ $i ]['mts_cc_image'] = $data['image_urls'][ $img ];
                }
            }

            $cat_id = $image['mts_cc_category'];

            if ( is_numeric( $cat_id ) && array_key_exists( $cat_id, $data['terms']['category'] ) ) {

                $new_item[ $i ]['mts_cc_category'] = $data['terms']['category'][ $cat_id ];
            }
        }

    } else if ( 'mts_blog_featured_categories' === $key ) {

        foreach( $item as $i => $category ) {

            $cat_id = $category['mts_blog_featured_category'];

            if ( is_numeric( $cat_id ) && array_key_exists( $cat_id, $data['terms']['category'] ) ) {

                $new_item[ $i ]['mts_blog_featured_category'] = $data['terms']['category'][ $cat_id ];
            }
        }

    } else { // mts_featured_categories

        foreach( $item as $i => $category ) {

            $cat_id = $category['mts_featured_category'];

            if ( is_numeric( $cat_id ) && array_key_exists( $cat_id, $data['terms']['category'] ) ) {

                $new_item[ $i ]['mts_featured_category'] = $data['terms']['category'][ $cat_id ];
            }
        }
    }

    return $new_item;
}

/**
 * Retrieves the attachment ID from the file URL
 *
 * @param $image_url
 *
 * @return string
 */
function mts_get_image_id_from_url( $image_url ) {
    global $wpdb;
    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
    if ( isset( $attachment[0] ) ) {
        return $attachment[0];
    } else {
        return false;
    }
}

/**
 * Remove new line tags from string
 *
 * @param $text
 *
 * @return string
 */
function mts_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}

/**
 * Remove new line tags from string
 *
 * @return string
 */
function mts_single_post_schema() {

    if ( is_singular( 'post' ) ) {

        global $post, $mts_options;

        if ( has_post_thumbnail( $post->ID ) && !empty( $mts_options['mts_logo'] ) ) {

            $logo_id = mts_get_image_id_from_url( $mts_options['mts_logo'] );

            if ( $logo_id ) {
                
                $images  = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $logo    = wp_get_attachment_image_src( $logo_id, 'full' );
                $excerpt = mts_escape_text_tags( $post->post_excerpt );
                $content = $excerpt === "" ? mb_substr( mts_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;

                $args = array(
                    "@context" => "http://schema.org",
                    "@type"    => "BlogPosting",
                    "mainEntityOfPage" => array(
                        "@type" => "WebPage",
                        "@id"   => get_permalink( $post->ID )
                    ),
                    "headline" => wp_title( '', false, 'right' ),
                    "image"    => array(
                        "@type"  => "ImageObject",
                        "url"    => $images[0],
                        "width"  => $images[1],
                        "height" => $images[2]
                    ),
                    "datePublished" => get_the_time( DATE_ISO8601, $post->ID ),
                    "dateModified"  => get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ),
                    "author" => array(
                        "@type" => "Person",
                        "name"  => mts_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
                    ),
                    "publisher" => array(
                        "@type" => "Organization",
                        "name"  => get_bloginfo( 'name' ),
                        "logo"  => array(
                            "@type"  => "ImageObject",
                            "url"    => esc_url( $mts_options['mts_logo'] ),
                            "width"  => $logo[1],
                            "height" => $logo[2]
                        )
                    ),
                    "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
                );

                echo '<script type="application/ld+json">' , PHP_EOL;
                echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) , PHP_EOL;
                echo '</script>' , PHP_EOL;
            }
        }
    }
}
add_action( 'wp_head', 'mts_single_post_schema' );

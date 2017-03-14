<?php

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'scalia_register_required_plugins' );
function scalia_register_required_plugins() {
	$plugins = array(
		array(
			'name' => 'Scalia Theme Elements',
			'slug' => 'scalia_elements',
			'source' => 'http://codex-themes.com/scalia/required-plugins/scalia_elements.zip',
			'required' => true,
			'version' => '1.1.1',
			'force_activation' => true,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => 'Scalia Import',
			'slug' => 'scalia-import',
			'source' => 'http://codex-themes.com/scalia/recommended-plugins/scalia-import.zip',
			'required' => false,
			'version' => '1.0.1',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => 'LayerSlider WP',
			'slug' => 'LayerSlider',
			'source' => 'http://codex-themes.com/scalia/required-plugins/layersliderwp.installable.zip',
			'required' => true,
			'version' => '',
			'force_activation' => true,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => 'Wordpress Page Widgets',
			'slug' => 'wp-page-widget',
			'source' => 'http://codex-themes.com/scalia/required-plugins/wp-page-widget.zip',
			'required' => true,
			'version' => '',
			'force_activation' => true,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => 'Black Studio TinyMCE Widget',
			'slug' => 'black-studio-tinymce-widget',
			'source' => 'https://downloads.wordpress.org/plugin/black-studio-tinymce-widget.zip',
			'required' => true,
			'version' => '',
			'force_activation' => true,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => 'WPBakery Visual Composer',
			'slug' => 'js_composer',
			'source' => 'http://codex-themes.com/scalia/required-plugins/js_composer.zip',
			'required' => true,
			'version' => '',
			'force_activation' => true,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'source' => 'https://downloads.wordpress.org/plugin/contact-form-7.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => 'JW Player 6 Plugin for Wordpress',
			'slug' => 'jw-player-plugin-for-wordpress',
			'source' => 'http://codex-themes.com/scalia/recommended-plugins/jw-player-plugin-for-wordpress.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => 'MailChimp for WordPress',
			'slug' => 'mailchimp-for-wp',
			'source' => 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => 'WP Google Analytics',
			'slug' => 'wp-google-analytics',
			'source' => 'https://downloads.wordpress.org/plugin/wp-google-analytics.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
	);

	$theme_text_domain = 'scalia';

	$config = array(
		'domain' => $theme_text_domain,
		'default_path' => '',
		'menu' => 'install-required-plugins',
		'has_notices' => true,
		'is_automatic' => true,
		'message' => '',
		'strings' => array(
			'page_title' => __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title' => __( 'Install Plugins', $theme_text_domain ),
			'installing' => __( 'Installing Plugin: %s', $theme_text_domain ),
			'oops' => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
			'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
			'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
			'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
			'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
			'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
			'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
			'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return' => __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated' => __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ),
			'nag_type' => 'updated'
		)
	);

	tgmpa( $plugins, $config );

}

add_action( 'admin_init', 'scalia_updater_plugin_load' );
function scalia_updater_plugin_load() {
	if ( ! class_exists( 'TGM_Updater' ) ) {
		require dirname( __FILE__ ) . '/class-tgm-updater.php';
	}
	if(scalia_is_plugin_active('scalia_elements/scalia_elements.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'scalia_elements/scalia_elements.php');
		$args = array(
			'plugin_name' => 'Scalia Theme Elements',
			'plugin_slug' => 'scalia_elements',
			'plugin_path' => 'scalia_elements/scalia_elements.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'scalia_elements',
			'remote_url'  => 'http://codex-themes.com/scalia/required-plugins/scalia_elements.json',
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(scalia_is_plugin_active('scalia-import/scalia-import.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'scalia-import/scalia-import.php');
		$args = array(
				'plugin_name' => 'Scalia Import',
			'plugin_slug' => 'scalia-import',
			'plugin_path' => 'scalia-import/scalia-import.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'scalia-import',
			'remote_url'  => 'http://codex-themes.com/scalia/recommended-plugins/scalia-import.json',
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(scalia_is_plugin_active('LayerSlider/layerslider.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'LayerSlider/layerslider.php');
		$args = array(
			'plugin_name' => 'LayerSlider WP',
			'plugin_slug' => 'LayerSlider',
			'plugin_path' => 'LayerSlider/layerslider.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'LayerSlider',
			'remote_url'  => 'http://codex-themes.com/scalia/required-plugins/layerslider.json',
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(scalia_is_plugin_active('js_composer/js_composer.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'js_composer/js_composer.php');
		$args = array(
			'plugin_name' => 'WPBakery Visual Composer',
			'plugin_slug' => 'js_composer',
			'plugin_path' => 'js_composer/js_composer.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'js_composer',
			'remote_url'  => 'http://codex-themes.com/scalia/required-plugins/js_composer.json',
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
}

if(function_exists('vc_set_as_theme')) vc_set_as_theme(true);

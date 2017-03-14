<?php

function scalia_get_theme_options() {
	$options = array(
		'general' => array(
			'title' => __('General', 'scalia'),
			'subcats' => array(
				'theme_layout' => array(
					'title' => __('Theme Layout', 'scalia'),
					'options' => array(
						'page_layout_style' => array(
							'title' => __('Page Layout Style', 'scalia'),
							'type' => 'select',
							'items' => array(
								'fullwidth' => __('Fullwidth Layout', 'scalia'),
								'boxed' => __('Boxed Layout', 'scalia'),
							),
							'default' => 'fullwidth',
							'description' => __('Select theme layout style', 'scalia'),
						),
						'disable_fixed_header' => array(
							'title' => __('Disable Fixed Header', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'header_on_slideshow' => array(
							'title' => __('Header On Slideshow', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'menu_appearance_tablet_portrait' => array(
							'title' => __('Menu appearance on tablets (portrait orientation)', 'scalia'),
							'type' => 'select',
							'items' => array(
								'responsive' => __('Responsive', 'scalia'),
								'centered' => __('Centered', 'scalia'),
								'default' => __('Default', 'scalia'),
							),
							'default' => 'responsive',
							'description' => __('Select the menu appearance style on tablet screens in portrait orientation', 'scalia'),
						),
						'menu_appearance_tablet_landscape' => array(
							'title' => __('Menu appearance on tablets (landscape orientation)', 'scalia'),
							'type' => 'select',
							'items' => array(
								'responsive' => __('Responsive', 'scalia'),
								'centered' => __('Centered', 'scalia'),
								'default' => __('Default', 'scalia'),
							),
							'default' => 'default',
							'description' => __('Select the menu appearance style on tablet screens in landscape orientation', 'scalia'),
						),
						'disable_scroll_top_button' => array(
							'title' => __('Disable Scroll Top Button', 'scalia'),
							'description' => __('Disable on-scroll "to the top" button', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
				'top_area' => array(
					'title' => __('Top Area', 'scalia'),
					'options' => array(
						'top_area_style' => array(
							'title' => __('Top Area Style', 'scalia'),
							'type' => 'select',
							'items' => array(
								'0' => 'None',
								'1' => 'Style 1',
								'2' => 'Style 2',
							),
							'description' => __('Select the style of top area (contacts & socials bar above main menu and logo) or disable it', 'scalia'),
						),
						'top_area_search' => array(
							'title' => __('Show Search', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'top_area_contacts' => array(
							'title' => __('Show Contacts', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'top_area_socials' => array(
							'title' => __('Show Socilas', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
				'identity' => array(
					'title' => __('Identity', 'scalia'),
					'options' => array(
						'logo' => array(
							'title' => __('Logo', 'scalia'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo.png',
							'description' => __('Default Logo', 'scalia'),
						),
						'small_logo' => array(
							'title' => __('Small Logo', 'scalia'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-small.png',
							'description' => __('Smaller Logo For Fixed Header & Mobile Devices', 'scalia'),
						),
						'logo_2x' => array(
							'title' => __('Logo 2x', 'scalia'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-2x.png',
							'description' => __('2x Retina Logo', 'scalia'),
						),
						'small_logo_2x' => array(
							'title' => __('Small Logo 2x', 'scalia'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-small-2x.png',
							'description' => __('2x Smaller Retina Logo For Mobile Devices', 'scalia'),
						),
						'logo_3x' => array(
							'title' => __('Logo 3x', 'scalia'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-3x.png',
							'description' => __('3x Retina Logo', 'scalia'),
						),
						'small_logo_3x' => array(
							'title' => __('Small Logo 3x', 'scalia'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-small-3x.png',
							'description' => __('3x Smaller Retina Logo For Mobile Devices', 'scalia'),
						),
						'logo_position' => array(
							'title' => __('Logo Position', 'scalia'),
							'type' => 'select',
							'items' => array(
								'left' => __('Left', 'scalia'),
								'right' => __('Right', 'scalia'),
								'center' => __('Center', 'scalia'),
							),
							'default' => 'left',
							'description' => __('Select position of your logo in website header', 'scalia'),
						),
						'favicon' => array(
							'title' => __('Favicon', 'scalia'),
							'type' => 'image',
							'description' => __('Upload or select file for your favicon', 'scalia'),
						),
					),
				),
				'advanced' => array(
					'title' => __('Advanced', 'scalia'),
					'options' => array(
						'preloader_style' => array(
							'title' => __('Preloader Style', 'scalia'),
							'type' => 'select',
							'items' => array(
								'preloader-1' => __('Preloader 1', 'scalia'),
								'preloader-2' => __('Preloader 2', 'scalia'),
								'preloader-3' => __('Preloader 3', 'scalia'),
							),
							'default' => 'preloader-1',
							'description' => __('Choose preloader you wish to use on your website', 'scalia'),
						),
						'custom_css' => array(
							'title' => __('Custom CSS', 'scalia'),
							'type' => 'textarea',
							'description' => __('Type your custom css here, which you would like to add to theme\'s css (or overwrite it)', 'scalia'),
						),
						'custom_js' => array(
							'title' => __('Custom JS', 'scalia'),
							'type' => 'textarea',
							'description' => __('Type your custom javascript here, which you would like to add to theme\'s js', 'scalia'),
						),
					),
				),
			),
		),

		'fonts' => array(
			'title' => __('Fonts', 'scalia'),
			'subcats' => array(
				'google_fonts' => array(
					'title' => __('Google Fonts', 'scalia'),
					'options' => array(
						'google_fonts_file' => array(
							'title' => __('Google Fonts File', 'scalia'),
							'type' => 'file',
							'description' => __('Upload or select you own google fonts file if you would like to use a different version than the theme\'s default', 'scalia'),
						),
					),
				),
				'main_menu_font' => array(
					'title' => __('Main Menu Font', 'scalia'),
					'options' => array(
						'main_menu_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'main_menu_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'main_menu_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'main_menu_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 18,
						),
						'main_menu_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'submenu_font' => array(
					'title' => __('Submenu Font', 'scalia'),
					'options' => array(
						'submenu_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'submenu_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'submenu_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'submenu_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 12,
						),
						'submenu_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'styled_subtitle_font' => array(
					'title' => __('Styled Subtitle Font', 'scalia'),
					'options' => array(
						'styled_subtitle_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'styled_subtitle_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'styled_subtitle_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'styled_subtitle_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 29,
						),
						'styled_subtitle_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'blog_post_title_font' => array(
					'title' => __('Default Blog Style Post Title Font', 'scalia'),
					'options' => array(
						'blog_post_title_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'blog_post_title_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'blog_post_title_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'blog_post_title_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 40,
						),
						'blog_post_title_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 60,
						),
					),
				),
				'h1_font' => array(
					'title' => __('H1 Font', 'scalia'),
					'options' => array(
						'h1_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'h1_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'h1_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'h1_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 29,
						),
						'h1_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h2_font' => array(
					'title' => __('H2 Font', 'scalia'),
					'options' => array(
						'h2_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'h2_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'h2_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'h2_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 25,
						),
						'h2_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h3_font' => array(
					'title' => __('H3 Font', 'scalia'),
					'options' => array(
						'h3_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'h3_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'h3_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'h3_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 23,
						),
						'h3_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h4_font' => array(
					'title' => __('H4 Font', 'scalia'),
					'options' => array(
						'h4_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'h4_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'h4_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'h4_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 21,
						),
						'h4_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h5_font' => array(
					'title' => __('H5 Font', 'scalia'),
					'options' => array(
						'h5_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'h5_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'h5_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'h5_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 19,
						),
						'h5_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'h6_font' => array(
					'title' => __('H6 Font', 'scalia'),
					'options' => array(
						'h6_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'h6_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'h6_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'h6_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 17,
						),
						'h6_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'body_font' => array(
					'title' => __('Body Font', 'scalia'),
					'options' => array(
						'body_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'body_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'body_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'body_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 14,
						),
						'body_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'widget_title_font' => array(
					'title' => __('Widget Title Font', 'scalia'),
					'options' => array(
						'widget_title_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'widget_title_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'widget_title_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'widget_title_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 14,
						),
						'widget_title_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'button_font' => array(
					'title' => __('Button Font', 'scalia'),
					'options' => array(
						'button_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'button_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'button_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'button_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'button_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'slideshow_title_font' => array(
					'title' => __('NivoSlider Title Font', 'scalia'),
					'options' => array(
						'slideshow_title_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'slideshow_title_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'slideshow_title_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'slideshow_title_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'slideshow_title_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'slideshow_description_font' => array(
					'title' => __('NivoSlider Description Font', 'scalia'),
					'options' => array(
						'slideshow_description_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'slideshow_description_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'slideshow_description_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'slideshow_description_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'slideshow_description_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'portfolio_title_font' => array(
					'title' => __('Portfolio Title Font', 'scalia'),
					'options' => array(
						'portfolio_title_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'portfolio_title_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'portfolio_title_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'portfolio_title_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'portfolio_title_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'portfolio_description_font' => array(
					'title' => __('Portfolio Description Font', 'scalia'),
					'options' => array(
						'portfolio_description_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'portfolio_description_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'portfolio_description_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'portfolio_description_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'portfolio_description_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_title_font' => array(
					'title' => __('Quickfinder Title Font', 'scalia'),
					'options' => array(
						'quickfinder_title_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'quickfinder_title_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'quickfinder_title_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_title_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'quickfinder_title_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_description_font' => array(
					'title' => __('Quickfinder Description Font', 'scalia'),
					'options' => array(
						'quickfinder_description_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'quickfinder_description_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'quickfinder_description_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_description_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'quickfinder_description_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_title_font' => array(
					'title' => __('Gallery Title Font', 'scalia'),
					'options' => array(
						'gallery_title_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'gallery_title_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'gallery_title_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'gallery_title_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'gallery_title_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_description_font' => array(
					'title' => __('Gallery Description Font', 'scalia'),
					'options' => array(
						'gallery_description_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'gallery_description_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'gallery_description_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'gallery_description_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'gallery_description_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'pricing_table_price_font' => array(
					'title' => __('Pricing Tables Price', 'scalia'),
					'options' => array(
						'pricing_table_price_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'pricing_table_price_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'pricing_table_price_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'pricing_table_price_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'pricing_table_price_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'testimonial_font' => array(
					'title' => __('Testimonials Quoted Text', 'scalia'),
					'options' => array(
						'testimonial_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'testimonial_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'testimonial_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'testimonial_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'testimonial_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'counter_font' => array(
					'title' => __('Counter Numbers', 'scalia'),
					'options' => array(
						'counter_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'counter_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'counter_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'counter_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'counter_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'woocommerce_price_font' => array(
					'title' => __('WooCommerce Product Category Price', 'scalia'),
					'options' => array(
						'woocommerce_price_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'woocommerce_price_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'woocommerce_price_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'woocommerce_price_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'woocommerce_price_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'highlight_label_font' => array(
					'title' => __('Highlight Label Font', 'scalia'),
					'options' => array(
						'highlight_label_font_family' => array(
							'title' => __('Font Family', 'scalia'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'scalia'),
						),
						'highlight_label_font_style' => array(
							'title' => __('Font Style', 'scalia'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'scalia'),
						),
						'highlight_label_font_sets' => array(
							'title' => __('Font Sets', 'scalia'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'scalia'),
							'default' => 'latin,latin-ext'
						),
						'highlight_label_font_size' => array(
							'title' => __('Font Size', 'scalia'),
							'description' => __('Select the font size', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'highlight_label_line_height' => array(
							'title' => __('Line Height', 'scalia'),
							'description' => __('Select the line height', 'scalia'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
			),
		),

		'colors' => array(
			'title' => __('Colors', 'scalia'),
			'subcats' => array(
				'background_main_colors' => array(
					'title' => __('Background And Main Colors', 'scalia'),
					'options' => array(
						'basic_outer_background_color' => array(
							'title' => __('Background Color For Boxed Layout', 'scalia'),
							'type' => 'color',
							'description' => __('Select website\'s backround color in boxed layout', 'scalia'),
						),
						'basic_inner_background_color' => array(
							'title' => __('Basic background color for website', 'scalia'),
							'type' => 'color',
							'description' => __('Basic background color is the continuous background color underlaying the whole webpage. By default it is visible for example in slideshow area, quickfinder area, portfolio-slider', 'scalia'),
						),
						'top_background_color' => array(
							'title' => __('Top Background Color', 'scalia'),
							'type' => 'color',
							'description' => __('Select color for website\'s top background', 'scalia'),
						),
						'main_background_color' => array(
							'title' => __('Main Content Background Color', 'scalia'),
							'type' => 'color',
							'description' => __('Select color for website\'s main content background', 'scalia'),
						),
						'footer_background_color' => array(
							'title' => __('Footer Background Color', 'scalia'),
							'type' => 'color',
							'description' => __('Select color footer bar at website\'s bottom', 'scalia'),
						),
						'styled_elements_background_color' => array(
							'title' => __('Styled Element Default Background Color', 'scalia'),
							'type' => 'color',
							'description' => __('Default background color which is used in following elements: text boxes, alert boxes, tables, news, tabs, galleries, rounded backgrounds in testimonials, recent posts, author block', 'scalia'),
						),
						'styled_elements_color_1' => array(
							'title' => __('Styled Element Default Color 1', 'scalia'),
							'type' => 'color',
							'description' => __('This color is used in such elements as table headers, teams & accordions titles, prcining tables, tabs titles & comments etc.', 'scalia'),
						),
						'styled_elements_color_2' => array(
							'title' => __('Styled Element Default Color 2', 'scalia'),
							'type' => 'color',
							'description' => __('This color is used for instance for portfolio sharing button, portfolio filters, titles in woocommerce cart, default prices in pricing tables etc.', 'scalia'),
						),
						'divider_default_color' => array(
							'title' => __('Divider Default Color', 'scalia'),
							'type' => 'color',
							'description' => __('Default color for dividers used in theme: content dividers, widget dividers, blog & news posts dividers etc.', 'scalia'),
						),
						'box_border_color' => array(
							'title' => __('Box Border Color', 'scalia'),
							'type' => 'color',
						),
						'box_rounded_corners' => array(
							'title' => __('Box Rounded Corners', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'box_shadow_color' => array(
							'title' => __('Box Shadows', 'scalia'),
							'type' => 'color',
						),
						'highlight_label_color' => array(
							'title' => __('Highlight Label Color', 'scalia'),
							'type' => 'color',
						),
					),
				),
				'menu_colors' => array(
					'title' => __('Menu Colors', 'scalia'),
					'options' => array(
						'main_menu_text_color' => array(
							'title' => __('Main Menu Text Color', 'scalia'),
							'type' => 'color',
						),
						'main_menu_hover_text_color' => array(
							'title' => __('Main Menu Hover Text Color', 'scalia'),
							'type' => 'color',
						),
						'main_menu_active_text_color' => array(
							'title' => __('Main Menu Active Text Color', 'scalia'),
							'type' => 'color',
						),
						'main_menu_active_background_color' => array(
							'title' => __('Main Menu Active Background Color', 'scalia'),
							'type' => 'color',
						),
						'submenu_text_color' => array(
							'title' => __('Submenu Text Color', 'scalia'),
							'type' => 'color',
						),
						'submenu_hover_text_color' => array(
							'title' => __('Submenu Hover Text Color', 'scalia'),
							'type' => 'color',
						),
						'submenu_background_color' => array(
							'title' => 'Submenu Background Color',
							'type' => 'color',
						),
						'submenu_hover_background_color' => array(
							'title' => __('Submenu Hover Background Color', 'scalia'),
							'type' => 'color',
						),
						'mega_menu_icons_color' => array(
							'title' => __('Mega Menu Icons Color', 'scalia'),
							'type' => 'color',
						),
						'menu_shadow_color' => array(
							'title' => __('Menu Shadow Color', 'scalia'),
							'type' => 'color',
						),
					),
				),
				'text_colors' => array(
					'title' => __('Text Colors', 'scalia'),
					'options' => array(
						'body_color' => array(
							'title' => __('Body Color', 'scalia'),
							'type' => 'color',
						),
						'h1_color' => array(
							'title' => __('H1 Color', 'scalia'),
							'type' => 'color',
						),
						'h2_color' => array(
							'title' => __('H2 Color', 'scalia'),
							'type' => 'color',
						),
						'h3_color' => array(
							'title' => __('H3 Color', 'scalia'),
							'type' => 'color',
						),
						'h4_color' => array(
							'title' => __('H4 Color', 'scalia'),
							'type' => 'color',
						),
						'h5_color' => array(
							'title' => __('H5 Color', 'scalia'),
							'type' => 'color',
						),
						'h6_color' => array(
							'title' => __('H6 Color', 'scalia'),
							'type' => 'color',
						),
						'link_color' => array(
							'title' => __('Link Color', 'scalia'),
							'type' => 'color',
						),
						'hover_link_color' => array(
							'title' => __('Hover Link Color', 'scalia'),
							'type' => 'color',
						),
						'active_link_color' => array(
							'title' => __('Active Link Color', 'scalia'),
							'type' => 'color',
						),
						'footer_text_color' => array(
							'title' => __('Footer Text Color', 'scalia'),
							'type' => 'color',
						),
						'copyright_text_color' => array(
							'title' => __('Copyright Text Color', 'scalia'),
							'type' => 'color',
						),
						'copyright_link_color' => array(
							'title' => __('Copyright Link Color', 'scalia'),
							'type' => 'color',
						),
						'title_bar_background_color' => array(
							'title' => __('Title Bar Default Background', 'scalia'),
							'type' => 'color',
						),
						'title_bar_text_color' => array(
							'title' => __('Title Bar Default Font', 'scalia'),
							'type' => 'color',
						),
						'top_area_text_color' => array(
							'title' => __('Top Area Body', 'scalia'),
							'type' => 'color',
						),
						'date_filter_subtitle_color' => array(
							'title' => __('Date, Filter & Team Subtitle Color', 'scalia'),
							'type' => 'color',
						),
						'system_icons_font' => array(
							'title' => __('System Icons Font', 'scalia'),
							'type' => 'color',
						),
						'system_icons_font_2' => array(
							'title' => __('System Icons Font 2', 'scalia'),
							'type' => 'color',
						),
					),
				),
				'button_colors' => array(
					'title' => __('Button Colors', 'scalia'),
					'options' => array(
						'button_text_basic_color' => array(
							'title' => __('Basic Text Color', 'scalia'),
							'type' => 'color',
						),
						'button_text_hover_color' => array(
							'title' => __('Hover Text Color', 'scalia'),
							'type' => 'color',
						),
						'button_text_active_color' => array(
							'title' => __('Active Text Color', 'scalia'),
							'type' => 'color',
						),
						'button_background_basic_color' => array(
							'title' => __('Basic Background Color', 'scalia'),
							'type' => 'color',
						),
						'button_background_hover_color' => array(
							'title' => __('Hover Background Color', 'scalia'),
							'type' => 'color',
						),
						'button_background_active_color' => array(
							'title' => __('Active Background Color', 'scalia'),
							'type' => 'color',
						),
					),
				),
				'widgets_colors' => array(
					'title' => __('Widgets Colors', 'scalia'),
					'options' => array(
						'widget_title_color' => array(
							'title' => __('Widget Title Color', 'scalia'),
							'type' => 'color',
							'description' => __('Choose color of widget titles', 'scalia'),
						),
						'widget_link_color' => array(
							'title' => __('Widget Link Color', 'scalia'),
							'type' => 'color',
							'description' => __('Choose color of links in widgets', 'scalia'),
						),
						'widget_hover_link_color' => array(
							'title' => __('Widget Hover Link Color', 'scalia'),
							'type' => 'color',
						),
						'widget_active_link_color' => array(
							'title' => __('Widget Active Link Color', 'scalia'),
							'type' => 'color',
						),
						'footer_widget_area_background_color' => array(
							'title' => __('Footer Widget Area Background Color', 'scalia'),
							'type' => 'color',
						),
						'footer_widget_title_color' => array(
							'title' => __('Footer Widget Title Color', 'scalia'),
							'type' => 'color',
						),
						'footer_widget_text_color' => array(
							'title' => __('Footer Widget Text Color', 'scalia'),
							'type' => 'color',
						),
						'footer_widget_link_color' => array(
							'title' => __('Footer Widget Link Color', 'scalia'),
							'type' => 'color',
							'description' => __('Choose color of links in widgets', 'scalia'),
						),
						'footer_widget_hover_link_color' => array(
							'title' => __('Footer Widget Hover Link Color', 'scalia'),
							'type' => 'color',
						),
						'footer_widget_active_link_color' => array(
							'title' => __('Footer Widget Active Link Color', 'scalia'),
							'type' => 'color',
						),
					),
				),
				'portfolio_colors' => array(
					'title' => __('Portfolio Colors', 'scalia'),
					'options' => array(
						'portfolio_slider_arrow_color' => array(
							'title' => __('Portfolio Slider Arrow', 'scalia'),
							'type' => 'color',
							'description' => __('Select color of slider\'s arrow', 'scalia'),
						),
						'portfolio_title_background_color' => array(
							'title' => __('Portfolio Overview Title Background', 'scalia'),
							'type' => 'color',
							'description' => __('Choose title & description background color for grid-style portfolio overviews', 'scalia'),
						),
						'portfolio_title_color' => array(
							'title' => __('Portfolio Overview Title Text', 'scalia'),
							'type' => 'color',
							'description' => __('Select portfolio item\'s title color for grid-style portfolio overviews', 'scalia'),
						),
						'portfolio_description_color' => array(
							'title' => __('Portfolio Overview Description Text', 'scalia'),
							'type' => 'color',
							'description' => __('Choose portfolio item\'s description color for grid-style portfolio overviews', 'scalia'),
						),
						'portfolio_sharing_button_background_color' => array(
							'title' => __('Sharing Button Background', 'scalia'),
							'type' => 'color',
							'description' => __('Choose background color for sharing button in portfolio overviews', 'scalia'),
						),
						'portfolio_date_color' => array(
							'title' => __('Portfolio Date Color', 'scalia'),
							'type' => 'color',
							'description' => __('Font color for showing the date in portfolio overviews', 'scalia'),
						),
					),
				),
				'gallery_colors' => array(
					'title' => __('Slideshow, Gallery And Image Box Colors', 'scalia'),
					'options' => array(
						'gallery_caption_background_color' => array(
							'title' => __('Gallery Lightbox Caption Background', 'scalia'),
							'type' => 'color',
							'description' => __('Select background color for image description in gallery', 'scalia'),
						),
						'gallery_title_color' => array(
							'title' => __('Gallery Lightbox Title Text', 'scalia'),
							'type' => 'color',
							'description' => __('Choose title color for image description in gallery', 'scalia'),
						),
						'gallery_description_color' => array(
							'title' => __('Gallery Lightbox Description Text', 'scalia'),
							'type' => 'color',
							'description' => __('Select text color for image description in gallery', 'scalia'),
						),
						'slideshow_arrow_background' => array(
							'title' => __('Slideshow Arrow Background', 'scalia'),
							'type' => 'color',
						),
						'slideshow_arrow_color' => array(
							'title' => __('Slideshow Arrow Font', 'scalia'),
							'type' => 'color',
						),
						'hover_effect_default_color' => array(
							'title' => __('"Default" Hover Color', 'scalia'),
							'type' => 'color',
						),
						'hover_effect_zooming_blur_color' => array(
							'title' => __('"Zooming Blur" Hover Color', 'scalia'),
							'type' => 'color',
						),
						'hover_effect_horizontal_sliding_color' => array(
							'title' => __('"Horizontal Sliding" Hover Color', 'scalia'),
							'type' => 'color',
						),
						'hover_effect_vertical_sliding_color' => array(
							'title' => __('"Vertical Sliding" Hover Color', 'scalia'),
							'type' => 'color',
						),
					),
				),
				'quickfinder_colors' => array(
					'title' => __('Quickfinder Colors', 'scalia'),
					'options' => array(
						'quickfinder_bar_background_color' => array(
							'title' => __('Quickfinder Bar Background', 'scalia'),
							'type' => 'color',
							'description' => __('Select background color for the bar/panel with quickfinders', 'scalia'),
						),
						'quickfinder_bar_title_color' => array(
							'title' => __('Quickfinder Bar Title Text', 'scalia'),
							'type' => 'color',
							'description' => __('Choose title color for the bar/panel with quickfinders', 'scalia'),
						),
						'quickfinder_bar_description_color' => array(
							'title' => __('Quickfinder Bar Description Text', 'scalia'),
							'type' => 'color',
							'description' => __('Select text color for the bar/panel with quickfinders', 'scalia'),
						),
						'quickfinder_title_color' => array(
							'title' => __('Quickfinder Title Text', 'scalia'),
							'type' => 'color',
						),
						'quickfinder_description_color' => array(
							'title' => __('Quickfinder Description Text', 'scalia'),
							'type' => 'color',
						),
					),
				),
				'bullets_pager_colors' => array(
					'title' => __('Bullets, Icons, Dropcaps & Pagination', 'scalia'),
					'options' => array(
						'bullets_symbol_color' => array(
							'title' => __('Bullets Symbol', 'scalia'),
							'type' => 'color',
							'description' => __('Select font color for bullets. The same color will be used as icon font color in "active" state', 'scalia'),
						),
						'icons_symbol_color' => array(
							'title' => __('Icons Font', 'scalia'),
							'type' => 'color',
							'description' => __('Select icon font color for "normal" state', 'scalia'),
						),
						'pagination_border_color' => array(
							'title' => __('Pagination Border', 'scalia'),
							'type' => 'color',
						),
						'pagination_text_color' => array(
							'title' => __('Pagination Font', 'scalia'),
							'type' => 'color',
						),
						'pagination_active_text_color' => array(
							'title' => __('Active and Hover Pagination Font', 'scalia'),
							'type' => 'color',
						),
						'pagination_active_background_color' => array(
							'title' => __('Active and Hover Pagination Background', 'scalia'),
							'type' => 'color',
						),
						'icons_slideshow_hovers_color' => array(
							'title' => __('Icon Font Color For Slideshows & Hovers', 'scalia'),
							'type' => 'color',
							'description' => __('Select icon font color for arrows in slideshow & hovers on portfolio items/gallery', 'scalia'),
						),
						'mini_pagination_color' => array(
							'title' => __('Slider Mini-Pagination (Not Active)', 'scalia'),
							'type' => 'color',
						),
						'mini_pagination_active_color' => array(
							'title' => __('Slider Mini-Pagination (Active)', 'scalia'),
							'type' => 'color',
						),
						'footer_social_color' => array(
							'title' => __('Footer Social Icons Font', 'scalia'),
							'type' => 'color',
						),
						'footer_social_hover_color' => array(
							'title' => __('Footer Social Icons Active & Hover', 'scalia'),
							'type' => 'color',
						),
						'top_area_icons_color' => array(
							'title' => __('Top Area Icons Font', 'scalia'),
							'type' => 'color',
						),
						'top_area_social_hover_color' => array(
							'title' => __('Top Area Social Icons Active & Hover', 'scalia'),
							'type' => 'color',
						),
					),
				),
				'form_colors' => array(
					'title' => __('Form', 'scalia'),
					'options' => array(
						'form_elements_background_color' => array(
							'title' => __('Background', 'scalia'),
							'type' => 'color',
						),
						'form_elements_text_color' => array(
							'title' => __('Font', 'scalia'),
							'type' => 'color',
						),
						'form_elements_border_color' => array(
							'title' => __('Border', 'scalia'),
							'type' => 'color',
						),
					),
				),
			),
		),

		'backgrounds' => array(
			'title' => __('Backgrounds', 'scalia'),
			'subcats' => array(
				'backgrounds_images' => array(
					'title' => __('Background Images', 'scalia'),
					'options' => array(
						'basic_outer_background_image' => array(
							'title' => __('Background for Boxed Layout', 'scalia'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s backround in boxed layout', 'scalia'),
						),
						'basic_outer_background_image_select' => array(
							'title' => __('Background Patterns for Boxed Layout', 'scalia'),
							'type' => 'image-select',
							'target' => 'basic_outer_background_image',
							'items' => array(
								0 => 'low_contrast_linen',
								1 => 'mochaGrunge',
								2 => 'bedge_grunge',
								3 => 'solid',
								4 => 'concrete_wall',
								5 => 'dark_circles',
								6 => 'debut_dark',
							),
						),
						'basic_inner_background_image' => array(
							'title' => __('Basic background for website', 'scalia'),
							'type' => 'image',
							'description' => __('Basic background is the continuous background underlaying the whole webpage. By default it is visible for example in slideshow area, quickfinder area, portfolio-slider', 'scalia'),
						),
						'top_background_image' => array(
							'title' => __('Top Background', 'scalia'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s top background', 'scalia'),
						),
						'main_background_image' => array(
							'title' => __('Main Content Background', 'scalia'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s main content background', 'scalia'),
						),
						'footer_background_image' => array(
							'title' => __('Footer Background', 'scalia'),
							'type' => 'image',
							'description' => __('Select or upload image file for footer bar at website\'s bottom', 'scalia'),
						),
						'footer_widget_area_background_image' => array(
							'title' => __('Footer Widget Area Background Image', 'scalia'),
							'type' => 'image',
						),
					),
				),
			),
		),

		'home_constructor' => array(
			'title' => __('Home Constructor', 'scalia'),
			'subcats' => array(
				'home_content_builder' => array(
					'title' => __('Home Constructor', 'scalia'),
					'options' => array(
						'home_content_enabled' => array(
							'title' => __('Activate Home Constructor', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'home_effects_disabled' => array(
							'title' => __('Lazy loading disabled', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'home_content' => array(
							'type' => 'content_builder',
							'blocks' => (scalia_is_plugin_active('scalia_elements/scalia_elements.php') ? array(
								'slideshow' => __('Slideshow', 'scalia'),
								'quickfinder' => __('Quickfinder', 'scalia'),
								'portfolio' => __('Portfolio', 'scalia'),
								'clients' => __('Clients', 'scalia'),
								'content' => __('Pages', 'scalia'),
								'news' => __('News', 'scalia'),
							) : array('content' => __('Pages', 'scalia'))),
							'description' => __('Drag-n-drop panels here to setup required order', 'scalia'),
						),
					),
				),
			),
		),

		'slideshow' => array(
			'title' => __('NivoSlider Options', 'scalia'),
			'subcats' => array(
				'slideshow_options' => array(
					'title' => __('NivoSlider Options', 'scalia'),
					'options' => array(
						'slider_effect' => array(
							'title' => __('Effect', 'scalia'),
							'type' => 'select',
							'items' => array(
								'random' => 'random',
								'fold' => 'fold',
								'fade' => 'fade',
								'sliceDown' => 'sliceDown',
								'sliceDownRight' => 'sliceDownRight',
								'sliceDownLeft' => 'sliceDownLeft',
								'sliceUpRight' => 'sliceUpRight',
								'sliceUpLeft' => 'sliceUpLeft',
								'sliceUpDown' => 'sliceUpDown',
								'sliceUpDownLeft' => 'sliceUpDownLeft',
								'fold' => 'fold',
								'fade' => 'fade',
								'boxRandom' => 'boxRandom',
								'boxRain' => 'boxRain',
								'boxRainReverse' => 'boxRainReverse',
								'boxRainGrow' => 'boxRainGrow',
								'boxRainGrowReverse' => 'boxRainGrowReverse',
							),
						),
						'slider_slices' => array(
							'title' => __('Slices', 'scalia'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 15,
						),
						'slider_boxCols' => array(
							'title' => __('Box Cols', 'scalia'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 10,
							'default' => 8,
						),
						'slider_boxRows' => array(
							'title' => __('Box Rows', 'scalia'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 10,
							'default' => 4,
						),
						'slider_animSpeed' => array(
							'title' => __('Animation Speed ( x 100 milliseconds )', 'scalia'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 50,
							'default' => 5,
						),
						'slider_pauseTime' => array(
							'title' => __('Pause Time ( x 1000 milliseconds )', 'scalia'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 3,
						),
						'slider_directionNav' => array(
							'title' => __('Direction Navigation', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'slider_controlNav' => array(
							'title' => __('Control Navigation', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),

		'blog' => array(
			'title' => __('Blog & News', 'scalia'),
			'subcats' => array(
				'blog_options' => array(
					'title' => __('Blog & News Options', 'scalia'),
					'options' => array(
						'show_author' => array(
							'title' => __('Show author', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'excerpt_length' => array(
							'title' => __('Excerpt lenght', 'scalia'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 150,
							'default' => 20,
						),
					),
				),
			),
		),

		'footer' => array(
			'title' => __('Footer', 'scalia'),
			'subcats' => array(
				'footer_options' => array(
					'title' => __('Footer Options', 'scalia'),
					'options' => array(
						'footer_active' => array(
							'title' => __('Activate footer', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'footer_html' => array(
							'title' => __('Footer Text', 'scalia'),
							'type' => 'textarea',
						),
					),
				),
			),
		),

		'socials' => array(
			'title' => __('Contacts & Socials', 'scalia'),
			'subcats' => array(
				'contacts' => array(
					'title' => __('Contacts', 'scalia'),
					'options' => array(
						'contacts_address' => array(
							'title' => __('Address', 'scalia'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_phone' => array(
							'title' => __('Phone', 'scalia'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_fax' => array(
							'title' => __('Fax', 'scalia'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_email' => array(
							'title' => __('Email', 'scalia'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_website' => array(
							'title' => __('Website', 'scalia'),
							'type' => 'input',
							'default' => '',
						),
						'admin_email' => array(
							'title' => __('Admin E-mail', 'scalia'),
							'type' => 'input',
							'description' => __('Define email address of website admin. All feedbacks from contact form will be forwarded on this email address', 'scalia'),
						),
					),
				),
				'socials_options' => array(
					'title' => __('Socials', 'scalia'),
					'options' => array(
						'twitter_active' => array(
							'title' => __('Activate Twitter Icon', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'facebook_active' => array(
							'title' => __('Activate Facebook Icon', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'linkedin_active' => array(
							'title' => __('Activate LinkedIn Icon', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'googleplus_active' => array(
							'title' => __('Activate Google Plus Icon', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'stumbleupon_active' => array(
							'title' => __('Activate StumbleUpon Icon', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
						),
						'rss_active' => array(
							'title' => __('Activate RSS Icon', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'twitter_link' => array(
							'title' => __('Twitter Profile Link', 'scalia'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your twitter profile', 'scalia'),
						),
						'facebook_link' => array(
							'title' => __('Facebook Profile Link', 'scalia'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your facebook profile', 'scalia'),
						),
						'linkedin_link' => array(
							'title' => __('LinkedIn Profile Link', 'scalia'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your linkedin profile', 'scalia'),
						),
						'googleplus_link' => array(
							'title' => __('Google Plus Profile Link', 'scalia'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your google+ profile', 'scalia'),
						),
						'stumbleupon_link' => array(
							'title' => __('StumbleUpon Profile Link', 'scalia'),
							'type' => 'input',
							'default' => '#',
							'description' => __('Enter URL to your stumbleupon profile', 'scalia'),
						),
						'rss_link' => array(
							'title' => __('RSS Link', 'scalia'),
							'type' => 'input',
							'default' => '#',
						),
						'show_social_icons' => array(
							'title' => __('Display Links For Sharing Posts On Social Networks', 'scalia'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),
	);

	return $options;
}

function scalia_get_option_element($oname = '', $option = array(), $default = NULL) {
	if($default !== NULL) {
		$option['default'] = $default;
	}

	if(!isset($option['default'])) {
		$option['default'] = '';
	}

	$ml_options = array('home_content', 'footer_html', 'contacts_title', 'contacts_html', 'follow_title', 'follow_us_text');
	if(in_array($oname, $ml_options) && is_array($option['default'])) {
		if(defined('ICL_LANGUAGE_CODE')) {
			global $sitepress;
			if(isset($option['default'][ICL_LANGUAGE_CODE])) {
				$option['default'] = $option['default'][ICL_LANGUAGE_CODE];
			} elseif($sitepress->get_default_language() && isset($option['default'][$sitepress->get_default_language()])) {
				$option['default'] = $option['default'][$sitepress->get_default_language()];
			} else {
				$option['default'] = '';
			}
		}else {
			$option['default'] = reset($option['default']);
		}
	}

	$option['default'] = stripslashes($option['default']);

	$output = '<div class="option '.$oname.'_field">';

	if(isset($option['type']) && $option['type'] == 'content_builder') {
		return scalia_content_builder_output($oname, $option);
	}

	if(isset($option['type'])) {

		if(isset($option['description'])) {
			$output .= '<div class="description">'.$option['description'].'</div>';
		}

		$output .= '<div class="label"><label for="'.$oname.'">'.$option['title'].'</label></div><div class="'.$option['type'].'">';
		switch ($option['type']) {

		case 'input':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'image':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'image-select':
			$skins = array('light', 'dark');
			foreach($skins as $skin) {
				foreach($option['items'] as $item) {
					$output .= '<a data-target="'.$option['target'].'" href="'.get_template_directory_uri().'/images/backgrounds/patterns/'.$skin.'/'.$item.'.jpg"><img alt="#" src="'.get_template_directory_uri().'/images/backgrounds/patterns/'.$skin.'/'.$item.'-thumb.jpg"/></a>';
				}
				$output .= '<span class="clear"></span>';
			}
			break;

		case 'file':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'font-select':
			$selected = isset($option['default']) ? $option['default'] : '';
			$fontsList = scalia_fonts_list();
			$output .= '<select id="'.$oname.'" name="theme_options['.$oname.']">';
			foreach($fontsList as $val => $item) {
				$output .= '<option value="'.esc_attr($val).'"';
				if($val == $selected) {
					$output .= ' selected';
				}
				$output .= '>'.esc_html($item).'</option>';
			}
			$output .= '</select>';
			break;

		case 'font-style':
			$selected = isset($option['default']) ? $option['default'] : '';
			$output .= '<select id="'.$oname.'" name="theme_options['.$oname.']" data-value="'.esc_attr($selected).'"></select>';
			break;

		case 'font-sets':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' data-value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'fixed-number':
			$min = isset($option['min']) ? $option['min'] : 1;
			$max = isset($option['max']) ? $option['max'] : $min+1;
			$default = isset($option['default']) ? $option['default'] : $min;
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']" value="'.esc_attr($default).'" data-min-value="'.$min.'" data-max-value="'.$max.'"/>';
			break;

		case 'color':
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= ' class="color-select"/>';
			break;

		case 'textarea':
			$output .= '<textarea id="'.$oname.'" name="theme_options['.$oname.']" cols="100" rows="15">';
			if(isset($option['default'])) {
				$output .= esc_textarea($option['default']);
			}
			$output .= '</textarea>';
			break;

		case 'select':
			$selected = isset($option['default']) ? $option['default'] : '';
			$output .= '<select id="'.$oname.'" name="theme_options['.$oname.']">';
			foreach($option['items'] as $val => $item) {
				$output .= '<option value="'.$val.'"';
				if($val == $selected) {
					$output .= ' selected';
				}
				$output .= '>'.$item.'</option>';
			}
			$output .= '</select>';
			break;

		default:
			$output .= '<input id="'.$oname.'" name="theme_options['.$oname.']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
		}

		$output .= '</div>';

		if($option['type'] == 'checkbox') {
			$output = '<div class="option '.$oname.'_field"><div class="checkbox"><input id="'.$oname.'" name="theme_options['.$oname.']" type="checkbox" value="'.$option['value'].'"';
			if($option['default'] == $option['value']) {
				$output .= ' checked';
			}
			$output .= '> <label for="'.$oname.'">'.$option['title'].'</label></div>';
		}

		$output .= '<div class="clear"></div></div>';
	}

	return $output;
}

function scalia_content_builder_output($oname, $option) {
	ob_start();
	$pages = array();
	$pages_list = get_pages();
	foreach ($pages_list as $page) {
		$pages[$page->ID] = $page->post_title . ' (ID = ' . $page->ID . ')';
	}
	$slideshow_types = array('NivoSlider' => 'NivoSlider', 'LayerSlider' => 'LayerSlider');
	$slideshows = array();
	$sliders = array();
	$portfolios = array();
	$clients_sets = array();
	$quickfinders = array();
	if(scalia_is_plugin_active('scalia_elements/scalia_elements.php')) {
		$slideshows_list = get_terms('scalia_slideshows', array('hide_empty' => false));
		if(!empty($slideshows_list) && !is_wp_error($slideshows_list)){
			foreach ($slideshows_list as $slideshow) {
				$slideshows[$slideshow->slug] = $slideshow->name . ' (Slug = ' . $slideshow->slug . ')';
			}
		}
		global $wpdb;
		$table_name = $wpdb->prefix . "layerslider";
		$slider_items = $wpdb->get_results("SELECT * FROM $table_name WHERE flag_hidden = '0' AND flag_deleted = '0' ORDER BY id ASC");
		foreach ($slider_items as $slider_item) {
			$sliders[$slider_item->id] = (empty($slider_item->name) ? 'Unnamed' : $slider_item->name) . ' (ID = ' . $slider_item->id . ')';
		}
		$portfolios_list = get_terms('scalia_portfolios', array('hide_empty' => false));
		if(!empty($portfolios_list) && !is_wp_error($portfolios_list)){
			foreach ($portfolios_list as $portfolio) {
				$portfolios[$portfolio->slug] = $portfolio->name . ' (Slug = ' . $portfolio->slug . ')';
			}
		}
		$clients_sets_list = get_terms('scalia_clients_sets', array('hide_empty' => false));
		if(!empty($clients_sets_list) && !is_wp_error($clients_sets_list)){
			foreach ($clients_sets_list as $clients_set) {
				$clients_sets[$clients_set->slug] = $clients_set->name . ' (Slug = ' . $clients_set->slug . ')';
			}
		}
		$quickfinders_list = get_terms('scalia_quickfinders', array('hide_empty' => false));
		if(!empty($quickfinders_list) && !is_wp_error($quickfinders_list)){
			foreach ($quickfinders_list as $quickfinder) {
				$quickfinders[$quickfinder->slug] = $quickfinder->name . ' (Slug = ' . $quickfinder->slug . ')';
			}
		}
	}
	echo '<input id="' . $oname . '" name="theme_options[' . $oname . ']" type="hidden" value=""/>';
?>
<div id="<?php print $oname; ?>-control">
	<div class="option">
		<div class="description"><?php _e('Move content block down to activate it on your Home', 'scalia'); ?></div>
		<div class="label"><label for=""><?php _e('Selectable Content Blocks', 'scalia'); ?></label></div>
		<div class="selectable-blocks">
			<?php foreach($option['blocks'] as $name => $title) : ?>
				<div class="block" data-type="<?php print $name; ?>">
					<div class="title"><?php print $title; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="option">
		<div class="description"><?php _e('Drag & drop blocks to define sort order. Open blocks to choose content.', 'scalia'); ?></div>
		<div class="label"><label for=""><?php _e('Active Home Content', 'scalia'); ?></label></div>
		<div class="active-blocks">
		</div>
	</div>
</div>
<script type="text/javascript">
var default_data = <?php print $option['default'] ? $option['default'] : '{}'; ?>;
var pages = <?php print json_encode($pages); ?>;
var slideshow_types = <?php print json_encode($slideshow_types); ?>;
var slideshows = <?php print json_encode($slideshows); ?>;
var sliders = <?php print json_encode($sliders); ?>;
var portfolios = <?php print json_encode($portfolios); ?>;
var clients_sets = <?php print json_encode($clients_sets); ?>;
var quickfinders = <?php print json_encode($quickfinders); ?>;
(function($) {
	$(document).ready(function() {

		function scalia_build_block(blockData) {
			var optionWrap;
			var dataType = blockData['block_type'];
			var block = $('<div class="block block-' + dataType + '"/>');
			$('<input type="hidden" name="block_type" value="' + dataType + '"/>').appendTo(block);
			var title = $('<div class="title">' + $('#<?php print $oname; ?>-control .selectable-blocks .block[data-type="' + dataType + '"]').find('.title').text() + '</div>').appendTo(block);
			$('<a href="javascript:void(0);" class="remove"><?php _e('Remove', 'scalia'); ?></a>').appendTo(title).click(function() {
				block.remove();
			});
			value = '';
			if(blockData['block_id'] !== undefined) {
				value = blockData['block_id'];
			}
			var blockOptions = $('<div class="options"/>').appendTo(block);
			$('<div class="label"><label for=""><?php _e('Block ID', 'scalia'); ?></label></div>').appendTo(blockOptions);
			optionWrap = $('<div class="input"><input type="text" name="block_id" value="' + value + '"/></div>').appendTo(blockOptions);
			if(dataType == 'content') {
				$('<div class="label"><label for=""><?php _e('Select Page', 'scalia'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="page"/>').appendTo(optionWrap);
				for(page in pages) {
					$('<option value="' + page + '">' + pages[page] + '</option>').appendTo(select);
				}
				if(blockData['page'] !== undefined) {
					select.val(blockData['page']);
				}
			}
			if(dataType == 'slideshow') {
				$('<div class="label"><label for=""><?php _e('Select Slideshow Type', 'scalia'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="slideshow_type"/>').appendTo(optionWrap);
				for(sshow in slideshow_types) {
					$('<option value="' + sshow + '">' + slideshow_types[sshow] + '</option>').appendTo(select);
				}
				if(blockData['slideshow_type'] !== undefined) {
					select.val(blockData['slideshow_type']);
				}
				select.change(function() {
					$('.slider-select', optionWrap.parent()).hide();
					$('.slider-select.'+$(this).val(), optionWrap.parent()).show();
				});
				$('<div class="label"><label for=""><?php _e('Select Slideshow', 'scalia'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select slider-select NivoSlider" />').appendTo(blockOptions);
				var select = $('<select name="slideshow"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'scalia'); ?> -</option>').appendTo(select);
				for(sshow in slideshows) {
					$('<option value="' + sshow + '">' + slideshows[sshow] + '</option>').appendTo(select);
				}
				if(blockData['slideshow'] !== undefined) {
					select.val(blockData['slideshow']);
				}
				optionWrap = $('<div class="select slider-select LayerSlider" />').appendTo(blockOptions);
				var select = $('<select name="slider"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'scalia'); ?> -</option>').appendTo(select);
				for(sshow in sliders) {
					$('<option value="' + sshow + '">' + sliders[sshow] + '</option>').appendTo(select);
				}
				if(blockData['slider'] !== undefined) {
					select.val(blockData['slider']);
				}
				$('select[name="slideshow_type"]', optionWrap.parent()).trigger('change');
			}
			if(dataType == 'portfolio') {
				$('<div class="label"><label for=""><?php _e('Select Portfolio', 'scalia'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="portfolio"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'scalia'); ?> -</option>').appendTo(select);
				for(portfolio in portfolios) {
					$('<option value="' + portfolio + '">' + portfolios[portfolio] + '</option>').appendTo(select);
				}
				if(blockData['portfolio'] !== undefined) {
					select.val(blockData['portfolio']);
				}
			}
			if(dataType == 'clients') {
				$('<div class="label"><label for=""><?php _e('Select Clients Sets', 'scalia'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="clients_set"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'scalia'); ?> -</option>').appendTo(select);
				for(clients_set in clients_sets) {
					$('<option value="' + clients_set + '">' + clients_sets[clients_set] + '</option>').appendTo(select);
				}
				if(blockData['clients_set'] !== undefined) {
					select.val(blockData['clients_set']);
				}
			}
			if(dataType == 'quickfinder') {
				$('<div class="label"><label for=""><?php _e('Select Quickfinder', 'scalia'); ?></label></div>').appendTo(blockOptions);
				optionWrap = $('<div class="select" />').appendTo(blockOptions);
				var select = $('<select name="quickfinder"/>').appendTo(optionWrap);
				$('<option value="">- <?php _e('Select', 'scalia'); ?> -</option>').appendTo(select);
				for(quickfinder in quickfinders) {
					$('<option value="' + quickfinder + '">' + quickfinders[quickfinder] + '</option>').appendTo(select);
				}
				if(blockData['quickfinder'] !== undefined) {
					select.val(blockData['quickfinder']);
				}
			}
			if(dataType == 'news') {
				value = '';
				if(blockData['news_count'] !== undefined) {
					value = blockData['news_count'];
				}
				$('<div class="label"><label for=""><?php _e('News Count', 'scalia'); ?></label></div><div class="input"><input type="text" name="news_count" value="' + value + '"/></div>').appendTo(blockOptions);
				value = '';
				if(blockData['news_link'] !== undefined) {
					value = blockData['news_link'];
				}
				$('<div class="label"><label for=""><?php _e('All News Link', 'scalia'); ?></label></div><div class="input"><input type="text" name="news_link" value="' + value + '"/></div>').appendTo(blockOptions);
			}
			block.appendTo($("#<?php print $oname; ?>-control .active-blocks"));
			block.accordion({
				collapsible: true,
				active: false,
				header: '.title',
				heightStyle: 'content',
				beforeActivate: function(event, ui) {
					if($(this).hasClass('sortable')) {
						$(this).removeClass('sortable');
						return false;
					}
				}
			});
			$('select', block).combobox();
		}

		function scalia_active_blocks_builder() {
			if(default_data != '') {
				var content = default_data;
				for(i in content) {
					scalia_build_block(content[i]);
				}
			}
		}

		scalia_active_blocks_builder();

		$("#<?php print $oname; ?>-control .selectable-blocks .block").draggable({
			appendTo: '#home_content-control',
			helper: 'clone',
			start: function(event, ui) {
				$(ui.helper.get(0)).outerWidth($(ui.helper.context).outerWidth());
			}
		});

		$("#<?php print $oname; ?>-control .active-blocks").droppable({
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				var dataType = ui.draggable.attr('data-type');
				scalia_build_block({'block_type' : dataType});
			}
		}).sortable({
			items: ".block",
			update: function(event, ui) {
				ui.item.addClass('sortable');
			}
		});

		$($("#<?php print $oname; ?>").get(0).form).submit(function() {
			var build_array = new Object();
			$("#<?php print $oname; ?>-control .active-blocks .block").each(function() {
				var arr = {};
				$(':input', this).each(function() {
					arr[$(this).attr('name')] = $(this).val();
				});
				build_array[Object.keys(build_array).length] = arr;
			});
			$("#<?php print $oname; ?>").val(JSON.stringify(build_array));
		});

	});
})(jQuery);
</script>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

function scalia_color_skin_defaults($skin = '') {
	$skin_defaults = apply_filters('scalia_default_skins_options', array(
		'light' => array(
			'main_menu_font_family' => 'Roboto',
			'main_menu_font_style' => '300',
			'main_menu_font_sets' => '',
			'main_menu_font_size' => '17',
			'main_menu_line_height' => '20',
			'submenu_font_family' => 'Roboto',
			'submenu_font_style' => '300',
			'submenu_font_sets' => '',
			'submenu_font_size' => '17',
			'submenu_line_height' => '30',
			'styled_subtitle_font_family' => 'Source Sans Pro',
			'styled_subtitle_font_style' => '300',
			'styled_subtitle_font_sets' => '',
			'styled_subtitle_font_size' => '26',
			'styled_subtitle_line_height' => '31',
			'blog_post_title_font_family' => 'Source Sans Pro',
			'blog_post_title_font_style' => '300',
			'blog_post_title_font_sets' => '',
			'blog_post_title_font_size' => '40',
			'blog_post_title_line_height' => '42',
			'h1_font_family' => 'Roboto Condensed',
			'h1_font_style' => '300',
			'h1_font_sets' => '',
			'h1_font_size' => '80',
			'h1_line_height' => '114',
			'h2_font_family' => 'Roboto Condensed',
			'h2_font_style' => '300',
			'h2_font_sets' => '',
			'h2_font_size' => '48',
			'h2_line_height' => '68',
			'h3_font_family' => 'Roboto Condensed',
			'h3_font_style' => '300',
			'h3_font_sets' => '',
			'h3_font_size' => '36',
			'h3_line_height' => '51',
			'h4_font_family' => 'Roboto Condensed',
			'h4_font_style' => '300',
			'h4_font_sets' => '',
			'h4_font_size' => '29',
			'h4_line_height' => '41',
			'h5_font_family' => 'Roboto Condensed',
			'h5_font_style' => '300',
			'h5_font_sets' => '',
			'h5_font_size' => '24',
			'h5_line_height' => '34',
			'h6_font_family' => 'Roboto Condensed',
			'h6_font_style' => '300',
			'h6_font_sets' => '',
			'h6_font_size' => '20',
			'h6_line_height' => '28',
			'body_font_family' => 'Source Sans Pro',
			'body_font_style' => '300',
			'body_font_sets' => '',
			'body_font_size' => '19',
			'body_line_height' => '27',
			'widget_title_font_family' => 'Roboto Condensed',
			'widget_title_font_style' => '300',
			'widget_title_font_sets' => '',
			'widget_title_font_size' => '29',
			'widget_title_line_height' => '40',
			'button_font_family' => 'Roboto Condensed',
			'button_font_style' => '300',
			'button_font_sets' => '',
			'button_font_size' => '22',
			'button_line_height' => '34',
			'slideshow_title_font_family' => 'Roboto Condensed',
			'slideshow_title_font_style' => '300',
			'slideshow_title_font_sets' => '',
			'slideshow_title_font_size' => '80',
			'slideshow_title_line_height' => '100',
			'slideshow_description_font_family' => 'Roboto',
			'slideshow_description_font_style' => '100',
			'slideshow_description_font_sets' => '',
			'slideshow_description_font_size' => '36',
			'slideshow_description_line_height' => '50',
			'portfolio_title_font_family' => 'Roboto Condensed',
			'portfolio_title_font_style' => 'regular',
			'portfolio_title_font_sets' => '',
			'portfolio_title_font_size' => '21',
			'portfolio_title_line_height' => '30',
			'portfolio_description_font_family' => 'Source Sans Pro',
			'portfolio_description_font_style' => '300',
			'portfolio_description_font_sets' => '',
			'portfolio_description_font_size' => '17',
			'portfolio_description_line_height' => '24',
			'quickfinder_title_font_family' => 'Roboto Condensed',
			'quickfinder_title_font_style' => 'regular',
			'quickfinder_title_font_sets' => '',
			'quickfinder_title_font_size' => '21',
			'quickfinder_title_line_height' => '30',
			'quickfinder_description_font_family' => 'Source Sans Pro',
			'quickfinder_description_font_style' => '300',
			'quickfinder_description_font_sets' => '',
			'quickfinder_description_font_size' => '17',
			'quickfinder_description_line_height' => '24',
			'gallery_title_font_family' => 'Roboto Condensed',
			'gallery_title_font_style' => 'regular',
			'gallery_title_font_sets' => '',
			'gallery_title_font_size' => '21',
			'gallery_title_line_height' => '30',
			'gallery_description_font_family' => 'Source Sans Pro',
			'gallery_description_font_style' => '300',
			'gallery_description_font_sets' => '',
			'gallery_description_font_size' => '17',
			'gallery_description_line_height' => '24',
			'pricing_table_price_font_family' => 'Roboto',
			'pricing_table_price_font_style' => '300',
			'pricing_table_price_font_sets' => '',
			'pricing_table_price_font_size' => '56',
			'pricing_table_price_line_height' => '56',
			'testimonial_font_family' => 'Source Sans Pro',
			'testimonial_font_style' => '300italic',
			'testimonial_font_sets' => '',
			'testimonial_font_size' => '32',
			'testimonial_line_height' => '29',
			'counter_font_family' => 'Roboto',
			'counter_font_style' => '300',
			'counter_font_sets' => '',
			'counter_font_size' => '59',
			'counter_line_height' => '66',
			'woocommerce_price_font_family' => 'Roboto',
			'woocommerce_price_font_style' => '300',
			'woocommerce_price_font_sets' => '',
			'woocommerce_price_font_size' => '26',
			'woocommerce_price_line_height' => '36',
			'highlight_label_font_family' => 'Roboto Condensed',
			'highlight_label_font_style' => '300',
			'highlight_label_font_sets' => '',
			'highlight_label_font_size' => '21',
			'highlight_label_line_height' => '18',
			'basic_outer_background_color' => '#8b94a5',
			'basic_inner_background_color' => '#E8ECEF',
			'top_background_color' => '#ffffff',
			'main_background_color' => '#ffffff',
			'footer_background_color' => '#2c2e3a',
			'styled_elements_background_color' => '#f1f5f8',
			'styled_elements_color_1' => '#418f9a',
			'styled_elements_color_2' => '#58ABB7',
			'divider_default_color' => '#d2dae1',
			'box_border_color' => '#D2DAE1',
			'box_rounded_corners' => '1',
			'box_shadow_color' => '#627080',
			'highlight_label_color' => '#ff7070',
			'main_menu_text_color' => '#4C5867',
			'main_menu_hover_text_color' => '#58ABB7',
			'main_menu_active_text_color' => '#58ABB7',
			'main_menu_active_background_color' => '',
			'submenu_text_color' => '#4C5867',
			'submenu_hover_text_color' => '#58ABB7',
			'submenu_background_color' => '#ffffff',
			'submenu_hover_background_color' => '#f1f5f8',
			'mega_menu_icons_color' => '#99A3B0',
			'menu_shadow_color' => '#4C5867',
			'body_color' => '#384554',
			'h1_color' => '#4c5867',
			'h2_color' => '#4c5867',
			'h3_color' => '#4c5867',
			'h4_color' => '#4c5867',
			'h5_color' => '#4c5867',
			'h6_color' => '#4c5867',
			'link_color' => '#418f9a',
			'hover_link_color' => '#384554',
			'active_link_color' => '#418f9a',
			'footer_text_color' => '#ffffff',
			'copyright_text_color' => '#728194',
			'copyright_link_color' => '#ff7070',
			'title_bar_background_color' => '#58ABB7',
			'title_bar_text_color' => '#ffffff',
			'top_area_text_color' => '#384554',
			'date_filter_subtitle_color' => '#99a3b0',
			'system_icons_font' => '#99a3b0',
			'system_icons_font_2' => '#d2dae1',
			'button_text_basic_color' => '#ffffff',
			'button_text_hover_color' => '#ffffff',
			'button_text_active_color' => '#ffffff',
			'button_background_basic_color' => '#58abb7',
			'button_background_hover_color' => '#58abb7',
			'button_background_active_color' => '#58abb7',
			'widget_title_color' => '',
			'widget_link_color' => '#418f9a',
			'widget_hover_link_color' => '#384554',
			'widget_active_link_color' => '#384554',
			'footer_widget_area_background_color' => '',
			'footer_widget_title_color' => '#58abb7',
			'footer_widget_text_color' => '#f1f5f8',
			'footer_widget_link_color' => '#58abb7',
			'footer_widget_hover_link_color' => '#ffffff',
			'footer_widget_active_link_color' => '#ffffff',
			'portfolio_slider_arrow_color' => '#58abb7',
			'portfolio_title_background_color' => '',
			'portfolio_title_color' => '#4c5867',
			'portfolio_description_color' => '#627080',
			'portfolio_sharing_button_background_color' => '#384554',
			'portfolio_date_color' => '#99a3b0',
			'gallery_caption_background_color' => '',
			'gallery_title_color' => '',
			'gallery_description_color' => '',
			'slideshow_arrow_background' => '',
			'slideshow_arrow_color' => '#ff7070',
			'hover_effect_default_color' => '#58ABB7',
			'hover_effect_zooming_blur_color' => '#ffffff',
			'hover_effect_horizontal_sliding_color' => '#ff7070',
			'hover_effect_vertical_sliding_color' => '#384554',
			'quickfinder_bar_background_color' => '#ffffff',
			'quickfinder_bar_title_color' => '#4c5867',
			'quickfinder_bar_description_color' => '#384554',
			'quickfinder_title_color' => '#4c5867',
			'quickfinder_description_color' => '#384554',
			'bullets_symbol_color' => '#58ABB7',
			'icons_symbol_color' => '#58abb7',
			'pagination_border_color' => '#d2dae1',
			'pagination_text_color' => '#418f9a',
			'pagination_active_text_color' => '#ffffff',
			'pagination_active_background_color' => '#ff7070',
			'icons_slideshow_hovers_color' => '#ffffff',
			'mini_pagination_color' => '#d2dae1',
			'mini_pagination_active_color' => '#ff7070',
			'footer_social_color' => '#4c5867',
			'footer_social_hover_color' => '#ff7070',
			'top_area_icons_color' => '#99A3B0',
			'top_area_social_hover_color' => '#384554',
			'form_elements_background_color' => '#ffffff',
			'form_elements_text_color' => '#384554',
			'form_elements_border_color' => '#d2dae1',
			'basic_outer_background_image' => '',
			'basic_inner_background_image' => '',
			'top_background_image' => '',
			'main_background_image' => '',
			'footer_background_image' => '',
			'footer_widget_area_background_image' => get_template_directory_uri().'/images/footer-bg.png',
		)
	));
	if($skin) {
		return $skin_defaults['$skin'];
	}
	return $skin_defaults;
}

function scalia_first_install_settings() {
	return apply_filters('scalia_default_theme_options', array(
		'page_layout_style' => 'fullwidth',
		'menu_appearance_tablet_portrait' => 'responsive',
		'menu_appearance_tablet_landscape' => 'centered',
		'top_area_style' => '1',
		'top_area_search' => '1',
		'top_area_contacts' => '1',
		'top_area_socials' => '1',
		'logo' => get_template_directory_uri().'/images/default-logo.png',
		'small_logo' => get_template_directory_uri().'/images/default-logo-small.png',
		'logo_2x' => get_template_directory_uri().'/images/default-logo-2x.png',
		'small_logo_2x' => get_template_directory_uri().'/images/default-logo-small-2x.png',
		'logo_3x' => get_template_directory_uri().'/images/default-logo-3x.png',
		'small_logo_3x' => get_template_directory_uri().'/images/default-logo-small-3x.png',
		'logo_position' => 'left',
		'favicon' => get_template_directory_uri().'/images/favicon.ico',
		'preloader_style' => 'preloader-2',
		'custom_css' => 'body.home .slideshow-preloader {
	height: 600px;
}
@media (max-width: 1259px) {
	body.home .slideshow-preloader {
		height: 480px;
	}
}
@media (max-width: 979px) {
	body.home .slideshow-preloader {
		height: 360px;
	}
	body.home .sc-slideshow .sc-button {
		display: none !important;
	}
}
@media (max-width: 767px) {
	body.home .slideshow-preloader {
		height: 220px;
	}
}
@media (max-width: 480px) {
	body.home .slideshow-preloader {
	height: 140px;
	}
}

/*   Slide 1 - Linear Scale Animation   */ 

#Slide1_Scale {
	-o-animation: slide 16s infinite linear;
	-moz-animation: slide 16s infinite linear;
	-webkit-animation: slide 16s infinite linear;
	animation: slide 16s infinite linear;
}
@keyframes slide {
	0% { transform: rotate(0deg) scale(1);top: 0px; left: 0px;}
	100% { transform: rotate(0deg) scale(1);top: 0px; left: -502px;}
}
@-o-keyframes slide {
	0% { -o-transform: rotate(0deg) scale(1);top: 0px; left: 0px;}
	100% { -o-transform: rotate(0deg) scale(1);top: 0px; left: -502px;}
}
@-moz-keyframes slide {
	0% { -moz-transform: rotate(0deg) scale(1);top: 0px; left: 0px;}
	100% { -moz-transform: rotate(0deg) scale(1);top: 0px; left: -502px;}
}
@-webkit-keyframes slide {
	0% { -webkit-transform: rotate(0deg) scale(1);top: 0px; left: 0px;}
	100% { -webkit-transform: rotate(0deg) scale(1);top: 0px; left: -502px;}
}


/*   Slide 1 - Glass Neon Light Animation   */ 

#Slide1_GlassNeon {
	-o-animation: glass_neon 1.5s infinite linear;
	-moz-animation: glass_neon 1.5s infinite linear;
	-webkit-animation: glass_neon 1.5s infinite linear;
	animation: glass_neon 1.5s infinite linear;
}
@keyframes glass_neon {
	0% { opacity: 0.2; }
	15% { opacity: 1; }
	25% { opacity: 0.2; }
	30% { opacity: 0.2; }
	31% { opacity: 0.9; }
	50% { opacity: 0.3; }
	60% { opacity: 0.3; }
	65% { opacity: 1; }
	70% { opacity: 0.2; }
	71% { opacity: 0.6; }
	85% { opacity: 0.2; }
	100% { opacity: 1;}
}
@-o-keyframes glass_neon {
	0% { opacity: 0.2; }
	15% { opacity: 1; }
	25% { opacity: 0.2; }
	30% { opacity: 0.2; }
	31% { opacity: 0.9; }
	50% { opacity: 0.3; }
	60% { opacity: 0.3; }
	65% { opacity: 1; }
	70% { opacity: 0.2; }
	71% { opacity: 0.6; }
	85% { opacity: 0.2; }
	100% { opacity: 1;}
}
@-moz-keyframes glass_neon {
	0% { opacity: 0.2; }
	15% { opacity: 1; }
	25% { opacity: 0.2; }
	30% { opacity: 0.2; }
	31% { opacity: 0.9; }
	50% { opacity: 0.3; }
	60% { opacity: 0.3; }
	65% { opacity: 1; }
	70% { opacity: 0.2; }
	71% { opacity: 0.6; }
	85% { opacity: 0.2; }
	100% { opacity: 1;}
}
@-webkit-keyframes glass_neon {
	0% { opacity: 0.2; }
	15% { opacity: 1; }
	25% { opacity: 0.2; }
	30% { opacity: 0.2; }
	31% { opacity: 0.9; }
	50% { opacity: 0.3; }
	60% { opacity: 0.3; }
	65% { opacity: 1; }
	70% { opacity: 0.2; }
	71% { opacity: 0.6; }
	85% { opacity: 0.2; }
	100% { opacity: 1;}
}',
		'custom_js' => '',
		'google_fonts_file' => '',
		'main_menu_font_family' => 'Roboto',
		'main_menu_font_style' => '300',
		'main_menu_font_sets' => '',
		'main_menu_font_size' => '17',
		'main_menu_line_height' => '20',
		'submenu_font_family' => 'Roboto',
		'submenu_font_style' => '300',
		'submenu_font_sets' => '',
		'submenu_font_size' => '17',
		'submenu_line_height' => '30',
		'styled_subtitle_font_family' => 'Source Sans Pro',
		'styled_subtitle_font_style' => '300',
		'styled_subtitle_font_sets' => '',
		'styled_subtitle_font_size' => '26',
		'styled_subtitle_line_height' => '31',
		'blog_post_title_font_family' => 'Source Sans Pro',
		'blog_post_title_font_style' => '300',
		'blog_post_title_font_sets' => '',
		'blog_post_title_font_size' => '40',
		'blog_post_title_line_height' => '42',
		'h1_font_family' => 'Roboto Condensed',
		'h1_font_style' => '300',
		'h1_font_sets' => '',
		'h1_font_size' => '80',
		'h1_line_height' => '114',
		'h2_font_family' => 'Roboto Condensed',
		'h2_font_style' => '300',
		'h2_font_sets' => '',
		'h2_font_size' => '48',
		'h2_line_height' => '68',
		'h3_font_family' => 'Roboto Condensed',
		'h3_font_style' => '300',
		'h3_font_sets' => '',
		'h3_font_size' => '36',
		'h3_line_height' => '51',
		'h4_font_family' => 'Roboto Condensed',
		'h4_font_style' => '300',
		'h4_font_sets' => '',
		'h4_font_size' => '29',
		'h4_line_height' => '41',
		'h5_font_family' => 'Roboto Condensed',
		'h5_font_style' => '300',
		'h5_font_sets' => '',
		'h5_font_size' => '24',
		'h5_line_height' => '34',
		'h6_font_family' => 'Roboto Condensed',
		'h6_font_style' => '300',
		'h6_font_sets' => '',
		'h6_font_size' => '20',
		'h6_line_height' => '28',
		'body_font_family' => 'Source Sans Pro',
		'body_font_style' => '300',
		'body_font_sets' => '',
		'body_font_size' => '19',
		'body_line_height' => '27',
		'widget_title_font_family' => 'Roboto Condensed',
		'widget_title_font_style' => '300',
		'widget_title_font_sets' => '',
		'widget_title_font_size' => '29',
		'widget_title_line_height' => '40',
		'button_font_family' => 'Roboto Condensed',
		'button_font_style' => '300',
		'button_font_sets' => '',
		'button_font_size' => '22',
		'button_line_height' => '34',
		'slideshow_title_font_family' => 'Roboto Condensed',
		'slideshow_title_font_style' => '300',
		'slideshow_title_font_sets' => '',
		'slideshow_title_font_size' => '80',
		'slideshow_title_line_height' => '100',
		'slideshow_description_font_family' => 'Roboto',
		'slideshow_description_font_style' => '100',
		'slideshow_description_font_sets' => '',
		'slideshow_description_font_size' => '36',
		'slideshow_description_line_height' => '50',
		'portfolio_title_font_family' => 'Roboto Condensed',
		'portfolio_title_font_style' => 'regular',
		'portfolio_title_font_sets' => '',
		'portfolio_title_font_size' => '21',
		'portfolio_title_line_height' => '30',
		'portfolio_description_font_family' => 'Source Sans Pro',
		'portfolio_description_font_style' => '300',
		'portfolio_description_font_sets' => '',
		'portfolio_description_font_size' => '17',
		'portfolio_description_line_height' => '24',
		'quickfinder_title_font_family' => 'Roboto Condensed',
		'quickfinder_title_font_style' => 'regular',
		'quickfinder_title_font_sets' => '',
		'quickfinder_title_font_size' => '21',
		'quickfinder_title_line_height' => '30',
		'quickfinder_description_font_family' => 'Source Sans Pro',
		'quickfinder_description_font_style' => '300',
		'quickfinder_description_font_sets' => '',
		'quickfinder_description_font_size' => '17',
		'quickfinder_description_line_height' => '24',
		'gallery_title_font_family' => 'Roboto Condensed',
		'gallery_title_font_style' => 'regular',
		'gallery_title_font_sets' => '',
		'gallery_title_font_size' => '21',
		'gallery_title_line_height' => '30',
		'gallery_description_font_family' => 'Source Sans Pro',
		'gallery_description_font_style' => '300',
		'gallery_description_font_sets' => '',
		'gallery_description_font_size' => '17',
		'gallery_description_line_height' => '24',
		'pricing_table_price_font_family' => 'Roboto',
		'pricing_table_price_font_style' => '300',
		'pricing_table_price_font_sets' => '',
		'pricing_table_price_font_size' => '56',
		'pricing_table_price_line_height' => '56',
		'testimonial_font_family' => 'Source Sans Pro',
		'testimonial_font_style' => '300italic',
		'testimonial_font_sets' => '',
		'testimonial_font_size' => '32',
		'testimonial_line_height' => '29',
		'counter_font_family' => 'Roboto',
		'counter_font_style' => '300',
		'counter_font_sets' => '',
		'counter_font_size' => '59',
		'counter_line_height' => '66',
		'woocommerce_price_font_family' => 'Roboto',
		'woocommerce_price_font_style' => '300',
		'woocommerce_price_font_sets' => '',
		'woocommerce_price_font_size' => '26',
		'woocommerce_price_line_height' => '36',
		'highlight_label_font_family' => 'Roboto Condensed',
		'highlight_label_font_style' => '300',
		'highlight_label_font_sets' => '',
		'highlight_label_font_size' => '21',
		'highlight_label_line_height' => '18',
		'basic_outer_background_color' => '#8b94a5',
		'basic_inner_background_color' => '#E8ECEF',
		'top_background_color' => '#ffffff',
		'main_background_color' => '#ffffff',
		'footer_background_color' => '#2c2e3a',
		'styled_elements_background_color' => '#f1f5f8',
		'styled_elements_color_1' => '#418f9a',
		'styled_elements_color_2' => '#58ABB7',
		'divider_default_color' => '#d2dae1',
		'box_border_color' => '#D2DAE1',
		'box_rounded_corners' => '1',
		'box_shadow_color' => '#627080',
		'highlight_label_color' => '#ff7070',
		'main_menu_text_color' => '#4C5867',
		'main_menu_hover_text_color' => '#58ABB7',
		'main_menu_active_text_color' => '#58ABB7',
		'main_menu_active_background_color' => '',
		'submenu_text_color' => '#4C5867',
		'submenu_hover_text_color' => '#58ABB7',
		'submenu_background_color' => '#ffffff',
		'submenu_hover_background_color' => '#f1f5f8',
		'mega_menu_icons_color' => '#99A3B0',
		'menu_shadow_color' => '#4C5867',
		'body_color' => '#384554',
		'h1_color' => '#4c5867',
		'h2_color' => '#4c5867',
		'h3_color' => '#4c5867',
		'h4_color' => '#4c5867',
		'h5_color' => '#4c5867',
		'h6_color' => '#4c5867',
		'link_color' => '#418f9a',
		'hover_link_color' => '#384554',
		'active_link_color' => '#418f9a',
		'footer_text_color' => '#ffffff',
		'copyright_text_color' => '#728194',
		'copyright_link_color' => '#ff7070',
		'title_bar_background_color' => '#58ABB7',
		'title_bar_text_color' => '#ffffff',
		'top_area_text_color' => '#384554',
		'date_filter_subtitle_color' => '#99a3b0',
		'system_icons_font' => '#99a3b0',
		'system_icons_font_2' => '#d2dae1',
		'button_text_basic_color' => '#ffffff',
		'button_text_hover_color' => '#ffffff',
		'button_text_active_color' => '#ffffff',
		'button_background_basic_color' => '#58abb7',
		'button_background_hover_color' => '#58abb7',
		'button_background_active_color' => '#58abb7',
		'widget_title_color' => '',
		'widget_link_color' => '#418f9a',
		'widget_hover_link_color' => '#384554',
		'widget_active_link_color' => '#384554',
		'footer_widget_area_background_color' => '',
		'footer_widget_title_color' => '#58abb7',
		'footer_widget_text_color' => '#f1f5f8',
		'footer_widget_link_color' => '#58abb7',
		'footer_widget_hover_link_color' => '#ffffff',
		'footer_widget_active_link_color' => '#ffffff',
		'portfolio_slider_arrow_color' => '#58abb7',
		'portfolio_title_background_color' => '',
		'portfolio_title_color' => '#4c5867',
		'portfolio_description_color' => '#627080',
		'portfolio_sharing_button_background_color' => '#384554',
		'portfolio_date_color' => '#99a3b0',
		'gallery_caption_background_color' => '',
		'gallery_title_color' => '',
		'gallery_description_color' => '',
		'slideshow_arrow_background' => '',
		'slideshow_arrow_color' => '#ff7070',
		'hover_effect_default_color' => '#58ABB7',
		'hover_effect_zooming_blur_color' => '#ffffff',
		'hover_effect_horizontal_sliding_color' => '#ff7070',
		'hover_effect_vertical_sliding_color' => '#384554',
		'quickfinder_bar_background_color' => '#ffffff',
		'quickfinder_bar_title_color' => '#4c5867',
		'quickfinder_bar_description_color' => '#384554',
		'quickfinder_title_color' => '#4c5867',
		'quickfinder_description_color' => '#384554',
		'bullets_symbol_color' => '#58ABB7',
		'icons_symbol_color' => '#58abb7',
		'pagination_border_color' => '#d2dae1',
		'pagination_text_color' => '#418f9a',
		'pagination_active_text_color' => '#ffffff',
		'pagination_active_background_color' => '#ff7070',
		'icons_slideshow_hovers_color' => '#ffffff',
		'mini_pagination_color' => '#d2dae1',
		'mini_pagination_active_color' => '#ff7070',
		'footer_social_color' => '#4c5867',
		'footer_social_hover_color' => '#ff7070',
		'top_area_icons_color' => '#99A3B0',
		'top_area_social_hover_color' => '#384554',
		'form_elements_background_color' => '#ffffff',
		'form_elements_text_color' => '#384554',
		'form_elements_border_color' => '#d2dae1',
		'basic_outer_background_image' => '',
		'basic_inner_background_image' => '',
		'top_background_image' => '',
		'main_background_image' => '',
		'footer_background_image' => '',
		'footer_widget_area_background_image' => get_template_directory_uri().'/images/footer-bg.png',
		'home_content_enabled' => '0',
		'home_content' => '',
		'slider_effect' => 'random',
		'slider_slices' => '15',
		'slider_boxCols' => '8',
		'slider_boxRows' => '4',
		'slider_animSpeed' => '5',
		'slider_pauseTime' => '20',
		'slider_directionNav' => '1',
		'slider_controlNav' => '1',
		'show_author' => '1',
		'excerpt_length' => '20',
		'footer_active' => '1',
		'footer_html' => '2015 &copy; Copyrights CodexThemes',
		'contacts_address' => '19th Ave New York, NY 95822, USA',
		'contacts_phone' => '+1 916-875-2235',
		'contacts_fax' => '+1 916-875-2235',
		'contacts_email' => 'info@domain.tld',
		'contacts_website' => 'www.codex-themes.com',
		'admin_email' => '',
		'twitter_active' => '1',
		'facebook_active' => '1',
		'linkedin_active' => '1',
		'googleplus_active' => '1',
		'stumbleupon_active' => '1',
		'rss_active' => '1',
		'twitter_link' => '#',
		'facebook_link' => '#',
		'linkedin_link' => '#',
		'googleplus_link' => '#',
		'stumbleupon_link' => '#',
		'rss_link' => '#',
		'show_social_icons' => '1'
	));
}

/* Create admin theme page */
function scalia_theme_add_page() {
	$page = add_theme_page(__('Scalia theme options','scalia'), __('Theme options','scalia'), 'edit_theme_options', 'options-framework', 'scalia_theme_options_page');
}
add_action( 'admin_menu', 'scalia_theme_add_page');

function scalia_theme_options_admin_enqueue_scripts($hook) {
	if($hook != 'appearance_page_options-framework') return;
	wp_enqueue_media();
	wp_enqueue_script('scalia-combobox', get_template_directory_uri() . '/js/combobox.js', array('jquery'));
	wp_enqueue_script('scalia-checkbox', get_template_directory_uri() . '/js/checkbox.js', array('jquery'));
	wp_enqueue_script('scalia-image-selector', get_template_directory_uri() . '/js/image-selector.js', array('jquery'));
	wp_enqueue_script('scalia-file-selector', get_template_directory_uri() . '/js/file-selector.js', array('jquery'));
	wp_enqueue_script('scalia-font-options', get_template_directory_uri() . '/js/font-options.js', array('jquery'));
	wp_enqueue_script('scalia-theme-options', get_template_directory_uri() . '/js/theme_options.js', array('jquery-ui-position', 'jquery-ui-tabs', 'jquery-ui-slider', 'jquery-ui-accordion', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable'));
	wp_localize_script('scalia-theme-options', 'theme_options_object',array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce('ajax_security'),
		'text1' => __('Get all from font.', 'scalia'),
		'scalia_color_skin_defaults' => json_encode(scalia_color_skin_defaults()),
		'text2' => __('et colors, backgrounds and fonts options to default?', 'scalia'),
		'text3' => __('Update backup data?', 'scalia'),
		'text4' => __('Restore settings from backup data?', 'scalia'),
		'text5' => __('Import settings?', 'scalia'),
	));
}
add_action('admin_enqueue_scripts', 'scalia_theme_options_admin_enqueue_scripts');

/* Build admin theme page form */
function scalia_theme_options_page(){
	$jQuery_ui_theme = 'ui-no-theme';
	$options = scalia_get_theme_options();
	$options_values = get_option('scalia_theme_options');
?>
<div class="wrap">
	<div class="theme-title">
		<img class="right-part" src="<?php echo get_template_directory_uri(); ?>/images/admin-images/theme-options-title-right.png" alt="Codex Tuner" />
		<img class="left-part" src="<?php echo get_template_directory_uri(); ?>/images/admin-images/theme-options-title-left.png" alt="Theme Options. scalia Business." />
		<div style="clear: both;"></div>
	</div>
	<form id="theme-options-form" method="POST">
		<div class="option-wrap <?php echo esc_attr($jQuery_ui_theme); ?>">
			<div class="submit_buttons"><button name="action" value="save"><?php _e( 'Save Changes', 'scalia' ); ?></button></div>
			<div id="categories">

				<?php if(count($options) > 0) : ?>
					<ul class="styled">
						<?php foreach($options as $name => $category) : ?>
							<?php if(isset($category['subcats']) && count($category['subcats']) > 0) : ?>
								<li><a href="<?php echo esc_url('#'.$name); ?>" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/admin-images/<?php print $name; ?>_icon.png');"><?php print $category['title']; ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
						<li><a href="#backup" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/admin-images/backup_icon.png');"><?php _e('Backup', 'scalia'); ?></a></li>
					</ul>
				<?php endif; ?>

				<?php if(count($options) > 0) : ?>
					<?php foreach($options as $name => $category) : ?>
						<?php if(isset($category['subcats']) && count($category['subcats']) > 0) : ?>
							<div id="<?php echo esc_attr($name); ?>">
								<div class="subcategories">

									<?php foreach($category['subcats'] as $sname => $subcat) : ?>
										<div id="<?php echo esc_attr($sname); ?>">
											<h3><?php echo $subcat['title']; ?></h3>
											<div class="inside">
												<?php foreach($subcat['options'] as $oname => $option) : ?>
													<?php echo scalia_get_option_element($oname, $option, isset($options_values[$oname]) ? $options_values[$oname] : NULL); ?>
												<?php endforeach; ?>
											</div>
										</div>
									<?php endforeach; ?>

								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>

					<div id="backup">
						<div class="subcategories">

								<div id="backup_theme_options">
									<h3><?php _e('Backup and Restore Theme Settings', 'scalia'); ?></h3>
									<div class="inside">
										<div class="option backup_restore_settings">
											<p><?php _e('If you would like to experiment with the settings of your theme and don\'t want to loose your previous settings, use the "Backup Settings"-button to backup your current theme options. You can restore these options later using the button "Restore Settings".', 'scalia'); ?></p>
											<?php if($backup = get_option('scalia_theme_options_backup')) : ?>
												<p><b><?php _e('Last backup', 'scalia'); ?>: <?php echo date('Y-m-d H:i', $backup['date']) ?></b></p>
											<?php else : ?>
												<p><b><?php _e('Last backup', 'scalia'); ?>: <?php _e('No backups yet', 'scalia'); ?></b></p>
											<?php endif; ?>
											<div class="backups-buttons">
												<button name="action" value="backup"><?php _e( 'Backup Settings', 'scalia' ); ?></button>
												<button name="action" value="restore"><?php _e( 'Restore Settings', 'scalia' ); ?></button>
											</div>
										</div>
										<div class="option import_settings">
											<p><?php _e('In order to apply the settings of another scalia theme used in a different install just copy and paste the settings in the text box and click on "Import Settings".', 'scalia'); ?></p>
											<div class="textarea">
												<textarea name="import_settings" cols="100" rows="8"><?php if($settings = get_option('scalia_theme_options')) { echo base64_encode(serialize($settings)); } ?></textarea>
											</div>
											<p>&nbsp;</p>
											<div class="backups-buttons">
												<button name="action" value="import"><?php _e( 'Import Settings', 'scalia' ); ?></button>
											</div>
										</div>
									</div>
								</div>

						</div>
					</div>

				<?php endif; ?>

			</div>
			<div class="submit_buttons"><button name="action" value="reset"><?php _e( 'Reset Style Settings', 'scalia' ); ?></button><button name="action" value="save"><?php _e( 'Save Changes', 'scalia' ); ?></button></div>
		</div>
	</form>
</div>
<?php
}

/* Update theme options */
add_action('admin_menu', 'scalia_theme_update_options');
function scalia_theme_update_options() {
	if(isset($_GET['page']) && $_GET['page'] == 'options-framework') {
		if(isset($_REQUEST['action']) && isset($_REQUEST['theme_options'])) {
			if($_REQUEST['action'] == 'save') {
				$theme_options = $_REQUEST['theme_options'];
				if(defined('ICL_LANGUAGE_CODE')) {
					$ml_options = array('home_content', 'footer_html', 'contacts_title', 'contacts_html', 'follow_title', 'follow_us_text');
					foreach ($ml_options as $ml_option) {
						$value = scalia_get_option($ml_option, false, true);
						if(!is_array($value)) {
							global $sitepress;
							if($sitepress->get_default_language()) {
								$value = array($sitepress->get_default_language() => $value);
							}
						}
						$value[ICL_LANGUAGE_CODE] = $theme_options[$ml_option];
						$theme_options[$ml_option] = $value;
					}
				}
				update_option('scalia_theme_options', $theme_options);
				scalia_generate_custom_css();
			} elseif($_REQUEST['action'] == 'reset') {
				if($options = get_option('scalia_theme_options')) {
					$defaults = scalia_color_skin_defaults();
					if(!($skin = scalia_get_option('page_color_style'))) {
						$skin = 'light';
					}
					$newOptions = array();
					foreach($defaults[$skin] as $key => $val) {
						$newOptions[$key] = $val;
					}
					$options = array_merge($options, $newOptions);
					update_option('scalia_theme_options', $options);
					scalia_generate_custom_css();
				}

			} elseif($_REQUEST['action'] == 'backup') {
				if($settings = get_option('scalia_theme_options')) {
					update_option('scalia_theme_options_backup', array('date' => time(), 'settings' => base64_encode(serialize($settings))));
				}
			} elseif($_REQUEST['action'] == 'restore') {
				if($settings = get_option('scalia_theme_options_backup')) {
					update_option('scalia_theme_options', unserialize(base64_decode($settings['settings'])));
					scalia_generate_custom_css();
				}
			} elseif($_REQUEST['action'] == 'import') {
				update_option('scalia_theme_options', unserialize(base64_decode($_REQUEST['import_settings'])));
				scalia_generate_custom_css();
			}
			wp_redirect(admin_url('themes.php?page=options-framework'));
		}
	}
}

/* Get theme option*/
if(!function_exists('scalia_get_option')) {
function scalia_get_option($name, $default = false, $ml_full = false) {
	$options = get_option('scalia_theme_options');
	if(isset($options[$name])) {
		$ml_options = array('home_content', 'footer_html');
		if(in_array($name, $ml_options) && is_array($options[$name]) && !$ml_full) {
			if(defined('ICL_LANGUAGE_CODE')) {
				global $sitepress;
				if(isset($options[$name][ICL_LANGUAGE_CODE])) {
					$options[$name] = $options[$name][ICL_LANGUAGE_CODE];
				} elseif($sitepress->get_default_language() && isset($options[$name][$sitepress->get_default_language()])) {
					$options[$name] = $options[$name][$sitepress->get_default_language()];
				} else {
					$options[$name] = '';
				}
			}else {
				$options[$name] = reset($options[$name]);
			}
		}
		return apply_filters('scalia_option_'.$name, $options[$name]);
	}
	return apply_filters('scalia_option_'.$name, $default);
}
}

function scalia_generate_custom_css() {
	ob_start();
	scalia_custom_fonts();
	require get_template_directory() . '/inc/custom-css.php';
	if(file_exists(get_stylesheet_directory() . '/inc/custom-css.php') && get_stylesheet_directory() != get_template_directory()) {
		require get_stylesheet_directory() . '/inc/custom-css.php';
	}
	$custom_css = ob_get_clean();
	file_put_contents(get_stylesheet_directory() . '/css/custom.css', $custom_css);
}

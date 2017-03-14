<?php
/**
 * SKT bakery Theme Customizer
 *
 * @package SKT Bakery
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function skt_bakery_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class skt_bakery_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	
	class WP_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
 
    public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
    }
}
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control('header_textcolor');
	$wp_customize->remove_control('display_header_text');
	
	$wp_customize->add_section(
        'logo_sec',
        array(
            'title' => __('Logo (PRO Version)', 'skt_bakery'),
            'priority' => 1,
 			'description' => sprintf( __( 'Logo Settings available in<br /> %s.', 'skt_bakery' ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( '"'.SKT_PRO_THEME_URL.'"' ), __( 'PRO Version', 'skt_bakery' )
						)
					),			
        )
    );  
    $wp_customize->add_setting('skt_bakery_options[logo-info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new skt_bakery_Info( $wp_customize, 'logo_section', array(
        'section' => 'logo_sec',
        'settings' => 'skt_bakery_options[logo-info]',
        'priority' => null
        ) )
    );
	
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#ff6d84',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','skt_bakery'),
 			'description' => sprintf( __( 'More color options in<br /> %s.', 'skt_bakery' ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( '"'.SKT_PRO_THEME_URL.'"' ), __( 'PRO Version', 'skt_bakery' )
						)
					),			
			
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	$wp_customize->add_section('footer_text',array(
			'title'	=> __('Footer Text','skt_bakery'),
			'priority'	=> null,
			'description'	=> __('Add footer copyright text','skt_bakery')
	));
	
	$wp_customize->add_setting('skt_bakery_options[credit-info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new skt_bakery_Info( $wp_customize, 'cred_section', array(
        'section' => 'footer_text',
		'label'	=> __('To remove credit &amp; copyright text upgrade to PRO version','skt_bakery'),
        'settings' => 'skt_bakery_options[credit-info]',
        ) )
    );
	
	$wp_customize->add_section('slider_section',array(
		'title'	=> __('Slider Settings','skt_bakery'),
 		'description' => sprintf( __( 'Featured Image Size (1600x705)<br /> More slider settings available in <br /> %s.', 'skt_bakery' ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( '"'.SKT_PRO_THEME_URL.'"' ), __( 'PRO Version', 'skt_bakery' )
						)
					),		
		'priority'		=> null
	));
	
// Slider Section

	$wp_customize->add_setting('page-setting7',array(
			'sanitize_callback'	=> 'skt_bakery_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','skt_bakery'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'sanitize_callback'	=> 'skt_bakery_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','skt_bakery'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'sanitize_callback'	=> 'skt_bakery_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','skt_bakery'),
			'section'	=> 'slider_section'
	));	
 
// Slider Section


// Home Boxes 	
	$wp_customize->add_section('page_boxes',array(
		'title'	=> __('Home Boxes','skt_bakery'),
		'description'	=> __('Select Pages from the dropdown','skt_bakery'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting(
    'page-setting1',
		array(
			'sanitize_callback' => 'skt_bakery_sanitize_integer',
		)
	);
 
	$wp_customize->add_control(
		'page-setting1',
		array(
			'type' => 'dropdown-pages',
			'label' => __('Select section page:','skt_bakery'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_setting('page-setting2',array(
			'sanitize_callback'	=> 'skt_bakery_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting2',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box one:','skt_bakery'),
			'section'	=> 'page_boxes'	
	));
	
	$wp_customize->add_setting('page-setting3',array(
			'sanitize_callback'	=> 'skt_bakery_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting3',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box two:','skt_bakery'),
			'section'	=> 'page_boxes'
	));
	
	$wp_customize->add_setting('page-setting4',array(
			'sanitize_callback'	=> 'skt_bakery_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting4',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box three:','skt_bakery'),
			'section'	=> 'page_boxes'
	));	
	
	$wp_customize->add_setting('page-setting5',array(
			'sanitize_callback'	=> 'skt_bakery_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting5',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box four:','skt_bakery'),
			'section'	=> 'page_boxes'
	));	
		
// Home Boxes
	
	$wp_customize->add_section('social_sec',array(
			'title'	=> __('Social Settings','skt_bakery'),
 			'description' => sprintf( __( 'Add social icons link here <br /> More icon available in <br /> %s.', 'skt_bakery' ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( '"'.SKT_PRO_THEME_URL.'"' ), __( 'PRO Version', 'skt_bakery' )
						)
					),			
			'priority'		=> null
	));
	
	$wp_customize->add_setting('fb_link',array(
			'default'	=> '#facebook',
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('fb_link',array(
			'label'	=> __('Add facebook link here','skt_bakery'),
			'setting'	=> 'fb_link',
			'section'	=> 'social_sec'
	));
	
	$wp_customize->add_setting('twitt_link',array(
			'default'	=> '#twitter',
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitt_link',array(
			'label'	=> __('Add twitter link here','skt_bakery'),
			'setting'	=> 'twitt_link',
			'section'	=> 'social_sec'
	));
	
	$wp_customize->add_setting('gplus_link',array(
			'default'	=> '#gplus',
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('gplus_link',array(
			'label'	=> __('Add google plus link here','skt_bakery'),
			'setting'	=> 'gplus_link',
			'section'	=> 'social_sec'
	));
	
	$wp_customize->add_setting('linked_link',array(
			'default'	=> '#linkedin',
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('linked_link',array(
			'label'	=> __('Add linkedin link here','skt_bakery'),
			'setting'	=> 'linked_link',
			'section'	=> 'social_sec'
	));
	
	$wp_customize->add_section('contact_sec',array(
			'title'	=> __('Contact Details','skt_bakery'),
			'description'	=> __('Add you contact details here','skt_bakery'),
			'priority'	=> null
	));
	
	$wp_customize->add_setting('contact_title',array(
			'default'	=> __('Our Location','skt_bakery'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('contact_title',array(
			'label'	=> __('Add contact title here','skt_bakery'),
			'setting'	=> 'contact_title',
			'section'	=> 'contact_sec'
	));
	
	$wp_customize->add_setting('contact_desc',array(
			'default'	=> __('Lorem Ipsum is simply dummy text of the printing and typesetting industry.','skt_bakery'),
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'contact_desc',
			array(
				'label'	=> __('Add contact description here','skt_bakery'),
				'setting'	=> 'contact_desc',
				'section'	=> 'contact_sec'
			)
		)
	);
	
	$wp_customize->add_setting('contact_no',array(
			'default'	=> __('+9876543210','skt_bakery'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('contact_no',array(
			'label'	=> __('Add contact number here.','skt_bakery'),
			'setting'	=> 'contact_no',
			'section'	=> 'contact_sec'
	));
	
	$wp_customize->add_setting('contact_mail',array(
			'default'	=> 'contact@company.com',
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('contact_mail',array(
			'label'	=> __('Add you email here','skt_bakery'),
			'setting'	=> 'contact_mail',
			'section'	=> 'contact_sec'
	));
	
	$wp_customize->add_section(
        'theme_layout_sec',
        array(
            'title' => __('Layout Settings (PRO Version)', 'skt_bakery'),
            'priority' => null,
 			'description' => sprintf( __( 'Layout Settings available in <br /> %s.', 'skt_bakery' ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( '"'.SKT_PRO_THEME_URL.'"' ), __( 'PRO Version', 'skt_bakery' )
						)
					),				
        )
    );  
    $wp_customize->add_setting('skt_bakery_options[layout-info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new skt_bakery_Info( $wp_customize, 'layout_section', array(
        'section' => 'theme_layout_sec',
        'settings' => 'skt_bakery_options[layout-info]',
        'priority' => null
        ) )
    );
	
	$wp_customize->add_section(
        'theme_font_sec',
        array(
            'title' => __('Fonts Settings (PRO Version)', 'skt_bakery'),
            'priority' => null,
 			'description' => sprintf( __( 'Font Settings available in <br /> %s.', 'skt_bakery' ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( '"'.SKT_PRO_THEME_URL.'"' ), __( 'PRO Version', 'skt_bakery' )
						)
					),			
        )
    );  
    $wp_customize->add_setting('skt_bakery_options[font-info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new skt_bakery_Info( $wp_customize, 'font_section', array(
        'section' => 'theme_font_sec',
        'settings' => 'skt_bakery_options[font-info]',
        'priority' => null
        ) )
    );
	
    $wp_customize->add_section(
        'theme_doc_sec',
        array(
            'title' => __('Documentation &amp; Support', 'skt_bakery'),
            'priority' => null,
 			'description' => sprintf( __( 'For documentation and support check this link <br /> %s.', 'skt_bakery' ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( '"'.SKT_THEME_DOC.'"' ), __( 'SKT Bakery Documentation', 'skt_bakery' )
						)
					),			
        )
    );  
    $wp_customize->add_setting('skt_bakery_options[info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new skt_bakery_Info( $wp_customize, 'doc_section', array(
        'section' => 'theme_doc_sec',
        'settings' => 'skt_bakery_options[info]',
        'priority' => 10
        ) )
    );
	
	
}
add_action( 'customize_register', 'skt_bakery_customize_register' );

//Integer
function skt_bakery_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function skt_bakery_custom_css(){
		?>
        	<style type="text/css">
					.feature-box-main h2,
					.feature-box h2,
					.section-title,
					#footer .widget-column h2,
					.morebtn:hover,
					#sidebar aside ul li a:hover,
					.recent-post-title a:hover,
					#copyright a,
					.foot-label,
					.theme-default .nivo-caption a:hover,
					.latest-blog span a,
					.postmeta a:hover, 
					a, 
					#footer .widget-column a:hover, 
					#copyright a:hover,
					.blog-post-repeat .entry-summary a, 
					.entry-content a,
					#sidebar aside h3.widget-title,
					.blog-post-repeat .blog-title a{
						color:<?php echo get_theme_mod('color_scheme','#ff6d84'); ?>;
					}
					.slide_more a:hover, .morebtn:hover{
						border-color:<?php echo get_theme_mod('color_scheme','#ff6d84'); ?>;
					}
					.yes,
					.theme-default .nivo-controlNav a.active,
					.site-nav li:hover ul li:hover, 
					.site-nav li:hover ul li.current-page-item,
					.site-nav li:hover ul li,
					p.form-submit input[type="submit"],
					#sidebar aside.widget_search input[type="submit"], 
					.wpcf7 input[type="submit"], 
					.pagination ul li .current, .pagination ul li a:hover{
						background-color:<?php echo get_theme_mod('color_scheme','#60646d'); ?>
					}
					.site-nav li:hover a, 
					.site-nav li.current_page_item a,
 					.site-nav li:hover ul li:hover, 
					.site-nav li:hover ul li.current-page-item,
					.site-nav li:hover ul li{
						color:<?php echo get_theme_mod('color_scheme','#ff6d84'); ?>
					}					
			</style>
	<?php }
add_action('wp_head','skt_bakery_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function skt_bakery_customize_preview_js() {
	wp_enqueue_script( 'skt_bakery_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'skt_bakery_customize_preview_js' );


function skt_bakery_custom_customize_enqueue() {
	wp_enqueue_script( 'skt-bakery-custom-customize', get_template_directory_uri() . '/js/custom.customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'skt_bakery_custom_customize_enqueue' );
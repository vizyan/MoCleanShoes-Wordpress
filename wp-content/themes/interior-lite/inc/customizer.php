<?php
/**
 * SKT Interior Lite Theme Customizer
 *
 * @package SKT Interior Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function interior_lite_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class interior_lite_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }

function interior_lite_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#ffae00',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','interior-lite'),						
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	// Slider Section		
	$wp_customize->add_section(
        'slider_section',
        array(
            'title' => __('Slider Settings', 'interior-lite'),
            'priority' => null,
            'description' => __( 'Featured Image Size Should be ( 1400x692 ) [ This only work when static front page is selected. ]', 'interior-lite' ),			
        )
    );
	
	$wp_customize->add_setting('page-setting7',array(
			'sanitize_callback'	=> 'interior_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','interior-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'sanitize_callback'	=> 'interior_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','interior-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'sanitize_callback'	=> 'interior_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','interior-lite'),
			'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('hide_slides',array(
			'default' => true,
			'sanitize_callback' => 'interior_lite_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'hide_slides', array(
		   'settings' => 'hide_slides',
    	   'section'   => 'slider_section',
    	   'label'     => __('Uncheck This Option To Display Slider','interior-lite'),
    	   'type'      => 'checkbox'
     ));		
		// Slider Section
	
	// Homepage Four Boxes Section 	
	$wp_customize->add_section('homepage_boxes_section', array(
		'title'	=> __('Homepage Four Boxes Section','interior-lite'),
		'description'	=> __('Select Pages from the dropdown for homepage four boxes section [ This only work when static front page is selected. ]','interior-lite'),
		'priority'	=> null
	));	
	
	$wp_customize->add_setting('section_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('section_title',array(
			'label'	=> __('Add title for section title','interior-lite'),
			'section'	=> 'homepage_boxes_section',
			'setting'	=> 'section_title'
	));	
	
	
	$wp_customize->add_setting('page-column1',	array(
			'sanitize_callback' => 'interior_lite_sanitize_integer',
		));
 
	$wp_customize->add_control(	'page-column1',array('type' => 'dropdown-pages',
			'section' => 'homepage_boxes_section',
	));	
	
	
	$wp_customize->add_setting('page-column2',	array(
			'sanitize_callback' => 'interior_lite_sanitize_integer',
		));
 
	$wp_customize->add_control(	'page-column2',array('type' => 'dropdown-pages',
			'section' => 'homepage_boxes_section',
	));
	
	$wp_customize->add_setting('page-column3',	array(
			'sanitize_callback' => 'interior_lite_sanitize_integer',
		));
 
	$wp_customize->add_control(	'page-column3',array('type' => 'dropdown-pages',
			'section' => 'homepage_boxes_section',
	));	
	
	
	$wp_customize->add_setting('page-column4',	array(
			'sanitize_callback' => 'interior_lite_sanitize_integer',
		));
 
	$wp_customize->add_control(	'page-column4',array('type' => 'dropdown-pages',
			'section' => 'homepage_boxes_section',
	));
	
	$wp_customize->add_setting('hide_boxes',array(
			'default' => true,
			'sanitize_callback' => 'interior_lite_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'hide_boxes', array(
		   'settings' => 'hide_boxes',
    	   'section'   => 'homepage_boxes_section',
    	   'label'     => __('Uncheck This Option To Display This Section','interior-lite'),
    	   'type'      => 'checkbox'
     ));	
	
		//end homepage boxes ection
	
	$wp_customize->add_section('social_sec',array(
			'title'	=> __('Social Settings','interior-lite'),						
			'priority'		=> null
	));
	
	$wp_customize->add_setting('social_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('social_title',array(
			'label'	=> __('Add title for footer follow us title','interior-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'social_title'
	));	
	
	
	$wp_customize->add_setting('fb_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('fb_link',array(
			'label'	=> __('Add facebook link here','interior-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'fb_link'
	));	
	$wp_customize->add_setting('twitt_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitt_link',array(
			'label'	=> __('Add twitter link here','interior-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'twitt_link'
	));
	$wp_customize->add_setting('gplus_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gplus_link',array(
			'label'	=> __('Add google plus link here','interior-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'gplus_link'
	));
	$wp_customize->add_setting('linked_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('linked_link',array(
			'label'	=> __('Add linkedin link here','interior-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'linked_link'
	));
	
	$wp_customize->add_section('contact_sec',array(
			'title'	=> __('Contact Details','interior-lite'),
			'description'	=> __('Add you contact details here','interior-lite'),
			'priority'	=> null
	));	
	$wp_customize->add_setting('contact_no',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('contact_no',array(
			'label'	=> __('Add contact number here.','interior-lite'),
			'section'	=> 'contact_sec',
			'setting'	=> 'contact_no'
	));
	$wp_customize->add_setting('contact_mail',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('contact_mail',array(
			'label'	=> __('Add you email here','interior-lite'),
			'section'	=> 'contact_sec',
			'setting'	=> 'contact_mail'
	));
}
add_action( 'customize_register', 'interior_lite_customize_register' );

//Integer
function interior_lite_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function interior_lite_custom_css(){
		?>
        	<style type="text/css"> 
					
					a, .blog_lists h2 a:hover,
					#sidebar ul li a:hover,								
					.footermenu ul li a:hover, .footermenu ul li.current_page_item a,							
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a,											
					.postmeta a:hover,
					.phoneemail a:hover, .logo h1		
					{ color:<?php echo esc_attr(get_theme_mod('color_scheme','#ffae00')); ?>;}
					 
					
					.pagination ul li .current, .pagination ul li a:hover, 
					#commentform input#submit:hover,					
					.nivo-controlNav a.active,				
					h3.widget-title,				
					.wpcf7 input[type='submit'],				
					.MoreLink:hover
					{ background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#ffae00')); ?>;}	
				
					.social-icons a:hover
					{ border-color:<?php echo esc_attr(get_theme_mod('color_scheme','#ffae00')); ?>;}
					
			</style> 
<?php   
}
         
add_action('wp_head','interior_lite_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
 
function interior_lite_customize_preview_js() {
	wp_enqueue_script( 'interior_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'interior_lite_customize_preview_js' );

function interior_lite_custom_customize_enqueue() {
	wp_enqueue_script( 'interior-lite-custom-customize', get_template_directory_uri() . '/js/custom-customize.js', array( 'jquery', 'customize-controls' ), false, true );
	wp_localize_script( 'custom-customize', 'custom_customize_vars', array('.accordion-section-title' => __('Upgrade to PRO Version', 'interior-lite')
		));
} 
add_action( 'customize_controls_enqueue_scripts', 'interior_lite_custom_customize_enqueue' );
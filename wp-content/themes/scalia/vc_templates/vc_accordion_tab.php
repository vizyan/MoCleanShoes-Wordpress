<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer")
), $atts));

global $vc_manager;

if($vc_manager->mode() == 'admin_frontend_editor' || $vc_manager->mode() == 'admin_page' || $vc_manager->mode() == 'page_editable') {
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );
	$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
	$output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header"><a href="#'.sanitize_title($title).'">'.$title.'</a></h3>';
	$output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content vc_clearfix">';
	$output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
	$output .= "\n\t\t\t\t" . '</div>';
	$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";
} else {
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'sc_accordion_section group', $this->settings['base'], $atts );
	$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
	$output .= "\n\t\t\t\t" . '<div class="sc_accordion_header ui-accordion-header"><a href="#'.sanitize_title($title).'">'.$title.'</a></div>';
	$output .= "\n\t\t\t\t" . '<div class="sc_accordion_content ui-accordion-content vc_clearfix">';
	$output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
	$output .= "\n\t\t\t\t" . '</div>';
	$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.sc_accordion_section') . "\n";
}

echo $output;

<?php
/**
 *	Set ACF Options pages here
 */

function init_acf_options() {
	// Put everything here if you want to use translations

	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'Theme Settings',
			'menu_title'	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-settings',
			'capability'	=> 'edit_posts'
		));
	}
}
add_action('acf/init', 'init_acf_options');

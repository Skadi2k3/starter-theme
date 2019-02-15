<?php
/**
 * The Template for the sidebar containing the main widget area
 *
 * @package  WordPress
 * @subpackage  Timber
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$context = [];
$context['widgets'] = Timber::get_widgets( 'sidebar-1' ); // when removing update functions.php

// add whatever to context

Timber::render( array( 'sidebar.twig' ), $context );

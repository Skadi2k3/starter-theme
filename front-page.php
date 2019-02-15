<?php
/**
 * The front-page
 */

$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['posts'] = new Timber\PostQuery(array(
	'post_type' => 'post',
	'posts_per_page' => 5,
	'paged' => $paged
));
$templates = array( 'front-page.twig', 'index.twig' );
Timber::render( $templates, $context );

<?php
/**
 * The Template for the sidebar containing the main widget area
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$context = [
  'data' => json_encode($data)
];

Timber::render( array( 'sidebar.twig' ), $context );

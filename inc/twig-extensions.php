<?php

/** This Would return 'foo bar!'.
 *
 * @param string $text being 'foo', then returned 'foo bar!'.
 */
function starter_theme_twig_extension_myfoo( $text ) {
  $text .= ' bar!';
  return $text;
}

/** This is where you can add your own functions to twig.
 *
 * @param string $twig get extension.
 */
function starter_theme_add_to_twig( $twig ) {
  $twig->addExtension( new Twig_Extension_StringLoader() );
  $twig->addFilter( new Twig_SimpleFilter( 'myfoo', 'starter_theme_twig_extension_myfoo' ) );
  return $twig;
}
add_filter( 'get_twig', 'starter_theme_add_to_twig' );
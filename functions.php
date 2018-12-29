<?php

require_once(__DIR__ . '/vendor/autoload.php');
$timber = new Timber\Timber();	// Initialize Timber

/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	});

	add_filter('template_include', function( $template ) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/** This is where you add some context
 *
 * @param string $context context['this'] Being the Twig's {{ this }}.
 */
function add_to_context( $context ) {
	$context['foo'] = 'bar';
	$context['stuff'] = 'I am a value set in your functions.php file';
	$context['notes'] = 'These values are available everytime you call Timber::get_context();';
	$context['widget_sidebar'] = Timber::get_widgets( 'widget_sidebar' );
	$context['menu'] = new Timber\Menu();
	$context['site'] = new Timber\Site();
	return $context;
}
add_filter( 'timber_context', 'add_to_context' );

/** This is where you enqueue your styles and scripts */
function enqueue_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( 'start-theme-style', get_theme_file_uri( '/static/styles/main.css' ) );
	wp_enqueue_script( 'start-theme-site', get_theme_file_uri( '/static/scripts/site.js' ), array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );


function theme_supports() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	add_theme_support( 'menus' );
}
add_action( 'after_setup_theme', 'theme_supports' );

/** This is where you can register custom post types. */
function register_post_types() {

}
add_action( 'init', 'register_post_types' );

/** This is where you can register custom taxonomies. */
function register_taxonomies() {

}
add_action( 'init', 'register_taxonomies' );

/** This is where you can register misc stuff */
function starter_theme_register_sidebars() {
	register_sidebar([
		'name' => 'User customizable Sidebar',
		'id' => 'widget_sidebar'
	]);
}
add_action( 'widgets_init', 'starter_theme_register_sidebars' );

/** remove the wordpress number in the head */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');

/**
 * Remove the Emoji Support
 */
function remove_emoji()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'remove_tinymce_emoji');
}
add_action('init', 'remove_emoji');
function remove_tinymce_emoji($plugins) {
	if (!is_array($plugins)) {
		return array();
	}
	return array_diff($plugins, array(
		'wpemoji'
	));
}

/**
 * Twig extensions.
 */
require get_parent_theme_file_path( '/inc/twig-extensions.php' );

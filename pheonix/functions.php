<?php
/**
 * Pheonix functions and definitions
 *
 * @package Pheonix
 */

// Define Constants.
if ( ! defined( 'PHOENIX_DIR_PATH' ) ) {
	define( 'PHOENIX_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'PHOENIX_DIR_URI' ) ) {
	define( 'PHOENIX_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'PHOENIX_BUILD_URI' ) ) {
	define( 'PHOENIX_BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/' );
}

if ( ! defined( 'PHOENIX_IMG_URI' ) ) {
	define( 'PHOENIX_IMG_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/img/' );
}
if ( ! defined( 'PHOENIX_JS_URI' ) ) {
	define( 'PHOENIX_JS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/js/' );
}

if ( ! defined( 'PHOENIX_JS_DIR_PATH' ) ) {
	define( 'PHOENIX_JS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/build/js/' );
}

if ( ! defined( 'PHOENIX_CSS_URI' ) ) {
	define( 'PHOENIX_CSS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/css/' );
}

if ( ! defined( 'PHOENIX_CSS_DIR' ) ) {
	define( 'PHOENIX_CSS_DIR', untrailingslashit( get_template_directory() ) . '/assets/build/css/' );
}

// Include autoloader.
require_once PHOENIX_DIR_PATH . '/inc/helpers/autoloader.php';
require_once PHOENIX_DIR_PATH . '/inc/helpers/template-tags.php';

/**
 * Creates an instance of the Phoenix_Theme class.
 *
 * This function is responsible for creating an instance of the Phoenix_Theme class
 * by calling the get_instance() method.
 *
 * @since 1.0.0
 */
function create_instance() {
	// Call the get_instance() method of the Phoenix_Theme class to create an instance.
	// This ensures that there is only one instance of the Phoenix_Theme class throughout the application.
	\PHOENIX_THEME\Inc\Phoenix_Theme::get_instance();
	\PHOENIX_THEME\Inc\Menus::get_instance();
}

create_instance();



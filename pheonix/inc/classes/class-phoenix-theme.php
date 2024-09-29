<?php
/**
 *  Bootstrap the theme
 *
 * @package Pheonix
 */

namespace PHOENIX_THEME\Inc;

use PHOENIX_THEME\Inc\Traits\Singleton;


/**
 * Pheonix_Theme class
 *
 * This class is responsible for bootstrapping the theme. It's a one-stop-shop
 * for registering any actions and filters needed by the theme.
 *
 * @package Pheonix
 */
class Phoenix_Theme {
	use Singleton;
	/**
	 * Constructor
	 */
	protected function __construct() {
		// Load Assets class.
		Assets::get_instance();

		// Load Menus class.
		Menus::get_instance();

		// Load metabox class.
		Meta_Box::get_instance();

		// Load sidebar class.
		Sidebar::get_instance();

		// Load Block categories class.
		Block_Categories::get_instance();

		// Load Block pattern class.
		Block_Pattern::get_instance();

		// Setup hooks.
		$this->setup_hooks();
	}

	/**
	 * Setup hooks
	 *
	 * This method sets up all of the hooks for the theme. It's a one-stop-shop
	 * for registering any actions and filters needed by the theme.
	 *
	 * @return void
	 */
	public function setup_hooks() {
		/**
		 * Actions
		 *
		 * @see add_action() for more information
		 */
		// Add any theme-specific actions here.
		// add action after theme setup.
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );

		/**
		 * Filters
		 *
		 * @see add_filter() for more information
		 */
		// Add any theme-specific filters here.
	}

	/**
	 * Setup the theme
	 *
	 * @return void
	 */
	public function theme_setup() {
		// Add theme support.
		add_theme_support( 'title-tag' );
		// Add custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'header-text' => array( 'site-title', 'site-description' ),
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		// Add custom background support.
		add_theme_support( 'custom-background', array( 'default-color' => 'ffffff' ) );

		// Add post thumbnail support which add feature image in post in backend.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Adds support for selective refresh in the Customizer for widgets.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
		 */
		// Add support for the Customizer to automatically refresh widgets when their settings change.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Automatic feed links.
		add_theme_support( 'automatic-feed-links' );

		// add image sizes.
		add_image_size( 'featured-thumbnail', 356, 188, true );

		// Add support for html5.
		// Add support for the following HTML5 elements:
		// - Search form
		// - Comment form
		// - Comment list
		// - Gallery
		// - Caption
		// - Style
		// - Script.
		add_theme_support(
			'html5',
			array(
				'search-form', // Adds the HTML5 search form element to the theme.
				'comment-form', // Adds the HTML5 comment form element to the theme.
				'comment-list', // Adds the HTML5 comment list element to the theme.
				'gallery', // Adds the HTML5 gallery element to the theme.
				'caption', // Adds the HTML5 caption element to the theme.
				'style', // Adds the HTML5 style element to the theme.
				'script', // Adds the HTML5 script element to the theme.
			)
		);

		// Add support for block editor styles to display in front.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Define content width.
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1240;
		}
		/**
		 * Add support for editor styles.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#block-styles
		 */
		add_theme_support( 'editor-styles' );
		// Add editor style.
		add_editor_style( 'assets/build/css/editor.css' );
	}
}

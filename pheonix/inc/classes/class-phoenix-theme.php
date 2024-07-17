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

		// Add enquue styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		// Add enqueue scripts action.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add phoenix site add action.
		add_action( 'pheonix_site_logo', array( $this, 'add_site_logo' ) );

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

		// add editor style.
		add_editor_style();

		// Add support for block editor styles to display in front.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Define content width.
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1240;
		}
	}

	/**
	 * Enqueue scripts and styles
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		// Add theme stylesheet.
		// wp_register_script( 'phoenix-script', PHOENIX_JS_URI . 'main.js', array(), filemtime( PHOENIX_JS_DIR_PATH . 'main.js' ), true );

		wp_register_script( 'phoenix-script', PHOENIX_DIR_URI . '/assets/js/main.js', array( 'jquery' ), filemtime( PHOENIX_DIR_PATH . '/assets/js/main.js' ), true );

		// register cdn for popper js.
		wp_register_script( 'popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js', array(), '2.11.8', true );
		// enqueue cdn for popper js.
		wp_enqueue_script( 'popper-js' );

		// register cdn for bootstrap 5.3.3.
		wp_register_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.3', true );
		// enqueue cdn for bootstrap 5.3.3.
		wp_enqueue_script( 'bootstrap-js' );

		// enqueue theme script.
		wp_enqueue_script( 'phoenix-script' );
	}

	/**
	 * Enqueue styles
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		// Add theme stylesheet.
		wp_register_style( 'phoenix-style', get_stylesheet_uri(), array(), filemtime( PHOENIX_DIR_PATH . '/style.css' ), 'all' );
		// enqueue theme stylesheet.
		wp_enqueue_style( 'phoenix-style' );

		// Add cdn for bootstrap 5.3.3 style.
		wp_register_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), '5.3.3', 'all' );
		// enqueue cdn for bootstrap 5.3.3 style.
		wp_enqueue_style( 'bootstrap-css' );

		wp_register_style( 'font-css', PHOENIX_DIR_URI . 'library/fonts/fonts.css', array(), '1.0.0', 'all' );

	}

	/**
	 * Add site logo
	 *
	 * @return void
	 */
	public function add_site_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}

}

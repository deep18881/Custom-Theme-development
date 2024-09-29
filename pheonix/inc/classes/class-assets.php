<?php
/**
 * Enqueue theme assets
 *
 * @package Phoenix
 */

namespace PHOENIX_THEME\Inc;

use PHOENIX_THEME\Inc\Traits\Singleton;


/**
 * Class Assets
 *
 * Singleton class for enqueueing theme assets.
 *
 * @package PHOENIX_THEME\Inc
 */
class Assets {

	use Singleton;

	/**
	 * Constructor
	 *
	 * Sets up the hooks for enqueueing assets.
	 */
	public function __construct() {

		// Setup hooks.
		$this->setup_hooks();
	}

	/**
	 * Setup hooks
	 */
	private function setup_hooks() {
		// Add your hooks here.

		// Add enquue styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		// Add enqueue scripts action.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add enqueue_block_assets.
		add_action( 'enqueue_block_assets', array( $this, 'enqueue_block_assets_wp' ) );

		// Add phoenix site add action.
		add_action( 'pheonix_site_logo', array( $this, 'add_site_logo' ) );
	}

	/**
	 * Enqueue scripts and styles
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		// Add theme stylesheet.
		wp_register_script( 'phoenix-script', PHOENIX_JS_URI . 'main.js', array( 'jquery' ), filemtime( PHOENIX_JS_DIR_PATH . 'main.js' ), true );

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
		// Add cdn for bootstrap 5.3.3 style.
		wp_register_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), '5.3.3', 'all' );

		// Add main style from build.
		wp_register_style( 'main-css', PHOENIX_CSS_URI . 'main.css', array( 'bootstrap-css' ), filemtime( PHOENIX_CSS_DIR . 'main.css' ), 'all' );

		// Enqueues all the styles.
		wp_enqueue_style( 'bootstrap-css' );
		wp_enqueue_style( 'main-css' );

	}

	/**
	 * Enqueue block assets for both frontend and backend.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_block_assets_wp() {
		/**
		 * Get the path to the assets.json file.
		 *
		 * @var string $asset_file_path
		 */
		$asset_file_path = sprintf( '%sassets.php', PHOENIX_BUILD_DIR_PATH );

		/**
		 * Check if the assets.json file exists.
		 *
		 * @return void
		 */
		if ( ! file_exists( $asset_file_path ) ) {
			return;
		}

		/**
		 * Include the assets.json file and get the content.
		 *
		 * @var array $assets_file_content
		 */
		$assets_file_content = require_once $asset_file_path;

		/**
		 * Check if the assets.json file has content.
		 *
		 * @return void
		 */
		if ( empty( $assets_file_content ) ) {
			return;
		}

		/**
		 * Get the path to the blocks.js file.
		 *
		 * @var array $assets_get_js_path
		 */
		$assets_get_js_path = $assets_file_content['js/blocks.js'];

		/**
		 * Get the dependencies for the blocks.js file.
		 *
		 * @var array $get_blockjs_file_dependency
		 */
		$get_blockjs_file_dependency = $assets_get_js_path['dependencies'] ? $assets_get_js_path['dependencies'] : array();

		/**
		 * Get the version for the blocks.js file.
		 *
		 * @var string $get_blockjs_file_version
		 */
		$get_blockjs_file_version = $assets_get_js_path['version'] ? $assets_get_js_path['version'] : filemtime( $asset_file_path );

		/**
		 * Enqueue the blocks.js file in admin.
		 *
		 * @return void
		 */
		if ( is_admin() ) {
			wp_enqueue_script( 'pheonix-blocks-js', PHOENIX_JS_URI . 'blocks.js', $get_blockjs_file_dependency, $get_blockjs_file_version, true );
		}

		/**
		 * Enqueue the blocks.css file.
		 *
		 * @return void
		 */
		$css_dependency = array(
			'wp-block-library-theme',
			'wp-block-library',
		);

		wp_enqueue_style( 'pheonix-blocks-css', PHOENIX_CSS_URI . 'blocks.css', $css_dependency, filemtime( PHOENIX_CSS_DIR . 'blocks.css' ), 'all' );
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

<?php
/**
 * Sidebar for pheonix
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
class Sidebar {

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

		add_action( 'widgets_init', array( $this, 'register_sidebar' ) );
		add_action( 'widgets_init', array( $this, 'register_clock_widget' ) );
	}

	/**
	 * Register sidebar
	 *
	 * @return void
	 */
	public function register_sidebar() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'pheonix' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'pheonix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title ">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Sidebar', 'pheonix' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Add widgets here.', 'pheonix' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}

	/**
	 * Register clock widget
	 *
	 * @return void
	 */
	public function register_clock_widget() {
		register_widget( 'PHOENIX_THEME\Inc\Clock_Widget' );
	}

}

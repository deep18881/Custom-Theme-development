<?php
/**
 * Create custom block pattern.
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
class Block_Pattern {

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
		// Register block pattern category.
		add_action( 'init', array( $this, 'register_block_pattern_category' ) );
		// Register block pattern.
		add_action( 'init', array( $this, 'register_block_pattern' ) );
	}

	/**
	 * Register block pattern category
	 *
	 * @since 1.0.0
	 */
	public function register_block_pattern_category() {
		$patterns_array = array(
			'cover'        => esc_html__( 'Cover', 'pheonix' ),
			'testimonials' => esc_html__( 'Testimonials', 'pheonix' ),
		);

		if ( ! empty( $patterns_array ) && is_array( $patterns_array ) ) {
			foreach ( $patterns_array as $pattern_key => $pattern_name ) {
				register_block_pattern_category(
					$pattern_key,
					array(
						'label' => $pattern_name,
					)
				);
			}
		}
	}

	/**
	 * Register block pattern
	 */
	public function register_block_pattern() {
		$cover_content       = $this->get_block_patterns_parts( 'cover' );
		$testimonial_content = $this->get_block_patterns_parts( 'testimonials' );
		// Register block pattern.
		if ( function_exists( 'register_block_pattern' ) ) {
			register_block_pattern(
				'pheonix/cover',
				array(
					'title'       => esc_html__( 'Cover', 'pheonix' ),
					'description' => esc_html__( 'Pheonix Cover Block', 'pheonix' ),
					'categories'  => array( 'cover' ),
					'content'     => $cover_content,
				)
			);
			register_block_pattern(
				'pheonix/testimonials',
				array(
					'title'       => esc_html__( 'Testimonial', 'pheonix' ),
					'description' => esc_html__( 'Pheonix Testimonial Block', 'pheonix' ),
					'categories'  => array( 'testimonials' ),
					'content'     => $testimonial_content,
				)
			);
		}
	}

	/**
	 * Get content of block pattern template part.
	 *
	 * @param string $templates_part The name of the template part.
	 *
	 * @return string The content of the template part.
	 */
	public function get_block_patterns_parts( $templates_part ) {
		ob_start();
		get_template_part( 'template-parts/patterns/' . $templates_part );
		$content = ob_get_clean();
		return $content;
	}
}

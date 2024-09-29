<?php
/**
 * Block categories
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
class Block_Categories {

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
		add_filter( 'block_categories', array( $this, 'ph_block_categories' ) );
	}

	/**
	 * Add block categories
	 *
	 * @param array $categories Block categories.
	 * @return array
	 */
	public function ph_block_categories( $categories ) {
		$category_slugs = wp_list_pluck( $categories, 'slug' );
		if ( ! in_array( 'phoenix', $category_slugs, true ) ) {
			$categories[] = array(
				'slug'  => 'phoenix',
				'title' => esc_html__( 'Phoenix Blocks', 'pheonix' ),
				'icon'  => 'info outline',
			);
		}
		return $categories;
	}

}

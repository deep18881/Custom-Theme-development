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
	}
}

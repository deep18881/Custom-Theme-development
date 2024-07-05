<?php
/**
 * Creating Meta Boxes.
 *
 * @package Phoenix
 */

namespace PHOENIX_THEME\Inc;

use PHOENIX_THEME\Inc\Traits\Singleton;


/**
 * Class metabox
 *
 * Singleton class for enqueueing theme assets.
 *
 * @package PHOENIX_THEME\Inc
 */
class Meta_Box {

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
		add_action( 'add_meta_boxes', array( $this, 'custom_meta_box' ) );

		// Save Meta Data.
		add_action( 'save_post', array( $this, 'save_custom_meta_data' ) );
	}
	/**
	 * Add Meta Box
	 */
	public function custom_meta_box() {
		add_meta_box(
			'hide_title',
			'Hide Title',
			array( $this, 'custom_meta_box_content' ),
			'post',
			'side',
		);
	}

	/**
	 * Callback for Meta Box
	 */
	public function custom_meta_box_content() {
		// Get the current status of the checkbox.
		$hide_title = get_post_meta( get_the_ID(), 'post_hide_title', true );

		// Echo out the checkbox form element.
		echo '<label for="hide_title">';
		echo '<input type="checkbox" name="post_hide_title" id="post_hide_title" value="true" ' . checked( $hide_title, true, false ) . ' />';
		wp_nonce_field( 'post_hide_title', 'nonce_post_hide_title' );
		echo 'Hide title</label>';
	}

	/**
	 * Save the checkbox value
	 *
	 * @param int $post_id The ID of the post being saved.
	 * @since 1.0.0
	 */
	public function save_custom_meta_data( $post_id ) {
		// Check if nonce is set.
		if ( ! isset( $_POST['nonce_post_hide_title'] ) ) {
			return;
		}

		// Check if nonce is valid.
		if ( isset( $_POST['nonce_post_hide_title'] ) ) {
			$nonce = sanitize_text_field( wp_unslash( $_POST['nonce_post_hide_title'] ) );
			if ( ! wp_verify_nonce( $nonce, 'post_hide_title' ) ) {
				return;
			}
		}

		// Check if the meta box was saved.
		if ( isset( $_POST['post_hide_title'] ) ) {
			update_post_meta( $post_id, 'post_hide_title', true );
		} else {
			delete_post_meta( $post_id, 'post_hide_title' );
		}
	}
}

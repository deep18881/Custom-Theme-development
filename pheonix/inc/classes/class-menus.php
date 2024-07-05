<?php
/**
 * Register Menus
 *
 * @package Aquila
 */

namespace PHOENIX_THEME\Inc;

use PHOENIX_THEME\Inc\Traits\Singleton;


/**
 * Class Menus
 *
 * Registers Menus.
 */
class Menus {

	use Singleton;

	/**
	 * Constructor
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Setup hooks
	 */
	protected function setup_hooks() {
		add_action( 'init', array( $this, 'register_menus' ) );
	}

	/**
	 * Register Menus
	 *
	 * Registers the header and footer menus.
	 *
	 * @since 1.0.0
	 */
	public function register_menus() {
		// Register the header menu.
		register_nav_menus(
			array(
				'phoenix-header-menu' => esc_html__( 'Header Menu', 'phoenix' ),
			)
		);

		// Register the footer menu.
		register_nav_menus(
			array(
				'phoenix-footer-menu' => esc_html__( 'Footer Menu', 'phoenix' ),
			)
		);

		// Register the extra menu.
		register_nav_menus(
			array(
				'phoenix-extra-menu' => esc_html__( 'Extra Menu', 'phoenix' ),
			)
		);
	}

	/**
	 * Get Menu ID
	 *
	 * Get the ID of a menu by its location.
	 *
	 * @param string $location The location of the menu.
	 *
	 * @return int|false The ID of the menu if it exists, false otherwise.
	 */
	public function get_menu_id( $location ) {
		// Get the menu locations.
		// This function retrieves an array of menu locations and their corresponding menu IDs.
		$locations = get_nav_menu_locations();

		// Check if the location exists in the menu locations.
		// If the location exists in the menu locations, return the menu ID.
		// If the location doesn't exist in the menu locations, return false.
		return isset( $locations[ $location ] ) ? $locations[ $location ] : false;
	}

	/**
	 * Get Child Menu Items
	 *
	 * Retrieves the child menu items for a given parent ID.
	 *
	 * @param array $header_menu_items The array of header menu items.
	 * @param int   $parent_id         The ID of the parent menu item.
	 *
	 * @return array The array of child menu items.
	 */
	public function get_child_menu_items( $header_menu_items, $parent_id ) {
		// Check if the header menu items array is not empty and is of type array.
		if ( ! empty( $header_menu_items ) && is_array( $header_menu_items ) ) {
			$child_items = array();
			// Loop through each menu item and check if it has the specified parent ID.
			foreach ( $header_menu_items as $item ) {
				if ( intval( $item->menu_item_parent ) === $parent_id ) {
					array_push( $child_items, $item );
				}
			}
			return $child_items;
		}
	}
}


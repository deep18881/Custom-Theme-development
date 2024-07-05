<?php
/**
 * Singleton pattern trait.
 *
 * @package PHOENIX_THEME
 */

namespace PHOENIX_THEME\Inc\Traits;

/**
 * Singleton pattern trait.
 */
trait Singleton {
	/**
	 * Protected constructor to prevent creating a new instance of the
	 * class via the `new` operator from outside of this class.
	 */
	protected function __construct() {
	}

	/**
	 * Private clone method to prevent cloning of the instance of the
	 * class via the `clone` operator.
	 *
	 * @return void
	 */
	private function __clone() {
	}

	/**
	 * Private unserialize method to prevent unserializing of the instance
	 * of the class via the global function `unserialize`.
	 *
	 * @return void
	 */
	private function __wakeup() {
	}

	/**
	 * Get the instance of the class.
	 *
	 * @since 1.0.0
	 *
	 * @return object Class instance.
	 */
	final public static function get_instance() {
		/**
		 * The instances of the classes using this trait.
		 *
		 * @var array
		 */
		static $instance = array();

		/**
		 * The class name which is being called to get the instance.
		 *
		 * @var string
		 */
		$called_class = get_called_class();

		if ( ! isset( $instance[ $called_class ] ) ) {
			/**
			 * Create a new instance of the class and initialize it.
			 */
			$instance[ $called_class ] = new $called_class();

			/**
			 * Fires after the instance of the class is initialized.
			 *
			 * The dynamic action name is `pheonix_theme_singleton_init_<class_name>`.
			 *
			 * @since 1.0.0
			 */
			do_action( sprintf( 'phoenix_theme_singleton_init_%s', $called_class ) ); // phpcs:ignore
		}

		/**
		 * Return the instance of the class.
		 *
		 * @since 1.0.0
		 */
		return $instance[ $called_class ];
	}
}

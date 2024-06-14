<?php
/**
 * Admin Panel Class
 *
 * This class manages all admin-related functionality.
 *
 * @package AT_Assistant
 */

namespace AT_Assistant;

/**
 * AdminPanel class used for managing
 * all Admin-related functionality.
 */
class AdminPanel {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		/**
		 * Instantiate the 'Notice'
		 * class from the 'Admin' namespace.
		 */
		new Admin\Notice();

		/**
		 * Instantiate the 'AdminEnqueue' class
		 * from the 'Admin' namespace.
		 */
		new Admin\AdminEnqueue();

		/**
		 * Manages custom post types.
		 * Custom Post define class
		 */
		new Admin\CustomPost();

		/**
		* Manages All Route and URL.
		* Route define class
		*/
		new Admin\Route();
	}
}

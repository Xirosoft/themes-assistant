<?php
/**
 * API Class
 *
 * This class manages all API functionality.
 *
 * @package AT_Assistant
 */

namespace AT_Assistant;

/**
 * Class API
 * Handles the registration of REST API endpoints.
 */
class API {

	/**
	 * API constructor.
	 * Adds the action to initialize the REST API.
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_api' ) );
	}

	/**
	 * Registers the REST API routes.
	 */
	public function register_api() {
		// Register your API routes here.
	}
}

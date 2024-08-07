<?php
/**
 * CustomPost Class
 *
 * This class manages all TrafficLocation functionality.
 *
 * @package ATA
 */

namespace ATA\Admin;

/**
 * Custom post Hander calass class
 */
class AtaCustomPost {

    /**
	 * CustomPost constructor.
	 * Adds the action to initialize.
	 */
	function __construct() {
		add_action( 'init', array( $this, 'at_assistant_custom_post_type' ) );
	}

	/**
	 * Custom post callback function
	 *
	 * @return void
	 */
	function at_assistant_custom_post_type() {
	}
}

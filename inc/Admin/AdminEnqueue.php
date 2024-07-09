<?php
/**
 * AdminEnqueue Class
 *
 * This class manages all Javascript and Css file loadng functionality.
 *
 * @package AT_Assistant
 */

namespace AT_Assistant\Admin;

/**
 * Class AdminEnqueue
 *
 * This class handles all enquee functionality.
 */
class AdminEnqueue {

	/**
	 * AdminEnqueue constructor.
	 * Adds the action to initialize the REST API.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'at_assistant_enqueue_dashboard_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'at_assistant_ajax_localie' ) );
	}

	/**
	 * CSS and JS enquee for dashboard.
	 */
	public function at_assistant_enqueue_dashboard_scripts() {

		$current_screen = get_current_screen();
		// Check if you're on the appropriate admin page(s) where you want to include your script.
		if ( $current_screen && 'themes-assistant' === $current_screen->post_type ) {
        }
        wp_enqueue_script('ata-dashboard-scripts', AT_ASSISTANT_ASSETS_URL . 'admin/js/dashboard.js', array('jquery'), '1.0', true);
        wp_enqueue_style( 'ata-dashboard-css', AT_ASSISTANT_ASSETS_URL . 'admin/css/dashboard.css', array(), time(), 'all' );
	}


	/**
	 * Ajax Data localize function
	 * Retrieve the API token and pass it to the script
	 *
	 * @return void
	 */
	public function at_assistant_ajax_localie() {
		wp_localize_script(
			'ata-dashboard-scripts',
			'ata_ajax_localize',
			array(
				'site_url' => site_url(),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'ata-nonce' ),
			)
		);
	}
}

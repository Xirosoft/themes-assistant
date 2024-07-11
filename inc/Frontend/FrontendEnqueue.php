<?php
// Enqueue assets
namespace ATA\Frontend;

class FrontendEnqueue {

	function __construct() {
		/**
		 * This Enquee method for script and style
		 *
		 * @load_ms_form_assets
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'load_at_assistant_assets' ) );
	}

	/**
	 * All Front-end Script and style enquee method.
	 *
	 * @return void
	 */
	function load_at_assistant_assets() {
		/**
		 * Enquee All Scripts
		 */
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'themes-assistant-fontend-script', ATA_ASSETS_URL . 'frontend/js/ata-fontend-script.js', array( 'jquery' ), time(), true );
		wp_localize_script(
			'ata-fontend-script',
			'at_assistant_ajax_object',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'ata-nonce' ),
			)
		);

		/**
		 * Enquee All Styles
		 */
		wp_enqueue_style( 'ata-frontend-style', ATA_ASSETS_URL . 'frontend/css/ata-frontend-style.css', array(), time(), 'all' );
	}
}

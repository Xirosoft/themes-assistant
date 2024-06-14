<?php
/**
 * Route Class File
 *
 * @package AT_Assistant\Admin
 */

namespace AT_Assistant\Admin;

use AT_Assistant\Query;

/**
 * Class Route
 *
 * This class handles URL routing for the admin interface.
 */
final class Route {

	/**
	 * Route constructor.
	 *
	 * Initializes the Route class.
	 */
	public function __construct() {
	}

	/**
	 * Get the page slug.
	 *
	 * @param string $url_slug URL slug.
	 * @return string Page slug URL.
	 */
	public function page_slug( $url_slug ) {
		$page_slug = '/wp-admin/edit.php?post_type=themes-assistant&page=' . $url_slug;
		return $page_slug;
	}

	/**
	 * Get the page URL.
	 *
	 * @param string $url_slug URL slug.
	 * @return string Page URL.
	 */
	public function page_url( $url_slug ) {
		$page_url = home_url( '/wp-admin/edit.php?post_type=themes-assistant&page=' . $url_slug );
		return $page_url;
	}

	/**
	 * Get the current URL.
	 *
	 * @return string Current URL.
	 */
	public function current_url() {
		if ( isset( $_SERVER['REQUEST_URI'] ) ) {
			$current_url = home_url( add_query_arg( array(), sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) ) );
			return $current_url;
		}
		return '';
	}

	/**
	 * Create a new URL.
	 *
	 * @return string New URL.
	 */
	public function create_url() {
		$new_from_slug = home_url( '/wp-admin/post-new.php?post_type=themes-assistant' );
		return $new_from_slug;
	}

	/**
	 * Get the settings URL.
	 *
	 * @return string Settings URL.
	 */
	public function settings_url() {
		$settings = $this->page_url( 'settings' );
		return $settings;
	}

	/**
	 * Get the entries URL.
	 *
	 * @return string Entries URL.
	 */
	public function entreies_url() {
		$entries = $this->page_url( 'docs' );
		return $entries;
	}

	/**
	 * Get the documentation URL.
	 *
	 * @return string Documentation URL.
	 */
	public function docs_url() {
		$docs = $this->page_url( 'submission' );
		return $docs;
	}
}

<?php
/**
 * Notice Class File
 *
 * @package AT_Assistant\Admin
 */

namespace AT_Assistant\Admin;

/**
 * Class Notice
 *
 * This class handles the display and dismissal of admin notices.
 */
class Notice {

	/**
	 * Notice constructor.
	 *
	 * Initializes the Notice class.
	 */
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'display_notice' ) );
	}

	/**
	 * Display admin notice.
	 *
	 * This function displays an admin notice if it hasn't been dismissed.
	 */
	public function display_notice() {
		$route            = new Route();
		$plugin_basename  = plugin_basename( __DIR__ . '/themes-assistant.php' );
		$dismissed_notice = 'at_assistant_dismissed_notice';

		if ( ! get_user_meta( get_current_user_id(), $dismissed_notice ) ) {
			$dismiss_url = add_query_arg(
				array(
					'dismiss'  => $dismissed_notice,
					'_wpnonce' => wp_create_nonce( 'at_assistant_dismissed_notice_nonce' ),
				),
				admin_url()
			);
			?>
			<div class="notice notice-info is-dismissible">
				<p>
					<?php echo esc_html__( 'Thank you for choosing the Thast plugin! If you find it helpful, please consider leaving us a review.', 'themes-assistant' ); ?>
				</p>
				<p><a href="<?php echo esc_url( $dismiss_url ); ?>"><?php echo esc_html__( 'Dismiss', 'themes-assistant' ); ?></a></p>
			</div>
			<?php
		}
	}

	/**
	 * Plugin activation redirect.
	 *
	 * Redirects to the desired page or URL after plugin activation.
	 */
	public function plugin_activation_redirect() {
		$route = new Route();
		// Redirect to the desired page or URL after plugin activation.
		$redirect_url = $route->create_url(); // Replace with your desired URL.

		// Redirect the user.
		wp_safe_redirect( $redirect_url );
		exit;
	}
}

// Initialize the Notice class.
if ( isset( $_GET['dismiss'] ) && sanitize_text_field( wp_unslash( $_GET['dismiss'] ) ) === 'at_assistant_dismissed_notice' && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'at_assistant_dismissed_notice_nonce' ) ) {
	update_user_meta( get_current_user_id(), 'at_assistant_dismissed_notice', true );
}
$dismiss_url = add_query_arg(
	array(
		'dismiss'  => 'at_assistant_dismissed_notice',
		'_wpnonce' => wp_create_nonce( 'at_assistant_dismissed_notice_nonce' ),
	),
);

?>

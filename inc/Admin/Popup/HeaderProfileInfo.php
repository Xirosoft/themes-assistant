<?php
/**
 * Popup Header Profile Info Class File
 *
 * @package AT_Assistant\Admin\Popup
 */

namespace AT_Assistant\Admin\Popup;

use AT_Assistant\Admin\Route;

/**
 * Class HeaderProfileInfo
 *
 * This class handles the profile information popup.
 */
class HeaderProfileInfo {
	/**
	 * Constructor.
	 */
	public function __construct() {
	}

	/**
	 * Display the profile information popup.
	 */
	public function profile_info_popup() {
		$route = new Route();
		?>
			<div class="info-popup mini" id="info-popup">
				<a href="<?php echo esc_url( home_url( 'wp-admin/profile.php' ) ); ?>" class="info-popup__header">
					<div class="avatar">
						<?php
							$current_user = wp_get_current_user();
							$user_avatar  = get_avatar( $current_user->user_email, 64 );
							echo esc_html( $user_avatar );
						?>
					</div>
					<div class="user">
						<h2 class="user__name">
							<?php
								echo esc_html( $current_user->display_name );
							?>
						</h2>
						<p class="user__email">
							<?php
								echo esc_html( $current_user->user_email );
							?>
						</p>
					</div>
				</a>
				<div class="info-popup__inner">
					<a class="info-popup__link" href="<?php echo esc_url( $route->page_url( 'settings' ) ); ?>">
						<i class="fi-settings"></i>
						<span><?php echo esc_html__( 'Settings', 'themes-assistant' ); ?></span>
					</a>
					<a class="info-popup__link" href="#">
						<i class="dashicons dashicons-arrow-up-alt"></i>
						<span><?php echo esc_html__( 'Upgrade', 'themes-assistant' ); ?></span>
					</a>
					<a class="info-popup__link" href="#">
						<i class="fi-docs"></i>
						<span><?php echo esc_html__( 'Change Log', 'themes-assistant' ); ?></span>
					</a>
					<a class="info-popup__link" href="#">
						<i class="fi-link"></i>
						<span><?php echo esc_html__( 'Other Plugins', 'themes-assistant' ); ?></span>
					</a>

					

					<div class="grid-full-width">
						<h2 class="title"><?php echo esc_html__( 'System Information', 'themes-assistant' ); ?></h2>
						<table class="form-table system-info-table info-popup__table">
							<tbody>
								<tr>
									<th scope="row"><?php echo esc_html__( 'Server software', 'themes-assistant' ); ?></th>
									<td>
									<?php
										$server_software = isset( $_SERVER['SERVER_SOFTWARE'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) : '';
										echo esc_html( sanitize_text_field( $server_software ) );
									?>
									</td>
								</tr>
								<tr>
									<th scope="row"><?php echo esc_html__( 'PHP version', 'themes-assistant' ); ?></th>
									<td><?php echo esc_html( phpversion() ); ?></td>
								</tr>
								<tr>
									<th scope="row"><?php echo esc_html__( 'WordPress version', 'themes-assistant' ); ?></th>
									<td><?php echo esc_html( get_bloginfo( 'version' ) ); ?></td>
								</tr>
								<tr>
									<th scope="row"><?php echo esc_html__( 'Theme', 'themes-assistant' ); ?></th>
									<td><?php echo esc_html( wp_get_theme()->Name ); ?></td>
								</tr>
								<tr>
									<th scope="row"><?php echo esc_html__( 'MySQL version', 'themes-assistant' ); ?></th>
									<td>
									<?php
										global $wpdb;
										echo esc_html( $wpdb->db_version() );
									?>
										</td>
								</tr>
								<tr>
									<th scope="row"><?php echo esc_html__( 'PHP memory limit', 'themes-assistant' ); ?></th>
									<td><?php echo esc_html( ini_get( 'memory_limit' ) ); ?></td>
								</tr>
								<tr>
									<th scope="row"><?php echo esc_html__( 'PHP max execution time', 'themes-assistant' ); ?></th>
									<td><?php echo esc_html( ini_get( 'max_execution_time' ) ); ?></td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
				
				<div class="info-popup__footer">
					<p class="xirosoft-credit">
						<a class="logout" href="<?php echo esc_url( wp_logout_url() ); ?>">
							<span class="dashicons dashicons-exit"></span>
							<?php echo esc_html__( 'Logout', 'themes-assistant' ); ?>
						</a>

						<?php esc_html_e( 'Powered by: ', 'themes-assistant' ); ?>
						<a href="<?php echo esc_url( 'https://xirosoft.com' ); ?>" target="_blank">
							<img src="<?php echo esc_url( AT_ASSISTANT_ASSETS_URL . '/img/xirosoft.webp' ); ?>" alt="<?php echo esc_attr__( 'xirosoft', 'themes-assistant' ); ?>" />
						</a>
					</p>
				</div>
			</div>
		<?php
	}
}

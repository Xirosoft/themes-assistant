<?php
/**
 * Plugin Name: Advance Themes Assistant – Theme Customization, Optimization, and Support
 * Description: Advance Themeies Assistant is a user-friendly WordPress plugin that simplifies and enhances your theme customization experience. Effortlessly tweak colors, layouts, styles, and designs to bring your creative vision to life. Save time and personalize your website with ease using Themeies Assistant..
 * Plugin URI: https://themeies.com/item/themes-assistant
 * Version: 1.0.3
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Xirosoft
 * Author URI: https://xirosoft.com/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: themes-assistant
 * Domain Path: /languages
 *
 * @package AT_Assistant
 */

/**
 * Main Thast Plugin Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 *
 * @since 1.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * AT_Assistant_Main class
 */
final class ATA_Main {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	// const ATA_VERSION = '1.0.2';
	const ATA_VERSION = '1.0.2';
    
	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const ATA_MINIMUM_PHP_VERSION = '7.4';


	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		/**
		 * Define Constants
		 */
		$this->define_constants();

        register_activation_hook( ATA__FILE__ , [$this, 'activate'] );

		// Load translation.
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin.
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'themes-assistant' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {
		/**
		 * Global function Initial
		 */
		new ATA\AtaGlobalControl();

		/**
		 * Checking admin or frontend
		 */
		if ( is_admin() ) {
			// Enqueue all admin styles and scripts.
			new ATA\AdminPanel();
		} else {
			// Manage All frontend functionality.
			new ATA\FrontendPanel();
		}
	}

	/**
	 * Define the required plugin constants
	 *
	 * @return void
	 */
	public function define_constants() {
        if ( ! defined( 'ATA_VERSION' ) ) {
            // Replace the ATA_VERSION number of the theme on each release.
            $mode   = 'dev'; /*build*/
            if ('dev' == $mode) {
                define( 'ATA_VERSION', time() );
            }else{
                define( 'ATA_VERSION', self::ATA_VERSION  );
            }
        }
		// define( 'ATA_VERSION', self::ATA_VERSION );
		define( 'ATA__FILE__', __FILE__ );
		define( 'ATA_PLUGIN_BASE', plugin_basename( ATA__FILE__ ) );
		define( 'ATA_PATH', plugin_dir_path( ATA__FILE__ ) );
		define( 'ATA_ASSETS_PATH', ATA_PATH . 'assets/' );
		define( 'ATA_MODULES_PATH', ATA_PATH . 'modules/' );
		define( 'ATA_URL', plugins_url( '/', ATA__FILE__ ) );
		define( 'ATA_ASSETS_URL', ATA_URL . 'assets/' );
		define( 'ATA_MODULES_URL', ATA_URL . 'modules/' );
        define( 'ATA_IMAGE', ATA_URL . 'assets/img' );
		define( 'ATA_WIDGET_DIR', plugin_dir_path( __FILE__ ) . 'inc/Admin/Views/Widgets/style/' );
        define( 'ATA_BASE_PRO', 'https://wpborax.com/');
	}


	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function activate() {
        $installer = new ATA\AtaInstaller(); 
        $installer->run();
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		wp_nonce_field( 'themes_assistant_nonce_action', 'themes_assistant_nonce_field' );

		// Verify nonce before processing form data.
		if ( ! isset( $_POST['themes_assistant_nonce_field'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['themes_assistant_nonce_field'] ) ), 'themes_assistant_nonce_action' ) ) {
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] ); }
		} else {
			echo 'Nonce verification failed. Please try again.';
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'themes-assistant' ),
			'<strong>' . esc_html__( 'Themes Assistant Plugin', 'themes-assistant' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'themes-assistant' ) . '</strong>',
			self::ATA_MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', esc_html( $message ) );
	}
}

// Instantiate Themeie_Assistant_Plugin.
new ATA_Main();

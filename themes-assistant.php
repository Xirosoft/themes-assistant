<?php
/**
 * Plugin Name: Themes Assistant
 * Description: Themeies Assistant is a user-friendly WordPress plugin that simplifies and enhances your theme customization experience. Effortlessly tweak colors, layouts, styles, and designs to bring your creative vision to life. Save time and personalize your website with ease using Themeies Assistant..
 * Plugin URI: https://themeies.com/item/themes-assistant
 * Version: 1.0.0
 * Author: Xirosoft
 * Author URI: https://xirosoft.com/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: themes-assistant
 * Domain Path: /languages
 */

 

/**
 * Main ThemesAssistant Plugin Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once __DIR__ .'/vendor/autoload.php';
final class Themeie_Assistant_Plugin
{

	/**
	 * Plugin Version
	 *
	 * @since 1.2.0
	 * @var string The plugin version.
	 */
	const version = '1.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.4';


	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{
		/**
		 * define constatns
		 */
		$this->define_constants(); 

		// register_activation_hook( THEMEASSISTANT__FILE__ , [$this, 'activate'] );

		// Load translation
		add_action('init', array($this, 'i18n'));

		// Init Plugin
		add_action('plugins_loaded', array($this, 'init'));
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
	public function i18n()
	{
		load_plugin_textdomain('themes-assistant');
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
	public function init()
	{
		/**
		 * Global function Innitial
		 */
		new Xirosoft\ThemesAssistant\GlobalFunctions(); 
		// new Xirosoft\ThemesAssistant\API(); 
		/**
		 * checking admin or frontend 
		 */
		if ( is_admin() ) {
			// Enqueue all admin styles and scripts
			new Xirosoft\ThemesAssistant\AdminPanel(); 
		}else{
			// Manege All fontend functionility
			new Xirosoft\ThemesAssistant\FrotnendPanel();
		}

	}

	/**
	 * Define the required plugin constants
	 *
	 * @return void
	 */
	public function define_constants()
	{
		define('THEMEASSISTANT_VERSION', self::version);
		define('THEMEASSISTANT__FILE__', __FILE__);
		define('THEMEASSISTANT_PLUGIN_BASE', plugin_basename(THEMEASSISTANT__FILE__));
		define('THEMEASSISTANT_PATH', plugin_dir_path(THEMEASSISTANT__FILE__));
		define('THEMEASSISTANT_ASSETS_PATH', THEMEASSISTANT_PATH . 'assets/');
		define('THEMEASSISTANT_MODULES_PATH', THEMEASSISTANT_PATH . 'modules/');
		define('THEMEASSISTANT_URL', plugins_url('/', THEMEASSISTANT__FILE__));
		define('THEMEASSISTANT_ASSETS_URL', THEMEASSISTANT_URL . 'assets/');
		define('THEMEASSISTANT_MODULES_URL', THEMEASSISTANT_URL . 'modules/');
		define( 'THEMEASSISTANT_WIDGET_DIR', plugin_dir_path( __FILE__ ) . 'inc/Admin/views/widgets/style/');
	}


	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function activate(){
		// $installer = new Xirosoft\ThemesAssistant\Installer(); 
		// $installer->run();
		
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version(){
		wp_nonce_field( 'themes_assistant_nonce_action', 'themes_assistant_nonce_field' );

        // Verify nonce before processing form data
        if ( ! isset( $_POST['themes_assistant_nonce_field'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['themes_assistant_nonce_field'] ) ) , 'themes_assistant_nonce_action' ) ){
           if (isset($_GET['activate'])) { unset($_GET['activate']); }
        } else {
            echo 'Nonce verification failed. Please try again.';
        }
		

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'themes-assistant'),
			'<strong>' . esc_html__('themes-assistant Plugin', 'themes-assistant') . '</strong>',
			'<strong>' . esc_html__('PHP', 'themes-assistant') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
}

// Instantiate Themeie_Assistant_Plugin.
new Themeie_Assistant_Plugin();

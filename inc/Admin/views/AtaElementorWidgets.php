<?php
/**
 * Class ElementorWidgets
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Admin\views
 * @since 1.0.0
 */

namespace ATA\Admin\Views;
use ATA\AtaQuery;

use ATA\Widgets\Ata_Banner;
use ATA\Widgets\Ata_Default_button;
use ATA\Widgets\Ata_Hero_slider;
use ATA\Widgets\Ata_icon_box;
use ATA\Widgets\Ata_section_header;
use ATA\Widgets\Ata_image_box;
use ATA\Widgets\Ata_team_box;

/**
 * ElementorWidgets for manage all elementor widget
 */
class AtaElementorWidgets {

    private $query; 
    private $wpdb;
    private $table_name;
    private $where;

	/**
	 * Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 */
	public function __construct() {

        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix . 'at_assistant_settings'; // Replace 't_assistant_settings' with your custom table name
        $this->query = new AtaQuery();
        $query = "SELECT * FROM %1s";
        $this->where = array('id' => 1);
		// Register widgets.
		add_action( 'elementor/elements/categories_registered', array( $this, 'ata_elementor_widget_categories' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'ata_register_widgets' ) );
	}

	/**
	 * Register Themes Assistant Elementor widget categories
	 *
	 * @param object $elements_manager Elementor elements manager.
	 * @since 1.2.0
	 */
	public function ata_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'themes-assistant',
			array(
				'title' => __( 'Themes Assistant', 'themes_assistant' ),
				'icon'  => 'fa fa-plug',
			)
		);
		$elements_manager->add_category(
			'themes-assistant-pro',
			array(
				'title' => __( 'Themes Assistant Pro', 'themes_assistant' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		/* All files includes */
		$borax_widget = array_map( 'basename', glob( __DIR__ . '/widgets/*.php' ) );
		foreach ( $borax_widget as $key => $value ) {
			require_once __DIR__ . '/widgets/' . $value;
		}
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 */

    public function ata_register_widgets() {
        // It is now safe to include Widgets files.
        $this->include_widgets_files();
    
        $rows = $this->query->ata_view_data($this->table_name, array('id' => $this->where['id']));
        $data = $rows[0]->elements_settings;
        $SettingsArray = json_decode($data, true);
        if(gettype($SettingsArray) == 'string') {
            $SettingsArray = json_decode($SettingsArray, true);
        }
    
        // List of widget classes to register, associated with their settings keys.
        $widget_classes = array(
            'ata_banner' => Ata_Banner::class,
            'default_button' => Ata_Default_button::class,
            'hero_slider' => Ata_Hero_slider::class,
            'imagebox' => Ata_image_box::class,
            'icon_box' => Ata_icon_box::class,
            'section_header' => Ata_section_header::class,
            'team_box' => Ata_team_box::class,
        );
    
        $widget_manager = \Elementor\Plugin::instance()->widgets_manager;
        
        // Register widget types based on SettingsArray.
        foreach ($widget_classes as $key => $widget_class) {
            if (isset($SettingsArray[$key]) && $SettingsArray[$key] === 'on') {
                $widget_manager->register_widget_type(new $widget_class());
            }
        }
    }

}

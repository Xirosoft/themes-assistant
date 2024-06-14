<?php
/**
 * Class ElementorWidgets
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package AT_Assistant\Admin\views
 * @since 1.0.0
 */

namespace AT_Assistant\Admin\Views;

use AT_Assistant\Widgets\At_Assistant_Banner;
use AT_Assistant\Widgets\AT_Assistant_Default_button;
use AT_Assistant\Widgets\AT_Assistant_Hero_slider;
use AT_Assistant\Widgets\AT_Assistant_icon_box;
use AT_Assistant\Widgets\AT_Assistant_section_header;
use AT_Assistant\Widgets\AT_Assistant_image_box;
use AT_Assistant\Widgets\AT_Assistant_team_box;

/**
 * ElementorWidgets for manage all elementor widget
 */
class ElementorWidgets {

	/**
	 * Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 */
	public function __construct() {
		// Register widgets.
		add_action( 'elementor/elements/categories_registered', array( $this, 'themes_assistant_elementor_widget_categories' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'at_assistant_register_widgets' ) );
	}

	/**
	 * Register Themes Assistant Elementor widget categories
	 *
	 * @param object $elements_manager Elementor elements manager.
	 * @since 1.2.0
	 */
	public function themes_assistant_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'themes-assistant',
			array(
				'title' => __( 'Themes Assistant', 'themes_assistant' ),
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
	public function at_assistant_register_widgets() {
		// It is now safe to include Widgets files.
		$this->include_widgets_files();

		// List of widget classes to register.
		$widget_classes = array(
			At_Assistant_Banner::class,
			AT_Assistant_Default_button::class,
			AT_Assistant_Hero_slider::class,
			AT_Assistant_icon_box::class,
			AT_Assistant_section_header::class,
			AT_Assistant_image_box::class,
			AT_Assistant_team_box::class,
		);

		$widget_manager = \Elementor\Plugin::instance()->widgets_manager;
		// Register all widget types in a loop.
		foreach ( $widget_classes as $widget_class ) {
			$widget_manager->register_widget_type( new $widget_class() );
		}
	}
}

<?php
namespace AT_Assistant\Admin\views;
use AT_Assistant\Widgets\Banner;
use AT_Assistant\Widgets\Default_button;
use AT_Assistant\Widgets\Hero_slider;
use AT_Assistant\Widgets\Widget_icon_box;
use AT_Assistant\Widgets\Widget_section_header;
use AT_Assistant\Widgets\Widget_image_box;
use AT_Assistant\Widgets\Widget_team_box;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class ElementorWidgets {

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		// Register widgets
        add_action( 'elementor/elements/categories_registered', [$this, 'themes_assistant_elementor_widget_categories' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

    function themes_assistant_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'themes-assistant',
            [
                'title' => __( 'Themes Assistant', 'themes_assistant' ),
                'icon' => 'fa fa-plug',
            ]
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
		$borax_widget= array_map('basename', glob(dirname( __FILE__ ) . '/widgets/*.php'));
		foreach($borax_widget as $key => $value){
			require_once __DIR__ . '/widgets/'.$value;
		}
	}
	
	
	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets($widgets_manager) {
		// It is now safe to include Widgets files
		$this->include_widgets_files();
	
		// List of widget classes to register
		$widget_classes = [
            Banner::class,
            Default_button::class,
			Hero_slider::class,
			Widget_icon_box::class,
			Widget_section_header::class,
			Widget_image_box::class,
			Widget_team_box::class,
		];

		$widget_manager = \Elementor\Plugin::instance()->widgets_manager;
		// Register all widget types in a loop
		foreach ($widget_classes as $widget_class) {
			$widget_manager->register_widget_type(new $widget_class());
		}
	}

}

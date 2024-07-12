<?php
/**
 * Class Ata_Bmi_Calculator
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Bmi_Calculator 
 * @since 1.0.0
 */

 namespace ATA\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Ata_Bmi_Calculator extends Widget_Base {
 
    protected $ata_elementor_enquee;

	/**
	 * Construction load for assets.
	 *
	 * @param array $data Data for construction.
	 * @param mixed $args Optional arguments for construction.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

        $widget_name                = $this->get_name(); // You can make this dynamic
        $this->ata_elementor_enquee = new AtaElementorEnquee($widget_name);
	}

  /**
   * Retrieve the widget name.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget name.
   */
	public function get_name() {
		return 'ata-bmi-calculator';
	}
 
  /**
   * Retrieve the widget title.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget title.
   */
	public function get_title() {
		return esc_html__( 'BMI Calculator', 'themes-assistant' );
	}
 
  /**
   * Retrieve the widget icon.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget icon.
   */
	public function get_icon() {
		return 'eicon-number-field  borax-el';
	}
 
  /**
   * Retrieve the list of categories the widget belongs to.
   *
   * Used to determine where to display the widget in the editor.
   *
   * Note that currently Elementor supports only one category.
   * When multiple categories passed, Elementor uses the first one.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return array Widget categories.
   */
  	/**
	 * Add Elementor category.
	 */
 
	public function get_categories() {
        return array( 'themes-assistant' );
	}

  /**
   * Register the widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.1.0
   *
   * @access protected
   */
protected function _register_controls() {

    $this->start_controls_section(
		'section_iconbox',
		[
			'label' => esc_html__( 'BMI Calculator', 'themes-assistant' ),
		]
    );
    $this->add_control(
        'bmi_style', [
            'type' => Controls_Manager::SELECT,
            'label' => esc_html__('Choose Style', 'themes-assistant'),
            'default' => '1',
            'options' => [
                '1' => esc_html__('Style 1', 'themes-assistant'),
            ],
        ]
    );

   


    $this->end_controls_section();

  }
 
  /**
   * Render the widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.1.0
   *
   * @access protected
   */
    protected function render() {
        $settings       = $this->get_settings_for_display(); 
        $widget_title   = $this->get_title(); // Get the widget title dynamically
        $style          = $settings['bmi_style'];
        $widget_name    = $this->get_name(); // You can make this dynamic
        $AtaWidget      = new AtaWidgetManage($widget_name, $settings, $style);
    }
}
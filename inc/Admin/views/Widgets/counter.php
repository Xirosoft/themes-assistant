<?php
/**
 * Class Ata_Counter
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Counter 
 * @since 1.0.0
 */

 namespace ATA\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Ata_Counter extends Widget_Base {
 
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
		return 'ata-counter';
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
		return esc_html__( 'Counter', 'themes-assistant' );
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
		return 'eicon-counter-circle  borax-el';
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
      'section_imgbox',
      [
        'label' => esc_html__( 'Fun Facts', 'themes-assistant' ),
      ]
    );

    $this->add_control(

      'counter_style', [
          'type' => Controls_Manager::SELECT,
          'label' => esc_html__('Choose Style', 'themes-assistant'),
          'default' => '1',
          'options' => [
              '1' => esc_html__('Style 1', 'themes-assistant'),
            //   '2' => esc_html__('Style 2', 'themes-assistant'),
          ],
      ]
  );
  
    $this->add_control(
        'image',
        [
            'label' => esc_html__( ' Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
        ]
    );
    $this->add_control(
      'number',
      [
        'label' => esc_html__( 'Number', 'themes-assistant' ),
        'type' => Controls_Manager::NUMBER,
        'default' => __( 'Building Brand is Our Business', 'themes-assistant' ),
      ]
    );
 
    $this->add_control(
      'text',
      [
        'label' => esc_html__( 'Text', 'themes-assistant' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( '', 'themes-assistant' ),
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
        $settings = $this->get_settings_for_display();
        $style = $settings['counter_style'];
        $widget_name    = $this->get_name(); // You can make this dynamic
        $AtaWidget      = new AtaWidgetManage($widget_name, $settings, $style);
    }
}
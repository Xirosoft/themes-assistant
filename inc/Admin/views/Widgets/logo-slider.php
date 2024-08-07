<?php
/**
 * Class Ata_Logo_Slider
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Logo_Slider 
 * @since 1.0.0
 */

 namespace ATA\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use \Elementor\Group_Control_Css_Filter;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ata_Logo_Slider extends Widget_Base {

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
		return 'ata-logo-slider';
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
        return esc_html__( 'Logo Slider', 'themes-assistant' );
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
		return 'eicon-carousel  borax-el';
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
			'logo_section',
			[
				'label' => esc_html__( 'Logo Slider', 'themes-assistant' ),
			]
		);
        $this->add_control(
            'logo_slider_style',
            [
                'label' => esc_html__( 'Select Style', 'themes-assistant' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'themes-assistant' ),
                    // '2' => esc_html__( 'Style 2', 'themes-assistant' ),
                ],
            ]
        );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Reviewer Image', 'themes-assistant' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		); 
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'themes-assistant' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_attr__( 'https://website.com/', 'themes-assistant' ),
				'default' => [
					'url' => '',
				]
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Logo List', 'themes-assistant' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
            			'iamge' => __( '', 'themes-assistant' ),					
          			],
					[
						'image' => __( '', 'themes-assistant' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'themes-assistant' ),
			]
		);
	
		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
				'true' => esc_attr__( 'Yes', 'themes-assistant' ),
				'false' => esc_attr__( 'No', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'nav',
			[
				'label' => esc_html__( 'Slider Navigation', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
				'true' => esc_attr__( 'Yes', 'themes-assistant' ),
				'false' => esc_attr__( 'No', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'control',
			[
				'label' => esc_html__( 'Slider Control', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
				'true' => esc_attr__( 'Yes', 'themes-assistant' ),
				'false' => esc_attr__( 'No', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Slider Loop', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
				'true' => esc_attr__( 'Yes', 'themes-assistant' ),
				'false' => esc_attr__( 'No', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
        );
        $this->add_control(
            'rtl',
            [
                'label' => __( 'RTL Enable', 'themes-assistant' ),
                'type' => Controls_Manager::SWITCHER,
                'true' => __( 'Enable', 'themes-assistant' ),
                'false' => __( 'Disable', 'themes-assistant' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style Section', 'themes-assistant' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->add_control(
			'logo_width',
			[
				'label' => esc_html__( 'Width', 'themes-assistant' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .partners-logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'themes-assistant' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'borax_css_filters_normal',
				'selector' => '{{WRAPPER}} .partners-logo img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'themes-assistant' ),
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'borax_css_filters_hover',
				'selector' => '{{WRAPPER}} .partners-logo img:hover',
			]
		);
		$this->add_control(
			'logo_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'themes-assistant' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['s' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
					's' => [
						'min' => 0,
						'max' => 1,
					],
				],
				'default' => [
					'unit' => 's',
					'size' => .5,
				],
				'selectors' => [
					'{{WRAPPER}} .partners-logo img:hover' => 'transition-duration: {{SIZE}}{{UNIT}};',
				],
			]
		);

	
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	


	}

	protected function render() {

		$settings = $this->get_settings_for_display();
        $style = $settings['logo_slider_style'];
        $widget_name  = $this->get_name(); // You can make this dynamic
		$AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style);
	}
}
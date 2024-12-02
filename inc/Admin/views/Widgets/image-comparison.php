<?php
/**
 * Class Ata_Image_Comparison
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Image_Comparison 
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
class Ata_Image_Comparison extends Widget_Base {

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
        return 'ata-image-comparison';
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
        return esc_html__( 'Image Comparison', 'themes-assistant' );
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
            return 'eicon-image-before-after  borax-el';
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
            'section_Image_Comparison',
        [
                'label' => esc_html__('Image Comparison', 'themes-assistant'),
        ]
    );
    $this->add_control(
        'image_cmparision_style',
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
    $this->add_control(
            'image_comparison_heading',
        [
            'label' => esc_html__('Image Comparison', 'themes-assistant'),
            'type' => Controls_Manager::HEADING,
        ]
    );
    $this->add_control(
            'before_title', [
                'label' => esc_html__('Enter Before Title', 'themes-assistant'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_attr('Before'),
            'label_block' => true,
        ]
    );
    $this->add_control(
            'before_image',
        [
                'label' =>esc_html__( 'Before Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                    'url' => Utils::get_placeholder_image_src(),
            ],
        ]
    );
    $this->add_control(
            'after_title', [
                'label' => esc_html__('Enter After Title', 'themes-assistant'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_attr('After'),
            'label_block' => true,
        ]
    );
    $this->add_control(
            'after_image',
        [
                'label' =>esc_html__( 'After Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                    'url' => Utils::get_placeholder_image_src(),
            ],
        ]
    );
    $this->add_control(
            'overlay_swicher',
        [
                'label' => esc_html__('Overlay Switcher', 'themes-assistant'),
            'type' => Controls_Manager::SWITCHER,
            'label_off' => esc_html__('No', 'themes-assistant'),
            'label_on' => esc_html__('Yes', 'themes-assistant'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );
    $this->add_control(
            'overlay_image',
        [
                'label' =>esc_html__( 'Overlay Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                    'url' => Utils::get_placeholder_image_src(),
            ],
            'condition' => [
                    'overlay_swicher' => 'yes',
            ],
        ]
    );

    $this->end_controls_section();
    $this->start_controls_section(
            'section_Comparison_options',
        [
                'label' => esc_html__('Comparison Options', 'themes-assistant'),
        ]
    );
    $this->add_control(
            'click_to_move',
        [
                'label' => esc_html__('Cursor Click option enable', 'themes-assistant'),
            'description' => esc_html__('Allow a user to click (or tap) anywhere on the image to move the slider to that location','themes-assistant'),
            'type' => Controls_Manager::SWITCHER,
            'label_off' => esc_html__('No', 'themes-assistant'),
            'label_on' => esc_html__('Yes', 'themes-assistant'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );
    $this->add_control(
            'no_overlay',
        [
                'label' => esc_html__('Click and disable Overlay', 'themes-assistant'),
            'description' => esc_html__('Do not show the overlay with before and after','themes-assistant'),
            'type' => Controls_Manager::SWITCHER,
            'label_off' => esc_html__('No', 'themes-assistant'),
            'label_on' => esc_html__('Yes', 'themes-assistant'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );
    $this->add_control(
            'comparison_orientation',
        [
                'label' => esc_html__( 'Select Orientation option', 'themes-assistant' ),
            'description' => esc_html__('Orientation of the before and after images (\'horizontal\' or \'vertical\') ','themes-assistant'),
            'type' => Controls_Manager::SELECT2,
            'multiple' => false,
            'label_block' => 1,
            'options' => [
                    'horizontal' =>  esc_html__( 'Horizontal', 'themes-assistant' ),
                'vertical' =>  esc_html__( 'Vertical', 'themes-assistant' ),
            ],
            'default' => 'vertical',				

            ]
        );

    $this->add_control(
    		'Image_offset',
		[
    			'label' => esc_html__( 'Image offset', 'themes-assistant' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px'],
			'range' => [
    				'px' => [
    					'min' => 0,
					'max' => 1,
					'step' => .1,
				],				
			],
			'default' => [
    				'unit' => 'px',
				'size' => 1,
			],
			'selectors' => [
    				'{{WRAPPER}} .sec-heading' => 'width: {{SIZE}}{{UNIT}};',
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
    $settings           = $this->get_settings_for_display();
    $style              = $settings['image_cmparision_style'];
    $widget_name        = $this->get_name(); // You can make this dynamic
	$AtaWidget          = new AtaWidgetManage($widget_name, $settings, $style);
    $image_offset       = $settings['Image_offset']['size'];
    $orientation        = $settings['comparison_orientation'];
    $beforelabel        = $settings['before_title'];
    $afterlabel         = $settings['after_title'];
    $no_overlay         = $settings['no_overlay'];
    $clickOption        = $settings['click_to_move'];
	}	
}
<?php
/**
 * Class AT_Assistant_image_box
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\AT_Assistant_image_box
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
use ATA\Admin\Views\AtaElementorEnquee;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * AT_Assistant_image_box class extend from Elementor Widget_Base class
 *
 * @since 1.1.0
 */
class Ata_image_box extends Widget_Base { //phpcs:ignore.


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
		return 'ata-image-box';
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
		return esc_html__( 'Image Box', 'themes-assistant' );
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
		return 'eicon-image  borax-el';
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
	protected function _register_controls() { //phpcs:ignore.

		$this->start_controls_section(
			'section_imgbox',
			array(
				'label' => esc_html__( 'Image Box', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'image_layout',
			array(
                'label'   => esc_html__( 'Image box layout', 'themes-assistant' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
                    '1' => esc_html__( 'Layout 1', 'borax' ),
                    '2' => esc_html__( 'Layout 2', 'borax' ),
                    '3' => esc_html__( 'Layout 3', 'borax' ),
                    '4' => esc_html__( 'Layout 4', 'borax' ),
                    '5' => esc_html__( 'Layout 5', 'borax' ),
                    '6' => esc_html__( 'Layout 6', 'borax' ),
                    '7' => esc_html__( 'Layout 7', 'borax' ),
                ],
            )
		);

        $this->add_control(
            'image_shape',
            array(
                'label' => esc_html__( 'Image Style', 'borax' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'borax' ),
                    'Triangle' => esc_html__( 'Triangle', 'borax' ),
                    'Trapezoid' => esc_html__( 'Trapezoid', 'borax' ),
                    'Parallelogram' => esc_html__( 'Parallelogram', 'borax' ),
                    'Rhombus' => esc_html__( 'Rhombus', 'borax' ),
                    'Pentagon' => esc_html__( 'Pentagon', 'borax' ),
                    'Hexagon' => esc_html__( 'Hexagon', 'borax' ),
                    'Heptagon' => esc_html__( 'Heptagon', 'borax' ),
                    'Octagon' => esc_html__( 'Octagon', 'borax' ),
                    'Nonagon' => esc_html__( 'Nonagon', 'borax' ),
                    'Decagon' => esc_html__( 'Decagon', 'borax' ),
                    'Bevel' => esc_html__( 'Bevel', 'borax' ),
                    'Rabbet' => esc_html__( 'Rabbet', 'borax' ),
                    'Left-arrow' => esc_html__( 'Left arrow', 'borax' ),
                    'Right-arrow' => esc_html__( 'Right arrow', 'borax' ),
                    'Left-Point' => esc_html__( 'Left Point', 'borax' ),
                    'Right-Point' => esc_html__( 'Right Point', 'borax' ),
                    'Left-Chevron' => esc_html__( 'Left Chevron', 'borax' ),
                    'Right-Chevron' => esc_html__( 'Right Chevron', 'borax' ),
                    'Star' => esc_html__( 'Star', 'borax' ),
                    'Cross' => esc_html__( 'Cross', 'borax' ),
                    'Message' => esc_html__( 'Message', 'borax' ),
                    'Close' => esc_html__( 'Close', 'borax' ),
                    'Frame' => esc_html__( 'Frame', 'borax' ),
                    'Inset' => esc_html__( 'Inset', 'borax' ),
                    'Custom Polygon' => esc_html__( 'Custom Polygon', 'borax' ),
                    'Circle' => esc_html__( 'Circle', 'borax' ),
                    'Ellipse' => esc_html__( 'Ellipse', 'borax' ),
                ],
                'condition' => [
                  'image_layout' => ['1','2','3','4','5','6'],
                ]	
            )
        );
        $this->add_control(
            'image_shadow',
            array(
                'label' => esc_html__( 'Image Shadow', 'borax' ),
                'type' 	=> Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'borax' ),
                'label_off' => esc_html__( 'Hide', 'borax' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'image_layout' => ['1','2','3','4','5','6'],
                ]	
            )
        );
      
        $this->add_control(
          'imageround',
            array(
                'label' => esc_html__( 'Image Round', 'borax' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],				
                    ],
                    'default' => [
                    'unit' => '%',
                    'size' => 0,
                    ],
                    'selectors' => [
                    '{{WRAPPER}} img' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                    'image_layout' => ['1','2','3','4','5','6'],
                ]
            )
        );

		$this->add_control(
			'image_max_size',
			array(
				'label'      => esc_html__( 'Image Max Height', 'themes-assistant' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 150,
						'max'  => 500,
						'step' => 20,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 200,
				),
				'selectors'  => array(
					'{{WRAPPER}} .service-image-height img' => 'max-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_align',
			array(
				'label'     => esc_html__( 'Content Alignment', 'themes-assistant' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'text-center',
				'options'   => array(
					'text-center' => esc_html__( 'Top Align', 'themes-assistant' ),
					'text-right'  => esc_html__( 'Right Align', 'themes-assistant' ),
					'text-left'   => esc_html__( 'Left Align', 'themes-assistant' ),
				),
				'condition' => array(
					'image_layout' => array( '1', '2', '3' ),
				),
			)
		);

		$this->add_control(
			'box_image',
			array(
				'label'     => esc_html__( ' Image', 'themes-assistant' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'image_layout' => array( '1', '2', '3', '4', '5', '6' ),
				),
			)
		);
		$this->add_control(
			'box_image_dimension',
			array(
				'label'       => esc_html__( 'Image Dimension', 'themes-assistant' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'themes-assistant' ),
				'default'     => array(
					'width'  => '321',
					'height' => '321',
				),
			)
		);
		$this->add_control(
			'space_title',
			array(
				'label'      => esc_html__( 'Space Title and Image Between', 'themes-assistant' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 15,
						'max'  => 150,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .borax-img-box h2' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'top_title',
			array(
				'label'     => esc_html__( 'Top Title', 'themes-assistant' ),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => esc_html__( 'Building Brand is Our Business', 'themes-assistant' ),
				'condition' => array(
					'image_layout' => array( '2', '3' ),
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'     => esc_html__( 'Title', 'themes-assistant' ),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => esc_html__( 'Image Box', 'themes-assistant' ),
				'condition' => array(
					'image_layout' => array( '1', '2', '3', '4', '5', '6' ),
				),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'     => esc_html__( 'Content', 'themes-assistant' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__( 'Content write here', 'themes-assistant' ),
				'condition' => array(
					'image_layout' => array( '1', '2', '3' ),
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => esc_html__( 'Link Text', 'themes-assistant' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'View Project', 'themes-assistant' ),
				'condition' => array(
					'image_layout' => array( '1', '2', '3', '4', '5', '6' ),
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'themes-assistant' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'themes-assistant' ),
				'default'     => array(
					'url' => '',
				),
				'condition'   => array(
					'image_layout' => array( '1', '2', '3', '4', '5', '6', '7' ),
				),
			)
		);

		$repeater = new Repeater();

			$repeater->add_control(
				't_image',
				array(
					'label'   => __( 'Customer/Client Image', 'themes-assistant' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => array(
						'url' => Utils::get_placeholder_image_src(),
					),
				)
			);
			$repeater->add_control(
				'Choose_Animation',
				array(
					'type'    => Controls_Manager::SELECT,
					'label'   => esc_html__( 'Choose Animations', 'themes-assistant' ),
					'default' => 'style1',
					'options' => array(
						'main'                            => esc_html__( 'Main', 'themes-assistant' ),
						'img_flotng_prtclesleftrght_add_cls' => esc_html__( 'Animation 1', 'themes-assistant' ),
						'img_flotng_prtclestpbtm_add_cls' => esc_html__( 'Animation 2', 'themes-assistant' ),
						'holostic_img_cls8'               => esc_html__( 'Animation 3', 'themes-assistant' ),
						'no-animation'                    => esc_html__( 'No Animation', 'themes-assistant' ),
					),
				)
			);

			$this->add_control(
				'list',
				array(
					'label'       => __( 'Repeater List', 'themes-assistant' ),
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => array(
						array(
							't_image'   => esc_html( '' ),
							'animation' => esc_html__( 'John Doe', 'themes-assistant' ),
						),
					),
					'condition'   => array(
						'image_layout' => '7',
					),
					'title_field' => '{{{ name }}}',
				)
			);
			$this->add_control(
				'imagelink',
				array(
					'label'       => esc_html__( 'Image Link', 'tohi' ),
					'type'        => Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://website.com/services', 'themes-assistant' ),
					'default'     => array(
						'url' => '',
					),
					'condition'   => array(
						'image_layout' => '7',
					),
				)
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_additional_options',
				array(
					'label' => esc_html__( 'Additional Options', 'themes-assistant' ),
				)
			);

			$this->add_control(
				'animation',
				array(
					'label'              => esc_html__( 'Animation', 'themes-assistant' ),
					'type'               => Controls_Manager::SELECT,
					'default'            => 'none',
					'options'            => array(
						'none'          => esc_html__( 'None', 'themes-assistant' ),
						'CardAnimation' => esc_html__( 'Card Animation', 'themes-assistant' ),
						'bottom-to-top' => esc_html__( 'Bottom To Top Hover Animation', 'themes-assistant' ),
					),
					'condition'          => array(
						'image_layout' => array( '1', '2', '3', '4', '5', '6' ),
					),
					'frontend_available' => true,
				)
			);

		$this->add_control(
			'background_shape',
			array(
				'label'              => esc_html__( 'Background Shape', 'themes-assistant' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'options'            => array(
					'none'     => esc_html__( 'None', 'themes-assistant' ),
					'no-shape' => esc_html__( 'Enable Shape', 'themes-assistant' ),
				),
				'condition'          => array(
					'image_align' => 'top',
				),
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			array(
				'label' => esc_html__( 'Content', 'themes-assistant' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'box_radius',
			array(
				'label'      => esc_html__( 'Box Radius', 'themes-assistant' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .borax-img-box' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'image_layout' => array( '1', '3', '4', '5', '6' ),
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'themes-assistant' ),
				'selector' => '{{WRAPPER}} .post.service-post:hover',
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'label'    => __( 'Border', 'themes-assistant' ),
				'selector' => '{{WRAPPER}} .post.service-post',
			)
		);
		$this->add_control(
			'imagepadding',
			array(
				'label'      => esc_html__( 'Image Box Padding', 'themes-assistant' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .post.service-post' => 'padding: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'img_title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .borax-img-box h2' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'img_title_hover_color',
			array(
				'label'     => esc_html__( 'Title Hoover Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .borax-img-box:hover h2' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'img_content_color',
			array(
				'label'     => esc_html__( 'Content Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .borax-img-box p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'img_title_typography',
				'label'    => __( 'Title Typography', 'themes-assistant' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .borax-img-box h2',
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'img_content_typography',
				'label'    => __( 'Content Typography', 'themes-assistant' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .borax-img-box p',
			)
		);
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
		$settings     = $this->get_settings_for_display();
		$style        = $settings['image_layout'];
		$widget_title = $this->get_title(); // Get the widget title dynamically.
		// Load Widget design.
		require ATA_WIDGET_DIR . 'image-box/style-' . $style . '.php';
	}
}

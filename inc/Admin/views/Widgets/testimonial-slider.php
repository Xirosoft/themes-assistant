<?php
/**
 * Class ATA_Hero_slider
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\ATA_Hero_slider 
 * @since 1.0.0
 */

namespace ATA\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
use ATA\Admin\Views\AtaElementorEnquee;
use ATA\Utils\AtaWidgetManage;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ata_Testimonial_Slider extends Widget_Base {

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
		return 'ata-testimonial-slider';
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
			return esc_html__( 'Testimonial Slider', 'themes-assistant' );
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
		return 'eicon-editor-quote  borax-el';
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
			'content_section',
			[
				'label' => __( 'Testimonial', 'themes-assistant' ),
			]
		);
        
        $this->add_control(
            'testimonial_style',
            [
                'label' => esc_html__( 'Testimonial style', 'themes-assistant' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'themes-assistant' ),
                    '2' => esc_html__( 'Style 2', 'themes-assistant' ),
                    '3' => esc_html__( 'Style 3', 'themes-assistant' ),
                    '4' => esc_html__( 'Style 4', 'themes-assistant' ),
                    '5' => esc_html__( 'Style 5', 'themes-assistant' ),
                    // '6' => esc_html__( 'Style 6', 'themes-assistant' ),
                ],
            ]
        );

        $this->add_control(
            'image_shape',
            [
                'label' => esc_html__( 'Image Style', 'themes-assistant' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'themes-assistant' ),
                    'Triangle' => esc_html__( 'Triangle', 'themes-assistant' ),
                    'Trapezoid' => esc_html__( 'Trapezoid', 'themes-assistant' ),
                    'Parallelogram' => esc_html__( 'Parallelogram', 'themes-assistant' ),
                    'Rhombus' => esc_html__( 'Rhombus', 'themes-assistant' ),
                    'Pentagon' => esc_html__( 'Pentagon', 'themes-assistant' ),
                    'Hexagon' => esc_html__( 'Hexagon', 'themes-assistant' ),
                    'Heptagon' => esc_html__( 'Heptagon', 'themes-assistant' ),
                    'Octagon' => esc_html__( 'Octagon', 'themes-assistant' ),
                    'Nonagon' => esc_html__( 'Nonagon', 'themes-assistant' ),
                    'Decagon' => esc_html__( 'Decagon', 'themes-assistant' ),
                    'Bevel' => esc_html__( 'Bevel', 'themes-assistant' ),
                    'Rabbet' => esc_html__( 'Rabbet', 'themes-assistant' ),
                    'Left-arrow' => esc_html__( 'Left arrow', 'themes-assistant' ),
                    'Right-arrow' => esc_html__( 'Right arrow', 'themes-assistant' ),
                    'Left-Point' => esc_html__( 'Left Point', 'themes-assistant' ),
                    'Right-Point' => esc_html__( 'Right Point', 'themes-assistant' ),
                    'Left-Chevron' => esc_html__( 'Left Chevron', 'themes-assistant' ),
                    'Right-Chevron' => esc_html__( 'Right Chevron', 'themes-assistant' ),
                    'Star' => esc_html__( 'Star', 'themes-assistant' ),
                    'Cross' => esc_html__( 'Cross', 'themes-assistant' ),
                    'Message' => esc_html__( 'Message', 'themes-assistant' ),
                    'Close' => esc_html__( 'Close', 'themes-assistant' ),
                    'Frame' => esc_html__( 'Frame', 'themes-assistant' ),
                    'Inset' => esc_html__( 'Inset', 'themes-assistant' ),
                    'Custom Polygon' => esc_html__( 'Custom Polygon', 'themes-assistant' ),
                    'Circle' => esc_html__( 'Circle', 'themes-assistant' ),
                    'Ellipse' => esc_html__( 'Ellipse', 'themes-assistant' ),
                ],
            ]
        );
        $this->add_control(
            'image_shadow',
            [
              'label' => esc_html__( 'Image Shadow', 'themes-assistant' ),
              'type' 	=> Controls_Manager::SWITCHER,
              'label_on' => esc_html__( 'Show', 'themes-assistant' ),
                    'label_off' => esc_html__( 'Hide', 'themes-assistant' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
            ]
        );
      
        $this->add_control(
          'imageround',
            [
          'label' => esc_html__( 'Image Round', 'themes-assistant' ),
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
          ]
        );


		$repeater = new Repeater();

		$repeater->add_control(
			'name', [
			'label' => __( 'Name', 'themes-assistant' ),
			'description' => __('The client or customer name for the testimonial', 'themes-assistant'),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'themes-assistant' ),
			]
    	);
		$repeater->add_control(
			'position', [
			'label' => __( 'Position', 'themes-assistant' ),
			'description' => __('The details of the client/customer like company name, position held, company URL etc.', 'themes-assistant'),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'themes-assistant' ),
			]
    	); 

		$repeater->add_control(
		't_image',
		[
			'label' => __( 'Customer/Client Image', 'themes-assistant' ),
			'type' => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		]
		); 
			$repeater->add_control(
				'content', [
				'label' => __( 'Reviewer Quote', 'themes-assistant' ),
				'description' => __('What your customer/client had to say', 'themes-assistant'),
					'type' => Controls_Manager::TEXTAREA,
					'default' => __( '' , 'themes-assistant' ),
				]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'themes-assistant' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						't_image' => __( '', 'themes-assistant' ),
						'name' => __( 'John Doe', 'themes-assistant' ),
						'position' => __( 'Position', 'themes-assistant' ),
						'content' => __( 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'themes-assistant' ),
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
                    'true' => esc_html__( 'Yes', 'themes-assistant' ),
                    'false' => esc_html__( 'No', 'themes-assistant' ),
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
                    'true' => esc_html__( 'Yes', 'themes-assistant' ),
                    'false' => esc_html__( 'No', 'themes-assistant' ),
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
                    'true' => esc_html__( 'Yes', 'themes-assistant' ),
                    'false' => esc_html__( 'No', 'themes-assistant' ),
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
                    'true' => esc_html__( 'Yes', 'themes-assistant' ),
                    'false' => esc_html__( 'No', 'themes-assistant' ),
                ],
                'frontend_available' => true,
            ]
        );
    
        $this->add_control(
            'testi_rtl',
            [
                'label' => __( 'RTL Enable', 'themes-assistant' ),
                'type' => Controls_Manager::SWITCHER,
                'true' => __( 'Enable', 'themes-assistant' ),
                'false' => __( 'Disable', 'themes-assistant' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
    

    
        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__( 'Icon Type', 'themes-assistant' ),
                'type' => Controls_Manager::CHOOSE,
                // 'condition' => [
                //     'testimonial_style' => '2',
                //     'testimonial_style' => '5',
                // ],
                'options' => [
                    'none' => [
                        'title' => esc_html__( 'None', 'themes-assistant' ),
                        'icon' => 'eicon-editor-close',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'themes-assistant' ),
                        'icon' => 'eicon-social-icons',
                    ],
                    'iconclass' => [
                        'title' => esc_html__( 'Icon Class', 'themes-assistant' ),
                        'icon' => 'eicon-text-field',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'themes-assistant' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => true,
            ]
        );
        
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Icon Image', 'themes-assistant' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        ); 
    
     
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'themes-assistant' ),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'icon_type' => 'icon',
                ],
            ]
        );
     
        $this->add_control(
            'iconclass',
            [
                'label' => esc_html__( 'Icon Class', 'themes-assistant' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'borax-spa-bathrobe', 'themes-assistant' ),
                'description' => 'You can get icon class from <a href="https://wpborax.com/demo/borax-v1.0/">Borax Icon</a> or <a href="https://themify.me/themify-icons">Themify Icon</a>',
                'condition' => [
                    'icon_type' => 'iconclass',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__( 'Style', 'themes-assistant' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
    
    
    
        $this->add_control(
            'review_content_color',
            [
                'label' => esc_html__( 'Content Color', 'themes-assistant' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__( '', 'themes-assistant' ),
                'selectors' => [
                    '{{WRAPPER}} .single-test > p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'Content_typography',
                'label' => __( 'Content Typography', 'themes-assistant' ), 
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .single-test > p',
            ]
        );
    
        $this->add_control(
            'name_color',
            [
                'label' => esc_html__( 'Name Color', 'themes-assistant' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__( '', 'themes-assistant' ),
                'selectors' => [
                    '{{WRAPPER}} .single-test p.name' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => __( 'Name Typography', 'themes-assistant' ), 
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .single-test p.name',
            ]
        );
    
        $this->add_control(
            'desigration_color',
            [
                'label' => esc_html__( 'Desigration Color', 'themes-assistant' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__( '', 'themes-assistant' ),
                'selectors' => [
                    '{{WRAPPER}} .single-test .desigration' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desigration_typography',
                'label' => __( 'Name Typography', 'themes-assistant' ), 
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .single-test .desigration',
            ]
        );
       
      
        $this->add_control(
        'margin',
            [
                'label' => esc_html__( 'Feedback Margin', 'themes-assistant' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                '{{WRAPPER}} .single-test > p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
    
    
    
    
      $this->end_controls_section();
    

	}
 
	protected function render() {
		// call load widget script
		$this->load_widget_script();
		
		$settings       = $this->get_settings_for_display();
        $style  		= $settings['testimonial_style'];
        $widget_title = $this->get_title(); // Get the widget title dynamically
        $widget_name  = $this->get_name(); // You can make this dynamic
        $AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style);
	}

}
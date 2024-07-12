<?php
/**
 * Class Ata_Banner
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Banner
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) )  exit; // Exit if accessed directly. 

/**
 * Ata_Banner class extend Elementor Widget_Base
 *
 * @since 1.1.0
 */
class Ata_Hero_Banner extends Widget_Base {

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
		return 'ata-hero-banner';
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
		return esc_html__( 'Hero Banner', 'themes-assistant' );
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
		return 'eicon-banner  borax-el';
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
	protected function _register_controls() { // phpcs:ignore.
        $this->start_controls_section(
            'section_banner',
                [
                'label' => esc_html__( 'Banner', 'themes-assistant' ),
                ]
            );
        
            $this->add_control(
                'banner_layout',
                [
                    'label' => esc_html__( 'Image box layout', 'themes-assistant' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1' => esc_html__( 'Layout 1', 'themes-assistant' ),
                        '2' => esc_html__( 'Layout 2', 'themes-assistant' ),
                    ],
                ]
            );
         
            $this->add_control(
            'top_title',
                [
                'label' => esc_html__( 'Top Title', 'themes-assistant' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Harbal Treatment', 'themes-assistant' ),
                ]
            );
         
            $this->add_control(
            'title',
                [
                'label' => esc_html__( 'Title', 'themes-assistant' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Beauty Means Healthy for You', 'themes-assistant' ),
                ]
            );
         
            $this->add_control(
            'content',
            [
                'label' => esc_html__( 'Subtitle', 'themes-assistant' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Can days you\'ll forth two grass form face you saying, divide. Subdue days light whose. Stars creepeth that creature thing.
        
                ', 'themes-assistant' ),
            ]
            );
        
            $this->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Button Text', 'themes-assistant' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Reservation', 'themes-assistant' ),
                ]
            );
        
            $this->add_control(
                'link',
                [
                    'label' => esc_html__( 'Link', 'elementor' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
                    'default' => [
                        'url' => '',
                    ]
                ]
            );
        
            $this->add_control(
                'video_btn_text',
                [
                    'label' => esc_html__( 'Video Button Text', 'themes-assistant' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Watch our story', 'themes-assistant' ),
                ]
            );
        
            $this->add_control(
                'video_btn_link',
                [
                    'label' => esc_html__( 'Video Button Link', 'elementor' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
                    'default' => [
                        'url' => '',
                    ]
                ]
            );
        
            $this->add_control(
                'image',
                [
                    'label' => esc_html__( 'Banner Image', 'themes-assistant' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'banner_layout' => '1',
                    ],
                ]
            );
        
         
          $this->add_control(
            'image_floating',
            [
                'label' => esc_html__( 'Image Floating switching', 'themes-assistant' ),
                'type' 	=> Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'themes-assistant' ),
                'label_off' => esc_html__( 'Hide', 'themes-assistant' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'banner_layout' => '1',
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
                    'condition' => [
                        'banner_layout' => '1',
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
                'condition' => [
                    'banner_layout' => '1',
                ],
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
                'condition' => [
                    'banner_layout' => '1',
                ],
              ]
            );
        
                $repeater = new Repeater();
        
                $repeater->add_control(
                  't_image', [
                      'label' => __( 'Customer/Client Image', 'themes-assistant' ),
                      'type' => Controls_Manager::MEDIA,
                      'default' => [
                          'url' => Utils::get_placeholder_image_src(),
                      ],
                  ]
                ); 
                $repeater->add_control(
        
                    'Choose_Animation', [
                        'type' => Controls_Manager::SELECT,
                        'label' => esc_html__('Choose Animations', 'themes-assistant'),
                        'default' => 'style1',
                        'options' => [
                            'main' => esc_html__('Main', 'themes-assistant'),
                            'img_flotng_prtclesleftrght_add_cls' => esc_html__('Animation 1', 'themes-assistant'),
                            'img_flotng_prtclestpbtm_add_cls' => esc_html__('Animation 2', 'themes-assistant'),
                            'holostic_img_cls8' => esc_html__('Animation 3', 'themes-assistant'),
                            'no-animation' => esc_html__('No Animation', 'themes-assistant'),
                        ],
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
                                'animation' => __( 'John Doe', 'themes-assistant' ),
                            ],
                        ],
                        'condition' => [
                            'banner_layout' => '1',
                        ],
                        'title_field' => '{{{ name }}}',
                    ]
                );
                $this->add_control(
                    'imagelink',
                    [
                        'label' => esc_html__( 'Image Link', 'tohi' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => esc_html__( 'https://website.com/services', 'themes-assistant' ),
                        'default' => [
                            'url' => '',
                        ],
                        'condition' => [
                            'banner_layout' => '2',
                        ]	
                    ]
                );
        
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style_content',
                [
                    'label' => esc_html__( 'Content', 'themes-assistant' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );
              
            $this->add_control(
                'slide_top_headering',
                [
                    'label' => esc_html__( 'Top Title Color', 'themes-assistant' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => esc_html__( '', 'themes-assistant' ),
                    'selectors' => [
                        '{{WRAPPER}} .banner .content-box span.tagline' => 'color: {{VALUE}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'slide_top_headeing_typo',
                    'label' => __( 'Top Title Typography', 'themes-assistant' ),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    '{{WRAPPER}} .banner .content-box span.tagline',
                ]
            );
          
            $this->add_control(
                'heading',
                [
                    'label' => esc_html__( 'Heading Text Color', 'themes-assistant' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => esc_html__( '', 'themes-assistant' ),
                    'selectors' => [
                        '{{WRAPPER}} .banner .content-box h2' => 'color: {{VALUE}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typo',
                    'label' => __( 'Heading Text Typography', 'themes-assistant' ),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    '{{WRAPPER}}  .banner .content-box h2',
                ]
            );
        
            $this->add_control(
                'slide_subheading',
                [
                    'label' => esc_html__( 'Sub Heading Text Color', 'themes-assistant' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => esc_html__( '', 'themes-assistant' ),
                    'selectors' => [
                        '{{WRAPPER}} .banner .content-box p' => 'color: {{VALUE}};',
                    ],
                ]
            );
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'slide_subheading_typo',
                    'label' => __( 'Sub Heading Text Typography', 'themes-assistant' ),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    '{{WRAPPER}}  .banner .content-box p',
                ]
            );
        
        
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'btnTypo',
                    'label' => __( 'Button Typography', 'themes-assistant' ),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    '{{WRAPPER}}  .banner .content-box a.btn',
                ]
            );
        
        
            $this->add_control(
                'btnTxtColor',
                [
                    'label' => esc_html__( 'Button Text Color', 'themes-assistant' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => esc_html__( '', 'themes-assistant' ),
                    'selectors' => [
                        '{{WRAPPER}} .banner .content-box  a.btn' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'btnTxtHoverColor',
                [
                    'label' => esc_html__( 'Buttob Hover Text Color', 'themes-assistant' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => esc_html__( '', 'themes-assistant' ),
                    'selectors' => [
                        '{{WRAPPER}} .banner .content-box a.btn:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'video_btnTxtColor',
                [
                    'label' => esc_html__( 'Video Button Text Color', 'themes-assistant' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => esc_html__( '', 'themes-assistant' ),
                    'selectors' => [
                        '{{WRAPPER}} .banner .content-box  a.video-btn' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'video_btnTxtHoverColor',
                [
                    'label' => esc_html__( 'Video Buttob Hover Text Color', 'themes-assistant' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => esc_html__( '', 'themes-assistant' ),
                    'selectors' => [
                        '{{WRAPPER}} .banner .content-box a.video-btn:hover' => 'color: {{VALUE}};',
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
		$settings     = $this->get_settings_for_display();
		$style        = $settings['banner_layout'];
		$widget_title = $this->get_title(); // Get the widget title dynamically.
        $widget_name  = $this->get_name(); // You can make this dynamic
        $AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style);
	}
}

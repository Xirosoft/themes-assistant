<?php
namespace Xirosoft\ThemesAssistant\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Widget_icon_box extends Widget_Base {
 
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
		return 'icon-box';
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
		return esc_html__( 'Icon Box', 'themes-assistant' );
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
		return 'eicon-icon-box  borax-el';
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
		return ['themes-assistant'];
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
			'label' => esc_html__( 'Icon Box', 'themes-assistant' ),
		]
    );

    $this->add_control(

        'style', [
            'type' => Controls_Manager::SELECT,
            'label' => esc_html__('Choose Style', 'themes-assistant'),
            'default' => 'style1',
            'options' => [
                'style1' => esc_html__('Style 1', 'themes-assistant'),
            ],
        ]
    );

    $this->add_control(
		'icon_type',
		[
			'label' => esc_html__( 'Icon Type', 'themes-assistant' ),
			'type' => Controls_Manager::CHOOSE,
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
    
    $this->add_control(
		'title',
		[
			'label' => esc_html__( 'Title', 'themes-assistant' ),
			'type' => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Title', 'themes-assistant' ),
		]
    );

    $this->add_control(
        'link',
        [
            'label' => esc_html__( 'Service Link', 'themes-assistant' ),
            'type' => Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://website.com/services', 'themes-assistant' ),
            'default' => [
                'url' => '', 
            ]
        ]
    );
 
    $this->add_control(
		'content',
		[
			'label' => esc_html__( 'Subtitle', 'themes-assistant' ),
			'type' => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'themes-assistant' ),
		]
    );
 
    $this->add_control(
		'view_details_icon',
		[
			'label' => esc_html__( 'Button Icon', 'themes-assistant' ),
			'type' => Controls_Manager::ICONS,
			'condition' => [
				'style' => 'style2',
			],
		]
    );
 
    $this->add_control(
		'btn_text',
      [
        'label' => esc_html__( 'Button Text', 'themes-assistant' ),
        'type' => Controls_Manager::TEXT,
          'default' => esc_html__( 'View Details', 'themes-assistant' ),
          'condition' => [
            'style!' => 'style1'
        ],
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
        'animation',
        [
            'label' => esc_html__( 'Animation', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'none',
            'options' => [
                'none' => esc_html__( 'None', 'themes-assistant' ),
                'CardAnimation' => esc_html__( 'Card Animation', 'themes-assistant' ),
                'bottom-to-top' => esc_html__( 'Bottom To Top Hover Animation', 'themes-assistant' ),
            ],
            'frontend_available' => true,
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
        'select_style',
        [
			'label' => esc_html__( 'Box Style', 'themes-assistant' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one'  => esc_html__( 'Icon Center', 'themes-assistant' ),
				'align-left' => esc_html__( 'Icon Left', 'themes-assistant' ),
				'align-right' => esc_html__( 'Icon Right', 'themes-assistant' ),
            ],
            'condition' => [
				'style' => 'style1',
			],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'heading_typography',
            'label' => __( 'Title Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .icon-heading h3',
        ]
    );

    $this->add_control(
        'heading_color',
        [
			'label' => esc_html__( 'Title Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .iconBox .icon-heading h3' => 'color: {{VALUE}};',
			],
        ]
    );
    $this->add_control(
        'heading_hover_color',
        [
			'label' => esc_html__( 'Title Hover Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .iconBox:hover .icon-heading h3' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'content_typography',
            'label' => __( 'Content Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .iconBox p',
        ]
    );

    $this->add_control(
        'content_color',
        [
			'label' => esc_html__( 'Content Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .iconBox p' => 'color: {{VALUE}};',
			],
        ]
    );



    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'title_typography',
            'label' => __( 'Title Typo', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .icon-heading p',
        ]
    );

    
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_shadow',
            'label' => __( 'Box Shadow', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .iconBox:hover',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border',
            'label' => __( 'Border', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .iconBox',
        ]
    );

    
    $this->add_control(
        'icon_size',
        [
			'label' => esc_html__( 'Icon Size', 'themes-assistant' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px'],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 150,
					'step' => 5,
				],				
			],
			'default' => [
				'unit' => 'px',
				'size' => 30,
			],
			'selectors' => [
				'{{WRAPPER}} .iconBox .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
    );
   
	
    $this->add_control(
        'icon_color',
        [
			'label' => esc_html__( 'Icon Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .iconBox .icon i' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
        'icon_hover_color',
        [
			'label' => esc_html__( 'Icon Hover Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .iconBox:hover .icon i' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
        'icon_bg',
        [
			'label' => esc_html__( 'Icon Background', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .iconBox .icon' => 'background-color: {{VALUE}};',
			],
        ]
    );
    $this->add_control(
        'icon_hover_bg',
        [
			'label' => esc_html__( 'Icon Hover Background', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .iconBox:hover .icon' => 'background-color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
        'iconboxradius',
          [
        'label' => esc_html__( 'Border Radius', 'themes-assistant' ),
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
            '{{WRAPPER}} .iconBox' => 'border-radius: {{SIZE}}{{UNIT}};',
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
    $settings   = $this->get_settings_for_display();
    $style      = $settings[ 'style' ];
    $widget_title = $this->get_title(); // Get the widget title dynamically
    require THEMEASSISTANT_WIDGET_DIR .'icon-box/'.$style.'.php';
  }
}
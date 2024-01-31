<?php
namespace Xirosoft\ThemesAssistant\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager; 
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Widget_team_box extends Widget_Base {
 
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
    return 'team-box';
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
    return esc_html__( 'Team Memeber', 'themes-assistant' );
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
    return 'eicon-person  borax-el';
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
      'team_memeber',
      [
        'label' => esc_html__( 'Team Memeber', 'themes-assistant' ),
      ]
	);
  
	$this->add_control(
        'teams_style',
        [
            'label' => esc_html__( 'Team Style', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => esc_html__( 'Style 1', 'themes-assistant' ),
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
      'team_image_dimension',
      [
        'label' => esc_html__( 'Team Image Dimension', 'themes-assistant' ),
        'type' => Controls_Manager::IMAGE_DIMENSIONS,
        'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'themes-assistant' ),
        'default' => [
          'width' => '232',
          'height' => '288',
        ],
      ]
    );
    $this->add_control(
      'name',
      [
        'label' => esc_html__( 'Name', 'themes-assistant' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_html__( 'Wendy Frazier', 'themes-assistant' ),
      ]
    );
    $this->add_control(
      'position',
      [
        'label' => esc_html__( 'Position', 'themes-assistant' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_html__( 'Software Architect', 'themes-assistant' ),
      ]
	);
	
    $this->end_controls_section();

    

    $this->start_controls_section(
        'team_memeber_socail',
        [
          'label' => esc_html__( 'Social Links', 'themes-assistant' ),
        ]
    );
   
	/* 
		Repeater for social 
	*/
    $repeater = new Repeater();

   
    $repeater->add_control(
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
    
    $repeater->add_control(
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

 
    $repeater->add_control(
		'icon',
		[
			'label' => esc_html__( 'Icon', 'themes-assistant' ),
			'type' => Controls_Manager::ICONS, 
			'condition' => [
				'icon_type' => 'icon',
			],
		]
    );
 
    $repeater->add_control(
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

    $repeater->add_control(
      'url', [
        'label' => esc_html__('Social URL', 'themes-assistant'),
        'type' => Controls_Manager::URL,
        'default' => [
          'url' => esc_attr('#'),
        ],
        'label_block' => true,
      ]
    );

    
    $this->add_control(
      'socials',
      [
        'label' => esc_html__( 'Social Icon', 'themes-assistant' ),
        'type' => Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'separator' => 'before',
        
        'condition' => [
          'teams_style' => ['1','3','4','5'],
        ]
        
      ]
    );

	/* 
		Style one controls
	*/
	$this->add_control(
		'facebook',
		[
			'label' => esc_html__( 'Facebook', 'themes-assistant' ),
			'type' => Controls_Manager::URL,
			'placeholder' => esc_html__( 'https://facebook.com', 'themes-assistant' ),
			'default' => [
				'url' => '',
			],
			'condition' => [
				'teams_style' => '2'
			]
		]
	);
	$this->add_control(
		'twitter',
		[
			'label' => esc_html__( 'Twitter', 'themes-assistant' ),
			'type' => Controls_Manager::URL,
			'placeholder' => esc_html__( 'https://twitter.com', 'themes-assistant' ),
			'default' => [
				'url' => '',
			],
			'condition' => [
				'teams_style' => '2'
			]
		]
	);
	$this->add_control(
		'linkedin',
		[
			'label' => esc_html__( 'Linkedin', 'themes-assistant' ),
			'type' => Controls_Manager::URL,
			'placeholder' => esc_html__( 'https://linkedin.com', 'themes-assistant' ),
			'default' => [
				'url' => '',
			]
			,
			'condition' => [
				'teams_style' => '2'
			]
		]
	);

	$this->end_controls_section();

	/* 
		Style tab
	*/
	$this->start_controls_section(
		'content_section',
		[
			'label' => esc_html__( 'Style', 'themes-assistant' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

    $this->add_control(
		'item_bg_color',
		[
			'label' => esc_html__( 'Item Background Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .team-item, {{WRAPPER}} .single-memb, {{WRAPPER}} .team' => 'background: {{VALUE}}',
			],
		]
	);
    $this->add_control(
		'item_bg_hover_color',
		[
			'label' => esc_html__( 'Item Hover Background Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .team-item:hover, {{WRAPPER}} .single-memb, {{WRAPPER}} .team:hover' => 'background: {{VALUE}}',
			],
		]
	);

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_shadow',
            'label' => __( 'Box Shadow', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .team-item, {{WRAPPER}} .single-memb, {{WRAPPER}} .team',
        ]
    );

  

	$this->add_control(
		'title_color',
		[
			'label' => esc_html__( 'Title Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .single-memb p, {{WRAPPER}} .team .team-info h4' => 'color: {{VALUE}}',
			],
		]
	);

    $this->add_control(
		'icon_color',
		[
			'label' => esc_html__( 'Icon Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .team-item .team-info .social-link a' => 'color: {{VALUE}}',
			],
		]
	);
    $this->add_control(
		'icon_hover_color',
		[
			'label' => esc_html__( 'Icon Hover Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .team-item:hover .team-info .social-link a' => 'color: {{VALUE}}',
			],
		]
	);

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'title_type',
            'label' => __( 'Title Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .single-memb h5, {{WRAPPER}} .team .team-info h4',
        ]
    );


	$this->add_control(
		'position_color',
		[
			'label' => esc_html__( 'Position Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .memb-details span, {{WRAPPER}} .team .team-info p' => 'color: {{VALUE}}',
			],
		]
	);

  $this->add_control(
		'social_color',
		[
			'label' => esc_html__( 'Socials Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .memb-details .memb-social a' => 'color: {{VALUE}}',
			],
		]
	);

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'title_name_type',
            'label' => __( 'Name Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .memb-details h5, {{WRAPPER}} .team .team-info h5',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'position_type',
            'label' => __( 'Position Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .memb-details span, {{WRAPPER}} .team .team-info p',
        ]
    );

    $this->add_control(
        'teamradius',
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
            '{{WRAPPER}} .team-item, {{WRAPPER}} .single-memb, {{WRAPPER}} .team' => 'border-radius: {{SIZE}}{{UNIT}};',
          ],
        ]
      );

      $this->add_control(
        'teampadding',
          [
        'label' => esc_html__( 'Item Padding', 'themes-assistant' ),
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
            '{{WRAPPER}} .team-item, {{WRAPPER}} .single-memb, {{WRAPPER}} .team' => 'padding: {{SIZE}}{{UNIT}};',
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
		$settings 	= $this->get_settings_for_display();
		$style 		=  $settings['teams_style']; 
		$socials 	=  $settings['socials'];
    $widget_title = $this->get_title(); // Get the widget title dynamically

    require THEMEASSISTANT_WIDGET_DIR .'team/style-'.$style.'.php';
   		
	}	

  	protected function _content_template() {
	}
}
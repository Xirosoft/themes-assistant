<?php
/**
 * Class Ata_Portfolio
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Portfolio 
 * @since 1.0.0
 */

 namespace ATA\Widgets;

use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
Use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Core\Schemes;
use Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Css_Filter;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ata_Portfolio extends Widget_Base {

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
			return 'ata-portfolio';
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
			return esc_html__( 'Portfolio', 'themes-assistant' );
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
			return 'eicon-gallery-grid  borax-el';
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
			'section_banner',
		[
				'label' => esc_html__( 'Portfolio', 'themes-assistant' ),
			'tab' => Controls_Manager::TAB_CONTENT
		]	
	);
	$this->add_control(
	        'portfolio_style',
        [
	            'label' =>esc_html__( 'Portfolio Style', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
	            '1'      => esc_html__( 'Style 1', 'themes-assistant' ),
                '2'      => esc_html__( 'Style 2', 'themes-assistant' ),
                '3'      => esc_html__( 'Style 3', 'themes-assistant' ),
                '4'      => esc_html__( 'Style 4', 'themes-assistant' ),
            ],
            'prefix_class' => 'elementor%s-align-',
            'default' => 'style-1',
        ]
    );

	// Enable repataer
	$repeaters = new Repeater();
	$repeaters->add_control(
			'portfolio_title',
		[
				'label' => esc_html__( 'Portfolio Title', 'themes-assistant' ),
			'type' 	=> Controls_Manager::TEXT,
			'default' => esc_html__( 'Creative Agency', 'themes-assistant' ),
		]
	);
	$repeaters->add_control(
		'portfolio_category',
		[
				'label' => esc_html__( 'Portfolio Category', 'themes-assistant' ),
			'type' 	=> Controls_Manager::TEXT,
			'default' => esc_html__( 'design', 'themes-assistant' ),
		]
	);
	$repeaters->add_control(
		'portfolio_description',
		[
				'label' => esc_html__( 'Portfolio Description', 'themes-assistant' ),
			'type' 	=> Controls_Manager::TEXT,
			'default' => esc_html__( 'Frass form face you', 'themes-assistant' ),

		]
	);
	$repeaters->add_control(
			'preview_link',
		[
				'label' => esc_html__( 'Preview Link', 'themes-assistant' ),
			'type' 	=> Controls_Manager::URL,
			'placeholder' => esc_attr__( 'https://your-link.com', 'themes-assistant' ),
			'show_external' => true, 
			'default' => [
				'url' => 'https://themeies.com/',
			'is_external' => true,
			'nofollow' => true,
			]
		]
	);
	$repeaters->add_control(
			'portfolio_image',
		[
				'label' => esc_html__( 'Portfolio Image', 'themes-assistant' ),
			'type' 	=> Controls_Manager::MEDIA,
			'default' => [
					'url' => Utils::get_placeholder_image_src(),
			],
			'label_block' => true,
			'dynamic' => [
					'active' => true,
			],
		]
	);
	$repeaters->add_control(
		'portfolio_image_dimension',
		[
			'label' => esc_html__( 'Image Dimension', 'themes-assistant' ),
			'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
			'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'themes-assistant' ),
			'default' => [
				'width' => '343',
				'height' => '343',
			],
		]
	);
	$this->add_control(
			'list',
		[
				'label' => esc_html__( 'Portfolios List', 'themes-assistant' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $repeaters->get_controls(),
			'default' => [
					[
						'portfolio_title' 	 => esc_html__( 'Creative agency', 'themes-assistant' ),
					'portfolio_category' => esc_html__( 'design seo', 'themes-assistant' ),
					'preview_link' 		 => esc_html__( 'https://themenies.com', 'themes-assistant' ),
					'portfolio_description' 		 => esc_html__( 'Can days you will forth two grass form face you', 'themes-assistant' ),
					'portfolio_image' 	 => esc_html__( '', '' ),
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
			'show_filter',
		[
				'label' => esc_html__( 'Show Filter', 'themes-assistant' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Show', 'themes-assistant' ),
			'label_off' => esc_html__( 'Hide', 'themes-assistant' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);
	$this->add_control(
			'category_name',
		[
			'label' => esc_html__( 'Portfolio Categories', 'themes-assistant' ),
		'type' 	=> Controls_Manager::TEXTAREA,
		'placeholder' => esc_attr__( 'Cateory add with "," coma Example: Design, Development', 'themes-assistant' ),
		'default' => esc_html__( 'design, seo, development', 'themes-assistant' )
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

	$this->end_controls_section();
    $this->start_controls_section(
	        'portfolio_section_style_content',
        [
	            'label' => esc_html__( 'Content Style', 'themes-assistant' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );
	$this->start_controls_tabs(
		'portfolio_style_tabs',
		[
			'label' => esc_html__( 'Image Fliter Effacts', 'themes-assistant' ), 
		]
	);
	$this->start_controls_tab(
		'port_image_normal_tab',
		[
			'label' => esc_html__( 'Normal', 'themes-assistant' ),
			'condition' => [
					'icon_type' => 'image',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Css_Filter::get_type(),
		[
			'name' => 'borax_portfolio_filters_normal',
			'label' => esc_html__( 'Image Fliter', 'themes-assistant' ),
			'selector' => '{{WRAPPER}} .portfolioITems .portGrid .protItem img',
			'condition' => [
					'icon_type' => 'image',
			],
		]
	);

	$this->end_controls_tab();

	$this->start_controls_tab(
		'port_image_hover_tab',
		[
			'label' => esc_html__( 'Hover', 'themes-assistant' ),
			'condition' => [
					'icon_type' => 'image',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Css_Filter::get_type(),
		[
			'name' => 'borax_portfolio_filters_hover',
			'label' => esc_html__( 'Image Fliter on Hover', 'themes-assistant' ),
			'selector' => '{{WRAPPER}} .portfolioITems .portGrid .protItem:hover img',
			'condition' => [
					'icon_type' => 'image',
			],
		]
	);
	$this->end_controls_tab();

	$this->end_controls_tabs();

    $this->add_group_control(
	        \Elementor\Group_Control_Typography::get_type(),
        [
	            'name' => 'filter_typography',
            'label' => __( 'Filter Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .portfolioITems .filters button',
        ]
    );
    $this->add_control(
	        'filter_color',
        [
				'label' => esc_html__( 'Filter Text Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
					'{{WRAPPER}} .portfolioITems .filters button' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
	        'filter_hover_active_color',
        [
				'label' => esc_html__( 'Filter Hover/Active  Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
					'{{WRAPPER}} .portfolioITems .filters button.active, .portfolioITems .filters button:hover' => 'color: {{VALUE}};',
			],
        ]
    );
    $this->add_control(
	        'filter_btn_bg_color',
        [
				'label' => esc_html__( 'Filter Background Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
					'{{WRAPPER}} .portfolioITems .filters button' => 'background: {{VALUE}};',
			],
        ]
    );
    $this->add_control(
	        'filter_btn_hover_bg_color',
        [
				'label' => esc_html__( 'Filter Hover/Active BG Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
					'{{WRAPPER}} .portfolioITems .filters button.active, .portfolioITems .filters button:hover' => 'background: {{VALUE}};',
			],
        ]
    );
    $this->add_control(
	        'filterradious',
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
	            '{{WRAPPER}}  .portfolioITems .filters button' => 'border-radius: {{SIZE}}{{UNIT}};',
          ],
        ]
      );

    $this->add_group_control(
	        \Elementor\Group_Control_Typography::get_type(),
        [
	            'name' => 'heading_typography',
            'label' => __( 'Title Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .portGrid .protItem .demoBox h3.pTitle',
        ]
    );
    $this->add_control(
	        'heading_color',
        [
				'label' => esc_html__( 'Title Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
					'{{WRAPPER}} .portGrid .protItem .demoBox h3.pTitle' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_group_control(
	        \Elementor\Group_Control_Typography::get_type(),
        [
	            'name' => 'content_typography',
            'label' => __( 'Content Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .portGrid .protItem .demoBox p.pCat',
        ]
    );
    $this->add_control(
	        'content_color',
        [
				'label' => esc_html__( 'Content Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
					'{{WRAPPER}} .portGrid .protItem .demoBox p.pCat' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .portfolioITems .portGrid .protItem .demoBox a i' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .portfolioITems .portGrid .protItem .demoBox a i' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .portfolioITems .portGrid .protItem .demoBox a:hover i' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .portfolioITems .portGrid .protItem .demoBox a.port_popup, {{WRAPPER}} .port-item:hover .img-box .port_popup' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .portfolioITems .portGrid .protItem .demoBox a.port_popup:hover, {{WRAPPER}} .portfolioITems .portGrid .port-item .demoBox a.port_popup' => 'background-color: {{VALUE}};',
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
	            '{{WRAPPER}} .portfolioITems .portGrid .protItem .demoBox a.port_popup' => 'border-radius: {{SIZE}}{{UNIT}};',
          ],
        ]
      );

	$this->start_controls_tabs(
		'style_tabs',
		[
			'label' => esc_html__( 'Image Icon Fliter', 'themes-assistant' ), 
		]
	);
	$this->start_controls_tab(
		'port_icon_normal_tab',
		[
			'label' => esc_html__( 'Normal', 'themes-assistant' ),
			'condition' => [
					'icon_type' => 'image',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Css_Filter::get_type(),
		[
			'name' => 'borax_css_filters_normal',
			'label' => esc_html__( 'Image Icon Fliter', 'themes-assistant' ),
			'selector' => '{{WRAPPER}} .protItem .port_popup img',
			'condition' => [
					'icon_type' => 'image',
			],
		]
	);

	$this->end_controls_tab();

	$this->start_controls_tab(
		'port_icon_hover_tab',
		[
			'label' => esc_html__( 'Hover', 'themes-assistant' ),
			'condition' => [
					'icon_type' => 'image',
			],
		]
	);
	$this->add_group_control(
		Group_Control_Css_Filter::get_type(),
		[
			'name' => 'borax_css_filters_hover',
			'label' => esc_html__( 'Image Icon Fliter on Hover', 'themes-assistant' ),
			'selector' => '{{WRAPPER}} .protItem .port_popup:hover img',
			'condition' => [
					'icon_type' => 'image',
			],
		]
	);
	$this->end_controls_tab();

	$this->end_controls_tabs();
		
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

	// call load widget script
    $this->load_widget_script();
    // Settings
	$settings = $this->get_settings_for_display(); 
	$style = $settings['portfolio_style'];
    $widget_name  = $this->get_name(); // You can make this dynamic
		$AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style);
  	require BORAX_WIDGET_DIR .'portfolio/'.$style.'.php';
 
	}
	public function load_widget_script(){
		if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) { ?>
		<script>
			(function($) {
			})(jQuery);
		</script>
		<?php 
		}
	}

}
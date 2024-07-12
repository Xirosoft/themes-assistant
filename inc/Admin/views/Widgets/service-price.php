<?php
/**
 * Class Ata_Servie_Price
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Servie_Price 
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
Use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * @since 1.1.0
 */
class Ata_Servie_Price extends Widget_Base {
 
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
		return 'ata-service-price';
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
		return esc_html__( 'Service Widget', 'themes-assistant' );
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
		return 'eicon-integration  borax-el';
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
      'section_service',
      [
        'label' => esc_html__( 'Service and Pricing', 'themes-assistant' ),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );
 

    $this->add_control(
        'service_style',
        [
            'label' =>esc_html__( 'Service Style', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'style-1'      => esc_html__( 'Style 1', 'themes-assistant' ),
                'style-2'      => esc_html__( 'Style 2', 'themes-assistant' ),
            ],
            'prefix_class' => 'elementor%s-align-',
            'default' => 'style-1',
        ]
    );

    $this->add_control(
		'category_name',
		[
		'label' => esc_html__( 'Portfolio Categories', 'themes-assistant' ),
		'type' 	=> Controls_Manager::TEXTAREA,
		'placeholder' => esc_attr__( 'Cateory add with "," coma Example: Design, Development', 'themes-assistant' ),
		'default' => esc_html__( 'design, seo, development', 'themes-assistant' ),
        'condition' => [
            'service_style' => 'style-2',
        ],
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
            'condition' => [
                'service_style' => 'style-2',
            ],
		]
	);
    
	$repeater = new Repeater();

    $repeater->add_control(
        'category_name_container',
        [
            'label' => esc_html__( 'Item Category' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Hand feet ', 'themes-assistant' ),
        ]
        ); 

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
            'description' => 'You can get icon class from <a href="//themeies.com/borax/">Borax Icon</a> or <a href="https://themify.me/themify-icons">Themify Icon</a>',
            'condition' => [
				'icon_type' => 'iconclass',
			],
		]
    );

    $repeater->add_control(
        'image_max',
        [
			'label' => esc_html__( 'Max Image Size', 'themes-assistant' ),
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
				'{{WRAPPER}} .borax-sp-wrapper .borax-pricing-list-item .icon img.img-icon' => 'max-width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
				'icon_type' => 'image',
			],
		]
    );

    $repeater->add_control(
      'service_title',
      [
          'label' => esc_html__( 'Title', 'themes-assistant' ),
          'type' => Controls_Manager::TEXT,
          'default' => esc_html__( 'Hand & feet ', 'themes-assistant' ),
      ]
    ); 
    
	$repeater->add_control(
		'service_subtitle',
		[
			'label' => esc_html__( 'Sub Title', 'themes-assistant' ),
			'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Lorem ipsum dolor sit amet, quo ut simul', 'themes-assistant' ),
		]
      ); 
      

      $repeater->add_control(
        'service_price',
        [
            'label' => esc_html__( 'Price', 'themes-assistant' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( '$70', 'themes-assistant' ),
        ]
      ); 
  
      $repeater->add_control(

        'price_labels', [
            'type' => Controls_Manager::SELECT,
            'label' => esc_html__('Choose Style', 'themes-assistant'),
            'default' => 'style1',
            'options' => [
                'new' => esc_html__('New', 'themes-assistant'),
                'best' => esc_html__('Best', 'themes-assistant'),
                'popular' => esc_html__('Popular', 'themes-assistant'),
            ],
        ]
    );

    $repeater->add_control(
        'discount',
        [
          'label' => esc_html__( 'Discount', 'themes-assistant' ),
          'type' => Controls_Manager::CHOOSE,
          'default' => 'no',
          'options' => [
            'no'  => esc_html__( 'No', 'themes-assistant' ),
            'active' => esc_html__( 'Yes', 'themes-assistant' ),
          ],
        ]
    );

    $repeater->add_control(
        'discount_rice',
        [
            'label' => esc_html__( 'Discount Price', 'themes-assistant' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( '$30', 'themes-assistant' ),
            'condition' => [
            'discount' => 'active',
          ],
        ]
      ); 

      $repeater->add_control(
        'link',
        [
            'label' => esc_html__( 'Link', 'themes-assistant' ),
            'type' => Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://website.com/services', 'themes-assistant' ),
            'default' => [
                'url' => '',
            ]
        ]
    );

    $this->add_control(
        'service_pricing_list',
        [
            'label' => esc_html__( 'Service Pricing list', 'themes-assistant' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ service_title }}}',
        ]
    );

    $this->add_control(
        'icon_max',
        [
			'label' => esc_html__( 'Max Icon Size', 'themes-assistant' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px'],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 150,
					'step' => 5,
				],				
			],
			'selectors' => [
				'{{WRAPPER}} .pricing-list-item .icon i, {{WRAPPER}} .pricing-list-item .icon i.fa' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
				'icon_type' => ['icon','iconclass'],
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
        'icon_box_width',
          [
        'label' => esc_html__( 'Icon Column Width', 'themes-assistant' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px'],
        'range' => [
            'px' => [
              'min' => 70,
              'max' => 100,
              'step' => 1,
            ],				
          ],
          'default' => [
            'unit' => 'px',
            'size' => 0,
          ],
          'selectors' => [
            '{{WRAPPER}} .sp-wrapper .pricing-list-item .icon' => 'min-width: {{SIZE}}{{UNIT}};',
          ],
        ]
      );
    
	$this->add_control(
        'icon_box_height',
          [
        'label' => esc_html__( 'Icon Column Height', 'themes-assistant' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px'],
        'range' => [
            'px' => [
              'min' => 70,
              'max' => 100,
              'step' => 1,
            ],				
          ],
          'default' => [
            'unit' => 'px',
            'size' => 0,
          ],
          'selectors' => [
            '{{WRAPPER}} .sp-wrapper .pricing-list-item .icon' => 'min-height: {{SIZE}}{{UNIT}};',
          ],
        ]
      );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'heading_typography',
            'label' => __( 'Title Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .sp-wrapper .pricing-list-item .content h2',
        ]
    );

    $this->add_control(
        'heading_color',
        [
			'label' => esc_html__( 'Title Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .sp-wrapper .pricing-list-item .content h2' => 'color: {{VALUE}};',
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
				'{{WRAPPER}} .sp-wrapper .pricing-list-item:hover .content h2' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'content_typography',
            'label' => __( 'Content Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .sp-wrapper .pricing-list-item .content p',
        ]
    );

    $this->add_control(
        'content_color',
        [
			'label' => esc_html__( 'Content Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .sp-wrapper .pricing-list-item .content p' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_shadow',
            'label' => __( 'Box Shadow', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .sp-wrapper .pricing-list-item',
        ]
    );
    
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_shadow_hover',
            'label' => __( 'Box Shadow Hover', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .sp-wrapper .pricing-list-item:hover',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border',
            'label' => __( 'Border', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .sp-wrapper .pricing-list-item',
        ]
    );

    
    
	
    $this->add_control(
        'icon_color',
        [
			'label' => esc_html__( 'Icon Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .sp-wrapper .pricing-list-item .icon i' => 'color: {{VALUE}};',
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
				'{{WRAPPER}} .sp-wrapper .pricing-list-item:hover .icon i' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
        'item_bg',
        [
			'label' => esc_html__( 'Item Background', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .sp-wrapper .pricing-list-item' => 'background-color: {{VALUE}};',
			],
        ]
    );
    $this->add_control(
        'item_hover_bg',
        [
			'label' => esc_html__( 'Item Hover Background', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}}.sp-wrapper .pricing-list-item:hover' => 'background-color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
        'item_box_radius',
          [
        'label' => esc_html__( 'Item Border Radius', 'themes-assistant' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px'],
        'range' => [
            'px' => [
              'min' => 0,
              'max' => 100,
              'step' => 5,
            ],				
          ],
          'default' => [
            'unit' => 'px',
            'size' => 0,
          ],
          'selectors' => [
            '{{WRAPPER}} .sp-wrapper .pricing-list-item' => 'border-radius: {{SIZE}}{{UNIT}};',
          ],
        ]
      );

      $this->add_control(
        'item_margin',
        [
            'label' => esc_html__( 'Item Margin', 'themes-assistant' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px'],
            'selectors' => [
                '{{WRAPPER}} .sp-wrapper .pricing-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->add_control(
        'icon_box_bg_shape_width',
          [
        'label' => esc_html__( 'Icon background ShapeWidth', 'themes-assistant' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px','%'],
        'range' => [
            'px' => [
              'min' => 0,
              'max' => 100,
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
            '{{WRAPPER}} .sp-wrapper .pricing-list-item .icon:before' => 'width: {{SIZE}}{{UNIT}};',
          ],
        ]
      );
    $this->add_control(
        'icon_box_bg_shape_height',
          [
        'label' => esc_html__( 'Icon background Shape Height', 'themes-assistant' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px','%'],
        'range' => [
            'px' => [
              'min' => 0,
              'max' => 100,
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
            '{{WRAPPER}} .sp-wrapper .pricing-list-item .icon:before' => 'height: {{SIZE}}{{UNIT}};',
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
				'{{WRAPPER}} .sp-wrapper .pricing-list-item .icon:before' => 'background-color: {{VALUE}};',
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
				'{{WRAPPER}} .sp-wrapper .pricing-list-item:hover .icon:before' => 'background-color: {{VALUE}};',
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
            '{{WRAPPER}} .sp-wrapper .pricing-list-item .icon:before' => 'border-radius: {{SIZE}}{{UNIT}};',
          ],
        ]
      );

      $this->add_control(
        'icon_box_padding',
          [
        'label' => esc_html__( 'Icon Padding', 'themes-assistant' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px'],
        'range' => [
            '%' => [
              'min' => 0,
              'max' => 50,
              'step' => 1,
            ],				
          ],
          'default' => [
            'unit' => '%',
            'size' => 0,
          ],
          'selectors' => [
            '{{WRAPPER}} .sp-wrapper .pricing-list-item .icon' => 'padding: {{SIZE}}{{UNIT}};',
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
    
        $settings = $this->get_settings_for_display();
        $style = $settings['service_style'];
        $widget_title = $this->get_title(); // Get the widget title dynamically
        if (LICFY_TYPE == 1 || LICFY_TYPE === null || LICFY_TYPE === 'undefined') {
            ?>
                <div class="pro-widget">
                    <h3 class="borax_pro_title"><?php echo esc_html__($widget_title. ' Widget', 'themes-assistant'); ?></h3>
                    <div class="dialog-message"><?php echo esc_html__('Leverage this feature, along with numerous other premium features, to expand your Website, enabling faster and superior website development.', 'themes-assistant'); ?> </div>
                    <a href="<?php echo WPBORAX; ?>" target="_blank" class="dialog-button button-success"><?php echo esc_html__('Go Pro', 'themes-assistant') ?></a> 
                </div>
            <?php
            return false; 
        }
        require BORAX_WIDGET_DIR .'service-price/'.$style.'.php';
		?>
		
	<?php
	}
}
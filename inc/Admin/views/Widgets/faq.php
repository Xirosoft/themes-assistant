<?php
/**
 * Class Ata_faq
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_faq 
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
Use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Core\Schemes;
use Elementor\Core\Schemes\Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Ata_faq extends Widget_Base {
   
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
  		return 'ata-faq';
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
  		return esc_html__( 'Faq', 'themes-assistant' );
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
  		return 'eicon-accordion  borax-el';
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
          'label' => esc_html__( 'Faq', 'themes-assistant' ),
      ]
    );
    $this->add_control(
        'faq_style',
        [
              'label' => esc_html__( 'FAQ style', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'version-1',
            'options' => [
                  'version-1' => esc_html__( 'Style 1', 'themes-assistant' ),
                'version-2' => esc_html__( 'Style 2', 'themes-assistant' ),
            ],
            'frontend_available' => true,
        ]
    );
    $repeater = new \Elementor\Repeater();
 
    $repeater->add_control(
        'title',
      [
          'label' => esc_html__( 'Title', 'themes-assistant' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_html__( '', 'themes-assistant' ),
      ]
    );
    $repeater->add_control(
        'text',
      [
          'label' => esc_html__( 'Text', 'themes-assistant' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => esc_html__( '', 'themes-assistant' ),
      ]
    );
    $this->add_control(
          'list',
        [
              'label' => esc_html__( 'Faq List', 'themes-assistant' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                  [
          			'iamge' => esc_html__( '', 'themes-assistant' ),					
      			],
                [
                      'title' => esc_html__( '', 'themes-assistant' ),
                ],
            ],
            'title_field' => '{{{ title }}}',
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
  				'{{WRAPPER}} .portfolioITems .portGrid .protItem .demoBox a.port_popup:hover, , {{WRAPPER}} .portfolioITems .portGrid .port-item .demoBox a.port_popup' => 'background-color: {{VALUE}};',
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
      $style = $settings['faq_style'];
      $widget_name  = $this->get_name(); // You can make this dynamic
		$AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style);
    ?>
	<div class="faq">
  		<div class="accordion <?php if('version-2' == $settings['style'] ){ echo 'version-2'; } ?>" id="accordionExample">
			<?php
				if ( $settings['list'] ) {
  					$i = 0;
					foreach (  $settings['list'] as $item ) {
  						$i++;
						if($i === 1) { ?> 
						<div class="card">
  							<div class="card-header" id="headingOne">
  								<button class="a-btn btn-link" type="button" data-toggle="collapse" data-target="#aa<?php echo $i ?>"
									aria-expanded="true" aria-controls="collapseOne">
									<?php echo esc_html($item['title'],'themes-assistant') ?>
								</button> 
							</div>
							<div id="aa<?php echo $i ?>" class="collapse show" aria-labelledby="headingOne"
								data-parent="#accordionExample">
								<div class="card-body">
  									<?php echo wp_kses_post($item['text']); ?>
								</div>
							</div>
						</div> <?php
									}else{?>
						<div class="card">
  							<div class="card-header" id="headingOne">
  								<button class="a-btn btn-link collapsed" type="button" data-toggle="collapse"
									data-target="#aa<?php echo esc_attr($i); ?>" aria-expanded="false" aria-controls="collapseOne">
									<?php echo esc_html($item['title']); ?>
								</button>
							</div>
							<div id="aa<?php echo $i ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body">
  									<?php echo wp_kses_post($item['text']); ?>
								</div>
							</div>
						</div>
						<?php
						}
					}
				}
				?>
		</div>
	</div>
	<?php
}
}
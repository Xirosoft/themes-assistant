<?php
/**
 * Class Ata_Office_Hours
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Office_Hours 
 * @since 1.0.0
 */

 namespace ATA\Widgets;
 
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Ata_Office_Hours extends Widget_Base {
 
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
		return 'ata-office-hour';
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
		return esc_html__( 'Opening Hour', 'themes-assistant' );
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
		return 'eicon-clock-o  borax-el';
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
        'label' => esc_html__( 'List Items', 'themes-assistant' ),
        'tab' => Controls_Manager::TAB_CONTENT,
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
        'heading',
        [
            'label' => esc_html__( 'Heading Title', 'themes-assistant' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Opening Hours', 'themes-assistant' ),
        ]
    ); 
    $this->add_control(
        'sub_heading',
        [
            'label' => esc_html__( 'Sub Heading Title', 'themes-assistant' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Mea ei paulo debitis affert nominati usu eu, et ius dicta detraxit probatus facete nusquam deleniti.', 'themes-assistant' ),
        ]
    ); 


    $repeater = new Repeater();

    $repeater->add_control(
      'day_name',
      [
          'label' => esc_html__( 'Enter Day Name', 'themes-assistant' ),
          'type' => Controls_Manager::TEXT,
          'default' => esc_html__( 'Friday', 'themes-assistant' ),
      ]
    ); 
    $repeater->add_control(
      'start_time_value',
      [
          'label' => esc_html__( 'Start Time', 'themes-assistant' ),
          'type' => Controls_Manager::DATE_TIME,
          'picker_options' => [
            'enableTime' => true,
            'noCalendar' => true,
            'dateFormat' => 'h:i:K',
            'defaultHour' => '12',
            
          ],
          'default' => esc_html__( '9:00 AM', 'themes-assistant' ),
      ]
    ); 
    $repeater->add_control(
      'end_time_value',
      [
          'label' => esc_html__( 'End Time', 'themes-assistant' ),
          'type' => Controls_Manager::DATE_TIME,
          'default' => esc_html__( '8:00 PM', 'themes-assistant' ),
          'picker_options' => [
            'enableTime' => true,
            'noCalendar' => true,
            'dateFormat' => 'h:i:K',
            'defaultHour' => '12',
          ],
      ]
    ); 

    $repeater->add_control(
        'closed',
        [
            'label' => __( 'Open/Close', 'themes-assistant' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Opend', 'themes-assistant' ),
            'label_off' => __( 'Closed', 'themes-assistant' ),
            'return_value' => 'no',
            'default' => 'yes',
        ]
    );
    $this->add_control(
        'open_hours',
        [
            'label' => esc_html__( 'Open Hours', 'themes-assistant' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ day_name }}}',
        ]
    );

    $this->end_controls_section();

 
    // Style
    $this->start_controls_section(
        'section_style_content',
        [
            'label' => esc_html__( 'Style', 'themes-assistant' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'headingTypeo',
            'label' => __( 'Heading Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .service-widget h3',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'sub_head_typography',
            'label' => __( 'Sub Heading Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .service-widget p',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'table_content_typography',
            'label' => __( 'Table Data Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .service-widget .sp-wrapper .pricing-list-item .content p',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_shadow',
            'label' => __( 'Box Shadow', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .service-widget',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border',
            'label' => __( 'Border', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .service-widget',
        ]
    );
    
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'item_border',
            'label' => __( 'Item Border', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .sp-wrapper .pricing-list-item:not(:last-child)',
        ]
    );

    $this->add_control(
        'show_border',
        [
            'label' => esc_html__( 'Show Border Animation', 'plugin-name' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'themes-assistant' ),
            'label_off' => esc_html__( 'Hide', 'themes-assistant' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );
    


    $this->add_control(
        'item_icon_color',
        [
            'label' => esc_html__( 'Icon Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .icon' => 'color: {{VALUE}}',
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
	?>
    <div class="service-widget open_hours">
        <?php 
            if ( 'yes' === $settings['show_border'] ) {
                echo '<span class="open_border"></span>';
            }
        ?>
        
        <?php if( $settings['icon_type'] == 'icon'):?>
        <span class="icon">
            <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </span>
        <?php elseif( $settings['icon_type'] == 'iconclass'):?>
        <span class="icon">
            <i class="<?php echo esc_html__($settings['iconclass'], 'themes-assistant'); ?>"></i>
        </span>
        <?php elseif( $settings['icon_type'] == 'image'):?>
        <span class="icon">
            <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="" class="img-icon" width="40" height="40">
        </span>
        <?php endif;?>

        <h3><?php echo esc_html__($settings['heading'],'themes-assistant'); ?></h3>
        <p><?php echo esc_html__($settings['sub_heading'],'themes-assistant'); ?></p>
        <div class="sp-wrapper">
			<?php if ( $settings['open_hours'] ): 
                foreach (  $settings['open_hours'] as $item ): ?>
					<div class="pricing-list-item <?php if($item['closed'] == 'no'){echo esc_attr('closeday'); } ?>">
						<div class="d-flex justify-content-between">
							<div class="content">
								<p><?php echo esc_html__($item['day_name'], 'themes-assistant'); ?></p>
                            </div>
							<div class="content">
                                <?php if($item['closed'] == 'no'): ?>
                                <span><?php echo esc_html__('Closed', 'themes-assistant'); ?></span>
                                <?php else: ?>
                                    <span><?php echo esc_html__($item['start_time_value'], 'themes-assistant'); ?></span>
                                    <span><?php echo esc_html__('---', 'themes-assistant'); ?></span>
                                    <span><?php echo esc_html__($item['end_time_value'], 'themes-assistant'); ?></span>
                                <?php endif; ?>
							</div>
						</div>	
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
    </div>
    <?php

}

}
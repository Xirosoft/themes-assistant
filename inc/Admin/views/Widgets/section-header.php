<?php
namespace AT_Assistant\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
Use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Core\Schemes;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Widget_section_header extends Widget_Base {
 
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
    return 'section-header';
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
    return esc_html__( 'Section Header', 'themes-assistant' );
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
    return 'eicon-header  borax-el';
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
		'section_header',
		[
		'label' => esc_html__( 'Section Header', 'themes-assistant' ),
		]
	);


	$this->add_control(
	'top_title',
		[
		'label' => esc_html__( 'Top Title', 'themes-assistant' ),
		'type' => Controls_Manager::TEXTAREA,
		'default' => esc_html__( 'Top title', 'themes-assistant' ),
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
		'description',
		[
		'label' => esc_html__( 'Description', 'themes-assistant' ),
		'type' => Controls_Manager::WYSIWYG,
		'default' => esc_html__( '', 'themes-assistant' ),
		]
	);

	$this->add_control(
        'title_image',
        [
            'label' => esc_html__( 'Title top Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
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
            'default' => esc_html__( 'borax-spa-leaves', 'themes-assistant' ),
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
		'align',
		[
			'label' => esc_html__('Alignment', 'themes-assistant'),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => esc_html__('Left', 'themes-assistant'),
					'icon' => 'fa fa-align-left',
				],
				'center' => [
					'title' => esc_html__('Center', 'themes-assistant'),
					'icon' => 'fa fa-align-center',
				],
				'right' => [
					'title' => esc_html__('Right', 'themes-assistant'),
					'icon' => 'fa fa-align-right',
				],
			],
			'default' => 'center',
		]
	);

    $this->add_control(
        'top_headong_color',
        [
			'label' => esc_html__( 'Top Title Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .tagline' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
		'heading',
        [
			'label' => esc_html__( 'Heading Text Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .sec-title' => 'color: {{VALUE}};',
			],
		]
	);

    $this->add_control(
		'slide_subheading',
        [
			'label' => esc_html__( 'Sub Heading Text Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .sec-heading .paragraph p' => 'color: {{VALUE}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'top_headong_typography',
			'label' => esc_html__('Top Title Typography', 'themes-assistant'),
			'selector' => '{{WRAPPER}} .tagline',
		]
	);
    
    $this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'heading_typography',
			'label' => esc_html__('Title Typography', 'themes-assistant'),
			'selector' => '{{WRAPPER}} .sec-title',
		]
	);

    $this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'paragraph_typography',
			'label' => esc_html__('Paragraph Typography', 'themes-assistant'),
			'selector' => '{{WRAPPER}} .sec-heading .paragraph p',
		]
	);

	$this->add_control(
	'margin',
		[
			'label' => esc_html__( 'Title Margin', 'themes-assistant' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
			'{{WRAPPER}} .sec-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);  

	$this->add_control(
		'width',
		[
			'label' => esc_html__( 'Width', 'themes-assistant' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1000,
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
    $settings = $this->get_settings_for_display();

    ?>
<div class="sec-heading m-auto text-<?php echo esc_attr($settings['align']); ?>">
    <?php 
		if(!empty($settings['title_image']['url'])){
			 echo '<img src="' . esc_url($settings['title_image']['url']) . '" alt="'. wp_kses_post($settings['title']) .'" width="50" height="50">'; 
		}
		?>
    <?php if(!empty($settings['top_title'])){ ?>
    <span class="tagline"><?php echo esc_html($settings['top_title']); ?></span><?php
		} 
		if(!empty($settings['title'])){ ?>
    <h2 class="sec-title"><?php echo wp_kses_post($settings['title']); ?></h2><?php
		} 
       if( $settings['icon_type'] == 'icon'):?>
    <span class="divider_icon">
        <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
    </span>
    <?php elseif( $settings['icon_type'] == 'iconclass'):?>
    <span class="divider_icon">
        <i class="<?php echo esc_attr($settings['iconclass']); ?>"></i>
    </span>
    <?php elseif( $settings['icon_type'] == 'image'):?>
    <span class="divider_icon">
        <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo wp_kses_post($settings['title'])  ?>" class="img-icon" width="50" height="50">
    </span>
    <?php endif;
 		if(!empty($settings['description'])){ ?>
    <div class="paragraph"><?php echo wp_kses_post($settings['description']); ?></div><?php
		} ?>
</div>
<?php
  	}
}
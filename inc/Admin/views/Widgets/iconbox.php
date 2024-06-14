<?php
/**
 * Class AT_Assistant_icon_box
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package AT_Assistant\Widgets\AT_Assistant_icon_box
 * @since 1.0.0
 */

namespace AT_Assistant\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * AT_Assistant_icon_box class extend from Elementor Widget_Base class
 *
 * @since 1.1.0
 */
class AT_Assistant_icon_box extends Widget_Base { //phpcs:ignore.

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
			'section_iconbox',
			array(
				'label' => esc_html__( 'Icon Box', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Choose Style', 'themes-assistant' ),
				'default' => 'style1',
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'themes-assistant' ),
				),
			)
		);

		$this->add_control(
			'icon_type',
			array(
				'label'   => esc_html__( 'Icon Type', 'themes-assistant' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'none'      => array(
						'title' => esc_html__( 'None', 'themes-assistant' ),
						'icon'  => 'eicon-editor-close',
					),
					'icon'      => array(
						'title' => esc_html__( 'Icon', 'themes-assistant' ),
						'icon'  => 'eicon-social-icons',
					),
					'iconclass' => array(
						'title' => esc_html__( 'Icon Class', 'themes-assistant' ),
						'icon'  => 'eicon-text-field',
					),
					'image'     => array(
						'title' => esc_html__( 'Image', 'themes-assistant' ),
						'icon'  => 'eicon-image',
					),
				),
				'default' => 'icon',
				'toggle'  => true,
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => esc_html__( 'Icon Image', 'themes-assistant' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => esc_html__( 'Icon', 'themes-assistant' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'icon_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'iconclass',
			array(
				'label'       => esc_html__( 'Icon Class', 'themes-assistant' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'borax-spa-bathrobe', 'themes-assistant' ),
				'description' => 'You can get icon class from <a href="https://wpborax.com/demo/borax-v1.0/">Borax Icon</a> or <a href="https://themify.me/themify-icons">Themify Icon</a>',
				'condition'   => array(
					'icon_type' => 'iconclass',
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'themes-assistant' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Title', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Service Link', 'themes-assistant' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://website.com/services', 'themes-assistant' ),
				'default'     => array(
					'url' => '',
				),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => esc_html__( 'Subtitle', 'themes-assistant' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'view_details_icon',
			array(
				'label'     => esc_html__( 'Button Icon', 'themes-assistant' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'style' => 'style2',
				),
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'     => esc_html__( 'Button Text', 'themes-assistant' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'View Details', 'themes-assistant' ),
				'condition' => array(
					'style!' => 'style1',
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
			'select_style',
			array(
				'label'     => esc_html__( 'Box Style', 'themes-assistant' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'one',
				'options'   => array(
					'one'         => esc_html__( 'Icon Center', 'themes-assistant' ),
					'align-left'  => esc_html__( 'Icon Left', 'themes-assistant' ),
					'align-right' => esc_html__( 'Icon Right', 'themes-assistant' ),
				),
				'condition' => array(
					'style' => 'style1',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => __( 'Title Typography', 'themes-assistant' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .icon-heading h3',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => esc_html__( 'Title Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .iconBox .icon-heading h3' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'heading_hover_color',
			array(
				'label'     => esc_html__( 'Title Hover Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .iconBox:hover .icon-heading h3' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Content Typography', 'themes-assistant' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .iconBox p',
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Content Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .iconBox p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typo', 'themes-assistant' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .icon-heading p',
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'themes-assistant' ),
				'selector' => '{{WRAPPER}} .iconBox:hover',
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'label'    => __( 'Border', 'themes-assistant' ),
				'selector' => '{{WRAPPER}} .iconBox',
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'themes-assistant' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 30,
				),
				'selectors'  => array(
					'{{WRAPPER}} .iconBox .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .iconBox .icon i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .iconBox:hover .icon i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => esc_html__( 'Icon Background', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .iconBox .icon' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'icon_hover_bg',
			array(
				'label'     => esc_html__( 'Icon Hover Background', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .iconBox:hover .icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'iconboxradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'themes-assistant' ),
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
					'{{WRAPPER}} .iconBox' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
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
		$style        = $settings['style'];
		$widget_title = $this->get_title(); // Get the widget title dynamically.
		require AT_ASSISTANT_WIDGET_DIR . 'icon-box/' . $style . '.php';
	}
}

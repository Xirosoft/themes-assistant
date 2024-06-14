<?php
/**
 * Class At_Assistant_Banner
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package AT_Assistant\Widgets\At_Assistant_Banner
 * @since 1.0.0
 */

namespace AT_Assistant\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * At_Assistant_Banner class extend Elementor Widget_Base
 *
 * @since 1.1.0
 */
class At_Assistant_Banner extends Widget_Base {

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
		return 'banner-borax';
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
		return esc_html__( 'Banner', 'themes-assistant' );
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
			array(
				'label' => esc_html__( 'Banner', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'banner_layout',
			array(
				'label'   => esc_html__( 'Image box layout', 'themes-assistant' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1' => esc_html__( 'Layout 1', 'themes-assistant' ),
				),
			)
		);

		$this->add_control(
			'top_title',
			array(
				'label'   => esc_html__( 'Top Title', 'themes-assistant' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Harbal Treatment', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'themes-assistant' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Beauty Means Healthy for You', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => esc_html__( 'Subtitle', 'themes-assistant' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__(
					'Can days you\'ll forth two grass form face you saying, divide. Subdue days light whose. Stars creepeth that creature thing.

        ',
					'themes-assistant'
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'themes-assistant' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Reservation', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'default'     => array(
					'url' => '',
				),
			)
		);

		$this->add_control(
			'video_btn_text',
			array(
				'label'   => esc_html__( 'Video Button Text', 'themes-assistant' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Watch our story', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'video_btn_link',
			array(
				'label'       => esc_html__( 'Video Button Link', 'elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'default'     => array(
					'url' => '',
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => esc_html__( 'Banner Image', 'themes-assistant' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'banner_layout' => '1',
				),
			)
		);

		$this->add_control(
			'imagelink',
			array(
				'label'       => esc_html__( 'Image Link', 'tohi' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://website.com/services', 'themes-assistant' ),
				'default'     => array(
					'url' => '',
				),
				'condition'   => array(
					'banner_layout' => '2',
				),
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
			'slide_top_headering',
			array(
				'label'     => esc_html__( 'Top Title Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .banner .content-box span.tagline' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'   => 'slide_top_headeing_typo',
				'label'  => __( 'Top Title Typography', 'themes-assistant' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'{{WRAPPER}} .banner .content-box span.tagline',
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'     => esc_html__( 'Heading Text Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .banner .content-box h2' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'   => 'heading_typo',
				'label'  => __( 'Heading Text Typography', 'themes-assistant' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'{{WRAPPER}}  .banner .content-box h2',
			)
		);

		$this->add_control(
			'slide_subheading',
			array(
				'label'     => esc_html__( 'Sub Heading Text Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .banner .content-box p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'   => 'slide_subheading_typo',
				'label'  => __( 'Sub Heading Text Typography', 'themes-assistant' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'{{WRAPPER}}  .banner .content-box p',
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'   => 'btnTypo',
				'label'  => __( 'Button Typography', 'themes-assistant' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'{{WRAPPER}}  .banner .content-box a.btn',
			)
		);

		$this->add_control(
			'btnTxtColor',
			array(
				'label'     => esc_html__( 'Button Text Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .banner .content-box  a.btn' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'btnTxtHoverColor',
			array(
				'label'     => esc_html__( 'Buttob Hover Text Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .banner .content-box a.btn:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'video_btnTxtColor',
			array(
				'label'     => esc_html__( 'Video Button Text Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .banner .content-box  a.video-btn' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'video_btnTxtHoverColor',
			array(
				'label'     => esc_html__( 'Video Buttob Hover Text Color', 'themes-assistant' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => esc_html( '' ),
				'selectors' => array(
					'{{WRAPPER}} .banner .content-box a.video-btn:hover' => 'color: {{VALUE}};',
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
		$style        = $settings['banner_layout'];
		$widget_title = $this->get_title(); // Get the widget title dynamically.

		require AT_ASSISTANT_WIDGET_DIR . 'banner/style-' . $style . '.php';
	}
}

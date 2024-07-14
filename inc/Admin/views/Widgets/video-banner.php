<?php
/**
 * Class Ata_Video_Banner
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Video_Banner 
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ata_Video_Banner extends Widget_Base {
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
		return 'ata-video-banner';
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
		return esc_html__( 'Video banner', 'themes-assistant' );
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
			return 'eicon-slider-video borax-el';
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
                    'label' => esc_html__( 'Video banner', 'themes-assistant' ),
            ]
        );
        $this->add_control(
            'video_banner_style',
            [
                'label' => esc_html__( 'Select Style', 'themes-assistant' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'themes-assistant' ),
                    // '2' => esc_html__( 'Style 2', 'themes-assistant' ),
                ],
            ]
        );

		$this->add_control(
				'top_title',
			[
					'label' => esc_html__( 'Top Title', 'themes-assistant' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Creative Agency', 'themes-assistant' ),
			]
		);

		$this->add_control(
				'title',
			[
					'label' => esc_html__( 'Title', 'themes-assistant' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Building Brand is Our Business', 'themes-assistant' ),
			]
		);

		$this->add_control(
				'content',
			[
					'label' => esc_html__( 'Subtitle', 'themes-assistant' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( '', 'themes-assistant' ),
			]
		);
		$this->add_control(
				'button_text',
			[
					'label' => esc_html__( 'Button Text', 'themes-assistant' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'View Project', 'themes-assistant' ),
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
				'image',
			[
					'label' => esc_html__( 'Banner Image', 'themes-assistant' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
						'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
				'poster',
			[
					'label' => esc_html__( 'Video poster', 'themes-assistant' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
						'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
				'video',
			[
				'label' => esc_html__( 'Choose File', 'themes-assistant' ),
			'type' => Controls_Manager::MEDIA,
			'media_type' => 'video',
			'default' => [
						'url' => Utils::get_placeholder_image_src(),
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
        $style = $settings['video_banner_style'];
        $widget_name  = $this->get_name(); // You can make this dynamic
        $AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style);
 	}
}
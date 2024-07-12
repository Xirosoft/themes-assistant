<?php
/**
 * Class Ata_Google_Reviews
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Google_Reviews 
 * @since 1.0.0
 */

 namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Ata_Google_Reviews extends Widget_Base {

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

	protected $google_place_url = "https://maps.googleapis.com/maps/api/place/";

	public function get_name() {
		return 'ata-google-reviews';
	}

	public function get_title() {
		return esc_html__('Google Reviews', 'themes-assistant');
	}

	public function get_icon() {
		return 'eicon-counter-circle  borax-el';
	}

	public function get_categories() {
        return array( 'themes-assistant' );
	}

	public function get_keywords() {
		return ['Google', 'Reviews', 'Google Reviews'];
	}

	// public function get_style_depends() {
	// 	if ($this->ep_is_edit_mode()) {
	// 		return ['ep-styles'];
	// 	} else {
	// 		return ['ep-font', 'ep-google-reviews'];
	// 	}
	// }

	public function get_custom_help_url() {
		return 'https://youtu.be/pp0mQpyKqfs';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__('Layout', 'themes-assistant'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
        'google_rwview_style',
        [
            'label' => esc_html__( 'Select Style', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => esc_html__( 'Style 1', 'themes-assistant' ),
                '2' => esc_html__( 'Style 2', 'themes-assistant' ),
            ],
        ]
    );

		$this->add_control(
			'google_api',
			[
				'label'       => esc_html__('Google API', 'themes-assistant'),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Google API', 'themes-assistant'),
				'description' => sprintf(__('%1s ', 'themes-assistant'), '<p class="description">Go to <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">https://developers.google.com</a> and <a href="https://console.cloud.google.com/google/maps-apis/overview">generate the API key</a> and insert here. This API key needs for show Advanced Google Map widget correctly. API Key also works for Google Review widget so you must enabled Places API too.</p>'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'google_place_id',
			[
				'label'       => esc_html__('Buisness ID', 'themes-assistant'),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Google Place ID', 'themes-assistant'),
				'description' => sprintf(__('Click %1s HERE %2s to find place ID  ', 'themes-assistant'), '<a href="https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/javascript/examples/full/places-placeid-finder" target="_blank">', '</a>'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'cache_reviews',
			[
				'label'   => esc_html__('Cache Reviews', 'themes-assistant') ,
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'refresh_reviews',
			array(
				'label'   => __('Reload Reviews after a', 'themes-assistant'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'day',
				'options' => array(
					'hour'  => __('Hour', 'themes-assistant'),
					'day'   => __('Day', 'themes-assistant'),
					'week'  => __('Week', 'themes-assistant'),
					'month' => __('Month', 'themes-assistant'),
					'year'  => __('Year', 'themes-assistant'),
				),
				'condition' => [
					'cache_reviews' => 'yes'
				]
			)
		);

		$this->add_control(
			'review_message',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __('Note: You can show only 5 most popular review right now.', 'themes-assistant'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition' => [
					'cache_reviews' => 'yes'
				]

			]
		);

		$this->add_control(
			'show_image',
			[
				'label'   => esc_html__('Show Thumb', 'themes-assistant'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_time',
			[
				'label'   => esc_html__('Show Time', 'themes-assistant'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_name',
			[
				'label'   => esc_html__('Show Name', 'themes-assistant'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_rating',
			[
				'label'   => esc_html__('Show Rating', 'themes-assistant'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_google_icon',
			[
				'label'   => esc_html__('Show Google Icon', 'themes-assistant') ,
				'type'    => Controls_Manager::SWITCHER,
				// 'default' => 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'   => esc_html__('Show Excerpt', 'themes-assistant'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_limit',
			[
				'label'     => esc_html__('Excerpt Limit', 'themes-assistant'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 55,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'carousel_columns',
			[
				'label'          => esc_html__('Columns', 'themes-assistant') ,
				'type'           => Controls_Manager::SELECT,
				'default'        => '1',
				'tablet_default' => '1',
				'mobile_default' => '1',
				'options'        => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label'   => esc_html__('Column Gap', 'themes-assistant') ,
				'type'    => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .borax-slider-items.borax-grid'     => 'margin-left: -{{SIZE}}px',
					'{{WRAPPER}} .borax-slider-items.borax-grid > *' => 'padding-left: {{SIZE}}px',
				],
			]
		);

		$this->add_control(
			'match_height',
			[
				'label'   => esc_html__('Match Height', 'themes-assistant') ,
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_navigation',
			[
				'label'     => __('Navigation', 'themes-assistant'),
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => __('Navigation', 'themes-assistant'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both'   => __('Arrows and Dots', 'themes-assistant'),
					'arrows' => __('Arrows', 'themes-assistant'),
					'dots'   => __('Dots', 'themes-assistant'),
					'none'   => __('None', 'themes-assistant'),
				],
				'prefix_class' => 'borax-navigation-type-',
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'nav_arrows_icon',
			[
				'label'   => esc_html__('Arrows Icon', 'themes-assistant') ,
				'type'    => Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'1' => esc_html__('Style 1', 'themes-assistant'),
					'2' => esc_html__('Style 2', 'themes-assistant'),
					'3' => esc_html__('Style 3', 'themes-assistant'),
					'4' => esc_html__('Style 4', 'themes-assistant'),
					'5' => esc_html__('Style 5', 'themes-assistant'),
					'6' => esc_html__('Style 6', 'themes-assistant'),
					'7' => esc_html__('Style 7', 'themes-assistant'),
					'8' => esc_html__('Style 8', 'themes-assistant'),
					'9' => esc_html__('Style 9', 'themes-assistant'),
					'10' => esc_html__('Style 10', 'themes-assistant'),
					'11' => esc_html__('Style 11', 'themes-assistant'),
					'12' => esc_html__('Style 12', 'themes-assistant'),
					'13' => esc_html__('Style 13', 'themes-assistant'),
					'14' => esc_html__('Style 14', 'themes-assistant'),
					'15' => esc_html__('Style 15', 'themes-assistant'),
					'16' => esc_html__('Style 16', 'themes-assistant'),
					'17' => esc_html__('Style 17', 'themes-assistant'),
					'18' => esc_html__('Style 18', 'themes-assistant'),
					'circle-1' => esc_html__('Style 19', 'themes-assistant'),
					'circle-2' => esc_html__('Style 20', 'themes-assistant'),
					'circle-3' => esc_html__('Style 21', 'themes-assistant'),
					'circle-4' => esc_html__('Style 22', 'themes-assistant'),
					'square-1' => esc_html__('Style 23', 'themes-assistant'),
				],
				'condition' => [
					'navigation' => ['both', 'arrows'],
				],
			]
		);

		$this->add_control(
			'both_position',
			[
				'label'     => __('Arrows and Dots Position', 'themes-assistant'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => $this->borax_navigation_position(),
				'condition' => [
					'navigation' => 'both',
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'     => __('Arrows Position', 'themes-assistant'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => $this->borax_navigation_position(),
				'condition' => [
					'navigation' => 'arrows',
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'     => __('Dots Position', 'themes-assistant'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom-center',
				'options'   => $this->borax_navigation_position(),
				'condition' => [
					'navigation' => 'dots',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_slider_settins',
			[
				'label' => esc_html__('Slider Settings', 'themes-assistant'),
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__('Auto Play', 'themes-assistant'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_interval',
			[
				'label'     => esc_html__('Autoplay Interval', 'themes-assistant'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 7000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'   => esc_html__('Pause on Hover', 'themes-assistant'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__('Loop', 'themes-assistant'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_additonal',
			[
				'label' => esc_html__('Additional Settings', 'themes-assistant'),
			]
		);

		$languageArr = array(
			'' => 'Language disable',
			'ar' => 'Arabic',
			'bg' => 'Bulgarian',
			'bn' => 'Bengali',
			'ca' => 'Catalan',
			'cs' => 'Czech',
			'da' => 'Danish',
			'de' => 'German',
			'el' => 'Greek',
			'en' => 'English',
			'custom' => 'Custom',
		);

		$languageArr = apply_filters('ep_google_reviews_review_language', $languageArr);
		$this->add_control(
			'reviews_lang',
			[
				'label'   => esc_html__('Filter Reviews language', 'themes-assistant'),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => $languageArr,
			]
		);

		$this->add_control(
			'custom_lang',
			[
				'label'       => esc_html__('Custom Language', 'themes-assistant') ,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => ['active' => true],
				'placeholder' => __('Your Language', 'themes-assistant'),
				'description' => sprintf(__('Please write your Language code here. It supports only language code. For the language code,  please look <a href="%s" target="_blank">here</a>
					 Please delete your transient if not works. You can simply delete transient from Layout ( Cache Reviews ) by on/off.'), 'http://www.lingoes.net/en/translator/langcode.htm'),
				'condition'	  => [
					'reviews_lang' => 'custom'
				]
			]
		);

		//Flex
		$this->add_responsive_control(
			'flex_direction',
			[
				'label'   => esc_html__('Thumb/info Position', 'bdthemes-prime-slider') ,
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'column',
				'toggle' => false,
				'options' => [
					'column' => [
						'title' => esc_html__('Top', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-v-align-top',
					],
					'row-reverse' => [
						'title' => esc_html__('Right', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-h-align-right',
					],
					'column-reverse' => [
						'title' => esc_html__('Bottom', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-v-align-bottom',
					],
					'row' => [
						'title' => esc_html__('Left', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-h-align-left',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item' => 'flex-direction: {{VALUE}};',
				],
				'label_block' => true,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'justify_content',
			[
				'label'   => esc_html__('Self Align', 'bdthemes-prime-slider') ,
				'type'    => Controls_Manager::CHOOSE,
				// 'default' => 'center',
				// 'toggle' => false,
				'options' => [
					'center' => [
						'title' => esc_html__('Center', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-align-center-h',
					],
					'flex-start' => [
						'title' => esc_html__('Start', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-align-start-v',
					],
					'flex-end' => [
						'title' => esc_html__('End', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-align-end-v',
					],
					'space-between' => [
						'title' => esc_html__('Space Between', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-justify-space-between-v',
					],
					'space-around' => [
						'title' => esc_html__('Space Around', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-justify-space-around-v',
					],
					'space-evenly' => [
						'title' => esc_html__('Space Evenly', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-justify-space-evenly-v',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item' => 'justify-content: {{VALUE}};',
				],
				'label_block' => true,
				'condition' => [
					'flex_direction' => ['column', 'column-reverse']
				]
			]
		);

		$this->add_responsive_control(
			'align_items',
			[
				'label'   => esc_html__('Self Align', 'bdthemes-prime-slider') ,
				'type'    => Controls_Manager::CHOOSE,
				// 'default' => 'center',
				// 'toggle' => false,
				'options' => [
					'center' => [
						'title' => esc_html__('Center', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-align-center-v',
					],
					'flex-start' => [
						'title' => esc_html__('Start', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-align-start-v',
					],
					'flex-end' => [
						'title' => esc_html__('End', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-align-end-v',
					],
					'stretch' => [
						'title' => esc_html__('stretch', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-align-stretch-v',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item' => 'align-items: {{VALUE}};',
				],
				'label_block' => true,
				'condition' => [
					'flex_direction' => ['row', 'row-reverse']
				]
			]
		);

		$this->add_responsive_control(
			'content_alignment',
			[
				'label'   => esc_html__('Text Alignment', 'bdthemes-prime-slider') ,
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item *' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_width',
			[
				'label'   => esc_html__('Content Width', 'themes-assistant') ,
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 100,
						'max'  => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews-desc' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};  margin: 0 auto;',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'thumb_info_width',
			[
				'label'   => esc_html__('Thumb/info Width', 'themes-assistant') ,
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 50,
						'max'  => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-thumb-info' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; margin: 0 auto;',
				],
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'section_google_reviews_style',
			[
				'label' => __('Google Reviews', 'themes-assistant'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_google_reviews_item_style');

		$this->start_controls_tab(
			'google_reviews_item_normal',
			[
				'label' => __('Normal', 'themes-assistant'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'google_reviews_item_background',
				'selector'  => '{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item',
			]
		);

		$this->add_responsive_control(
			'google_reviews_item_padding',
			[
				'label'      => esc_html__('Padding', 'themes-assistant'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'google_reviews_item_border',
				'selector'    => '{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item',
			]
		);

		$this->add_control(
			'google_reviews_item_radius',
			[
				'label'      => esc_html__('Radius', 'themes-assistant'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'google_reviews_item_shadow',
				'selector' => '{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'google_reviews_item_hover',
			[
				'label' => __('hover', 'themes-assistant'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'google_reviews_item_hover_background',
				'selector'  => '{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item:hover',
			]
		);

		$this->add_control(
			'google_reviews_item_hover_border_color',
			[
				'label'     => __('Border Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item:hover'  => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'google_reviews_item_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'google_reviews_item_hover_shadow',
				'selector' => '{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label'     => esc_html__('Image', 'themes-assistant'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_image' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__('Size', 'themes-assistant'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-img img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label'     => esc_html__('Spacing', 'themes-assistant'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-img img' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_name',
			[
				'label'     => esc_html__('Name', 'themes-assistant'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__('Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-name a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-name a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-name a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_time',
			[
				'label'     => esc_html__('Time', 'themes-assistant'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_time' => 'yes',
				],
			]
		);

		$this->add_control(
			'time_color',
			[
				'label'     => esc_html__('Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'time_spacing',
			[
				'label'     => esc_html__('Spacing', 'themes-assistant'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-date' => 'padding-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'time_typography',
				'selector' => '{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-date',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_rating',
			[
				'label'     => esc_html__('Rating', 'themes-assistant'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_rating' => 'yes',
				],
			]
		);

		$this->add_control(
			'rating_color',
			[
				'label'     => esc_html__('Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e7e7e7',
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-rating .borax-rating-item' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'active_rating_color',
			[
				'label'     => esc_html__('Active Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFCC00',
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-rating.borax-rating-1 .borax-rating-item:nth-child(1)'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .borax-google-reviews .borax-rating.borax-rating-2 .borax-rating-item:nth-child(-n+2)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .borax-google-reviews .borax-rating.borax-rating-3 .borax-rating-item:nth-child(-n+3)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .borax-google-reviews .borax-rating.borax-rating-4 .borax-rating-item:nth-child(-n+4)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .borax-google-reviews .borax-rating.borax-rating-5 .borax-rating-item:nth-child(-n+5)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_margin',
			[
				'label'      => esc_html__('Margin', 'themes-assistant'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .borax-google-reviews .borax-rating .borax-rating-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_spacing',
			[
				'label'     => esc_html__('Spacing', 'themes-assistant'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-rating' => 'padding-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_excerpt',
			[
				'label'     => esc_html__('Excerpt', 'themes-assistant'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__('Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_padding',
			[
				'label'      => esc_html__('Padding', 'themes-assistant'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_align',
			[
				'label'   => __('Alignment', 'themes-assistant'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'themes-assistant'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'themes-assistant'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'themes-assistant'),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __('Justified', 'themes-assistant'),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-desc' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_spacing',
			[
				'label'     => esc_html__('Spacing', 'themes-assistant'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-desc' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .borax-google-reviews .borax-google-reviews-item .borax-google-reviews-desc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_google_icon',
			[
				'label'     => esc_html__('Google Icon', 'themes-assistant') ,
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_google_icon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'google_icon_position',
			[
				'label'   => esc_html__('Position', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'right',
				'toggle' => false,
				'options' => [
					'left' => [
						'title' => esc_html__('left', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__('Right', 'bdthemes-prime-slider'),
						'icon'  => 'eicon-h-align-right',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-icon' => '{{VALUE}}: 0;',
				],
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'google_icon_size',
			[
				'label'     => esc_html__('Size', 'themes-assistant'),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'google_icon_margin',
			[
				'label'      => esc_html__('Margin', 'themes-assistant'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .borax-google-reviews .borax-google-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'      => __('Navigation', 'themes-assistant'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name'     => 'navigation',
							'operator' => '!=',
							'value'    => 'none',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label' => __('Arrows Size', 'themes-assistant'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev i,
					{{WRAPPER}} .borax-google-reviews .borax-navigation-next i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_background',
			[
				'label'     => __('Background Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev,
					{{WRAPPER}} .borax-google-reviews .borax-navigation-next' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_hover_background',
			[
				'label'     => __('Hover Background Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev:hover,
					{{WRAPPER}} .borax-google-reviews .borax-navigation-next:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __('Arrows Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev i,
					{{WRAPPER}} .borax-google-reviews .borax-navigation-next i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __('Arrows Hover Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev:hover i,
					{{WRAPPER}} .borax-google-reviews .borax-navigation-next:hover i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_space',
			[
				'label' => __('Space', 'themes-assistant'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-next' => 'margin-left: {{SIZE}}px;',
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => esc_html__('Padding', 'themes-assistant'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev,
					{{WRAPPER}} .borax-google-reviews .borax-navigation-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __('Border Radius', 'themes-assistant'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev,
					{{WRAPPER}} .borax-google-reviews .borax-navigation-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_responsive_control(
			'dots_size',
			[
				'label' => __('Dots Size', 'themes-assistant'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-slider-nav li a' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __('Dots Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-slider-nav li a' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'active_dot_color',
			[
				'label'     => __('Active Dots Color', 'themes-assistant'),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-slider-nav li.borax-active a' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_ncx_position',
			[
				'label'   => __('Horizontal Offset', 'themes-assistant'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'arrows_ncy_position',
			[
				'label'   => __('Vertical Offset', 'themes-assistant'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-arrows-container' => 'transform: translate({{arrows_ncx_position.size}}px, {{SIZE}}px);',
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'arrows_acx_position',
			[
				'label'   => __('Horizontal Offset', 'themes-assistant'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'  => 'arrows_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'dots_nnx_position',
			[
				'label'   => __('Horizontal Offset', 'themes-assistant'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'dots_nny_position',
			[
				'label'   => __('Vertical Offset', 'themes-assistant'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-dots-container' => 'transform: translate({{dots_nnx_position.size}}px, {{SIZE}}px);',
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'both_ncx_position',
			[
				'label'   => __('Horizontal Offset', 'themes-assistant'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'both_ncy_position',
			[
				'label'   => __('Vertical Offset', 'themes-assistant'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-arrows-dots-container' => 'transform: translate({{both_ncx_position.size}}px, {{SIZE}}px);',
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'both_cx_position',
			[
				'label'   => __('Arrows Offset', 'themes-assistant'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .borax-google-reviews .borax-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'both_cy_position',
			[
				'label'   => __('Dots Offset', 'themes-assistant'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .borax-google-reviews .borax-dots-container' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->end_controls_section();
	}


	function borax_navigation_position() {
		$position_options = [
			'top-left'      => esc_html__('Top Left', 'themes-assistant'),
			'top-center'    => esc_html__('Top Center', 'themes-assistant'),
			'top-right'     => esc_html__('Top Right', 'themes-assistant'),
			'center'        => esc_html__('Center', 'themes-assistant'),
			'center-left'   => esc_html__('Center Left', 'themes-assistant'),
			'center-right'  => esc_html__('Center Right', 'themes-assistant'),
			'bottom-left'   => esc_html__('Bottom Left', 'themes-assistant'),
			'bottom-center' => esc_html__('Bottom Center', 'themes-assistant'),
			'bottom-right'  => esc_html__('Bottom Right', 'themes-assistant'),
		];
	
		return $position_options;
	}

	public function get_transient_expire($settings) {

		$expire_value = $settings['refresh_reviews'];
		$expire_time  = 24 * HOUR_IN_SECONDS;

		if ('hour' === $expire_value) {
			$expire_time = 60 * MINUTE_IN_SECONDS;
		} elseif ('week' === $expire_value) {
			$expire_time = 7 * DAY_IN_SECONDS;
		} elseif ('month' === $expire_value) {
			$expire_time = 30 * DAY_IN_SECONDS;
		} elseif ('year' === $expire_value) {
			$expire_time = 365 * DAY_IN_SECONDS;
		}

		return $expire_time;
	}

	public function get_transient_key($placeId) {
		$placeId = strtolower($placeId);
		$transient = 'google_reviews_data_' . $placeId;
		return $transient;
	}

	public function get_api_url($api_key, $placeid, $language) {
		$settings   = $this->get_settings_for_display();
		$url = $this->google_place_url . 'details/json?placeid=' . $placeid . '&key=' . $settings['google_api'];
		if (strlen($language) > 0) {
			$url = $url . '&language=' . $language;
		}
		// var_dump($url);
		return $url;
	}

	public function get_cache_data($placeId) {
		$settings   = $this->get_settings_for_display();

		$transient = $this->get_transient_key($placeId);
		$data      = get_transient($transient);

		if ($settings['cache_reviews'] != 'yes') {
			delete_transient($transient);
		}

		if (is_array($data) && count($data) > 0) {
			if ($placeId == $data['place_id']) {
				return $data;
			} else {
				delete_transient($transient);
			}
		}
		return false;
	}

	public function getReviews() {
		$settings   = $this->get_settings_for_display();
		$placeId    = isset($settings['google_place_id']) ? esc_html($settings['google_place_id']) : '';
		$ApiKey     = isset($settings['google_api']) ? esc_html($settings['google_api']) : '';

		$language = '';

		if (isset($settings['reviews_lang'])) {
			if ($settings['reviews_lang'] == 'custom') {
				if (empty($settings['custom_lang'])) {
					$language = '';
				} else {
					$language = esc_html($settings['custom_lang']);
				}
			} else {
				$language = esc_html($settings['reviews_lang']);
			}
		} else {
			$language = '';
		}

		$language   = isset($settings['reviews_lang']) ? esc_html($settings['reviews_lang']):'';

		if (!$placeId || !$ApiKey) {
			return false;
		}


		$reviewData = $this->get_cache_data($placeId);

		if ($reviewData) {
			return $reviewData;
		} else {
			$requestUrl = $this->get_api_url($ApiKey, $placeId, $language);

			$response = wp_remote_get($requestUrl);

			if (is_wp_error($response)) {
				return array('error_message' => $response->get_error_message());
			}
			$response   = json_decode($response['body'], true);
			$result     = (isset($response['result']) && is_array($response['result'])) ? $response['result'] : '';

			if (is_array($result)) {
				if (isset($result['error_message'])) {
					return $result;
				}

				$transient = $this->get_transient_key($placeId);
				$expireTime = $this->get_transient_expire($settings);

				set_transient($transient, $result, $expireTime); // One day
				return $result;
			}
			return $response;
		}
	}

	public function render_rating($rating) {
		$settings = $this->get_settings_for_display();

		if (!$settings['show_rating']) {
			return;
		}

?>
		<div class="borax-google-reviews-rating">
			<ul class="borax-rating borax-grid borax-grid-collapse borax-rating-<?php echo esc_attr($rating); ?>" data-borax-grid>
				<li class="borax-rating-item"><i class="eicon-star" aria-hidden="true"></i></li>
				<li class="borax-rating-item"><i class="eicon-star" aria-hidden="true"></i></li>
				<li class="borax-rating-item"><i class="eicon-star" aria-hidden="true"></i></li>
				<li class="borax-rating-item"><i class="eicon-star" aria-hidden="true"></i></li>
				<li class="borax-rating-item"><i class="eicon-star" aria-hidden="true"></i></li>
			</ul>
		</div>
	<?php
	}

	public function render_excerpt($excerpt, $limit = '', $trail = '') {
		$settings = $this->get_settings_for_display();

		$excerpt_limit = $settings['excerpt_limit'];
		$limit = $excerpt_limit;

		$output = strip_shortcodes(wp_trim_words($excerpt, $limit, $trail));

		return $output;
	}

	public function render_footer() {
		$settings = $this->get_settings_for_display();

	?>
		</ul>
		<?php if ('both' == $settings['navigation']) : ?>
			<?php $this->render_both_navigation(); ?>

			<?php if ('center' === $settings['both_position']) : ?>
				<?php $this->render_dotnavs(); ?>
			<?php endif; ?>

		<?php elseif ('arrows' == $settings['navigation']) : ?>
			<?php $this->render_navigation(); ?>
		<?php elseif ('dots' == $settings['navigation']) : ?>
			<?php $this->render_dotnavs(); ?>
		<?php endif; ?>
		</div>
		</div>
	<?php
	}

	public function render_navigation() {
		$settings = $this->get_settings_for_display();

		if (('both' == $settings['navigation']) and ('center' == $settings['both_position'])) {
			$arrows_position = 'center';
		} else {
			$arrows_position = $settings['arrows_position'];
		}

	?>
		<div class="borax-position-z-index borax-visible@m borax-position-<?php echo esc_attr($arrows_position); ?>">
			<div class="borax-arrows-container borax-slidenav-container">
				<a href="" class="borax-navigation-prev borax-slidenav-previous borax-icon borax-slidenav" data-borax-slider-item="previous">
					<i class="ep-icon-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
				</a>
				<a href="" class="borax-navigation-next borax-slidenav-next borax-icon borax-slidenav" data-borax-slider-item="next">
					<i class="ep-icon-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
				</a>
			</div>
		</div>
	<?php
	}

	public function render_dotnavs() {
		$settings = $this->get_settings_for_display();

		if (('both' == $settings['navigation']) and ('center' == $settings['both_position'])) {
			$dots_position = 'bottom-center';
		} else {
			$dots_position = $settings['dots_position'];
		}

	?>
		<div class="borax-position-z-index borax-visible@m borax-position-<?php echo esc_attr($dots_position); ?>">
			<div class="borax-dotnav-wrapper borax-dots-container">

				<ul class="borax-slider-nav borax-dotnav borax-flex-center">
				</ul>

			</div>
		</div>
	<?php
	}

	public function render_both_navigation() {
		$settings = $this->get_settings_for_display();

	?>
		<div class="borax-position-z-index borax-position-<?php echo esc_attr($settings['both_position']); ?>">
			<div class="borax-arrows-dots-container borax-slidenav-container ">

				<div class="borax-flex borax-flex-middle">
					<div>
						<a href="" class="borax-navigation-prev borax-slidenav-previous borax-icon borax-slidenav" data-borax-slider-item="previous">
							<i class="ep-icon-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>

					<?php if ('center' !== $settings['both_position']) : ?>
						<div class="borax-dotnav-wrapper borax-dots-container">
							<ul class="borax-dotnav">
							</ul>
						</div>
					<?php endif; ?>

					<div>
						<a href="" class="borax-navigation-next borax-slidenav-next borax-icon borax-slidenav" data-borax-slider-item="next">
							<i class="ep-icon-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	<?php
	}

	protected function render_header() {
		$settings = $this->get_settings_for_display();
        $style = $settings['google_rwview_style'];
        $widget_name  = $this->get_name(); // You can make this dynamic
		$AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style);
		$reviewData     = $this->getReviews();
		// $is_editor      = Plugin::instance()->editor->is_edit_mode();


		// $errorMessage   = "";
		// if ($is_editor) {
		// 	$errorMessage   = (isset($reviewData['error_message'])) ? $reviewData['error_message'] : '';
		// }
		$clientReview = isset($reviewData['reviews']) ? $reviewData['reviews'] : [];

		$this->add_render_attribute('google-reviews', 'class', 'borax-google-reviews borax-google-reviews-slider');


		$carousel_columns_mobile = isset($settings['carousel_columns_mobile']) ? $settings['carousel_columns_mobile'] : '1';
		$carousel_columns_tablet = isset($settings['carousel_columns_tablet']) ? $settings['carousel_columns_tablet'] : '1';
		$carousel_columns 		 = isset($settings['carousel_columns']) ? $settings['carousel_columns'] : '1';


		$this->add_render_attribute('carousel', 'data-borax-grid', '');
		$this->add_render_attribute('carousel', 'class', ['borax-grid', 'borax-grid-small']);
		if ($settings['match_height']) {
			$this->add_render_attribute('carousel', 'class', ['borax-grid-match']);
		}
		$this->add_render_attribute('carousel', 'class', 'borax-slider-items');
		$this->add_render_attribute('carousel', 'class', 'borax-child-width-1-' . esc_attr($carousel_columns_mobile));
		$this->add_render_attribute('carousel', 'class', 'borax-child-width-1-' . esc_attr($carousel_columns_tablet) . '@s');
		$this->add_render_attribute('carousel', 'class', 'borax-child-width-1-' . esc_attr($carousel_columns) . '@m');

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

		<div <?php echo $this->get_render_attribute_string('google-reviews'); ?>>
			<?php

			$this->add_render_attribute(
				[
					'slider-settings' => [
						'class' => [
							('both' == $settings['navigation']) ? 'borax-arrows-dots-align-' . $settings['both_position'] : '',
							('arrows' == $settings['navigation'] or 'arrows-thumbnavs' == $settings['navigation']) ? 'borax-arrows-align-' . $settings['arrows_position'] : '',
							('dots' == $settings['navigation']) ? 'borax-dots-align-' . $settings['dots_position'] : '',
						],
						'data-borax-slider' => [
							wp_json_encode(array_filter([
								"autoplay"          => $settings["autoplay"],
								"autoplay-interval" => $settings["autoplay_interval"],
								"finite"            => $settings["loop"] ? false : true,
								"pause-on-hover"    => $settings["pause_on_hover"] ? true : false,
								// "center"            => true,
							]))
						]
					]
				]
			);

			?>
			<div <?php echo ($this->get_render_attribute_string('slider-settings')); ?>>
				<ul <?php echo $this->get_render_attribute_string('carousel'); ?>>

					<?php
					foreach ($clientReview as $review) {
						$author_name    = $review['author_name'];
						$author_url     = $review['author_url'];
						//$language     = $review['language'];
						$profile_photo_url = $review['profile_photo_url'];
						$humanTime      = $review['relative_time_description'];
						$review_text    = $review['text'];
						//$timeStamp    = $review['time'];
						$rating      = $review['rating'];

					?>

						<li>
							<div class="borax-google-reviews-item">

								<div class="borax-thumb-info borax-flex borax-flex-middle borax-flex-center">
									<?php if ('yes' == $settings['show_image']) : ?>
										<div class="borax-google-reviews-img">
											<img src="<?php echo esc_url($profile_photo_url); ?>" alt="<?php echo esc_html($author_name); ?>">
										</div>
									<?php endif; ?>

									<div>

										<?php if ('yes' == $settings['show_name']) : ?>
											<div class="borax-google-reviews-name">
												<a href="<?php echo esc_url($author_url) ?>" target="_blank"><?php echo esc_html($author_name); ?></a>
											</div>
										<?php endif; ?>

										<?php if ('yes' == $settings['show_time']) : ?>
											<div class="borax-google-reviews-date">
												<?php echo esc_attr($humanTime); ?>
											</div>
										<?php endif; ?>

										<?php $this->render_rating($rating); ?>

									</div>
								</div>


								<?php if ('yes' == $settings['show_excerpt']) : ?>
									<div class="borax-google-reviews-desc">
										<?php echo $this->render_excerpt($review_text); ?>
									</div>
								<?php endif; ?>

								<?php if ('yes' == $settings['show_google_icon']) : ?>
									<div class="borax-google-icon">
										<svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
											<path fill="#EA4335 " d="M5.26620003,9.76452941 C6.19878754,6.93863203 8.85444915,4.90909091 12,4.90909091 C13.6909091,4.90909091 15.2181818,5.50909091 16.4181818,6.49090909 L19.9090909,3 C17.7818182,1.14545455 15.0545455,0 12,0 C7.27006974,0 3.1977497,2.69829785 1.23999023,6.65002441 L5.26620003,9.76452941 Z" />
											<path fill="#34A853" d="M16.0407269,18.0125889 C14.9509167,18.7163016 13.5660892,19.0909091 12,19.0909091 C8.86648613,19.0909091 6.21911939,17.076871 5.27698177,14.2678769 L1.23746264,17.3349879 C3.19279051,21.2936293 7.26500293,24 12,24 C14.9328362,24 17.7353462,22.9573905 19.834192,20.9995801 L16.0407269,18.0125889 Z" />
											<path fill="#4A90E2" d="M19.834192,20.9995801 C22.0291676,18.9520994 23.4545455,15.903663 23.4545455,12 C23.4545455,11.2909091 23.3454545,10.5272727 23.1818182,9.81818182 L12,9.81818182 L12,14.4545455 L18.4363636,14.4545455 C18.1187732,16.013626 17.2662994,17.2212117 16.0407269,18.0125889 L19.834192,20.9995801 Z" />
											<path fill="#FBBC05" d="M5.27698177,14.2678769 C5.03832634,13.556323 4.90909091,12.7937589 4.90909091,12 C4.90909091,11.2182781 5.03443647,10.4668121 5.26620003,9.76452941 L1.23999023,6.65002441 C0.43658717,8.26043162 0,10.0753848 0,12 C0,13.9195484 0.444780743,15.7301709 1.23746264,17.3349879 L5.27698177,14.2678769 Z" />
										</svg>
									</div>
								<?php endif; ?>

							</div>
						</li>

					<?php

					}

					?>

			<?php
		}

		protected function render() {
			$settings = $this->get_settings_for_display();
            $style = $settings['google_rwview_style'];
			if (empty($settings['google_place_id'])) {
				echo '<div class="borax-alert borax-alert-warning">' . __('Please type google place id From Setting!', 'themes-assistant') . '</div>';
				return;
			}

			$this->render_header();
			$this->render_footer();
		}
	}

<?php
/**
 * Class Ata_Lottie_Animation
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Lottie_Animation 
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ata_Lottie_Animation extends Widget_Base {

	
    protected $ata_elementor_enquee;
    public $base;

	/**
	 * Construction load for assets.
	 *
	 * @param array $data Data for construction.
	 * @param mixed $args Optional arguments for construction.
	 */
    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );
		add_filter( 'wp_check_filetype_and_ext', [ $this, 'handle_file_type' ], 10, 3 );
        $widget_name                = $this->get_name(); // You can make this dynamic
        $this->ata_elementor_enquee = new AtaElementorEnquee($widget_name);
    }


	/**
	 * Get element name.
	 *
	 * Retrieve the element name.
	 *
	 * @return string The name.
	 * @since 2.7.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'ata-lottie-animation';
	}

	public function get_title() {
		return __( 'Lottie', 'themes-assistant' );
	}

	public function get_icon() {
		return 'eicon-lottie';
	}

	 
	public function get_categories() {
        return array( 'themes-assistant' );
	}
	protected function _register_controls() {

		$this->start_controls_section( 'lottie', [
			'label' => __( 'Lottie', 'themes-assistant' ),
		] );

		$this->add_control(
			'lottie_style',
			[
				'label' => __( 'Lottie Style', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( 'Style 1', 'themes-assistant' ),
					'2' => __( 'Style 2', 'themes-assistant' ),
					'3' => __( 'Style 3', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
		);
	

		$this->add_control(
			'source',
			[
				'label' => __( 'Source', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'media_file',
				'options' => [
					'media_file' => __( 'Media File', 'themes-assistant' ),
					'external_url' => __( 'External URL', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'source_external_url',
			[
				'label' => __( 'External URL', 'themes-assistant' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'source' => 'external_url',
				],
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your URL', 'themes-assistant' ),
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'source_json',
			[
				'label' => __( 'Upload JSON File', 'themes-assistant' ),
				'type' => Controls_Manager::MEDIA,
				'media_type' => 'application/json',
				'frontend_available' => true,
				'condition' => [
					'source' => 'media_file',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'themes-assistant' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'themes-assistant' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'themes-assistant' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'themes-assistant' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => 'center',
			]
		);

		

		$this->add_control(
			'title',
			[
				'label' => __( 'Custom Title', 'themes-assistant' ),
				'type' => Controls_Manager::TEXT,
				'render_type' => 'none',
				// 'conditions' => [
				// 	'relation' => 'or',
				// 	'terms' => [
				// 		[
				// 			'name' => 'lottie-style',
				// 			'value' => '1',
				// 		],
				// 		[
				// 			'name' => 'lottie-style',
				// 			'value' => '2',
				// 		],
				// 	],
				// ],
				
				'dynamic' => [
					'active' => true,
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'btn-text',
			[
				'label' => __( 'Button Text', 'themes-assistant' ),
				'type' => Controls_Manager::TEXT,
				'render_type' => 'none',
				'default' => 'Learn More',
				'condition' => [
					'lottie_style' => 'style-3',
				],
				'dynamic' => [
					'active' => true,
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'caption',
			[
				'label' => __( 'Custom Caption', 'themes-assistant' ),
				'type' => Controls_Manager::TEXTAREA,
				'render_type' => 'none',
				
				'dynamic' => [
					'active' => true,
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => __( 'Link', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'render_type' => 'none',
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'themes-assistant' ),
					'custom' => __( 'Custom URL', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'custom_link',
			[
				'label' => __( 'Link', 'themes-assistant' ),
				'type' => Controls_Manager::URL,
				'render_type' => 'none',
				'placeholder' => __( 'Enter your URL', 'themes-assistant' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				'show_label' => false,
				'frontend_available' => true,
			]
		);

		// lottie.
		$this->end_controls_section();

		$this->start_controls_section( 'settings', [
			'label' => __( 'Settings', 'themes-assistant' ),
		] );

		$this->add_control(
			'trigger',
			[
				'label' => __( 'Trigger', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'arriving_to_viewport',
				'options' => [
					'on_hover' => __( 'On Hover', 'themes-assistant' ),
					'bind_to_scroll' => __( 'Scroll', 'themes-assistant' ),
					'autoplay' => __( 'AutoPlay', 'themes-assistant' ),
					'none' => __( 'None', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'themes-assistant' ),
				'type' => Controls_Manager::SWITCHER,
				'render_type' => 'none',
				'condition' => [
					'trigger!' => 'bind_to_scroll',
				],
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'on_hover_out',
			[
				'label' => __( 'On Hover Out', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'render_type' => 'none',
				'condition' => [
					'trigger' => 'on_hover',
				],
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'themes-assistant' ),
					'reverse' => __( 'Reverse', 'themes-assistant' ),
					'pause' => __( 'Pause', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'hover_area',
			[
				'label' => __( 'Hover Area', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'render_type' => 'none',
				'condition' => [
					'trigger' => 'on_hover',
				],
				'default' => 'animation',
				'options' => [
					'animation' => __( 'Animation', 'themes-assistant' ),
					'column' => __( 'Column', 'themes-assistant' ),
					'section' => __( 'Section', 'themes-assistant' ),
				],
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'reverse_animation',
			[
				'label' => __( 'Reverse', 'themes-assistant' ),
				'type' => Controls_Manager::SWITCHER,
				'render_type' => 'none',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'trigger',
							'operator' => '!==',
							'value' => 'bind_to_scroll',
						],
						[
							'name' => 'trigger',
							'operator' => '!==',
							'value' => 'on_hover',
						],
					],
				],
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'renderer',
			[
				'label' => __( 'Renderer', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'svg',
				'options' => [
					'svg' => __( 'SVG', 'themes-assistant' ),
					'canvas' => __( 'Canvas', 'themes-assistant' ),
				],
				'separator' => 'before',
				'frontend_available' => true,
			]
		);

	
		// Settings.
		$this->end_controls_section();

		$this->start_controls_section(
			'style',
			[
				'label' => __( 'Lottie', 'themes-assistant' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'themes-assistant' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .e-lottie__animation' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => __( 'Max Width', 'themes-assistant' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .e-lottie__animation' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);



		$this->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

			$this->start_controls_tab( 'normal',
				[
					'label' => __( 'Normal', 'themes-assistant' ),
				]
			); 

			$this->add_control(
				'opacity',
				[
					'label' => __( 'Opacity', 'themes-assistant' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 1,
							'min' => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .e-lottie__animation' => 'opacity: {{SIZE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'css_filters',
					'selector' => '{{WRAPPER}} .e-lottie__container',
				]
			);

			// Normal.
			$this->end_controls_tab();

			$this->start_controls_tab( 'hover',
				[
					'label' => __( 'Hover', 'themes-assistant' ),
				]
			);

			$this->add_control(
				'opacity_hover',
				[
					'label' => __( 'Opacity', 'themes-assistant' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 1,
							'min' => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .e-lottie__animation' => '--lottie-container-opacity-hover: {{SIZE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'css_filters_hover',
					'selector' => '{{WRAPPER}} .e-lottie__container:hover',
				]
			);

			$this->add_control(
				'background_hover_transition',
				[
					'label' => __( 'Transition Duration', 'themes-assistant' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 3,
							'step' => 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => '--lottie-container-transition-duration-hover: {{SIZE}}s',
					],
				]
			);

		// Hover.
		$this->end_controls_tab();

		// Image effects.
		$this->end_controls_tabs();

		// lottie style.
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption',
			[
				'label' => __( 'Caption', 'themes-assistant' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_source!' => 'none',
				],
			]
		);

		$this->add_control(
			'caption_align',
			[
				'label' => __( 'Alignment', 'themes-assistant' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'themes-assistant' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'themes-assistant' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'themes-assistant' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}}' => '--caption-text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'themes-assistant' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => '--caption-color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .e-lottie__caption',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_responsive_control(
			'caption_space',
			[
				'label' => __( 'Spacing', 'themes-assistant' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--caption-margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
        
	}
    public function get_render_attribute_string($attribute) {
        // Implement or call the parent method if it exists
        return parent::get_render_attribute_string($attribute);
    }

	protected function render() {
		$settings       = $this->get_settings_for_display();
        $style          = $settings['lottie_style'];
		// $caption = $this->get_caption( $settings );
        $widget_name    = $this->get_name(); // You can make this dynamic
		$title          = $settings['title'];
		$caption        = $settings['caption'];
		$btnText        = $settings['btn-text'];		
		$widget_title   = $title ? '<h3 class="ata-lottie__title"> ' . $title . '</h3>' : '';
		$widget_caption = $caption ? '<p class="ata-lottie__caption"> ' . $caption . '</p>' : '';
        $widget_instance = $this;

		if ( ! empty( $settings['source_json']['url'] ) ) {
		$source_json = $settings['source_json']['url'];
		}

		if($settings['source_external_url']){
			$jsonData = $settings['source_external_url']['url'];
		}else{
			$jsonData = $source_json;
		}


		if ($jsonData != '') {
			$this->add_render_attribute(
				'wrapper',
				[
					'id'                    => 'ata-lottie_' . $this->get_id(),
					'data-class'            => 'ata-lottie-animation',
					'data-path'				=> $jsonData ,
					'data-trigger'        	=> $settings['trigger'],
					'data-loop'				=> $settings['loop'],
					'data-anim_renderer'    => $settings['renderer'],
					'data-hover-area'       => $settings['hover_area'],
					'data-direction'        => $settings['reverse_animation'],
					'data-on-hover-out'     => $settings['on_hover_out'],
				]
			);
		}else{
			echo '<h3 class="posts-not-found">'.esc_html__("Opps!! Please Enter JSON File Extension.",'themes-assistant').'</h3>';
		}
	
        $AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style, $widget_instance);
		
	}

	public function handle_file_type( $file_data, $file, $filename ) {
		if ( $file_data['ext'] && $file_data['type'] ) {
			return $file_data;
		}

		$filetype = wp_check_filetype( $filename );

		if ( 'json' === $filetype['ext'] ) {
			$file_data['ext'] = 'json';
			$file_data['type'] = 'application/json';
		}

		return $file_data;
	}
	
}
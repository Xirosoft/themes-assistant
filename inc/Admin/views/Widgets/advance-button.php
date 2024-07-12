<?php
/**
 * Class Ata_Advance_Button
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Advance_Button 
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Icons_Manager; 
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ata_Advance_Button extends Widget_Base {

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
            return 'ata-advance-button';
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
            return esc_html__( 'Advance Button', 'themes-assistant' );
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
            return 'eicon-button  borax-el';
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
            'section_tab',
        [
                'label' =>esc_html__('Button', 'themes-assistant'),
        ]
    );
    $this->add_control(
            'btn_style', [
                'type' => Controls_Manager::SELECT,
            'label' => esc_html__('Choose Style', 'themes-assistant'),
            'default' => 'btn-secondary',
            'options' => [
                    'btn-primary' => esc_html__('Primary', 'themes-assistant'),
                'btn-secondary' => esc_html__('Secondary', 'themes-assistant'),
            ],
        ]
    );
    $this->add_control(
            'btn_text',
        [
                'label' =>esc_html__( 'Label', 'themes-assistant' ),
            'type' => Controls_Manager::TEXT,
            'default' =>esc_html__( 'Learn more ', 'themes-assistant' ),
            'placeholder' =>esc_html__( 'Learn more ', 'themes-assistant' ),
        ]
    );
    $this->add_control(
            'btn_link',
        [
                'label' =>esc_html__( 'Link', 'themes-assistant' ),
            'type' => Controls_Manager::URL,
            'placeholder' =>esc_html__('http://your-link.com','themes-assistant' ),
            'default' => [
                    'url' => '#',
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
            'default' => esc_html__( 'borax-spa-bathrobe', 'themes-assistant' ),
            'description' => 'You can get icon class from <a href="https://wpborax.com/demo/borax-v1.0/">Borax Icon</a> or <a href="https://themify.me/themify-icons">Themify Icon</a>',
            'condition' => [
				'icon_type' => 'iconclass',
			],
		]
    );
    $this->add_control(
            'icon_align',
        [
                'label' =>esc_html__( 'Icon Position', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'left',
            'options' => [
                    'left' =>esc_html__( 'Before', 'themes-assistant' ),
                'right' =>esc_html__( 'After', 'themes-assistant' ),
            ],
            'condition' => [
                    'icon!' => '',
            ],
        ]
    );
    $this->add_responsive_control(
            'btn_align',
        [
                'label' =>esc_html__( 'Alignment', 'themes-assistant' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                    'left'    => [
                        'title' =>esc_html__( 'Left', 'themes-assistant' ),
                    'icon' => 'fa fa-align-left',
                ],
                'center' => [
                        'title' =>esc_html__( 'Center', 'themes-assistant' ),
                    'icon' => 'fa fa-align-center',
                ],
                'right' => [
                        'title' =>esc_html__( 'Right', 'themes-assistant' ),
                    'icon' => 'fa fa-align-right',
                ],
            ],
            'prefix_class' => 'elementor%s-align-',
            'default' => '',
        ]
    );

    $this->add_control(
            'button_class',
        [
                'label' =>esc_html__( 'Class', 'themes-assistant' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'placeholder' =>esc_html__( 'Add custom Class', 'themes-assistant' ),
        ]
    );
    $this->end_controls_section();
    $this->start_controls_section(
            'section_style',
        [
                'label' =>esc_html__( 'Button Style', 'themes-assistant' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
    $this->add_responsive_control(
            'text_padding',
        [
                'label' =>esc_html__( 'Padding', 'themes-assistant' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [
                    '{{WRAPPER}} a.btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_group_control(
            Group_Control_Typography::get_type(),
        [
                'name' => 'btn_typography',
            'label' =>esc_html__( 'Typography', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} a.btn',
        ]
    );
    $this->start_controls_tabs( 'tabs_button_style' );
    $this->start_controls_tab(
            'tab_button_normal',
        [
                'label' =>esc_html__( 'Normal', 'themes-assistant' ),
        ]
    );
    $this->add_control(
            'btn_text_color',
        [
                'label' =>esc_html__( 'Text Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                    '{{WRAPPER}} a.btn' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->add_group_control(
            Group_Control_Background::get_type(),
        [
                'name' => 'background',
            'label' => esc_html__( 'Background', 'themes-assistant' ),
            'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} a.btn',
        ]
    );
    $this->end_controls_tab();
    $this->start_controls_tab(
            'btn_tab_button_hover',
        [
                'label' =>esc_html__( 'Hover', 'themes-assistant' ),
        ]
    );
    $this->add_control(
            'btn_hover_color',
        [
                'label' =>esc_html__( 'Text Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                    '{{WRAPPER}} a.btn:hover' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->add_group_control(
            Group_Control_Background::get_type(),
        [
                'name' => 'background_hover',
            'label' => esc_html__( 'Background', 'themes-assistant' ),
            'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} a.btn:hover',
        ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

    $this->start_controls_section(
            'border_style',
        [
                'label' =>esc_html__( 'Border Style', 'themes-assistant' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
    $this->add_control(
            'btn_border_style',
        [
                'label' => esc_html__( 'Border Type',  'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                    '' => esc_html__( 'None', 'themes-assistant' ),
                'solid' => esc_html__( 'Solid', 'themes-assistant' ),
                'double' => esc_html__( 'Double', 'themes-assistant' ),
                'dotted' => esc_html__( 'Dotted', 'themes-assistant' ),
                'dashed' => esc_html__( 'Dashed', 'themes-assistant' ),
                'groove' => esc_html__( 'Groove', 'themes-assistant' ),
            ],
            'selectors' => [
                    '{{WRAPPER}} a.btn' => 'border-style: {{VALUE}};',
            ],
        ]
    );
    $this->add_control(
            'btn_border_dimensions',
        [
                'label' => esc_html__( 'Width', 'themes-assistant' ),
            'type' => Controls_Manager::DIMENSIONS,
            'selectors' => [
                    '{{WRAPPER}} a.btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->start_controls_tabs( 'tabs_button_border_style' );

    $this->start_controls_tab(
            'tab_button_border_normal',
        [
                'label' =>esc_html__( 'Normal', 'themes-assistant' ),
        ]
    );
    $this->add_control(
            'btn_border_color',
        [
                'label' => esc_html__( 'Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                    '{{WRAPPER}} a.btn' => 'border-color: {{VALUE}};',
            ],
        ]
    );
    $this->end_controls_tab();
    $this->start_controls_tab(
            'btn_tab_button_border_hover',
        [
                'label' =>esc_html__( 'Hover', 'themes-assistant' ),
        ]
    );
    $this->add_control(
            'btn_hover_border_color',
        [
                'label' => esc_html__( 'Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                    '{{WRAPPER}} a.btn:hover' => 'border-color: {{VALUE}};',
            ],
        ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->add_responsive_control(
            'btn_border_radius',
        [
                'label' =>esc_html__( 'Border Radius', 'themes-assistant' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px'],
            'default' => [
                    'top' => '',
                'right' => '',
                'bottom' => '' ,
                'left' => '',
            ],
            'selectors' => [
                    '{{WRAPPER}} a.btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_section();
    $this->start_controls_section(
            'box_shadow_style',
        [
                'label' =>esc_html__( 'Box Shadow Style', 'themes-assistant' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
    $this->add_control(
            'btn_box_shadow_dimensions',
        [
                'label' => esc_html__( 'Dimensions', 'themes-assistant' ),
            'type' => Controls_Manager::DIMENSIONS,
            'selectors' => [
                    '{{WRAPPER}} a.btn' => 'box-shadow: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} var(--box-shadow-color);',
            ],
        ]
    );
    $this->add_control(
            'btn_box_shadow_color',
        [
                'label' =>esc_html__( 'Box Shadow Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                    '{{WRAPPER}} a.btn' => '--box-shadow-color: {{VALUE}};',
            ],
        ]
    );
    $this->end_controls_section();
}
    protected function render( ) {
        $settings   = $this->get_settings();
        $btn_text   = $settings['btn_text'];
        $btn_class  = $settings['button_class'];
        $btn_style  = ($btn_class != '') ? $settings['btn_style'].' '.$btn_class : $settings['btn_style'];
        $icon_align = $settings['icon_align'];
        $btn_link   = (! empty( $settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';    
        $btn_target = ( $settings['btn_link']['is_external']) ? '_blank' : '_self';
        $this->add_render_attribute( 'icon-align', 'class', 'button-icon align-icon-' . $settings['icon_align'] );
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
        <a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="btn <?php echo esc_attr( $btn_style ); ?>">
            <?php if($icon_align == 'right'): ?>
                <span class="button-text"><?php echo esc_html( $btn_text ); ?></span>
            <?php endif; ?>
            <?php if( $settings['icon_type'] == 'icon'):?>
                <span class="icon">
                    <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
                <?php elseif( $settings['icon_type'] == 'iconclass'):?>
                <span class="icon">
                    <i class="<?php echo esc_html__($settings['iconclass'], 'themes-assistant'); ?>"></i>
            </span>
                <?php elseif( $settings['icon_type'] == 'image'): ?>
                <span class="icon">
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="" class="img-icon" width="40" height="40" style="max-width:20px">
            </span>
            <?php endif;?>
            <?php if($icon_align == 'left'): ?>
            <span class="button-text"><?php echo esc_html( $btn_text ); ?></span>
            <?php endif; ?>
        </a>
        <?php
    }
    protected function _content_template() {



    }
}
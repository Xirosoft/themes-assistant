<?php
/**
 * Class Ata_Cta_Section
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Cta_Section 
 * @since 1.0.0
 */

 namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
Use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Core\Schemes;
use Elementor\Core\Schemes\Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ata_Cta_Section extends Widget_Base {

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
        return 'ata-cta-section';
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
        	return esc_html__( 'CTA Section', 'themes-assistant' );
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
          'section_videobox',
      [
            'label' =>esc_html__( 'CTA Box', 'themes-assistant' ),
      ]
    );

    $this->add_control(
            'title',
        [
              'label' =>esc_html__( 'Title', 'themes-assistant' ),
          'type' => Controls_Manager::TEXT,
          'default' =>esc_html__( '25+ years of experiences for give you better results.', 'themes-assistant' ),
        ]
    );
    $this->add_control(
            'text',
        [
              'label' =>esc_html__( 'Text', 'themes-assistant' ),
          'type' => Controls_Manager::TEXT,
          'default' =>esc_html__( 'There are many variations of passages of Lorem Ipsum but majority have suffered alteration form by injected humour or randomised words.', 'themes-assistant' ),
        ]
    );
    $this->add_control(
            'btn',
        [
              'label' =>esc_html__( 'Button', 'themes-assistant' ),
          'type' => Controls_Manager::TEXT,
          'default' =>esc_html__( 'Contact Us', 'themes-assistant' ),
        ]
    );
    $this->add_control(
            'link',
        [
                'label' =>esc_html__( 'Button Link', 'themes-assistant' ),
            'type' => Controls_Manager::URL,
            'placeholder' =>esc_html__( 'https://vimeo.com/191947042', 'themes-assistant' ),
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
    $this->add_control(
            'select_style',
        [
                'label' => esc_html__( 'Style', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'align-center',
            'options' => [
                    'align-center'  => esc_html__( 'Center Alignment', 'themes-assistant' ),
                'align-left' => esc_html__( 'Left Alignment', 'themes-assistant' ),
            ],
        ]
    );
    $this->add_control(
            'call_overlay', [
                'label'     => esc_html__( 'Overlay  Color', 'themes-assistant' ),
            'type'      => Controls_Manager::COLOR,
            'scheme' => [
                  'type' =>  Color::get_type(),
              'value' => Color::COLOR_1,
            ],
            'selectors' => [
                    '{{WRAPPER}} .call-action-section .call-inner' => 'background-color: {{VALUE}};',
            ],
        ]
    );    

    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'heading_typography',
            'label' => __( 'Title Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .call-content h2',
        ]
    );
    $this->add_control(
            'heading_color',
        [
    			'label' => esc_html__( 'Title Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .call-content h2' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'content_typography',
            'label' => __( 'Content Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .call-content p',
        ]
    );
    $this->add_control(
            'content_color',
        [
    			'label' => esc_html__( 'Content Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .call-content p' => 'color: {{VALUE}};',
			],
        ]
    );
    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'button_typography',
            'label' => __( 'Button Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .call-action-section a.btn',
        ]
    );
    $this->add_control(
            'button_color',
        [
    			'label' => esc_html__( 'Button Text Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .call-action-section a.btn' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
            'button_bg',
        [
    			'label' => esc_html__( 'Button Background', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .call-action-section a.btn' => 'background-color: {{VALUE}};',
			],
        ]
    );
    $this->add_control(
            'button_hover_bg',
        [
    			'label' => esc_html__( 'Button Hover Background', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .call-action-section a.btn:hover' => 'background-color: {{VALUE}};',
			],
        ]
    );
    $this->add_control(
            'buttonradius',
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
                'unit' => 'px',
            'size' => 0,
          ],
          'selectors' => [
                '{{WRAPPER}} .call-action-section a.btn' => 'border-radius: {{SIZE}}{{UNIT}};',
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
    // require_once __DIR__ . '/widgets/style/heading/'.$style.'.php';
    ?>
	<div class="call-action-section">
    		<div class="call-inner">
    			<div class="container">
    				<div class="row <?php if($settings['select_style'] == 'align-left'){ echo 'align-items-center'; }  ?>">
                    <?php if($settings['select_style'] == 'align-center'): ?>
					<div class="col-md-12">
    						<div class="call-content text-center">
    							<h2><?php echo esc_html__($settings['title'], 'themes-assistant'); ?></h2>
							<p><?php echo esc_html__($settings['text'], 'themes-assistant'); ?></p>
							<a href="<?php echo esc_url($settings['link']['url']); ?>"
								class="btn"><?php echo esc_html__($settings['btn'], 'themes-assistant'); ?></a>
						</div>
					</div>
                    <?php elseif($settings['select_style'] == 'align-left'): ?>
                        <div class="col-md-8">
                                <div class="call-content text-left">
                                    <h2 class="text-left"><?php echo esc_html__($settings['title'], 'themes-assistant'); ?></h2>
                                <p><?php echo esc_html__($settings['text'], 'themes-assistant'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="call-content text-right">
                                    <a href="<?php echo esc_url($settings['link']['url']); ?>"
                                    class="btn"><?php echo esc_html__($settings['btn'], 'themes-assistant'); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
}
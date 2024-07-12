<?php
/**
 * Class Ata_blog_post
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_blog_post 
 * @since 1.0.0
 */

 namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * * @since 1.1.0
 * 
*/
class Ata_blog_post extends Widget_Base {

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
		return 'ata-blog-post';
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
		return esc_html__( 'Blog Post', 'themes-assistant' );
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
		return 'eicon-posts-grid  borax-el';
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
  *   * Register the widget controls.
  *   *
  *   * Adds different input fields to allow the user to change and customize the widget settings.
  *   *
  *   * @since 1.1.0
  *   *
  *   * @access protected
  *   */
  	protected function _register_controls() {
		$this->start_controls_section(
		'blog_post',
		[
			'label' => esc_html__( 'Blog Post', 'themes-assistant' ),
		]
		);
		$this->add_control(
			'blogs_style',
			[
				'label' =>esc_html__( 'Blog Style', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Style 1', 'themes-assistant' ),
					'2' => esc_html__( 'Style 2', 'themes-assistant' ),
					'3' => esc_html__( 'Style 3', 'themes-assistant' ),
					'4' => esc_html__( 'Style 4', 'themes-assistant' ),
					'5' => esc_html__( 'Style 5', 'themes-assistant' ),
				],
			]
		);
		 
		$this->add_control(
		'post_show',
		[
			'label' => esc_html__( 'Post', 'themes-assistant' ),
			'type' => Controls_Manager::NUMBER,
			'default' => esc_html__( 3, 'themes-assistant' ),
		]
		);
          $this->add_control(
               'see_more_text',
               [
                    'label' => esc_html__( 'Title', 'themes-assistant' ),
                    'type' 	=> Controls_Manager::TEXT,
                    'default' => esc_html__( 'Discover more', 'themes-assistant' ),
               ]
           );

		$this->add_control(
		'content_align',
		[
			'label' => __('Content Alignment', 'themes-assistant'),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
			'text-left' => [
				'title' => esc_html__('Left', 'themes-assistant'),
				'icon' => 'fa fa-align-left',
			],
			'text-center' => [
				'title' => esc_html__('Center', 'themes-assistant'),
				'icon' => 'fa fa-align-center',
			],
			'text-right' => [
				'title' => esc_html__('Right', 'themes-assistant'),
				'icon' => 'fa fa-align-right',
			],
			],
			'default' => 'center',
		]
		);


		$this->add_control(
			'animation',
			[
				'label' => esc_html__( 'Animation', 'themes-assistant' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'themes-assistant' ),
					'CardAnimation' => esc_html__( 'Card Animation', 'themes-assistant' ),
					'bottom-to-top' => esc_html__( 'Bottom To Top Hover Animation', 'themes-assistant' ),
				],
				'frontend_available' => true,
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
                   'block_padding',
                      [
                           'label' => esc_html__( 'Block Padding', 'themes-assistant' ),
                          'type' => Controls_Manager::DIMENSIONS,
                          'size_units' => [ 'px', '%', 'em' ],
                          'selectors' => [
                           '{{WRAPPER}} .post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                      ]
               );  
                  $this->add_group_control(
                       \Elementor\Group_Control_Border::get_type(),
                      [
                           'name' => 'border',
                          'label' => __( 'Block Border', 'themes-assistant' ),
                          'selector' => '{{WRAPPER}} .post',
                      ]
               );

       $this->add_control(
                   'margin',
                      [
                           'label' => esc_html__( 'Image Margin', 'themes-assistant' ),
                          'type' => Controls_Manager::DIMENSIONS,
                          'size_units' => [ 'px', '%', 'em' ],
                          'selectors' => [
                           '{{WRAPPER}} .post-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                      ]
               );  
              $this->add_control(
                   'contentpadding',
                      [
                           'label' => esc_html__( 'Content Margin', 'themes-assistant' ),
                          'type' => Controls_Manager::DIMENSIONS,
                          'size_units' => [ 'px', '%', 'em' ],
                          'selectors' => [
                           '{{WRAPPER}} .post-content-area ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                      ]
               );  

       $this->add_control(
                           'title_color',
                          [
                               'label' => esc_html__( 'Title Color', 'themes-assistant' ),
                              'type' => Controls_Manager::COLOR,
                              'default' => esc_html__( '', 'themes-assistant' ),
                              'selectors' => [
                                   '{{WRAPPER}} .post h3 a' => 'color: {{VALUE}};',
                           ],
                          ]
                   );
                      $this->add_control(
                           'title_hover_color',
                          [
                               'label' => esc_html__( 'Title Hover Color', 'themes-assistant' ),
                              'type' => Controls_Manager::COLOR,
                              'default' => esc_html__( '', 'themes-assistant' ),
                              'selectors' => [
                                   '{{WRAPPER}} .post:hover h3 a' => 'color: {{VALUE}};',
                           ],
                          ]
                   );
                      $this->add_group_control(
                           \Elementor\Group_Control_Typography::get_type(),
                          [
                               'name' => 'Title_typography',
                              'label' => __( 'Title Typography', 'themes-assistant' ), 
                              'scheme' => Typography::TYPOGRAPHY_1,
                              'selector' => '{{WRAPPER}} .post h3',
                          ]
                   );
                  
                      $this->add_control(
                           'content_color',
                          [
                               'label' => esc_html__( 'Content Color', 'themes-assistant' ),
                              'type' => Controls_Manager::COLOR,
                              'default' => esc_html__( '', 'themes-assistant' ),
                              'selectors' => [
                                   '{{WRAPPER}} .post p' => 'color: {{VALUE}};',
                           ],
                          ]
                   );
                      $this->add_group_control(
                           \Elementor\Group_Control_Typography::get_type(),
                          [
                               'name' => 'content_typography',
                              'label' => __( 'Content Typography', 'themes-assistant' ), 
                              'scheme' => Typography::TYPOGRAPHY_1,
                              'selector' => '{{WRAPPER}} .post p',
                          ]
                   );
                  
                      $this->add_control(
                           'btn_txt_color',
                          [
                               'label' => esc_html__( 'Button Color', 'themes-assistant' ),
                              'type' => Controls_Manager::COLOR,
                              'default' => esc_html__( '', 'themes-assistant' ),
                              'selectors' => [
                                   '{{WRAPPER}} .post .btn' => 'color: {{VALUE}};',
                           ],
                          ]
                   );
                      $this->add_control(
                           'btn_txt_bgcolor',
                          [
                               'label' => esc_html__( 'Button Background Color', 'themes-assistant' ),
                              'type' => Controls_Manager::COLOR,
                              'default' => esc_html__( '', 'themes-assistant' ),
                              'selectors' => [
                                   '{{WRAPPER}} .post .btn' => 'background: {{VALUE}};',
                           ],
                          ]
                   );
                  
                      $this->add_group_control(
                           \Elementor\Group_Control_Typography::get_type(),
                          [
                               'name' => 'btn_typography',
                              'label' => __( 'Button Typography', 'themes-assistant' ), 
                              'scheme' => Typography::TYPOGRAPHY_1,
                              'selector' => '{{WRAPPER}} .post .btn',
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
        global $post;
       	$settings 		= $this->get_settings_for_display();
		$style  		= $settings['blogs_style'];
		$content_align  = $settings['content_align'];
		$total_posts    = $settings['post_show'];
        $widget_name    = $this->get_name(); // You can make this dynamic
        $args           = array( 'numberposts' => $total_posts,   );
        $myposts        = get_posts( $args ); 
        ?>
            <div class="row">
                <?php
                    foreach( $myposts as $post ) :  setup_postdata($post);
                        $AtaWidget      = new AtaWidgetManage($widget_name, $settings, $style);
                    endforeach; wp_reset_postdata(); 
                ?>
            </div>
	    <?php
    }
}
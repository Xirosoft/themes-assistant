<?php
namespace AT_Assistant\Widgets;
 
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
// use \Elementor\Controls_Manager::IMAGE_DIMENSIONS,

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Widget_image_box extends Widget_Base {
 
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
		return 'image-box';
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
		return esc_html__( 'Image Box', 'themes-assistant' );
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
		return 'eicon-image  borax-el';
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
		'section_imgbox',
		[
		'label' => esc_html__( 'Image Box', 'themes-assistant' ),
		]
    );

    $this->add_control(
        'image_layout',
        [
            'label' => esc_html__( 'Image box layout', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => esc_html__( 'Layout 1', 'themes-assistant' ),
            ],
        ]
    );
    

    $this->add_control(
        'image_max_size',
        [
			'label' => esc_html__( 'Image Max Height', 'themes-assistant' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px'],
			'range' => [
				'px' => [
					'min' => 150,
					'max' => 500,
					'step' => 20,
				],				
			],
			'default' => [
				'unit' => 'px',
				'size' => 200,
			],
			'selectors' => [
				'{{WRAPPER}} .service-image-height img' => 'max-height: {{SIZE}}{{UNIT}};',
			],
		]
    );

    $this->add_control(
        'content_align',
        [
            'label' => esc_html__( 'Content Alignment', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'text-center',
            'options' => [
                'text-center' => esc_html__( 'Top Align', 'themes-assistant' ),
                'text-right' => esc_html__( 'Right Align', 'themes-assistant' ),
                'text-left' => esc_html__( 'Left Align', 'themes-assistant' ),
            ],
            'condition' => [
              'image_layout' => ['1','2','3'],
            ]	
        ]
    );


    $this->add_control(
        'box_image',
        [
            'label' => esc_html__( ' Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'condition' => [
              'image_layout' => ['1','2','3','4','5','6'],
            ]	
        ]
	);
	$this->add_control(
		'box_image_dimension',
		[
			'label' => esc_html__( 'Image Dimension', 'themes-assistant' ),
			'type' => Controls_Manager::IMAGE_DIMENSIONS,
			'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'themes-assistant' ),
			'default' => [
				'width' => '321',
				'height' => '321',
			],
		]
	);
    $this->add_control(
        'space_title',
        [
			'label' => esc_html__( 'Space Title and Image Between', 'themes-assistant' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px'],
			'range' => [
				'px' => [
					'min' => 15,
					'max' => 150,
					'step' => 5,
				],				
			],
			'default' => [
				'unit' => 'px',
				'size' => 15,
			],
			'selectors' => [
				'{{WRAPPER}} .borax-img-box h2' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		]
    );

    $this->add_control(
      'top_title',
      [
        'label' => esc_html__( 'Top Title', 'themes-assistant' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_html__( 'Building Brand is Our Business', 'themes-assistant' ),
        'condition' => [
            'image_layout' => ['2','3'],
        ]	
      ]
    );
 
    $this->add_control(
      'title',
      [
        'label' => esc_html__( 'Title', 'themes-assistant' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_html__( '', 'themes-assistant' ),
        'condition' => [
          'image_layout' => ['1','2','3','4','5','6'],
        ]	
      ]
    );
 
    $this->add_control(
      'content',
      [
        'label' => esc_html__( 'Content', 'themes-assistant' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => esc_html__( '', 'themes-assistant' ),
        'condition' => [
            'image_layout' => ['1','2','3'],
        ]	
      ]
    );

    $this->add_control(
      'button_text',
      [
        'label' => esc_html__( 'Link Text', 'themes-assistant' ),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__( 'View Project', 'themes-assistant' ),
        'condition' => [
          'image_layout' => ['1','2','3','4','5','6'],
        ]	
      ]
    );

    $this->add_control(
        'link',
        [
            'label' => esc_html__( 'Link', 'themes-assistant' ),
            'type' => Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'themes-assistant' ),
            'default' => [
                'url' => '',
            ],
            'condition' => [
              'image_layout' => ['1','2','3','4','5','6','7'],
            ]	
        ]
	);
	

    // $this->end_controls_section();

    // $this->start_controls_section(
    //     'section_additional_options',
    //     [
    //         'label' => esc_html__( 'Additional Options', 'themes-assistant' ),
    //     ]
    // );

   
    
    $repeater = new Repeater();

		$repeater->add_control(
          't_image', [
              'label' => __( 'Customer/Client Image', 'themes-assistant' ),
              'type' => Controls_Manager::MEDIA,
              'default' => [
                  'url' => Utils::get_placeholder_image_src(),
              ],
          ]
		); 
        $repeater->add_control(

            'Choose_Animation', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Choose Animations', 'themes-assistant'),
                'default' => 'style1',
                'options' => [
                    'main' => esc_html__('Main', 'themes-assistant'),
                    'img_flotng_prtclesleftrght_add_cls' => esc_html__('Animation 1', 'themes-assistant'),
                    'img_flotng_prtclestpbtm_add_cls' => esc_html__('Animation 2', 'themes-assistant'),
                    'holostic_img_cls8' => esc_html__('Animation 3', 'themes-assistant'),
                    'no-animation' => esc_html__('No Animation', 'themes-assistant'),
                ],
            ]
        );
		

		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'themes-assistant' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						't_image' => __( '', 'themes-assistant' ),
						'animation' => __( 'John Doe', 'themes-assistant' ),
					],
				],
        'condition' => [
            'image_layout' => '7',
        ],
				'title_field' => '{{{ name }}}',
			]
		);
        $this->add_control(
            'imagelink',
            [
                'label' => esc_html__( 'Image Link', 'tohi' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://website.com/services', 'themes-assistant' ),
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'image_layout' => '7',
                ]	
            ]
        );

        $this->end_controls_section();

        
        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => esc_html__( 'Additional Options', 'themes-assistant' ),
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
              'condition' => [
                'image_layout' => ['1','2','3','4','5','6'],
              ],
              'frontend_available' => true,
          ]
      );
      
      $this->add_control(
          'background_shape',
          [
              'label' => esc_html__( 'Background Shape', 'themes-assistant' ),
              'type' => Controls_Manager::SELECT,
              'default' => 'none',
              'options' => [
                  'none' => esc_html__( 'None', 'themes-assistant' ),
                  'no-shape' => esc_html__( 'Enable Shape', 'themes-assistant' ),
              ],
              'condition' => [
                  'image_align' => 'top',
              ],
              'frontend_available' => true,
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
        'box_radius',
          [
        'label' => esc_html__( 'Box Radius', 'themes-assistant' ),
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
            'unit' => '%',
            'size' => 0,
          ],
          'selectors' => [
            '{{WRAPPER}} .borax-img-box' => 'border-radius: {{SIZE}}{{UNIT}};',
          ],
          'condition' => [
            'image_layout' => ['1','3','4','5','6'],
          ]	
        ]
      );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_shadow',
            'label' => __( 'Box Shadow', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .post.service-post:hover',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border',
            'label' => __( 'Border', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .post.service-post',
        ]
    );
    $this->add_control(
        'imagepadding',
        [
			'label' => esc_html__( 'Image Box Padding', 'themes-assistant' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px'],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 50,
					'step' => 5,
				],				
			],
			'default' => [
				'unit' => 'px',
				'size' => 20,
			],
			'selectors' => [
				'{{WRAPPER}} .post.service-post' => 'padding: {{SIZE}}{{UNIT}};',
			],
		]
    );

    $this->add_control(
        'img_title_color',
        [
			'label' => esc_html__( 'Title Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .borax-img-box h2' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
        'img_title_hover_color',
        [
			'label' => esc_html__( 'Title Hoover Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .borax-img-box:hover h2' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
        'img_content_color',
        [
			'label' => esc_html__( 'Content Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .borax-img-box p' => 'color: {{VALUE}};',
			],
        ]
    );


    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'img_title_typography',
            'label' => __( 'Title Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .borax-img-box h2',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'img_content_typography',
            'label' => __( 'Content Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .borax-img-box p',
        ]
    );



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
  $this->load_widget_script();
	$settings = $this->get_settings_for_display();
	$style = $settings['image_layout'];
  $widget_title = $this->get_title(); // Get the widget title dynamically

  require AT_Assistant_WIDGET_DIR .'image-box/style-'.$style.'.php';

}

protected function _content_template() {

}
public function load_widget_script(){
  if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
      ?>
<script>
if (jQuery(".animation").length > 0) {
    jQuery(".animation").each(function() {
        jQuery(this).onScreen({
            container: window,
            direction: "vertical",
            doIn: function() {
                jQuery(this).addClass("animationActive");
            },
            doOut: function() {
                jQuery(this).removeClass("animationActive");
                // Do something to the matched elements as they get off scren
            },
        });
    });
}
</script>
<?php 
  }
}

}
?>
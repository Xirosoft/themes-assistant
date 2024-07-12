<?php
/**
 * Class Ata_about_box
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_about_box 
 * @since 1.0.0
 */

 namespace ATA\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Ata_about_box extends Widget_Base {
 
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
	return 'ata-about-box';
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
	return esc_html__( 'About Section', 'themes-assistant' );
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
	return 'eicon-single-post borax-el';
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
      'about_box',
      [
        'label' => esc_html__( 'Image Section', 'themes-assistant' ),
      ]
    );

    $this->add_control(

        'style', [
            'type' => Controls_Manager::SELECT,
            'label' => esc_html__('Choose Style', 'themes-assistant'),
            'default' => '1',
            'options' => [
                '1' => esc_html__('Style 1', 'themes-assistant'),
                '2' => esc_html__('Style 2', 'themes-assistant'),
                '3' => esc_html__('Style 3', 'themes-assistant'),
            ],
        ]
    );
 

    $this->add_control(
        'image',
        [
            'label' => esc_html__( 'Image One', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
        ]
    );
    $this->add_control(
      'about_image1_dimension',
      [
        'label' => esc_html__( 'Team Image Dimension', 'themes-assistant' ),
        'type' => Controls_Manager::IMAGE_DIMENSIONS,
        'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'themes-assistant' ),
        'default' => [
          'width' => '300',
          'height' => '300',
        ],
      ]
    );
    $this->add_control(
        'image2',
        [
            'label' => esc_html__( 'Image Two', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
        ]
    );
    $this->add_control(
      'about_image2_dimension',
      [
        'label' => esc_html__( 'Team Image Dimension', 'themes-assistant' ),
        'type' => Controls_Manager::IMAGE_DIMENSIONS,
        'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'themes-assistant' ),
        'default' => [
          'width' => '200',
          'height' => '250',
        ],
      ]
    );
    $this->add_control(
        'animation_img',
        [
            'label' => esc_html__( 'Dotted animation Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA, 
            'default' => [
                'url' => ATA_IMAGE .'/bg.png'
            ],
        ]
    );
    $this->add_control(
      'animation_img_dimension',
      [
        'label' => esc_html__( 'Team Image Dimension', 'themes-assistant' ),
        'type' => Controls_Manager::IMAGE_DIMENSIONS,
        'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'themes-assistant' ),
        'default' => [
          'width' => '530',
          'height' => '444',
        ],
      ]
    );
    $this->add_control(
      'img_title',
      [
        'label' => esc_html__( 'Title', 'themes-assistant' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_attr__( '25 Years Working Experience', 'themes-assistant' ),
      ]
    );
    $this->add_control(
        'about_content_sw',
        [
            'label' => __( 'Enable Content', 'themes-assistant' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Enable', 'themes-assistant' ),
            'label_off' => __( 'Disable', 'themes-assistant' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );
    $this->end_controls_section();

    $this->start_controls_section(
        'about_box_content',
        [
            'label' => esc_html__( 'Text Section', 'themes-assistant' ),
            'condition' => [
                'about_content_sw' => 'yes',
            ],	
        ]
    );

    $this->add_control(
      'about_text_align',
      [
          'label' =>esc_html__( 'Content Align', 'themes-assistant' ),
          'type' => Controls_Manager::SELECT,
          'options' => [
              'center'      => esc_html__( 'center', 'themes-assistant' ),
              'left'      => esc_html__( 'left', 'themes-assistant' ),
              'right'      => esc_html__( 'right', 'themes-assistant' ),
          ],
          'prefix_class' => 'elementor%s-align-',
          'default' => 'center',
      ]
  );

    $this->add_control(
        'top_title',
        [
          'label' => esc_html__( 'Top Title', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'ABOUT OUR COMPANY', 'themes-assistant' ),
        ]
    );
    $this->add_control(
        'title',
        [
          'label' => esc_html__( 'Title', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Make the customer the hero of your story', 'themes-assistant' ),
        ]
    );
    $this->add_control(
        'bottom_title',
        [
          'label' => esc_html__( 'Bottom Title', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Open without also first greats land and bring said you give second face seed deep whales.', 'themes-assistant' ),
        ]
    );
    $this->add_control(
        'content',
        [
          'label' => esc_html__( 'Content', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'May is called whose was moveth was isn\'t. Great day man green whales kind own saying divided kind beginning be was every were a spirit those have wherein he third, give, green light sea', 'themes-assistant' ),
        ]
    );
    $this->add_control(
        'btn_text',
        [
          'label' => esc_html__( 'Button Text', 'themes-assistant' ),
          'type' => Controls_Manager::TEXT,
          'default' => esc_html__( 'Learn more', 'themes-assistant' ),
        ]
    );
    $this->add_control(
        'btn_link',
        [
          'label' => esc_html__( 'Button Link', 'themes-assistant' ),
          'type' => Controls_Manager::URL,
            'placeholder' => __( 'https://website.com/about', 'themes-assistant' ),
            'default' => [
                'url' => '',
            ]
        ]
    );
    $repeater = new \Elementor\Repeater();
 
    $repeater->add_control(
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
      
      $repeater->add_control(
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
  
   
      $repeater->add_control(
      'icon',
      [
        'label' => esc_html__( 'Icon', 'themes-assistant' ),
        'type' => Controls_Manager::ICONS,
        'condition' => [
          'icon_type' => 'icon',
        ],
      ]
      );
   
      $repeater->add_control(
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

    $repeater->add_control(
      'title',
      [
        'label' => esc_html__( 'Title', 'themes-assistant' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_html__( '', 'themes-assistant' ),
      ]
    );
    $repeater->add_control(
      'text',
      [
        'label' => esc_html__( 'Text', 'themes-assistant' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => esc_html__( '', 'themes-assistant' ),
      ]
    );

    $repeater->add_control(
      'link',
      [
          'label' => esc_html__( 'Service Link', 'themes-assistant' ),
          'type' => Controls_Manager::URL,
          'placeholder' => esc_html__( 'https://website.com/services', 'themes-assistant' ),
          'default' => [
              'url' => '', 
          ]
      ]
  );



    $this->add_control(
        'list',
        [
            'label' => esc_html__( 'Faq List', 'themes-assistant' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' =>
            [
                [
                  'title' => esc_html__( 'Input Title Here', 'themes-assistant' ),					
                  'text' => esc_html__( 'Input Content Here', 'themes-assistant' ),
                ],
            ],
            'title_field' => '{{{ title }}}',
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
			'label' => esc_html__( 'Box Style', 'themes-assistant' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one'  => esc_html__( 'Icon Center', 'themes-assistant' ),
				'align-left' => esc_html__( 'Icon Left', 'themes-assistant' ),
				'align-right' => esc_html__( 'Icon Right', 'themes-assistant' ),
            ],
            'condition' => [
				'style' => 'style1',
			],
        ]
    );

    $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Title Typo', 'themes-assistant' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .feature-item h3',
			]
		);

    
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_shadow', 
            'label' => __( 'Box Shadow', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .feature-item:hover',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border',
            'label' => __( 'Border', 'themes-assistant' ),
            'selector' => '{{WRAPPER}} .feature-item',
        ]
    );
    $this->add_control(
        'icon_size',
        [
			'label' => esc_html__( 'Icon Size', 'themes-assistant' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px'],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 150,
					'step' => 5,
				],				
			],
			'default' => [
				'unit' => 'px',
				'size' => 30,
			],
			'selectors' => [
				'{{WRAPPER}} .feature-item .icon-box i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
    );
   
	
    $this->add_control(
        'icon_color',
        [
			'label' => esc_html__( 'Icon Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .feature-item .icon-box i' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
        'icon_hover_color',
        [
			'label' => esc_html__( 'Icon Hover Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .feature-item:hover .icon-box i' => 'color: {{VALUE}};',
			],
        ]
    );

    $this->add_control(
        'icon_bg',
        [
			'label' => esc_html__( 'Icon Background', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .feature-item .icon-box' => 'background-color: {{VALUE}};',
			],
        ]
    );
    $this->add_control(
        'icon_hover_bg',
        [
			'label' => esc_html__( 'Icon Hover Background', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
				'{{WRAPPER}} .feature-item:hover .icon-box' => 'background-color: {{VALUE}};',
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
    $content_align = $settings['about_text_align'];
    $style = $settings['style'];
    $lists       = $settings[ 'list' ];
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
    	require BORAX_WIDGET_DIR .'about/style-'.$style.'.php';
  	}
  	protected function _content_template() {

	}	
}
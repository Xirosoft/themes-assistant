<?php
namespace AT_Assistant\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */ 
class Hero_slider extends Widget_Base {

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
        return 'hero_slider_borax';
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
        return esc_html__( 'Hero Slider', 'themes-assistant' );
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
        return 'eicon-slider-album  borax-el';
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
    		'section_banner',
		[
    			'label' => esc_html__( 'Hero Slider', 'themes-assistant' ),
			'tab' => Controls_Manager::TAB_CONTENT
		]

	);
	$this->add_control(
            'slider_style', [
                'type' => Controls_Manager::SELECT,
            'label' => esc_html__('Choose Style', 'themes-assistant'),
            'default' => '1',
            'options' => [
                    '1' => esc_html__('Style 1', 'themes-assistant'),
            ],
        ]
    );

	// Enable repataer
	$repeaters = new \Elementor\Repeater();

    $repeaters->add_control(
    		'top_title',
		[
    			'label' => esc_html__( 'Top Title', 'themes-assistant' ),
			'type' 	=> Controls_Manager::TEXT,
			'default' => esc_html__( 'Creative Agency', 'themes-assistant' ),
		]
    );

    $repeaters->add_control(
    		'title',
		[
    			'label' => esc_html__( 'Title', 'themes-assistant' ),
			'type' 	=> Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Building Brand is Our Business', 'themes-assistant' ),
		]
    );

    $repeaters->add_control(
    		'content_txt',
		[
    			'label' => esc_html__( 'Slider description', 'themes-assistant' ),
			'type' 	=> Controls_Manager::WYSIWYG,
			'default' => esc_html__( 'Can days you willl forth two grass form face you saying, divide. Subdue days light whose. Stars creepeth that creature thing.', 'themes-assistant' ),
		]
    );
    $repeaters->add_control(
    		'button_text',
		[
    			'label' => esc_html__( 'Button Text', 'themes-assistant' ),
			'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'View Project', 'themes-assistant' ),
		]
    );
    $repeaters->add_control(
    		'button_text2',
		[
    			'label' => esc_html__( 'Button Text 2', 'themes-assistant' ),
			'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'View Project', 'themes-assistant' ),
		]
    );
    $repeaters->add_control(
            'link',
        [
                'label' => esc_html__( 'Link', 'themes-assistant' ),
            'type' 	=> Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'themes-assistant' ),
            'default' => [
                    'url' => '',
            ]
        ]
    );
    $repeaters->add_control(
            'link2',
        [
                'label' => esc_html__( 'Link 2', 'themes-assistant' ),
            'type' 	=> Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'themes-assistant' ),
            'default' => [
                    'url' => '',
            ]
        ]
    );
    $repeaters->add_control(
            'image',
        [
                'label' => esc_html__( 'Banner Image', 'themes-assistant' ),
            'type' 	=> Controls_Manager::MEDIA,
            'default' => [
                    'url' => Utils::get_placeholder_image_src(),
            ],
        ]
	);	
	$this->add_control(
    		'list',
		[
    			'label' => esc_html__( 'Sliders List', 'themes-assistant' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $repeaters->get_controls(),
			'default' => [
    				[
    					'top_title' 	=> esc_html__( 'Creative agency', 'themes-assistant' ),
					'title' 		=> esc_html__( 'Building Brand is Our Business', 'themes-assistant' ),
					'content_txt' 		=> esc_html__( 'Can days you will forth two grass form face you saying, divide. Subdue days light whose. Stars creepeth that creature thing.', 'themes-assistant' ),
					'button_text' 	=> esc_html__( 'Learn More', 'themes-assistant' ),
					'button_text2' 	=> esc_html__( 'Watch our story', 'themes-assistant' ),
					'link' 			=> esc_html__( 'https://themenies.com', 'themes-assistant' ),
					'link2' 			=> esc_html__( 'https://themenies.com', 'themes-assistant' ),
					'image' 		=> esc_html__( '', '' ),
				],
			],
			'title_field' => '{{{ name }}}',
		]
	);
	$this->add_control(
            'image_overlay_color',
        [
    			'label' => esc_html__( 'Overlay Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .banner .item .ImageOverlay' => 'background-color: {{VALUE}};',
			],
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
    		'autoplay',
		[
    			'label' => esc_html__( 'Autoplay', 'themes-assistant' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'true',
			'options' => [
    				'true' => esc_html__( 'Yes', 'themes-assistant' ),
				'false' => esc_html__( 'No', 'themes-assistant' ),
			],
			'frontend_available' => true,
		]
	);
	$this->add_control(
    		'nav',
		[
    			'label' => esc_html__( 'Slider Navigation', 'themes-assistant' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'true',
			'options' => [
    				'true' => esc_html__( 'Yes', 'themes-assistant' ),
				'false' => esc_html__( 'No', 'themes-assistant' ),
			],
			'frontend_available' => true,
		]
	);
	$this->add_control(
    		'control',
		[
    			'label' => esc_html__( 'Slider Control', 'themes-assistant' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'true',
			'options' => [
    				'true' => esc_html__( 'Yes', 'themes-assistant' ),
				'false' => esc_html__( 'No', 'themes-assistant' ),
			],
			'frontend_available' => true,
		]
	);
	$this->add_control(
    		'loop',
		[
    			'label' => esc_html__( 'Slider Loop', 'themes-assistant' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'true',
			'options' => [
    				'true' => esc_html__( 'Yes', 'themes-assistant' ),
				'false' => esc_html__( 'No', 'themes-assistant' ),
			],
			'frontend_available' => true,
		]
    );
    $this->add_control(
            'rtl',
        [
                'label' => __( 'RTL Enable', 'themes-assistant' ),
            'type' => Controls_Manager::SWITCHER,
            'true' => __( 'Enable', 'themes-assistant' ),
            'false' => __( 'Disable', 'themes-assistant' ),
            'return_value' => 'yes',
            'default' => 'no',
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
            'slide_top_headering',
        [
    			'label' => esc_html__( 'Top Text Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .banner .content-box span.tagline' => 'color: {{VALUE}};',
			],
        ]
    );
    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'slide_tagline_headeing_typo',
            'label' => __( 'Top Title Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            '{{WRAPPER}} .banner .content-box span.tagline',
        ]
    );


    $this->add_control(
            'slide_headering',
        [
    			'label' => esc_html__( 'Main Heading Text Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .banner .content-box h2' => 'color: {{VALUE}};',
			],
        ]
    );
    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'slide__headeringg_typo',
            'label' => __( 'Title Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            '{{WRAPPER}} .banner .content-box h2',
        ]
    );

    $this->add_control(
    		'slide_subheading',
        [
    			'label' => esc_html__( 'Sub Heading Text Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .banner .content-box p' => 'color: {{VALUE}};',
			],
		]
	);

    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'slide_contetnt_typo',
            'label' => __( 'Content Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            '{{WRAPPER}} .banner .content-box p',
        ]
    );


    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'slide_button_typo',
            'label' => __( 'Button Typography', 'themes-assistant' ),
            'scheme' => Typography::TYPOGRAPHY_1,
            '{{WRAPPER}} .banner.v2 .hero-slide .active .content-box.v1 a',
        ]
    );
	$this->add_control(
    		'btnTxtColor',
		[
    			'label' => esc_html__( 'Button Text Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .banner.v2 .hero-slide .active .content-box.v1 a' => 'color: {{VALUE}};',
			],
		]
	);
	$this->add_control(
    		'btnTxtHoverColor',
		[
    			'label' => esc_html__( 'Buttob Hover Text Color', 'themes-assistant' ),
			'type' => Controls_Manager::COLOR,
			'default' => esc_html__( '', 'themes-assistant' ),
			'selectors' => [
    				'{{WRAPPER}} .banner.v2 .hero-slide .active .content-box.v1 a:hover' => 'color: {{VALUE}};',
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
    // call load widget script
    $this->load_widget_script();
    // Settings
	$settings = $this->get_settings_for_display();
	$style = $settings['slider_style'];
    $widget_title = $this->get_title(); // Get the widget title dynamically

	require AT_Assistant_WIDGET_DIR .'slider/style-'.$style.'.php';
  }
public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) { ?>
<script>
(function($) {
        function feedbackfunc(selector, next, prev) {
            var snav = $(selector).data('nav');
        var scontrol = $(selector).data('control');
        var sautoplay = $(selector).data('autoplay');
        var sloop = $(selector).data('loop');
        var rtlSlide = $(selector).data('rtl');
        var feedCaro = $(selector);
        if (rtlSlide == 'yes') {
                rtlSlide = true;
        } else {
                rtlSlide = false;
        }
        $(feedCaro).owlCarousel({
                rtl: rtlSlide,
            loop: sloop,
            center: true,
            margin: 30,
            nav: snav,
            dots: scontrol,
            autoplay: sautoplay,
            autoplayHoverPause: true,
            responsive: {
                    0: {
                        items: 1
                },
                992: {
                        items: 1
                },
                1000: {
                        items: 1
                }
            }
        });
        var owl = $(feedCaro);
        owl.owlCarousel();
        $(next).on('click', function() {
                owl.trigger('next.owl.carousel');
        });
        $(prev).on('click', function() {
                owl.trigger('prev.owl.carousel', [300]);
        });
    }
    feedbackfunc('.hero-slide', '.home-next', '.home-prev');
})(jQuery);
</script>
<?php 
    }
}
}
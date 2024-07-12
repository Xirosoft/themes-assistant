<?php
/**
 * Class Ata_Background_Animation
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Background_Animation 
 * @since 1.0.0
 */

 namespace ATA\Widgets;
 
use Elementor\Widget_Base;
Use Elementor\Core\Schemes\Color;
use Elementor\Controls_Manager;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Ata_Background_Animation extends Widget_Base {
   
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
  		return 'ata-background-animation';
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
  		return esc_html__( 'Background Animation', 'themes-assistant' );
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
  		return 'eicon-clock-o  borax-el';
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
  		'label' => esc_html__( 'Background Animation', 'themes-assistant' ),
		'tab' => Controls_Manager::TAB_CONTENT
	  ]
	  
	);
    $this->add_control(
          'animation_style',
        [
              'label' =>esc_html__( 'Animation Type Style', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                  '1' => esc_html__( 'Images shape', 'themes-assistant' ),
                '2' => esc_html__( 'Custom Shape', 'themes-assistant' ),
            ],
        ]
    );
 
    $this->add_control(
          'gallery',
        [
              'label' => __( 'Add Images', 'themes-assistant' ),
            'type' => \Elementor\Controls_Manager::GALLERY,
            'default' => [],
            'condition' => [
                  'animation_style' => '1'
            ]
        ]
    );
   
 
    $repeater = new \Elementor\Repeater();
    $repeater->add_control(
          'title',
        [
            'label' => esc_html__( 'Title', 'themes-assistant' ),
          'type' => Controls_Manager::TEXT,
          'default' => esc_html__( '', 'themes-assistant' ),
        ]
      );
      $repeater->add_control(
          'shape_color',
        [
              'label' => __( 'Shape Color', 'plugin-domain' ),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                  'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#000',
            'selectors' => [
                  '{{WRAPPER}} .title' => 'color: {{VALUE}}',
            ],
        ]
    );
    $repeater->add_control(
          'shape_type',
        [
              'label' => esc_html__( 'Shape Style', 'themes-assistant' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'none',
            'options' => [
                  'none' => esc_html__( 'None', 'themes-assistant' ),
                'Triangle' => esc_html__( 'Triangle', 'themes-assistant' ),
                'Trapezoid' => esc_html__( 'Trapezoid', 'themes-assistant' ),
                'Parallelogram' => esc_html__( 'Parallelogram', 'themes-assistant' ),
                'Rhombus' => esc_html__( 'Rhombus', 'themes-assistant' ),
                'Pentagon' => esc_html__( 'Pentagon', 'themes-assistant' ),
                'Hexagon' => esc_html__( 'Hexagon', 'themes-assistant' ),
                'Heptagon' => esc_html__( 'Heptagon', 'themes-assistant' ),
                'Octagon' => esc_html__( 'Octagon', 'themes-assistant' ),
                'Nonagon' => esc_html__( 'Nonagon', 'themes-assistant' ),
                'Decagon' => esc_html__( 'Decagon', 'themes-assistant' ),
                'Bevel' => esc_html__( 'Bevel', 'themes-assistant' ),
                'Rabbet' => esc_html__( 'Rabbet', 'themes-assistant' ),
                'Left-arrow' => esc_html__( 'Left arrow', 'themes-assistant' ),
                'Right-arrow' => esc_html__( 'Right arrow', 'themes-assistant' ),
                'Left-Point' => esc_html__( 'Left Point', 'themes-assistant' ),
                'Right-Point' => esc_html__( 'Right Point', 'themes-assistant' ),
                'Left-Chevron' => esc_html__( 'Left Chevron', 'themes-assistant' ),
                'Right-Chevron' => esc_html__( 'Right Chevron', 'themes-assistant' ),
                'Star' => esc_html__( 'Star', 'themes-assistant' ),
                'Cross' => esc_html__( 'Cross', 'themes-assistant' ),
                'Message' => esc_html__( 'Message', 'themes-assistant' ),
                'Close' => esc_html__( 'Close', 'themes-assistant' ),
                'Frame' => esc_html__( 'Frame', 'themes-assistant' ),
                'Inset' => esc_html__( 'Inset', 'themes-assistant' ),
                'Custom Polygon' => esc_html__( 'Custom Polygon', 'themes-assistant' ),
                'Circle' => esc_html__( 'Circle', 'themes-assistant' ),
                'Ellipse' => esc_html__( 'Ellipse', 'themes-assistant' ),
            ],
        ]
    );
    $repeater->add_control(
          'shape_shadow',
        [
              'label' => esc_html__( 'Shape Shadow', 'themes-assistant' ),
            'type' 	=> Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'themes-assistant' ),
            'label_off' => esc_html__( 'Hide', 'themes-assistant' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );
    $repeater->add_control(
        'shape_rotate',
      [
            'label' =>esc_html__( 'Shape Rotation', 'themes-assistant' ),
          'type' => Controls_Manager::SELECT,
          'default' => '1',
          'options' => [
                '' => esc_html__( 'None', 'themes-assistant' ),
              'rotating1' => esc_html__( 'Rotate Plus', 'themes-assistant' ),
              'rotating2' => esc_html__( 'Rotate Minus', 'themes-assistant' ),
          ],
      ]
  );
    
  
    $repeater->add_control(
        'shapeRound',
        [
        'label' => esc_html__( 'Shape Round', 'themes-assistant' ),
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
       
      ]
    );
    $repeater->add_control(
          'shapeWidth',
          [
          'label' => esc_html__( 'Shape Width', 'themes-assistant' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px'],
        'range' => [
              'px' => [
                'min' => 0,
              'max' => 100,
              'step' => 5,
            ],				
          ],
          'default' => [
              'unit' => 'px',
            'size' => 0,
          ],
        ]
      );
    $repeater->add_control(
          'shapeHeight',
          [
          'label' => esc_html__( 'Shape Height', 'themes-assistant' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px'],
        'range' => [
              'px' => [
                'min' => 0,
              'max' => 100,
              'step' => 5,
            ],				
          ],
          'default' => [
              'unit' => 'px',
            'size' => 0,
          ],
        ]
      );
      $this->add_control(
          'list',
        [
              'label' => esc_html__( 'Shape List', 'themes-assistant' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
          
            'condition' => [
                  'animation_style' => '2'
            ],
            'title_field' => '{{{ title }}}',
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
        $style = $settings['animation_style'];
        
		?>
<!-- Coming section start -->
<div class="background_animation">
      <?php 
                require BORAX_WIDGET_DIR .'bg-animation/style-'.$style.'.php';
            ?>
</div>
<?php
   }
  	public function load_widget_script(){
  		if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) { ?>
<script>
(function($) {
      // $(window).on("load", function () {
      var els = $('.ael')
    for (let index = 1; index < els.length + 1; index++) {
          animateDiv(".el" + index);
    }
    // });
    function makeNewPosition() {
          // Get viewport dimensions (remove the dimension of the div)
        var h = $(window).height() - 50;
        var w = $(window).width() - 50;
        var nh = Math.floor(Math.random() * h);
        var nw = Math.floor(Math.random() * w);
        return [nh, nw];
    }
    function animateDiv(myclass) {
          var newq = makeNewPosition();
        $(myclass).animate({
                  top: newq[0],
                left: newq[1],
            },
            10000,
            function() {
                  animateDiv(myclass);
            }
        );
    }
    var divs = document.getElementsByClassName('ael');
    // get window width and height
    var winWidth = window.innerWidth;
    var winHeight = window.innerHeight;
    // i stands for "index". you could also call this banana or haircut. it's a variable
    for (var i = 0; i < divs.length; i++) {
          // shortcut! the current div in the list
        var thisDiv = divs[i];
        // get random numbers for each element
        var randomTop = getRandomNumber(0, winHeight);
        var randomLeft = getRandomNumber(0, winWidth);
        // console.log(randomTop);
        // update top and left position
        thisDiv.style.opacity = 1;
        thisDiv.style.top = randomTop + "px";
        thisDiv.style.left = randomLeft + "px";
    }
    // function that returns a random number between a min and max
    function getRandomNumber(min, max) {
          return Math.random() * (max - min) + min;
    }
})(jQuery);
</script>
<?php 
		}
	}
}
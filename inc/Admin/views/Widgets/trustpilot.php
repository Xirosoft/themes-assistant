<?php
/**
 * Class Ata_Trust_Pilot
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Trust_Pilot 
 * @since 1.0.0
 */

namespace ATA\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Utils;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ata_Trust_Pilot extends Widget_Base {

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
        add_action('wp_enqueue_scripts', array($this, 'trustpilot_enqueue_scripts'));
	}
    
    
    function trustpilot_enqueue_scripts() {
        wp_enqueue_script('trustpilot-widget', 'https://widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js', array(), '1.0', true);
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
		return 'ata-trust-pilot';
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
			return esc_html__( 'TrustPilot Review', 'themes-assistant' );
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
		return 'eicon-editor-quote  borax-el';
	}

    public function get_keywords() {
		return ['Trust', 'Pilot', 'Reviews', 'Trustpilot', 'Trust Pilot Reviews'];
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
            'content_section',
            [
                'label' => __('Content', 'trustpilot-elementor-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'trustpilot_url',
            [
                'label' => __('Trustpilot URL', 'trustpilot-elementor-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __('Enter your Trustpilot URL', 'trustpilot-elementor-widget'),
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Trustpilot', 'themes-assistant' ),
			]
		);

        $this->add_control(
			'businessunitid', [
			'label' => __( 'Buiseness ID', 'themes-assistant' ),
			'description' => __('The details of the client/customer like company name, position held, company URL etc.', 'themes-assistant'),
				'type' => Controls_Manager::TEXT,
				'default' => __( '' , 'themes-assistant' ),
			]
    	); 
        
        $this->add_control(
            'trust_pilot_style',
            [
                'label' => esc_html__( 'Trust Pilot Style', 'themes-assistant' ),
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
            'image_shape',
            [
                'label' => esc_html__( 'Image Style', 'themes-assistant' ),
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
        $this->add_control(
            'image_shadow',
            [
              'label' => esc_html__( 'Image Shadow', 'themes-assistant' ),
              'type' 	=> Controls_Manager::SWITCHER,
              'label_on' => esc_html__( 'Show', 'themes-assistant' ),
                    'label_off' => esc_html__( 'Hide', 'themes-assistant' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
            ]
        );
      
        $this->add_control(
          'imageround',
            [
          'label' => esc_html__( 'Image Round', 'themes-assistant' ),
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
              '{{WRAPPER}} img' => 'border-radius: {{SIZE}}{{UNIT}};',
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
            'testi_rtl',
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

	}

    
    
	protected function render() {
		// call load widget script
		
		$settings       = $this->get_settings_for_display();
        $style  		= $settings['trust_pilot_style'];
        $widget_name  = $this->get_name(); // You can make this dynamic
		// $AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style);
    
        // Output the Trustpilot widget
        ob_start();

        $settings = $this->get_settings_for_display();

        if (!empty($settings['trustpilot_url'])) {
            echo '<div class="trustpilot-widget">';
            echo '<iframe src="' . esc_url($settings['trustpilot_url']) . '" width="100%" height="500" frameborder="0" scrolling="no"></iframe>';
            echo '</div>';
        } else {
            echo '<div class="trustpilot-widget">';
            echo '<p>' . __('Please enter a Trustpilot URL in the widget settings.', 'trustpilot-elementor-widget') . '</p>';
            echo '</div>';
        }
        
        ?>
        
        <h1>Trust Pilot</h1>
        <div class="trustpilot-widget" 
            data-locale="en-US" 
            data-template-id="5419b6a8b0d04a076446a9ad" 
            data-businessunit-id="5e06f4c0ace5b50001743016" 
            data-style-height="24px" 
            data-style-width="100%" 
            data-theme="light" 
            data-min-review-count="10" 
            data-style-alignment="center">
            <a href="https://www.trustpilot.com/review/xirosoft.com" target="_blank" rel="noopener">Trustpilot</a>
        </div>
        <?php
        return ob_get_clean();
	}
}
<?php
/**
 * Class Ata_Coming_soon
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Coming_soon 
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ata_Coming_soon extends Widget_Base {

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
        return 'ata-coming-soon';
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
        return esc_html__( 'Coming Soon', 'themes-assistant' );
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
        return 'eicon-clock-o borax-el';
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
                'label' => esc_html__( 'Coming Soon', 'themes-assistant' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'counter_style',
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
            'date_time',
            [
                'label' => esc_html__( 'Date', 'themes-assistant' ),
                'type' => Controls_Manager::DATE_TIME,
                'default' => esc_html__( '2031-11-11 11:59', 'themes-assistant' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'themes-assistant' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'We Are Coming Soon', 'themes-assistant' ),
            ]
        );

        $this->add_control(
            'content_txt',
            [
                'label' => esc_html__( 'Coming soon description', 'themes-assistant' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Our exciting new website is coming soon, Stay connected... Can days you willl forth two grass form face you saying, divide. Subdue days light whose. Stars creepeth that creature thing.', 'themes-assistant' ),
            ]
        );

        $this->add_control(
            'mailchip',
            [
                'label' => esc_html__( 'Enter Your put mailchp plugin shortcode', 'themes-assistant' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( '', 'themes-assistant' ),
            ]
        );

        $this->add_control(
            'width',
            [
                'label' => esc_html__( 'Width', 'themes-assistant' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bill-form' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'head_text_color',
            [
                'label' => esc_html__( 'Heading Color', 'themes-assistant' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__( '', 'themes-assistant' ),
                'selectors' => [
                    '{{WRAPPER}} .coming-style-3, {{WRAPPER}} .coming-sec .sec-heading h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sub_text_color',
            [
                'label' => esc_html__( 'Sub Heading Color', 'themes-assistant' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__( '', 'themes-assistant' ),
                'selectors' => [
                    '{{WRAPPER}} .coming-style-3, {{WRAPPER}} .coming-sec .sec-heading p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'Count_text_color',
            [
                'label' => esc_html__( 'Count Down Color', 'themes-assistant' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__( '', 'themes-assistant' ),
                'selectors' => [
                    '{{WRAPPER}} .coming-sec #clock p span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'coming_sec_overlay',
            [
                'label' => esc_html__( 'Section background overlay', 'themes-assistant' ),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__( '', 'themes-assistant' ),
                'selectors' => [
                    '{{WRAPPER}} .coming-sec:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'select_align',
            [
                'label' => esc_html__( 'Box Style', 'themes-assistant' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text-left',
                'options' => [
                    'text-center' => esc_html__( 'Align Center', 'themes-assistant' ),
                    'text-left' => esc_html__( 'Align Left', 'themes-assistant' ),
                    'text-right' => esc_html__( 'Align Right', 'themes-assistant' ),
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
        $style = $settings['counter_style'];
        $widget_name    = $this->get_name(); // You can make this dynamic
        $AtaWidget      = new AtaWidgetManage($widget_name, $settings, $style);
        require ATA_WIDGET_DIR . 'coming/style-' . $style . '.php';
    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) { ?>
            <script>
            (function($) {
                var clock = $('#clock');
                if ($(clock).length > 0) {
                    var date = $(clock).data('date');
                    $(clock).countdown(date).on('update.countdown', function(event) {
                        var $this = $(this).html(event.strftime('' +
                            '<p><span>week%!w</span> <span>%-w</span> </p>' +
                            '<p><span>day%!d</span> <span>%-d</span> </p>' +
                            '<p><span>hr</span> <span>%H</span> </p>' +
                            '<p><span>min</span> <span>%M</span> </p>' +
                            '<p><span>sec</span> <span>%S</span> </p>'));
                    });
                }
            })(jQuery);
            </script>
        <?php 
        }
    }
}
?>

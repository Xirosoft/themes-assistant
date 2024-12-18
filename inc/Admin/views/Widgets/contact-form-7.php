<?php
/**
 * Class Ata_Contact_Form_7
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Contact_Form_7
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Style for Contact Form 7
 *
 * @since 1.0.0
 */
class Ata_Contact_Form_7 extends Widget_Base { // this name is added to plugin.php of the root folder

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
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'ata-contact-form-7';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Contact Form 7', 'themes-assistant'); // title to show on Elementor
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-form-horizontal borax-el'; // icon to show on Elementor
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * @since 1.0.0
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
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Contact Form 7', 'themes-assistant'), // section name for control view
            ]
        );
        $this->add_control(
            'cf7_style',
            [
                'label' => esc_html__( 'Select Style', 'themes-assistant' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'themes-assistant' ),
                    // '2' => esc_html__( 'Style 2', 'themes-assistant' ),
                ],
            ]
        );

        $this->add_control(
            'cf7',
            [
                'label' => esc_html__('Select Contact Form', 'themes-assistant'),
                'description' => esc_html__('Contact Form 7 plugin must be installed and there must be created contact forms made with Contact Form 7.', 'themes-assistant'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->get_contact_form_7_posts(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_redirect',
            [
                'label' => esc_html__('Redirect Options', 'themes-assistant'), // section name for control view
            ]
        );

        $this->add_control(
            'redirect_option',
            [
                'label' => esc_html__('Select Redirect Option', 'themes-assistant'),
                'description' => esc_html__('Specify the type of redirect option: Internal or External page.', 'themes-assistant'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => [
                    'internal' => esc_html__('Internal Page', 'themes-assistant'),
                    'external' => esc_html__('External Page', 'themes-assistant'),
                ],
                'default' => 'internal',
            ]
        );

        $this->add_control(
            'cf7_redirect_external',
            [
                'label' => esc_html__('On Success External URL Redirect', 'themes-assistant'),
                'description' => esc_html__('Insert the external URL where users should be redirected when the contact form is successfully submitted. Leave blank to disable.', 'themes-assistant'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://example.com', 'themes-assistant'),
                'label_block' => true,
                'condition' => [
                    'redirect_option' => 'external',
                ],
            ]
        );

        $this->add_control(
            'cf7_redirect_page',
            [
                'label' => esc_html__('On Success Internal Redirect', 'themes-assistant'),
                'description' => esc_html__('Select a page within the site where users should be redirected when the contact form is successfully submitted. Leave blank to disable.', 'themes-assistant'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->get_all_wp_pages(),
                'condition' => [
                    'redirect_option' => 'internal',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        static $data = 0;
        $settings = $this->get_settings_for_display();
        $style = $settings['cf7_style'];

        if (!empty($settings['cf7'])) {
            echo '<div class="ata-shortcode ata-cf7 ata-cf7-' . esc_attr($data) . '">';
            echo do_shortcode('[contact-form-7 id="' . esc_attr($settings['cf7']) . '"]');
            echo '</div>';
        }

        if (!empty($settings['cf7_redirect_page']) || !empty($settings['cf7_redirect_external'])) { ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var theform = document.querySelector('.ata-cf7-<?php echo esc_js($data); ?>');
                    if (theform) {
                        theform.addEventListener('wpcf7mailsent', function(event) {
                            location.href = '<?php 
                                if (!empty($settings['cf7_redirect_external'])) {
                                    echo esc_url($settings['cf7_redirect_external']);
                                } else {
                                    echo esc_url(get_permalink($settings['cf7_redirect_page']));
                                }
                            ?>';
                        }, false);
                    }
                });
            </script>
        <?php
            $data++;
        }
    }

    /**
     * Retrieve the list of Contact Form 7 posts.
     *
     * @since 1.0.0
     *
     * @access private
     *
     * @return array List of Contact Form 7 posts.
     */
    private function get_contact_form_7_posts() {
        $args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
        $catlist=[];

        if( $categories = get_posts($args)){
            foreach ( $categories as $category ) {
                (int)$catlist[$category->ID] = $category->post_title; 
            }
        }
        else{
            (int)$catlist['0'] = esc_html__('No contect From 7 form found', 'borax');
        }
        return $catlist;
    }

    /**
     * Retrieve the list of all WordPress pages.
     *
     * @since 1.0.0
     *
     * @access private
     *
     * @return array List of all WordPress pages.
     */
    private function get_all_wp_pages() {
        $args = array('post_type' => 'page', 'posts_per_page' => -1);
        $catlist=[];

        if( $categories = get_posts($args)){
            foreach ( $categories as $category ) {
                (int)$catlist[$category->ID] = $category->post_title;
            }
        }
        else{
            (int)$catlist['0'] = esc_html__('No Pages Found!', 'borax');
        }
        return $catlist;
    }
}

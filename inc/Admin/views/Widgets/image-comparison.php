<?php
/**
 * Class Ata_Image_Comparison
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Image_Comparison 
 * @since 1.0.0
 */

 namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ata_Image_Comparison extends Widget_Base {

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
        return 'ata-image-comparison';
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
        return esc_html__( 'Image Comparison', 'themes-assistant' );
    }

    // public function get_script_depends() {
	// 	return [ 'twentytwenty-lib'];
	// }

	// public function get_style_depends() {
	// 	return [ 'lottie' ];
	// }

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
            return 'eicon-image-before-after  borax-el';
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
            'section_Image_Comparison',
        [
                'label' => esc_html__('Image Comparison', 'themes-assistant'),
        ]
    );
    $this->add_control(
            'image_comparison_heading',
        [
            'label' => esc_html__('Image Comparison', 'themes-assistant'),
            'type' => Controls_Manager::HEADING,
        ]
    );
    $this->add_control(
            'before_title', [
                'label' => esc_html__('Enter Before Title', 'themes-assistant'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_attr('Before'),
            'label_block' => true,
        ]
    );
    $this->add_control(
            'before_image',
        [
                'label' =>esc_html__( 'Before Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                    'url' => Utils::get_placeholder_image_src(),
            ],
        ]
    );
    $this->add_control(
            'after_title', [
                'label' => esc_html__('Enter After Title', 'themes-assistant'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_attr('After'),
            'label_block' => true,
        ]
    );
    $this->add_control(
            'after_image',
        [
                'label' =>esc_html__( 'After Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                    'url' => Utils::get_placeholder_image_src(),
            ],
        ]
    );
    $this->add_control(
            'overlay_swicher',
        [
                'label' => esc_html__('Overlay Switcher', 'themes-assistant'),
            'type' => Controls_Manager::SWITCHER,
            'label_off' => esc_html__('No', 'themes-assistant'),
            'label_on' => esc_html__('Yes', 'themes-assistant'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );
    $this->add_control(
            'overlay_image',
        [
                'label' =>esc_html__( 'Overlay Image', 'themes-assistant' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                    'url' => Utils::get_placeholder_image_src(),
            ],
            'condition' => [
                    'overlay_swicher' => 'yes',
            ],
        ]
    );

    $this->end_controls_section();
    $this->start_controls_section(
            'section_Comparison_options',
        [
                'label' => esc_html__('Comparison Options', 'themes-assistant'),
        ]
    );
    $this->add_control(
            'click_to_move',
        [
                'label' => esc_html__('Cursor Click option enable', 'themes-assistant'),
            'description' => esc_html__('Allow a user to click (or tap) anywhere on the image to move the slider to that location','themes-assistant'),
            'type' => Controls_Manager::SWITCHER,
            'label_off' => esc_html__('No', 'themes-assistant'),
            'label_on' => esc_html__('Yes', 'themes-assistant'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );
    $this->add_control(
            'no_overlay',
        [
                'label' => esc_html__('Click and disable Overlay', 'themes-assistant'),
            'description' => esc_html__('Do not show the overlay with before and after','themes-assistant'),
            'type' => Controls_Manager::SWITCHER,
            'label_off' => esc_html__('No', 'themes-assistant'),
            'label_on' => esc_html__('Yes', 'themes-assistant'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );
    $this->add_control(
            'comparison_orientation',
        [
                'label' => esc_html__( 'Select Orientation option', 'themes-assistant' ),
            'description' => esc_html__('Orientation of the before and after images (\'horizontal\' or \'vertical\') ','themes-assistant'),
            'type' => Controls_Manager::SELECT2,
            'multiple' => false,
            'label_block' => 1,
            'options' => [
                    'horizontal' =>  esc_html__( 'Horizontal', 'themes-assistant' ),
                'vertical' =>  esc_html__( 'Vertical', 'themes-assistant' ),
            ],
            'default' => 'vertical',				

            ]
        );

    $this->add_control(
    		'Image_offset',
		[
    			'label' => esc_html__( 'Image offset', 'themes-assistant' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px'],
			'range' => [
    				'px' => [
    					'min' => 0,
					'max' => 1,
					'step' => .1,
				],				
			],
			'default' => [
    				'unit' => 'px',
				'size' => 1,
			],
			'selectors' => [
    				'{{WRAPPER}} .sec-heading' => 'width: {{SIZE}}{{UNIT}};',
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
    $settings           = $this->get_settings_for_display();
    $image_offset       = $settings['Image_offset']['size'];
    $orientation        = $settings['comparison_orientation'];
    $beforelabel        = $settings['before_title'];
    $afterlabel         = $settings['after_title'];
    $no_overlay         = $settings['no_overlay'];
    $clickOption        = $settings['click_to_move'];
    $comporisionValues  = array( 
        'default_offset_pct'    => $image_offset,
        'orientation'           => $orientation,
        'before_label'          => $beforelabel,
        'after_label'           => $afterlabel,
        'no_overlay'            => $no_overlay,
        'click_to_move'         => $clickOption,
     );
    wp_localize_script( 'twentytwenty-lib', 'comporision', $comporisionValues );
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
    <div class="comporision-slider" data-offset="<?php echo esc_attr($image_offset); ?>" data-orient="<?php echo esc_attr($orientation); ?>" data-belabel="<?php echo esc_attr($beforelabel); ?>" data-aflabel="<?php echo esc_attr($afterlabel); ?>" data-overl="<?php echo esc_attr($no_overlay); ?>" data-click="<?php echo esc_attr($clickOption); ?>">
        <div class="imageDiff">
            <img src="<?php echo esc_url($settings['before_image']['url']); ?>" alt="<?php esc_attr__($settings['before_title'], 'themes-assistant'); ?>" width="442" height="571">
            <img src="<?php echo esc_url($settings['after_image']['url']); ?>" alt="<?php esc_attr__($settings['after_title'], 'themes-assistant'); ?>" width="442" height="571">
        </div>
        <?php if($settings['overlay_swicher'] == 'yes'): ?>
            <img src="<?php echo esc_url($settings['overlay_image']['url']); ?>" alt="<?php echo esc_html__( $settings['after_title'],'themes-assistant' ); ?>" class="overlay" width="442" height="571">
        <?php endif; ?>
    </div> 
    <?php
	}	
  	protected function _content_template() {

    }

public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
            ( function( $ ){
                    /* 
                Before/After
                */
                var image_offset    = $('.comporision-slider').data('offset');
                var orientation     = $('.comporision-slider').data('orient');
                var beforelabel     = $('.comporision-slider').data('belabel');
                var afterlabel      = $('.comporision-slider').data('aflabel');
                var no_overlay      = $('.comporision-slider').data('overl');
                var clickOption     = $('.comporision-slider').data('click');
                if (clickOption == 'yes') {
                        clickOption = false;
                }else{
                        clickOption = true;
                }
                if (no_overlay == 'yes') {
                        no_overlay = true;
                }else{
                        no_overlay = false;
                }
                if($('.imageDiff').length > 0){
                    $(".imageDiff").twentytwenty({
                        default_offset_pct: image_offset, // How much of the before image is visible when the page loads
                    orientation: orientation, // Orientation of the before and after images ('horizontal' or 'vertical')
                    before_label: beforelabel, // Set a custom before label
                    after_label: afterlabel, // Set a custom after label
                    no_overlay: no_overlay, //Do not show the overlay with before and after
                    move_slider_on_hover: clickOption, // Move slider on mouse hover?
                    move_with_handle_only: true, // Allow a user to swipe anywhere on the image to control slider movement. 
                    click_to_move: false, // Allow a user to click (or tap) anywhere on the image to move the slider to that location.
                    });
                }
            })(jQuery);
        </script>
    <?php 
    }
}
}
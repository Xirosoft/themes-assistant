<?php
/**
 * Class Ata_Bmi_Calculator
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Bmi_Calculator 
 * @since 1.0.0
 */

 namespace ATA\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Ata_Bmi_Calculator extends Widget_Base {
 
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
		return 'ata-bmi-calculator';
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
		return esc_html__( 'BMI Calculator', 'themes-assistant' );
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
		return 'eicon-number-field  borax-el';
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
		'section_iconbox',
		[
			'label' => esc_html__( 'BMI Calculator', 'themes-assistant' ),
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

    <form class="bmi-form bmi" id="form" onsubmit="return validateForm()">
        <div class="form-row">
            <div class="form-field col-12">
                <p class="text"><?php echo esc_html__('Age', 'themes-assistant'); ?></p>
                <input type="number" class="text-input form-control" id="age" autocomplete="off" required  placeholder="<?php echo esc_attr('Enter Your age', 'themes-assistant'); ?>"/>
            </div>

            <div class="form-field col-sm-6">
                <label class="custom-label">
                    <input type="radio" name="radio" id="f">
                    <p class="text"><?php echo esc_html__('Female', 'themes-assistant'); ?></p>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-field col-sm-6">
                <label class="custom-label">
                    <input type="radio" name="radio" id="m">
                    <p class="text"><?php echo esc_html__('Male', 'themes-assistant'); ?></p>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="col-12">
                <div class="form-field">
                    <p class="text"><?php echo esc_html__('Height (cm)', 'themes-assistant'); ?></p>
                    <input type="number" class="text-input form-control" id="height" autocomplete="off" required  placeholder="<?php echo esc_attr('Enter Your height', 'themes-assistant'); ?>">
                </div>
                <div class="form-field">
                    <p class="text"><?php echo esc_html__('Weight (kg)', 'themes-assistant'); ?></p>
                    <input type="number" class="text-input form-control" id="weight" autocomplete="off" required  placeholder="<?php echo esc_attr('Enter Your weight', 'themes-assistant'); ?>">
                </div>
            </div>
        </div>
        <button type="button" id="submit" class="btn "><?php echo esc_html__('Submit', 'themes-assistant'); ?></button>
        <div id="message"></div>
    </form>

    <?php

  }
}
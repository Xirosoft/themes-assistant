<?php
/**
 * Class AT_Assistant_Default_button
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package AT_Assistant\Widgets\AT_Assistant_Default_button
 * @since 1.0.0
 */

namespace AT_Assistant\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * AT_Assistant_Default_button class extend from elementor Widget_Base class
 *
 * @since 1.1.0
 */
class AT_Assistant_Default_button extends Widget_Base { // phpcs:ignore.

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
		return 'default-button';
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
		return esc_html__( 'Default Button', 'themes-assistant' );
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
		return 'eicon-button  borax-el';
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
	protected function _register_controls() { // phpcs:ignore.
			$this->start_controls_section(
				'section_videobox',
				array(
					'label' => esc_html__( 'Default Button', 'themes-assistant' ),
				)
			);

		$this->add_control(
			'btn',
			array(
				'label'   => esc_html__( 'Button', 'themes-assistant' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact Us', 'themes-assistant' ),
			)
		);

		$this->add_control(
			'btn_link',
			array(
				'label'       => esc_html__( 'Button Link', 'themes-assistant' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'http://your-link.com', 'themes-assistant' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'background',
				'label'    => esc_html__( 'Background', 'themes-assistant' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} a.btn',
			)
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

		$btn_link   = ( ! empty( $settings['btn_link']['url'] ) ) ? $settings['btn_link']['url'] : '';
		$btn_target = ( $settings['btn_link']['is_external'] ) ? '_blank' : '_self';
		?>
		<a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="btn">
		<?php
			printf(
                esc_html__( '%s', 'themes-assistant' ), // phpcs:ignore.
				esc_html( $settings['btn'] )
			);
		?>
		</a>
		<?php
	}
}
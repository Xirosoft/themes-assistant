<?php
/**
 * Class Ata_List_Items
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_List_Items 
 * @since 1.0.0
 */

namespace ATA\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class Ata_List_Items extends Widget_Base {
 
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
		return 'ata-list-items';
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
		return esc_html__( 'List Items', 'themes-assistant' );
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
		return 'eicon-post-list  borax-el';
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
      'section_service',
      [
        'label' => esc_html__( 'List Items', 'themes-assistant' ),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );
 
    $this->add_control(
        'title',
        [
            'label' => esc_html__( 'Heading Title', 'themes-assistant' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__( 'Our Services', 'themes-assistant' ),
        ]
      ); 


    $repeater = new Repeater();

    $repeater->add_control(
      'service_a',
      [
          'label' => esc_html__( 'Title', 'themes-assistant' ),
          'type' => Controls_Manager::TEXT,
          'default' => esc_html__( 'Web Design', 'themes-assistant' ),
      ]
    ); 
    $repeater->add_control(
        'link',
        [
            'label' => esc_html__( 'Link', 'themes-assistant' ),
            'type' => Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://website.com/services', 'themes-assistant' ),
            'default' => [
                'url' => '',
            ]
        ]
    );
    $repeater->add_control(
        'active',
        [
          'label' => esc_html__( 'Active', 'themes-assistant' ),
          'type' => Controls_Manager::CHOOSE,
          'default' => 'no',
          'options' => [
            'no'  => esc_html__( 'No', 'themes-assistant' ),
            'active' => esc_html__( 'Yes', 'themes-assistant' ),
          ],
        ]
    );

    $this->add_control(
        'list',
        [
            'label' => esc_html__( 'List', 'themes-assistant' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'link' => esc_html__( '', 'themes-assistant' ),					
                ],
                [
                    'link' => esc_html__( '', 'themes-assistant' ),					
                ]
            ],
            'title_field' => '{{{ service_a }}}',
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
	<div class="service-widget">
		<h3><?php echo esc_html__($settings['title'], 'themes-assistant'); ?></h3>
		<?php 
			if ( $settings['list'] ) { ?>
			<ul class="serviceList"> 
				<?php
				foreach (  $settings['list'] as $item ) { ?>
					<li class="<?php echo esc_html__($item['active'], 'themes-assistant'); ?>">
					<a href="<?php echo esc_url($item['link']['url']); ?>"><?php echo esc_html__($item['service_a'],'themes-assistant'); ?></a></li> <?php
				} ?>
		</ul>
		<?php } ?>
	</div>
<?php

}

}
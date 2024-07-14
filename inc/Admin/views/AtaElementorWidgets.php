<?php
/**
 * Class ElementorWidgets
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Admin\views
 * @since 1.0.0
 */

namespace ATA\Admin\Views;
use ATA\AtaQuery;

use ATA\Widgets\Ata_about_box;
use ATA\Widgets\Ata_Advance_Button;
use ATA\Widgets\Ata_Background_Animation;
use ATA\Widgets\Ata_blog_post;
use ATA\Widgets\Ata_Bmi_Calculator;
use ATA\Widgets\Ata_Coming_soon;
use ATA\Widgets\Ata_Contact_Form_7;
use ATA\Widgets\Ata_contact_Info;
use ATA\Widgets\Ata_Cta_Section;
use ATA\Widgets\Ata_Default_button;
use ATA\Widgets\Ata_faq;
use ATA\Widgets\Ata_Counter;
use ATA\Widgets\Ata_Google_Reviews;
use ATA\Widgets\Ata_Hero_Banner;
use ATA\Widgets\Ata_Hero_slider;
use ATA\Widgets\Ata_icon_box;
use ATA\Widgets\Ata_image_box;
use ATA\Widgets\Ata_Image_Comparison;
use ATA\Widgets\Ata_Instagram_Gallery;
use ATA\Widgets\Ata_List_Items;
use ATA\Widgets\Ata_Logo_Slider;
use ATA\Widgets\Ata_Lottie_Animation;
use ATA\Widgets\Ata_Office_Hours;
use ATA\Widgets\Ata_Portfolio;
use ATA\Widgets\Ata_Price_Table;
use ATA\Widgets\Ata_Section_Header;
use ATA\Widgets\Ata_Servie_Price;
use ATA\Widgets\Ata_Team_Box;
use ATA\Widgets\Ata_Testimonial_Slider;
use ATA\Widgets\Ata_Timetable;
use ATA\Widgets\Ata_Trust_Pilot;
use ATA\Widgets\Ata_Video_Banner;
use ATA\Widgets\Ata_Work_Flow;

/**
 * ElementorWidgets for manage all elementor widget
 */
class AtaElementorWidgets {

    private $query; 
    private $wpdb;
    private $table_name;
    private $where;

	/**
	 * Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 */
	public function __construct() {

        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix . 'at_assistant_settings'; // Replace 't_assistant_settings' with your custom table name
        $this->query = new AtaQuery();
        $query = "SELECT * FROM %1s";
        $this->where = array('id' => 1);
		// Register widgets.
		add_action( 'elementor/elements/categories_registered', array( $this, 'ata_elementor_widget_categories' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'ata_register_widgets' ) );
	}

	/**
	 * Register Themes Assistant Elementor widget categories
	 *
	 * @param object $elements_manager Elementor elements manager.
	 * @since 1.2.0
	 */
	public function ata_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'themes-assistant',
			array(
				'title' => __( 'Themes Assistant', 'themes-assistant' ),
				'icon'  => 'fa fa-plug',
			)
		);
		$elements_manager->add_category(
			'themes-assistant-pro',
			array(
				'title' => __( 'Themes Assistant Pro', 'themes-assistant' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		/* All files includes */
		$ata_el_widget = array_map( 'basename', glob( __DIR__ . '/widgets/*.php' ) );
		foreach ( $ata_el_widget as $key => $value ) {
			require_once __DIR__ . '/widgets/' . $value;
		}
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 */

    public function ata_register_widgets() {
        // It is now safe to include Widgets files.
        $this->include_widgets_files();
    
        $rows = $this->query->ata_view_data($this->table_name, array('id' => $this->where['id']));
        $data = $rows[0]->elements_settings;
        $SettingsArray = json_decode($data, true);
        if(gettype($SettingsArray) == 'string') {
            $SettingsArray = json_decode($SettingsArray, true);
        }
    
        // List of widget classes to register, associated with their settings keys.
        $widget_classes = array(
            'ata_about_box' => Ata_about_box::class,
            'ata_advance_button' => Ata_Advance_Button::class,
            'ata_background_animation' => Ata_Background_Animation::class,
            'ata_blog_post' => Ata_blog_post::class,
            'ata_bmi_calculator' => Ata_Bmi_Calculator::class,
            'ata_coming_soon' => Ata_Coming_soon::class,
            'ata_contact_form_7' => Ata_Contact_Form_7::class,
            'ata_contact_info' => Ata_contact_Info::class,
            'ata_cta_section' => Ata_Cta_Section::class,
            'ata_default_button' => Ata_Default_button::class,
            'ata_faq' => Ata_faq::class,
            'ata_counter' => Ata_Counter::class,
            'ata_google_reviews' => Ata_Google_Reviews::class,
            'ata_hero_banner' => Ata_Hero_Banner::class,
            'ata_hero_slider' => Ata_Hero_slider::class,
            'ata_icon_box' => Ata_icon_box::class,
            'ata_image_box' => Ata_image_box::class,
            'ata_image_comparison' => Ata_Image_Comparison::class,
            'ata_instagram' => Ata_Instagram_Gallery::class,
            'ata_list_items' => Ata_List_Items::class,
            'ata_logo_slider' => Ata_Logo_Slider::class,
            'ata_lottie_animation' => Ata_Lottie_Animation::class,
            'ata_office_hour' => Ata_Office_Hours::class,
            'ata_portfolio' => Ata_Portfolio::class,
            'ata_price_table' => Ata_Price_Table::class,
            'ata_section_header' => Ata_Section_Header::class,
            'ata_service_price' => Ata_Servie_Price::class,
            'ata_team' => Ata_Team_Box::class,
            'ata_testimonial_slider' => Ata_Testimonial_Slider::class,
            'ata_time_table' => Ata_Timetable::class,
            'ata_trust_pilot' => Ata_Trust_Pilot::class,
            'ata_video_banner' => Ata_Video_Banner::class,
            'ata_work_flow' => Ata_Work_Flow::class,
        );
    
        $widget_manager = \Elementor\Plugin::instance()->widgets_manager;
        
        // Register widget types based on SettingsArray.
        foreach ($widget_classes as $key => $widget_class) {
            if (isset($SettingsArray[$key]) && $SettingsArray[$key] === 'on') {
                $widget_manager->register_widget_type(new $widget_class());
            }
        }
    }

}

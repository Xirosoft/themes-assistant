<?php
/**
 * Class Ata_Timetable
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Timetable 
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ata_Timetable extends Widget_Base {

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
    		return 'ata-time-table';
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
    		return esc_html__( 'Time Table', 'themes-assistant' );
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
    		return 'eicon-table borax-el';
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
          'table_heading',
          [
            'label' => esc_html__( 'Table Heading Content', 'themes-assistant' ),
          ]
    );
        $this->add_control(
            'fcolname',
            [
              'label' => esc_html__( '1st Column Name', 'themes-assistant' ),
              'type' => Controls_Manager::TEXT,
              'default' => esc_html__( 'Time', 'themes-assistant' ),
            ]
      );

        $this->add_control(
            'scolname',
            [
              'label' => esc_html__( '2nd Column Name', 'themes-assistant' ),
              'type' => Controls_Manager::TEXT,
              'default' => esc_html__( 'Class Type', 'themes-assistant' ),
            ]
      );

        $this->add_control(
            'tcolname',
            [
              'label' => esc_html__( '3rd Column Name', 'themes-assistant' ),
              'type' => Controls_Manager::TEXT,
              'default' => esc_html__( 'Coach Name', 'themes-assistant' ),
            ]
      );
          $this->end_controls_section();
        $this->start_controls_section(
          'section_monday',
          [
            'label' => esc_html__( 'Time Table  Monday', 'themes-assistant' ),
          ]
    );



        $section_monday = new \Elementor\Repeater();

        $section_monday->add_control(
            'start_time_value',
            [
                'label' => esc_html__( 'Start Time', 'themes-assistant' ),
                'type' => Controls_Manager::DATE_TIME,
                'picker_options' => [
                  'enableTime' => true,
                  'noCalendar' => true,
                  'dateFormat' => 'h:i:K',
                  'defaultHour' => '12',

            ],
                'default' => esc_html__( '9:00 AM', 'themes-assistant' ),
            ]
      ); 
          $section_monday->add_control(
            'end_time_value',
            [
                'label' => esc_html__( 'End Time', 'themes-assistant' ),
                'type' => Controls_Manager::DATE_TIME,
                'default' => esc_html__( '8:00 PM', 'themes-assistant' ),
                'picker_options' => [
                  'enableTime' => true,
                  'noCalendar' => true,
                  'dateFormat' => 'h:i:K',
                  'defaultHour' => '12',
            ],
            ]
      ); 
        $section_monday->add_control(
          'class_type',
          [
            'label' => esc_html__( 'Class Type', 'themes-assistant' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__( 'Fitness', 'themes-assistant' ),
          ]
    );
        $section_monday->add_control(
            'coach_photo',
            [
                'label' => esc_html__( 'Coach Photo', 'themes-assistant' ),
                'type' 	=> Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
            ],
            ]
	);
        $section_monday->add_control(
          'coach_name',
          [
            'label' => esc_html__( 'Coach Name', 'themes-assistant' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__( 'Melvin Harvey', 'themes-assistant' ),
          ]
    );
        $this->add_control(
            'mondaylist',
            [
                'label' => esc_html__( 'Monday List', 'themes-assistant' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $section_monday->get_controls(),
                'title_field' => '{{{ class_type }}}',
        ]
    );
    $this->end_controls_section();
    $this->start_controls_section(
            'section_tuesday',
        [
              'label' => esc_html__( 'Time Table Tuesday ', 'themes-assistant' ),
        ]
      );

      $section_tuesday  = new \Elementor\Repeater();

      $section_tuesday ->add_control(
              'start_time_value',
          [
                  'label' => esc_html__( 'Start Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',

              ],
              'default' => esc_html__( '9:00 AM', 'themes-assistant' ),
          ]
        ); 
        $section_tuesday ->add_control(
              'end_time_value',
          [
                  'label' => esc_html__( 'End Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'default' => esc_html__( '8:00 PM', 'themes-assistant' ),
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',
              ],
          ]
        ); 

      $section_tuesday ->add_control(
            'class_type',
        [
              'label' => esc_html__( 'Class Type', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Fitness', 'themes-assistant' ),
        ]
      );
      $section_tuesday ->add_control(
              'coach_photo',
          [
                  'label' => esc_html__( 'Coach Photo', 'themes-assistant' ),
              'type' 	=> Controls_Manager::MEDIA,
              'default' => [
                      'url' => Utils::get_placeholder_image_src(),
              ],
          ]
      );
      $section_tuesday ->add_control(
            'coach_name',
        [
              'label' => esc_html__( 'Coach Name', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Melvin Harvey', 'themes-assistant' ),
        ]
      );

      $this->add_control(
              'tuesdaylist',
          [
                  'label' => esc_html__( 'Tuesday  List', 'themes-assistant' ),
              'type' => Controls_Manager::REPEATER,
              'fields' => $section_tuesday ->get_controls(),
              'title_field' => '{{{ class_type }}}',
          ]
      );
      $this->end_controls_section();
      $this->start_controls_section(
            'section_wednesday',
        [
              'label' => esc_html__( 'Time Table Wednesday ', 'themes-assistant' ),
        ]
      );
      $section_wednesday  = new \Elementor\Repeater();

      $section_wednesday ->add_control(
              'start_time_value',
          [
                  'label' => esc_html__( 'Start Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',

              ],
              'default' => esc_html__( '9:00 AM', 'themes-assistant' ),
          ]
        ); 
        $section_wednesday ->add_control(
              'end_time_value',
          [
                  'label' => esc_html__( 'End Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'default' => esc_html__( '8:00 PM', 'themes-assistant' ),
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',
              ],
          ]
        ); 

      $section_wednesday ->add_control(
            'class_type',
        [
              'label' => esc_html__( 'Class Type', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Fitness', 'themes-assistant' ),
        ]
      );
      $section_wednesday ->add_control(
              'coach_photo',
          [
                  'label' => esc_html__( 'Coach Photo', 'themes-assistant' ),
              'type' 	=> Controls_Manager::MEDIA,
              'default' => [
                      'url' => Utils::get_placeholder_image_src(),
              ],
          ]
      );
      $section_wednesday ->add_control(
            'coach_name',
        [
              'label' => esc_html__( 'Coach Name', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Melvin Harvey', 'themes-assistant' ),
        ]
      );

      $this->add_control(
              'wednesdaylist',
          [
                  'label' => esc_html__( 'Wednesday  List', 'themes-assistant' ),
              'type' => Controls_Manager::REPEATER,
              'fields' => $section_wednesday ->get_controls(),
              'title_field' => '{{{ class_type }}}',
          ]
      );
      $this->end_controls_section();


      $this->start_controls_section(
            'section_thursday',
        [
              'label' => esc_html__( 'Time Table Thursday ', 'themes-assistant' ),
        ]
      );
      $section_thursday  = new \Elementor\Repeater();

      $section_thursday ->add_control(
              'start_time_value',
          [
                  'label' => esc_html__( 'Start Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',

              ],
              'default' => esc_html__( '9:00 AM', 'themes-assistant' ),
          ]
        ); 
        $section_thursday ->add_control(
              'end_time_value',
          [
                  'label' => esc_html__( 'End Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'default' => esc_html__( '8:00 PM', 'themes-assistant' ),
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',
              ],
          ]
        ); 

      $section_thursday ->add_control(
            'class_type',
        [
              'label' => esc_html__( 'Class Type', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Fitness', 'themes-assistant' ),
        ]
      );
      $section_thursday ->add_control(
              'coach_photo',
          [
                  'label' => esc_html__( 'Coach Photo', 'themes-assistant' ),
              'type' 	=> Controls_Manager::MEDIA,
              'default' => [
                      'url' => Utils::get_placeholder_image_src(),
              ],
          ]
      );
      $section_thursday ->add_control(
            'coach_name',
        [
              'label' => esc_html__( 'Coach Name', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Melvin Harvey', 'themes-assistant' ),
        ]
      );

      $this->add_control(
              'thursdaylist',
          [
                  'label' => esc_html__( 'Thursday  List', 'themes-assistant' ),
              'type' => Controls_Manager::REPEATER,
              'fields' => $section_thursday ->get_controls(),
              'title_field' => '{{{ class_type }}}',
          ]
      );
      $this->end_controls_section();

      $this->start_controls_section(
            'section_friday',
        [
              'label' => esc_html__( 'Time Table Friday ', 'themes-assistant' ),
        ]
      );
      $section_friday  = new \Elementor\Repeater();

      $section_friday ->add_control(
              'start_time_value',
          [
                  'label' => esc_html__( 'Start Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',

              ],
              'default' => esc_html__( '9:00 AM', 'themes-assistant' ),
          ]
        ); 
        $section_friday ->add_control(
              'end_time_value',
          [
                  'label' => esc_html__( 'End Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'default' => esc_html__( '8:00 PM', 'themes-assistant' ),
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',
              ],
          ]
        ); 

      $section_friday ->add_control(
            'class_type',
        [
              'label' => esc_html__( 'Class Type', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Fitness', 'themes-assistant' ),
        ]
      );
      $section_friday ->add_control(
              'coach_photo',
          [
                  'label' => esc_html__( 'Coach Photo', 'themes-assistant' ),
              'type' 	=> Controls_Manager::MEDIA,
              'default' => [
                      'url' => Utils::get_placeholder_image_src(),
              ],
          ]
      );
      $section_friday ->add_control(
            'coach_name',
        [
              'label' => esc_html__( 'Coach Name', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Melvin Harvey', 'themes-assistant' ),
        ]
      );

      $this->add_control(
              'fridaylist',
          [
                  'label' => esc_html__( 'Friday  List', 'themes-assistant' ),
              'type' => Controls_Manager::REPEATER,
              'fields' => $section_friday ->get_controls(),
              'title_field' => '{{{ class_type }}}',
          ]
      );
      $this->end_controls_section();

      $this->start_controls_section(
            'section_saturday',
        [
              'label' => esc_html__( 'Time Table Saturday', 'themes-assistant' ),
        ]
      );
      $section_saturday  = new \Elementor\Repeater();

      $section_saturday ->add_control(
              'start_time_value',
          [
                  'label' => esc_html__( 'Start Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',

              ],
              'default' => esc_html__( '9:00 AM', 'themes-assistant' ),
          ]
        ); 
        $section_saturday ->add_control(
              'end_time_value',
          [
                  'label' => esc_html__( 'End Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'default' => esc_html__( '8:00 PM', 'themes-assistant' ),
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',
              ],
          ]
        ); 

      $section_saturday ->add_control(
            'class_type',
        [
              'label' => esc_html__( 'Class Type', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Fitness', 'themes-assistant' ),
        ]
      );
      $section_saturday ->add_control(
              'coach_photo',
          [
                  'label' => esc_html__( 'Coach Photo', 'themes-assistant' ),
              'type' 	=> Controls_Manager::MEDIA,
              'default' => [
                      'url' => Utils::get_placeholder_image_src(),
              ],
          ]
      );
      $section_saturday ->add_control(
            'coach_name',
        [
              'label' => esc_html__( 'Coach Name', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Melvin Harvey', 'themes-assistant' ),
        ]
      );

      $this->add_control(
              'saturdaylist',
          [
                  'label' => esc_html__( 'Saturday  List', 'themes-assistant' ),
              'type' => Controls_Manager::REPEATER,
              'fields' => $section_saturday ->get_controls(),
              'title_field' => '{{{ class_type }}}',
          ]
      );
      $this->end_controls_section();

      $this->start_controls_section(
            'section_sunday',
        [
              'label' => esc_html__( 'Time Table Sunday', 'themes-assistant' ),
        ]
      );
      $section_sunday  = new \Elementor\Repeater();

      $section_sunday ->add_control(
              'start_time_value',
          [
                  'label' => esc_html__( 'Start Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',

              ],
              'default' => esc_html__( '9:00 AM', 'themes-assistant' ),
          ]
        ); 
        $section_sunday ->add_control(
              'end_time_value',
          [
                  'label' => esc_html__( 'End Time', 'themes-assistant' ),
              'type' => Controls_Manager::DATE_TIME,
              'default' => esc_html__( '8:00 PM', 'themes-assistant' ),
              'picker_options' => [
                    'enableTime' => true,
                'noCalendar' => true,
                'dateFormat' => 'h:i:K',
                'defaultHour' => '12',
              ],
          ]
        ); 

      $section_sunday ->add_control(
            'class_type',
        [
              'label' => esc_html__( 'Class Type', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Fitness', 'themes-assistant' ),
        ]
      );
      $section_sunday ->add_control(
              'coach_photo',
          [
                  'label' => esc_html__( 'Coach Photo', 'themes-assistant' ),
              'type' 	=> Controls_Manager::MEDIA,
              'default' => [
                      'url' => Utils::get_placeholder_image_src(),
              ],
          ]
      );
      $section_sunday ->add_control(
            'coach_name',
        [
              'label' => esc_html__( 'Coach Name', 'themes-assistant' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => esc_html__( 'Melvin Harvey', 'themes-assistant' ),
        ]
      );

      $this->add_control(
              'sundaylist',
          [
                  'label' => esc_html__( 'Sunday  List', 'themes-assistant' ),
              'type' => Controls_Manager::REPEATER,
              'fields' => $section_saturday ->get_controls(),
              'title_field' => '{{{ class_type }}}',
          ]
      );
      $this->end_controls_section();
    // Style
    $this->start_controls_section(
            'section_style_content',
        [
                'label' => esc_html__( 'Style', 'themes-assistant' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'tab_button_typography',
            'label' => __( 'Tab Button Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .nav-tabs .nav-item .nav-link',
        ]
    );
    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'table_head_typography',
            'label' => __( 'Table Heading Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .table thead th',
        ]
    );
    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'table_datra_typography',
            'label' => __( 'Table Data Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .table td',
        ]
    );
    $this->add_control(
            'item_bg_color',
        [
                'label' => esc_html__( 'Table Button Background Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                    '{{WRAPPER}} .nav-item .nav-link' => 'background: {{VALUE}}',
            ],
        ]
    );
    $this->add_control(
            'item_text_color',
        [
                'label' => esc_html__( 'Table Button Text Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                    '{{WRAPPER}} .nav-item .nav-link' => 'color: {{VALUE}}',
            ],
        ]
    );
    $this->add_control(
            'item_bg_hover_color',
        [
                'label' => esc_html__( 'Table Button Hover/Active BG Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                    '{{WRAPPER}} .nav-item .nav-link:hover, {{WRAPPER}} .nav-item .nav-link.active' => 'background: {{VALUE}}',
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
    <div class="table-area">
        <div class="table-row">
            <ul class="nav nav-tabs nav-pills flex-column flex-sm-row mb-4" id="pills-tab" role="tablist">
                <li class="nav-item flex-sm-fill text-center" role="presentation">
                    <a class="nav-link active" id="monday-tab" data-toggle="pill" href="#monday" role="tab"
                        aria-controls="monday" aria-selected="true"><span><?php echo esc_html__('Monday', 'themes-assistant'); ?>  </span></a>
                </li>
                <li class="nav-item flex-sm-fill text-center" role="presentation">
                    <a class="nav-link" id="tuesday-tab" data-toggle="pill" href="#tuesday" role="tab"
                        aria-controls="tuesday" aria-selected="false"><span><?php echo esc_html__('Tuesday', 'themes-assistant'); ?>  </span></a>
                </li>
                <li class="nav-item flex-sm-fill text-center" role="presentation">
                    <a class="nav-link" id="wednesday-tab" data-toggle="pill" href="#wednesday" role="tab"
                        aria-controls="wednesday" aria-selected="false"><span><?php echo esc_html__('Wednesday', 'themes-assistant'); ?>  </span></a>
                </li>
                <li class="nav-item flex-sm-fill text-center" role="presentation">
                    <a class="nav-link" id="thursday-tab" data-toggle="pill" href="#thursday" role="tab"
                        aria-controls="thursday" aria-selected="false"><span><?php echo esc_html__('Thursday', 'themes-assistant'); ?>  </span></a>
                </li>
                <li class="nav-item flex-sm-fill text-center" role="presentation">
                    <a class="nav-link" id="friday-tab" data-toggle="pill" href="#friday" role="tab" aria-controls="friday"
                        aria-selected="false"><span><?php echo esc_html__('Friday', 'themes-assistant'); ?>  </span></a>
                </li>
                <li class="nav-item flex-sm-fill text-center" role="presentation">
                    <a class="nav-link" id="saturday-tab" data-toggle="pill" href="#saturday" role="tab"
                        aria-controls="saturday" aria-selected="false"><span><?php echo esc_html__('Saturday', 'themes-assistant'); ?>  </span></a>
                </li>
                <li class="nav-item flex-sm-fill text-center" role="presentation">
                    <a class="nav-link" id="sunday-tab" data-toggle="pill" href="#sunday" role="tab" aria-controls="sunday"
                        aria-selected="false"><span><?php echo esc_html__('Sunday', 'themes-assistant'); ?>  </span></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="monday" role="tabpanel" aria-labelledby="monday-tab">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-skew mb-0">
                            <thead class="bg-white">
                                <tr>
                                    <th><?php echo esc_html__($settings['fcolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['scolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['tcolname'], 'themes-assistant'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if ( $settings['mondaylist'] ): 
                                    foreach (  $settings['mondaylist'] as $item ):

                                ?>
                                    <tr>
                                        <td><?php echo esc_html__($item['start_time_value'], 'themes-assistant'); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php echo esc_html__($item['end_time_value'], 'themes-assistant'); ?></td>
                                        <td><?php echo esc_html__($item['class_type'], 'themes-assistant'); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="avatar" width="40" height="40">
                                                <span class="ml-3 mb-0 pr-4"><?php echo esc_html__($item['coach_name'], 'themes-assistant'); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                endforeach;
                            endif; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="tuesday" role="tabpanel" aria-labelledby="tuesday-tab">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-skew mb-0">
                            <thead class="bg-white">
                                <tr>
                                    <th><?php echo esc_html__($settings['fcolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['scolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['tcolname'], 'themes-assistant'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if ( $settings['tuesdaylist'] ): 
                                    foreach (  $settings['tuesdaylist'] as $item ):

                                ?>
                                    <tr>
                                        <td><?php echo esc_html__($item['start_time_value'], 'themes-assistant'); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php echo esc_html__($item['end_time_value'], 'themes-assistant'); ?></td>
                                        <td><?php echo esc_html__($item['class_type'], 'themes-assistant'); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php echo esc_html__($item['coach_name'], 'themes-assistant'); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                endforeach;
                            endif; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="wednesday" role="tabpanel" aria-labelledby="wednesday-tab">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-skew mb-0">
                            <thead class="bg-white">
                                <tr>
                                    <th><?php echo esc_html__($settings['fcolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['scolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['tcolname'], 'themes-assistant'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if ( $settings['wednesdaylist'] ): 
                                    foreach (  $settings['wednesdaylist'] as $item ):

                                ?>
                                    <tr>
                                        <td><?php echo esc_html__($item['start_time_value'], 'themes-assistant'); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php echo esc_html__($item['end_time_value'], 'themes-assistant'); ?></td>
                                        <td><?php echo esc_html__($item['class_type'], 'themes-assistant'); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php echo esc_html__($item['coach_name'], 'themes-assistant'); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                endforeach;
                            endif; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="thursday" role="tabpanel" aria-labelledby="thursday-tab">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-skew mb-0">
                            <thead class="bg-white">
                                <tr>
                                <th><?php echo esc_html__($settings['fcolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['scolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['tcolname'], 'themes-assistant'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if ( $settings['thursdaylist'] ): 
                                    foreach (  $settings['thursdaylist'] as $item ):

                                ?>
                                    <tr>
                                        <td><?php echo esc_html__($item['start_time_value'], 'themes-assistant'); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php echo esc_html__($item['end_time_value'], 'themes-assistant'); ?></td>
                                        <td><?php echo esc_html__($item['class_type'], 'themes-assistant'); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php echo esc_html__($item['coach_name'], 'themes-assistant'); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                endforeach;
                            endif; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="friday" role="tabpanel" aria-labelledby="friday-tab">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-skew mb-0">
                            <thead class="bg-white">
                                <tr>
                                    <th><?php echo esc_html__($settings['fcolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['scolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['tcolname'], 'themes-assistant'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if ( $settings['fridaylist'] ): 
                                    foreach (  $settings['fridaylist'] as $item ):

                                ?>
                                    <tr>
                                        <td><?php echo esc_html__($item['start_time_value'], 'themes-assistant'); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php echo esc_html__($item['end_time_value'], 'themes-assistant'); ?></td>
                                        <td><?php echo esc_html__($item['class_type'], 'themes-assistant'); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php echo esc_html__($item['coach_name'], 'themes-assistant'); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                endforeach;
                            endif; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="saturday" role="tabpanel" aria-labelledby="saturday-tab">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-skew mb-0">
                            <thead class="bg-white">
                                <tr>
                                    <th><?php echo esc_html__($settings['fcolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['scolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['tcolname'], 'themes-assistant'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if ( $settings['saturdaylist'] ): 
                                    foreach (  $settings['saturdaylist'] as $item ):

                                ?>
                                    <tr>
                                        <td><?php echo esc_html__($item['start_time_value'], 'themes-assistant'); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php echo esc_html__($item['end_time_value'], 'themes-assistant'); ?></td>
                                        <td><?php echo esc_html__($item['class_type'], 'themes-assistant'); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="<?php echo esc_html__($item['coach_name'], 'themes-assistant'); ?>" width="30" height="30">
                                                <span class="ml-3 mb-0 pr-4"><?php echo esc_html__($item['coach_name'], 'themes-assistant'); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                endforeach;
                            endif; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-skew mb-0">
                            <thead class="bg-white">
                                <tr>
                                    <th><?php echo esc_html__($settings['fcolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['scolname'], 'themes-assistant'); ?></th>
                                    <th><?php echo esc_html__($settings['tcolname'], 'themes-assistant'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if ( $settings['sundaylist'] ): 
                                    foreach (  $settings['sundaylist'] as $item ):

                                ?>
                                    <tr>
                                        <td><?php echo esc_html__($item['start_time_value'], 'themes-assistant'); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php echo esc_html__($item['end_time_value'], 'themes-assistant'); ?></td>
                                        <td><?php echo esc_html__($item['class_type'], 'themes-assistant'); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php echo esc_html__($item['coach_name'], 'themes-assistant'); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                endforeach;
                            endif; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
}
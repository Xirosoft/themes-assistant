<?php
/**
 * Class Ata_Price_Table
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Price_Table 
 * @since 1.0.0
 */

 namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager; 
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * @since 1.1.0 
 */
class Ata_Price_Table extends Widget_Base {
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
            return 'ta-price-table';
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
            return esc_html__( 'Pricing Table', 'themes-assistant' );
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
            return 'eicon-price-table  borax-el';
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
                'section_pricing_table',
            [
                    'label' => esc_html__('Pricing Table', 'themes-assistant'),
            ]
        );
        $this->add_control(
            'table_style',
            [
                    'label' =>esc_html__( 'Table Style', 'themes-assistant' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'themes-assistant' ),
                    '2' => esc_html__( 'Style 2', 'themes-assistant' ),
                    '3' => esc_html__( 'Style 3', 'themes-assistant' ),
                ],
            ]
        );
        $this->add_control(
                'pricing_heading',
            [
                    'label' => esc_html__('Pricing Plans', 'themes-assistant'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
                'pricing_style',
            [
                    'label' => esc_html__( 'Align', 'themes-assistant' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'one',
                'options' => [
                        'center'  => esc_html__( 'Align Center', 'themes-assistant' ),
                    'align-left' => esc_html__( 'Align Left', 'themes-assistant' ),
                    'align-right' => esc_html__( 'Align Right', 'themes-assistant' ),
                ]
            ]
        );
        $this->add_control(
                'month_year_control',
            [
                'label' => esc_html__('Pricing Month/Year Fiter Button Control', 'themes-assistant'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('You can enable/disable pricing filter button', 'themes-assistant'),
                'label_off' => esc_html__('No', 'themes-assistant'),
                'label_on' => esc_html__('Yes', 'themes-assistant'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                        'table_style' => '1',
                ]
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
                'pricing_title',
            [
                    'label' => esc_html__('Pricing Plan Title', 'themes-assistant'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('PREMIUM', 'themes-assistant'),
                'dynamic' => [
                        'active' => true,
                ],
            ],
        );

         $repeater->add_control(
                'month_or_year_control',
            [
                'label' => esc_html__('Month/Year Control', 'themes-assistant'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('You can enable/disable pricing filter button', 'themes-assistant'),
                'label_off' => esc_html__('No', 'themes-assistant'),
                'label_on' => esc_html__('Yes', 'themes-assistant'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
                'tagline',
            [
                    'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Tagline Text', 'themes-assistant'),
                'description' => esc_html__('Provide any subtitle or taglines like "Most Popular", "Best Value", "Best Selling", "Most Flexible" etc. that you would like to use for this pricing plan.', 'themes-assistant'),
                'default' => esc_html__('Tagline', 'themes-assistant'),
                'dynamic' => [
                        'active' => true,
                ],
            ],
        );
        $repeater->add_control(
                'pricing_image',
            [
                    'label' => esc_html__('Pricing Image', 'themes-assistant'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true, 
                'dynamic' => [
                        'active' => true,
                ],
            ],
        );
        $repeater->add_control(
                'price_month',
            [
                    'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Price Monthly', 'themes-assistant'),
                'default' => esc_html__('230', 'themes-assistant'),
                'description' => esc_html__('Enter the price tag for the pricing plan. HTML is accepted.', 'themes-assistant'),
                'dynamic' => [
                        'active' => true,
                ],
            ],
        );
        $repeater->add_control(
                'price_year',
            [
                    'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Price Yearly', 'themes-assistant'),
                'default' => esc_html__('230', 'themes-assistant'),
                'description' => esc_html__('Enter the price tag for the pricing plan. HTML is accepted.', 'themes-assistant'),
                'dynamic' => [
                        'active' => true,
                ],
                'condition' => [
                        'month_or_year_control' => 'yes',
                ]
            ],
        );
        $repeater->add_control(
                'disscount_caption_year',
            [
                    'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Yearly Disscount Caption', 'themes-assistant'),
                'default' => esc_html__('Save if choice yearly plan', 'themes-assistant'),
                'description' => esc_html__('Write the content about your disscount content', 'themes-assistant'),
                'dynamic' => [
                        'active' => true,
                ],
            ],
        );
        $repeater->add_control(
                'disscount_caption_month',
            [
                    'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Month Disscount Caption', 'themes-assistant'),
                'default' => esc_html__('No Disscount if choice monthly plan', 'themes-assistant'),
                'description' => esc_html__('Write the content about your disscount content', 'themes-assistant'),
                'dynamic' => [
                        'active' => true,
                ],
            ],
        );
        
        $repeater->add_control(
                'pakage_type',
            [
                    'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Pakage', 'themes-assistant'),
                'default' => esc_html__('Month', 'themes-assistant'),
                'description' => esc_html__('Enter the price pakage type Monthly or Yearly'),
                'dynamic' => [
                        'active' => true,
                ],
            ],
        );
        $repeater->add_control(
                'button_text',
            [
                    'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Text for Pricing Link/Button', 'themes-assistant'),
                'default' => esc_html__('Contact Us', 'themes-assistant'),
                'dynamic' => [
                        'active' => true,
                ],
            ],
        );
        $repeater->add_control(
                'button_url',
            [
                    'label' => esc_html__('URL for the Pricing link/button', 'themes-assistant'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                        'url' => '',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_attr__('http://your-link.com', 'themes-assistant'),
                'dynamic' => [
                        'active' => true,
                ],
            ],
        );
        $repeater->add_control(
                'highlight',
            [
                    'label' => esc_html__('Highlight Pricing Plan', 'themes-assistant'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('No', 'themes-assistant'),
                'label_on' => esc_html__('Yes', 'themes-assistant'),
                'return_value' => 'yes',
                'default' => 'no',
            ],
        );
        $repeater->add_control(
                'pricing_content',
            [
                    'type' => Controls_Manager::WYSIWYG,
                'label' => esc_html__('Pricing Plan Details', 'themes-assistant'),
                'description' => esc_html__('Enter the content for the pricing plan that include information about individual features of the pricing plan. For prebuilt styling, enter shortcodes content.', 'themes-assistant'),
                'default' => esc_html__('Content', 'themes-assistant'),
                'show_label' => true,
                'rows' => 10,
                'dynamic' => [
                        'active' => true,
                ],
            ],            
        );
        $this->add_control(
                'pricing_plans',
            [
                    'label' => esc_html__( 'Price Table', 'themes-assistant' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ pricing_title }}}',
            ]
        );
        $this->add_control(
                'animation',
            [
                    'label' => esc_html__( 'Animation', 'themes-assistant' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                        'none' => esc_html__( 'None', 'themes-assistant' ),
                    'CardAnimation' => esc_html__( 'Card Animation', 'themes-assistant' ),
                    'bottom-to-top' => esc_html__( 'Bottom To Top Hover Animation', 'themes-assistant' ),
                ],
                'frontend_available' => true,
            ]
        );
        $this->end_controls_section();
        /* 
		Style tab
	*/
	$this->start_controls_section(
    		'content_section',
		[
    			'label' => esc_html__( 'Style', 'themes-assistant' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'title_type',
            'label' => __( 'Heading Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .card-title, {{WRAPPER}} .pricing-info, {{WRAPPER}} .table-price, {{WRAPPER}} .price-table-wrapper .table-price, .price-table-wrapper .pricing-table-header',
        ]
    );
    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
        [
                'name' => 'position_type',
            'label' => __( 'Content Typography', 'themes-assistant' ), 
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}}  ul li, {{WRAPPER}} .price-table-wrapper ul li',
        ]
    );
    $this->add_control(
            'table_bg',
        [
                'label' => esc_html__( 'Table BG Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
            'selectors' => [
                    '{{WRAPPER}} .price-table-wrapper, {{WRAPPER}}  .price-card' => 'background: {{VALUE}};',
            ],
        ]
    );
    $this->add_control(
            'table_hover_bg',
        [
                'label' => esc_html__( 'Table Hover BG Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
            'selectors' => [
                    '{{WRAPPER}} .price-table-wrapper:hover {{WRAPPER}} .price-card:hover
                    ' => 'background: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
            'table_btn_text',
        [
                'label' => esc_html__( 'Button Text Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
            'selectors' => [
                    '{{WRAPPER}} .pricings .card .btn, {{WRAPPER}} .price-card .price-card-header .btn,  {{WRAPPER}} .price-table-wrapper .btn
                    ' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    $this->add_control(
            'table_btn_bg',
        [
                'label' => esc_html__( 'Button Background Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
            'selectors' => [
                    '{{WRAPPER}} .pricings .card .btn, {{WRAPPER}} .price-card .price-card-header .btn,  {{WRAPPER}} .price-table-wrapper .btn
                    ' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    $this->add_control(
            'table_btn_hover_bg',
        [
                'label' => esc_html__( 'Button Hover background Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
            'selectors' => [
                    '{{WRAPPER}} .pricings .card .btn:hover, {{WRAPPER}} .price-card .price-card-header .btn:hover,  {{WRAPPER}} .price-table-wrapper .btn:hover
                    ' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    $this->add_control(
            'table_btn_hover_color',
        [
                'label' => esc_html__( 'Button Hover Text Color', 'themes-assistant' ),
            'type' => Controls_Manager::COLOR,
            'default' => esc_html__( '', 'themes-assistant' ),
            'selectors' => [
                    '{{WRAPPER}} .pricings .card .btn:hover, {{WRAPPER}} .price-card .price-card-header .btn:hover,  {{WRAPPER}} .price-table-wrapper .btn:hover
                    ' => 'color: {{VALUE}};',
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
        //   $this->load_widget_script();
        $settings       = $this->get_settings_for_display();
        $style  		= $settings['table_style'];
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
        require BORAX_WIDGET_DIR .'price-table/style-'.$style.'.php';
	}	
  	protected function _content_template() { }
}
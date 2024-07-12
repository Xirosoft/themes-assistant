<?php
/**
 * Class Ata_Instagram_Gallery
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_Instagram_Gallery 
 * @since 1.0.0
 */

 namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;
Use Elementor\Core\Schemes\Color;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    	exit;  
}
/**
 *
 *  elementor instagram gallery section widget.
 *
 * @since 1.0
 */
class Ata_Instagram_Gallery extends Widget_Base {

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
    	return 'ata-instagram';
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
    		return esc_html__( 'Instagram Gallery', 'themes-assistant' );
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
    		return 'eicon-instagram-post  borax-el';
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
            // ----------------------------------------  content ------------------------------
        $this->start_controls_section(
                'instagram_section',
            [
                    'label' => esc_html__( 'Instagram Gallery Settings', 'themes-assistant' ),
            ]
        );
        $this->add_control(
            'instagram_style',
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
    			'inst_id',
			[
                    'label'     => esc_html__( 'Add your Instagram token', 'themes-assistant' ),
                'type'      => Controls_Manager::TEXT,
                'description'   => 'You can guide from <a href="https://wp.me/pbwC5B-qAc" target="_blank" >Here</a> for API Token',
                'label_block' => true,
                'default'   => esc_html__( 'themeiesltd', 'themes-assistant' )
			]
        );
        $this->add_control(
    			'inst_item',
			[
                    'label'         => esc_html__( 'Instagram Gallery Items', 'themes-assistant' ),
                'type'          => Controls_Manager::NUMBER,
                'label_block'   => true,
                'default'       => esc_html__( '4', 'themes-assistant' )
			]
        );
        $this->add_control(
                'instagram_overlay', [
                    'label'     => esc_html__( 'Overlay  Color', 'themes-assistant' ),
                'type'      => Controls_Manager::COLOR,
				'scheme' => [
    					'type' =>  Color::get_type(),
					'value' => Color::COLOR_1,
				],
                'selectors' => [
                        '{{WRAPPER}} .social_connect_overlay' => 'background-color: {{VALUE}};',
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
                  '{{WRAPPER}} a' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
          ]
        );
        $this->end_controls_section(); // End content
	}
	protected function render() {
        // call load widget script
        // $this->load_widget_script();
        $settings   = $this->get_settings();
        $style = $settings['instagram_style'];
        $widget_name  = $this->get_name(); // You can make this dynamic
		$AtaWidget    = new AtaWidgetManage($widget_name, $settings, $style);
        $access_token    = !empty( $settings['inst_id'] ) ? $settings['inst_id'] : '';
        $inst_item  = !empty( $settings['inst_item'] ) ? $settings['inst_item'] : '';
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
        // Replace 'USERNAME' with the username for which you want to retrieve the User ID
        $username = 'themeiesltd';
        $user_id = '30331539587';
        $appId = '204481338165486';
        $appSecret = 'c7adada8365ec23aea2ddace7ee68b31';
        $url = 'https://graph.instagram.com/me/media?fields=id,media_url,thumbnail_url,caption,timestamp,permalink&access_token=' . $access_token;
        $counter = 0; // Counter to track the number of iterations
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Set the following line to ignore SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        
        if ($response === false) {
            $error = curl_error($ch);
            // Handle the cURL error, if any
            echo "cURL Error: " . $error;
        } else {
            $jsonData = json_decode($response, true);
            $instaData = $jsonData['data'];
            echo '<div id="instagram-feed1" class="instagram_gallery">';
            foreach ($instaData as $instaConetnt) {
                if ($counter < $inst_item) {
                    ?>
                    <div class="<?php if ('yes' === $settings['image_shadow']) {
                        echo 'ImgShadow';
                    } ?>">
                        <div class="<?php echo $settings['image_shape']; ?>">
                            <a class="insta-link" href="<?php echo $instaConetnt['permalink']; ?>" rel="noopener" target="_blank">
                                <img src="<?php echo esc_url($instaConetnt['media_url']); ?>" loading="lazy"
                                     alt="<?php echo esc_attr($instaConetnt['caption']); ?>" class="insta-image" width="300" height="300">
                            </a>
                        </div>
                    </div>
                    <?php
                    $counter++; // Increment the counter after each iteration
                } else {
                    break; // Exit the loop once the limit is reached
                }
            }
            echo '</div>';
            // Your code to handle the API response goes here
            // This section remains the same as before
        }
        
        curl_close($ch);
      
        
                

    }

public function borax_pack_instagram_ajax_load(){

}
public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        (function($) {
            function design(params) {
                var IntervalA = setInterval(() => {
                    startANimation();
                }, 500);
                function startANimation() {
                    var instaContainer = $('#instaContainer');
                    var ShadowAttr = $(instaContainer).data('shadow');
                    var ShapeAttr = $(instaContainer).data('shape');
                    if (ShadowAttr) {
                        $('.instagram_gallery a').addClass('design-none');
                        $('.instagram_gallery a').wrap('<div class="ImgShadow"> </div>');
                    }
                    if (ShapeAttr) {
                        $('.instagram_gallery a').wrap('<div class="' + ShapeAttr + '"> </div>');
                        $('.instagram_gallery a').addClass(ShapeAttr);
                    }
                    if ($('.instagram_gallery a img').length > 0) {
                        clearInterval(IntervalA);
                    }
                }
            }
            function cp_instagram_photos() {
                $('.cp-instagram-photos').each(function() {
                    new InstagramFeed({
                        'username': $(this).data('username'),
                        'container': this,
                        'display_profile': false,
                        'display_biography': false,
                        'display_gallery': true,
                        'display_captions': false,
                        'callback': design(),
                        'styling': true,
                        'items': $(this).data('items'),
                        'items_per_row': $(this).data('items'),
                        'margin': 0
                    });
                });
            }
            // cp_instagram_photos();
        })(jQuery);
        </script>
<?php 
    }
}

	
}
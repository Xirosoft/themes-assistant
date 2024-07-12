<?php
/**
 * Class Ata_contact_info
 *
 * Main Plugin class for Elementor Widgets
 *
 * @package ATA\Widgets\Ata_contact_info 
 * @since 1.0.0
 */

namespace ATA\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use ATA\Utils\AtaWidgetManage;
use ATA\Admin\Views\AtaElementorEnquee;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ata_contact_info extends Widget_Base
  {

  /**
   * Retrieve the widget name.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name()
    {
    return 'ata-contact-info';
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
  public function get_title()
    {
    return esc_html__('Contact Info Page', 'themes-assistant');
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
  public function get_icon()
    {
    return 'eicon-info-circle-o  borax-el';
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

  public function get_categories()
    {
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
  protected function _register_controls()
    {
    $this->start_controls_section(
      'contact_page_info',
      [
        'label' => esc_html__('Contact Page Info', 'themes-assistant'),
      ]
    );
    $this->add_control(
      'address_icon_type',
      [
        'label' => esc_html__('Icon Type', 'themes-assistant'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
          'none' => [
            'title' => esc_html__('None', 'themes-assistant'),
            'icon' => 'eicon-editor-close',
          ],
          'address_icon' => [
            'title' => esc_html__('Icon', 'themes-assistant'),
            'icon' => 'eicon-social-icons',
          ],
          'address_iconclass' => [
            'title' => esc_html__('Icon Class', 'themes-assistant'),
            'icon' => 'eicon-text-field',
          ],
          'address_image' => [
            'title' => esc_html__('Image', 'themes-assistant'),
            'icon' => 'eicon-image',
          ],
        ],
        'default' => 'icon',
        'toggle' => true,
      ]
    );

    $this->add_control(
      'address_image',
      [
        'label' => esc_html__('Address Icon Image', 'themes-assistant'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => Utils::get_placeholder_image_src(),
        ],
        'condition' => [
          'address_icon_type' => 'address_image',
        ],
      ]
    );

    $this->add_control(
      'address_icon',
      [
        'label' => esc_html__('Address Icon', 'themes-assistant'),
        'type' => Controls_Manager::ICONS,
        'condition' => [
          'address_icon_type' => 'address_icon',
        ],
      ]
    );

    $this->add_control(
      'address_iconclass',
      [
        'label' => esc_html__('Address Icon Class', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('borax-spa-bathrobe', 'themes-assistant'),
        'description' => 'You can get icon class from <a href="https://wpborax.com/demo/borax-v1.0/">Borax Icon</a> or <a href="https://themify.me/themify-icons">Themify Icon</a>',
        'condition' => [
          'address_icon_type' => 'address_iconclass',
        ],
      ]
    );

    $this->add_control(
      'a_title',
      [
        'label' => esc_html__('Address Title', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_attr__('Office Address', 'themes-assistant'),
      ]
    );
    $this->add_control(
      'a_text',
      [
        'label' => esc_html__('Address', 'themes-assistant'),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_attr__('848 E 28th ST, BROOKLYN NEW YORK, USA', 'themes-assistant'),
      ]
    );
    $this->add_control(
      'Phone_icon_type',
      [
        'label' => esc_html__('Icon Type', 'themes-assistant'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
          'none' => [
            'title' => esc_html__('None', 'themes-assistant'),
            'icon' => 'eicon-editor-close',
          ],
          'Phone_icon' => [
            'title' => esc_html__('Icon', 'themes-assistant'),
            'icon' => 'eicon-social-icons',
          ],
          'Phone_iconclass' => [
            'title' => esc_html__('Icon Class', 'themes-assistant'),
            'icon' => 'eicon-text-field',
          ],
          'Phone_image' => [
            'title' => esc_html__('Image', 'themes-assistant'),
            'icon' => 'eicon-image',
          ],
        ],
        'default' => 'icon',
        'toggle' => true,
      ]
    );

    $this->add_control(
      'Phone_image',
      [
        'label' => esc_html__('Phone Icon Image', 'themes-assistant'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => Utils::get_placeholder_image_src(),
        ],
        'condition' => [
          'Phone_icon_type' => 'Phone_image',
        ],
      ]
    );

    $this->add_control(
      'Phone_icon',
      [
        'label' => esc_html__('Phone Icon', 'themes-assistant'),
        'type' => Controls_Manager::ICONS,
        'condition' => [
          'Phone_icon_type' => 'Phone_icon',
        ],
      ]
    );

    $this->add_control(
      'Phone_iconclass',
      [
        'label' => esc_html__('Phone Icon Class', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('borax-spa-bathrobe', 'themes-assistant'),
        'description' => 'You can get icon class from <a href="https://wpborax.com/demo/borax-v1.0/">Borax Icon</a> or <a href="https://themify.me/themify-icons">Themify Icon</a>',
        'condition' => [
          'Phone_icon_type' => 'Phone_iconclass',
        ],
      ]
    );

    $this->add_control(
      'p_title',
      [
        'label' => esc_html__('Phone Title', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_attr__('Phone', 'themes-assistant'),
      ]
    );
    $this->add_control(
      'p_text1',
      [
        'label' => esc_html__('Phone 1', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_attr__('+01- 190 -2258 - 2658', 'themes-assistant'),
      ]
    );
    $this->add_control(
      'p_text2',
      [
        'label' => esc_html__('Phone 2', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_attr__('+01- 190 -2258 - 2658', 'themes-assistant'),
      ]
    );
    $this->add_control(
      'Email_icon_type',
      [
        'label' => esc_html__('Icon Type', 'themes-assistant'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
          'none' => [
            'title' => esc_html__('None', 'themes-assistant'),
            'icon' => 'eicon-editor-close',
          ],
          'Email_icon' => [
            'title' => esc_html__('Icon', 'themes-assistant'),
            'icon' => 'eicon-social-icons',
          ],
          'Email_iconclass' => [
            'title' => esc_html__('Icon Class', 'themes-assistant'),
            'icon' => 'eicon-text-field',
          ],
          'Email_image' => [
            'title' => esc_html__('Image', 'themes-assistant'),
            'icon' => 'eicon-image',
          ],
        ],
        'default' => 'icon',
        'toggle' => true,
      ]
    );

    $this->add_control(
      'Email_image',
      [
        'label' => esc_html__('Email Icon Image', 'themes-assistant'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => Utils::get_placeholder_image_src(),
        ],
        'condition' => [
          'Email_icon_type' => 'Email_image',
        ],
      ]
    );

    $this->add_control(
      'Email_icon',
      [
        'label' => esc_html__('Email Icon', 'themes-assistant'),
        'type' => Controls_Manager::ICONS,
        'condition' => [
          'Email_icon_type' => 'Email_icon',
        ],
      ]
    );

    $this->add_control(
      'Email_iconclass',
      [
        'label' => esc_html__('Email Icon Class', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('borax-spa-bathrobe', 'themes-assistant'),
        'description' => 'You can get icon class from <a href="https://wpborax.com/demo/borax-v1.0/">Borax Icon</a> or <a href="https://themify.me/themify-icons">Themify Icon</a>',
        'condition' => [
          'Email_icon_type' => 'Email_iconclass',
        ],
      ]
    );
    $this->add_control(
      'e_title',
      [
        'label' => esc_html__('Email Title', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_attr__('Email', 'themes-assistant'),
      ]
    );
    $this->add_control(
      'e_text1',
      [
        'label' => esc_html__('Email 1', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_attr__('contact@themeies.com', 'themes-assistant'),
      ]
    );
    $this->add_control(
      'e_text2',
      [
        'label' => esc_html__('Email 2', 'themes-assistant'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_attr__('contact@themeies.com', 'themes-assistant'),
      ]
    );
    $this->end_controls_section();

    $this->start_controls_section(
      'section_style_content',
      [
        'label' => esc_html__('Content', 'themes-assistant'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_control(
      'icon_color',
      [
        'label' => esc_html__('icon Color', 'themes-assistant'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .contact address span' => 'color: {{VALUE}}',
        ],
      ]
    );
    $this->add_control(
      'position_color',
      [
        'label' => esc_html__('Icon background Color', 'themes-assistant'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .contact address span' => 'background-color: {{VALUE}}',
        ],
      ]
    );


    $this->add_control(
      'iconboxradius',
      [
        'label' => esc_html__('Icon Radius', 'themes-assistant'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['%'],
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
          '{{WRAPPER}} .contact address span' => 'border-radius: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'heading_typography',
        'label' => __('Title Typography', 'themes-assistant'),
        'scheme' => Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .contact address h5',
      ]
    );
    $this->add_control(
      'heading_color',
      [
        'label' => esc_html__('Title Color', 'themes-assistant'),
        'type' => Controls_Manager::COLOR,
        'default' => esc_html__('', 'themes-assistant'),
        'selectors' => [
          '{{WRAPPER}} .contact address h5' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'content_typography',
        'label' => __('Content Typography', 'themes-assistant'),
        'scheme' => Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .contact address p,   .contact address a',
      ]
    );
    $this->add_control(
      'content_color',
      [
        'label' => esc_html__('Content Color', 'themes-assistant'),
        'type' => Controls_Manager::COLOR,
        'default' => esc_html__('', 'themes-assistant'),
        'selectors' => [
          '{{WRAPPER}}  .contact address p,   .contact address a' => 'color: {{VALUE}};',
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
  protected function render()
    {
    $settings = $this->get_settings_for_display();
    ?>
    <div class="contact">

		<!-- Address -->
      <address>
        <?php if ($settings['address_icon_type'] == 'address_icon'): ?>
          <span class="icon">
            <?php Icons_Manager::render_icon($settings['address_icon'], ['aria-hidden' => 'true']); ?>
          </span>
        <?php elseif ($settings['address_icon_type'] == 'address_iconclass'): ?>
          <span class="icon">
            <i class="<?php echo esc_html__($settings['address_iconclass'], 'themes-assistant'); ?>"></i>
          </span>
        <?php elseif ($settings['address_icon_type'] == 'address_image'): ?>
          <span class="icon">
            <img src="<?php echo esc_url($settings['address_image']['url']); ?>"
              alt="<?php echo esc_attr__($settings['a_title'], 'themes-assistant') ?>" class="img-icon" width="30" height="30">
          </span>
        <?php endif; ?>
        <h5>
          <?php echo esc_html__($settings['a_title'], 'themes-assistant') ?>
        </h5>
        <p>
          <?php echo esc_html__($settings['a_text'], 'themes-assistant') ?>
        </p>
      </address>

	  <!-- E-mail  -->
      <address>
	  	<?php if ($settings['Phone_icon_type'] == 'Phone_icon'): ?>
          <span class="icon">
            <?php Icons_Manager::render_icon($settings['Phone_icon'], ['aria-hidden' => 'true']); ?>
          </span>
        <?php elseif ($settings['Phone_icon_type'] == 'Phone_iconclass'): ?>
          <span class="icon">
            <i class="<?php echo esc_html__($settings['Phone_iconclass'], 'themes-assistant'); ?>"></i>
          </span>
        <?php elseif ($settings['Phone_icon_type'] == 'Phone_image'): ?>
          <span class="icon">
            <img src="<?php echo esc_url($settings['Phone_image']['url']); ?>"
              alt="<?php echo esc_attr__($settings['a_title'], 'themes-assistant') ?>" class="img-icon" width="30" height="30">
          </span>
        <?php endif; ?>
	
        <h5>
          <?php echo $settings['p_title'] ?>
        </h5>
        <a href="mailto:<?php echo esc_url($settings['p_text1']); ?>">
          <?php echo esc_html__($settings['p_text1'], 'themes-assistant'); ?>
        </a>
        <a href="mailto:<?php echo esc_url($settings['p_text2']); ?>">
          <?php echo esc_html__($settings['p_text2'], 'themes-assistant'); ?>
        </a>
      </address>

	<!-- Phone number -->
      <address>
		
        <?php if ($settings['Email_icon_type'] == 'Email_icon'): ?>
          <span class="icon">
            <?php Icons_Manager::render_icon($settings['Email_icon'], ['aria-hidden' => 'true']); ?>
          </span>
        <?php elseif ($settings['Email_icon_type'] == 'Email_iconclass'): ?>
          <span class="icon">
            <i class="<?php echo esc_html__($settings['Email_iconclass'], 'themes-assistant'); ?>"></i>
          </span>
        <?php elseif ($settings['Email_icon_type'] == 'Email_image'): ?>
          <span class="icon">
            <img src="<?php echo esc_url($settings['Email_image']['url']); ?>"
              alt="<?php echo esc_attr__($settings['a_title'], 'themes-assistant') ?>" class="img-icon" width="30" height="30">
          </span>
        <?php endif; ?>
        
        <h5>
          <?php echo $settings['e_title'] ?>
        </h5>
        <a href="<?php echo esc_attr($settings['e_text1']); ?>">
          <?php echo esc_html__($settings['e_text1'], 'themes-assistant'); ?>
        </a>
        <a href="<?php echo esc_url($settings['e_text2']) ?>">
          <?php echo esc_html__($settings['e_text2'], 'themes-assistant') ?>
        </a>
      </address>


    </div>
    <?php
    }
  }
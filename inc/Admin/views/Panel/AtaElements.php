<?php 

namespace ATA\Admin\Views\Panel;
use ATA\AtaQuery;

class AtaElements{
    private $query; 
    private $wpdb;
    private $table_name;
    private $data_format;
    private $where;
    private $existing_data;

    public function __construct() {

        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix . 'ata_settings'; // Replace 't_assistant_settings' with your custom table name
        $this->query = new AtaQuery();
        $query = "SELECT * FROM %1s"; // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
        $this->existing_data =  $this->wpdb->get_row($wpdb->prepare($query, $this->table_name));
        $this->where = array('id' => $this->existing_data->id);
        $this->data_format = array(
            '%s', // 'post_id' is a string
            '%s', // 'form_title' is a string
            '%s', // 'form_json' is a string
            '%s', // 'form_html' is an integer
        );

        add_action('wp_ajax_elements_settings', [$this, 'elements_settings']);
        add_action('wp_ajax_nopriv_elements_settings', [$this, 'elements_settings']); // For non-logged-in users
        
    }

    function elements_settings(){
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['nonce'] ) ) , 'ata-nonce' ) ){
            wp_send_json_error(array(
                'status' => '400',
                'message' => 'Nonce verification failed'
            ));
        }

        if (isset($_POST['ataElementsData'])) {
            // Retrieve and decode the data from $_POST
            $raw_data = wp_unslash(sanitize_textarea_field($_POST['ataElementsData']));

            // Sanitize and validate the data as needed
            $sanitized_data = sanitize_text_field($raw_data);

            // Encode the sanitized data as JSON
            $encoded_data = wp_json_encode($sanitized_data);

            // Now $encoded_data contains the sanitized and encoded data
        } else {
            // Handle the case where 'ataElementsData' is not set in $_POST
            $encoded_data = wp_json_encode(array('error' => 'ataElementsData not set.'));
        }

        parse_str(str_replace(array("'", "\""), '', $encoded_data), $formFields);
        
        // Define data to insert or update
        $data_to_insert = array(
            'elements_settings' => wp_json_encode($formFields),
            'addon_setting' => 'coming soon',
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql'),
        );
        $defaults = array(
            'elements_settings' => '',
            'addon_setting' => '',
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql'),
        );


        // Check if data exists in the database
        if (empty($this->existing_data)) {
            // Data does not exist, insert it
            $data_to_insert = array(
                'elements_settings' => wp_json_encode($formFields),
                'addon_setting' => 'coming soon',
                'created_at' => current_time('mysql'),
                'updated_at' => current_time('mysql'),
            );
        
            // Insert the data
            $this->query->ata_insert_data($this->table_name, $data_to_insert, $defaults);

        } else {
            // Data exists, update it
            $updated_data = array(
                'elements_settings' => wp_json_encode($formFields),
                'updated_at' => current_time('mysql'),
            );
            // Define the WHERE clause to identify the existing record (you might need to adjust this based on your table structure)
            $where = array('id' => $this->existing_data->id);
            // Update the data
            $result = $this->query->ata_update_data( $this->table_name, $updated_data, $where);
            wp_send_json(array('success' => 'Settings have been updated!'));
        }
        
    }


    public function ata_elements_page(){
        // Default SettingsArray. 
        $pre_defined_elements = array(
            'ata_about_box' => false,
            'ata_advance_button' => false,
            'ata_background_animation' => false,
            'ata_blog_post' => false,
            'ata_bmi_calculator' => false,
            'ata_coming_soon' => false,
            'ata_contact_form_7' => false,
            'ata_contact_info' => false,
            'ata_cta_section' => false,
            'ata_default_button' => false,
            'ata_faq' => false,
            'ata_counter' => false,
            'ata_google_reviews' => false,
            'ata_hero_banner' => false,
            'ata_hero_slider' => false,
            'ata_icon_box' => false,
            'ata_image_box' => false,
            'ata_image_comparison' => false,
            'ata_instagram' => false,
            'ata_list_items' => false,
            'ata_logo_slider' => false,
            'ata_lottie_animation' => false,
            'ata_office_hour' => false,
            'ata_portfolio' => false,
            'ata_price_table' => false,
            'ata_section_header' => false,
            'ata_service_price' => false,
            'ata_team' => false,
            'ata_testimonial_slider' => false,
            'ata_time_table' => false,
            'ata_trust_pilot' => false,
            'ata_video_banner' => false,
            'ata_work_flow' => false,
        );
        

        // user's modified settingsArray
        $user_defined_elements = $this->ata_elements_settings_config();


        // Update the SettingsArray
        $SettingsArray = $this->ata_update_elements($pre_defined_elements, $user_defined_elements);

        $ata_elements_array = array(
            array(
                'name' => 'ata_about_box',
                'label' => 'About Box',
                'desc' => 'Description for the "About Box" feature.',
                'value' => $SettingsArray['ata_about_box'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/about_box',
                'doc_link' => 'https://example.com/docs/about_box',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_advance_button',
                'label' => 'Advance Button',
                'desc' => 'Description for the "Advance Button" feature.',
                'value' => $SettingsArray['ata_advance_button'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/advance_button',
                'doc_link' => 'https://example.com/docs/advance_button',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_background_animation',
                'label' => 'Background Animation',
                'desc' => 'Description for the "Background Animation" feature.',
                'value' => $SettingsArray['ata_background_animation'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/background_animation',
                'doc_link' => 'https://example.com/docs/background_animation',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_blog_post',
                'label' => 'Blog Post',
                'desc' => 'Description for the "Blog Post" feature.',
                'value' => $SettingsArray['ata_blog_post'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/blog_post',
                'doc_link' => 'https://example.com/docs/blog_post',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_bmi_calculator',
                'label' => 'BMI Calculator',
                'desc' => 'Description for the "BMI Calculator" feature.',
                'value' => $SettingsArray['ata_bmi_calculator'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/bmi_calculator',
                'doc_link' => 'https://example.com/docs/bmi_calculator',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_coming_soon',
                'label' => 'Coming Soon',
                'desc' => 'Description for the "Coming Soon" feature.',
                'value' => $SettingsArray['ata_coming_soon'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/coming_soon',
                'doc_link' => 'https://example.com/docs/coming_soon',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_contact_form_7',
                'label' => 'Contact Form 7',
                'desc' => 'Description for the "Contact Form 7" feature.',
                'value' => $SettingsArray['ata_contact_form_7'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/contact_form_7',
                'doc_link' => 'https://example.com/docs/contact_form_7',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_contact_info',
                'label' => 'Contact Info',
                'desc' => 'Description for the "Contact Info" feature.',
                'value' => $SettingsArray['ata_contact_info'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/contact_info',
                'doc_link' => 'https://example.com/docs/contact_info',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_cta_section',
                'label' => 'CTA Section',
                'desc' => 'Description for the "CTA Section" feature.',
                'value' => $SettingsArray['ata_cta_section'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/cta_section',
                'doc_link' => 'https://example.com/docs/cta_section',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_default_button',
                'label' => 'Default Button',
                'desc' => 'Description for the "Default Button" feature.',
                'value' => $SettingsArray['ata_default_button'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/default_button',
                'doc_link' => 'https://example.com/docs/default_button',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_faq',
                'label' => 'FAQ',
                'desc' => 'Description for the "FAQ" feature.',
                'value' => $SettingsArray['ata_faq'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/faq',
                'doc_link' => 'https://example.com/docs/faq',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_counter',
                'label' => 'Counter',
                'desc' => 'Description for the "Counter" feature.',
                'value' => $SettingsArray['ata_counter'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/counter',
                'doc_link' => 'https://example.com/docs/counter',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_google_reviews',
                'label' => 'Google Reviews',
                'desc' => 'Description for the "Google Reviews" feature.',
                'value' => $SettingsArray['ata_google_reviews'] ? true : false,
                'disabled' => true,
                'demo_link' => 'https://example.com/demo/google_reviews',
                'doc_link' => 'https://example.com/docs/google_reviews',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_hero_banner',
                'label' => 'Hero Banner',
                'desc' => 'Description for the "Hero Banner" feature.',
                'value' => $SettingsArray['ata_hero_banner'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/hero_slider',
                'doc_link' => 'https://example.com/docs/hero_slider',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_hero_slider',
                'label' => 'Hero Slider',
                'desc' => 'Description for the "Hero Slider" feature.',
                'value' => $SettingsArray['ata_hero_slider'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/hero_slider',
                'doc_link' => 'https://example.com/docs/hero_slider',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_icon_box',
                'label' => 'Icon Box',
                'desc' => 'Description for the "Icon Box" feature.',
                'value' => $SettingsArray['ata_icon_box'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/icon_box',
                'doc_link' => 'https://example.com/docs/icon_box',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_image_box',
                'label' => 'Image Box',
                'desc' => 'Description for the "Image Box" feature.',
                'value' => $SettingsArray['ata_image_box'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/image_box',
                'doc_link' => 'https://example.com/docs/image_box',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_image_comparison',
                'label' => 'Image Comparison',
                'desc' => 'Description for the "Image Comparison" feature.',
                'value' => $SettingsArray['ata_image_comparison'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/image_comparison',
                'doc_link' => 'https://example.com/docs/image_comparison',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_instagram',
                'label' => 'Instagram',
                'desc' => 'Description for the "Instagram" feature.',
                'value' => $SettingsArray['ata_instagram'] ? true : false,
                'disabled' => true,
                'demo_link' => 'https://example.com/demo/instagram',
                'doc_link' => 'https://example.com/docs/instagram',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_list_items',
                'label' => 'List Items',
                'desc' => 'Description for the "List Items" feature.',
                'value' => $SettingsArray['ata_list_items'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/list_items',
                'doc_link' => 'https://example.com/docs/list_items',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_logo_slider',
                'label' => 'Logo Slider',
                'desc' => 'Description for the "Logo Slider" feature.',
                'value' => $SettingsArray['ata_logo_slider'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/logo_slider',
                'doc_link' => 'https://example.com/docs/logo_slider',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_lottie_animation',
                'label' => 'Lottie Animation',
                'desc' => 'Description for the "Lottie Animation" feature.',
                'value' => $SettingsArray['ata_lottie_animation'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/lottie_animation',
                'doc_link' => 'https://example.com/docs/lottie_animation',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_office_hour',
                'label' => 'Office Hour',
                'desc' => 'Description for the "Office Hour" feature.',
                'value' => $SettingsArray['ata_office_hour'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/office_hour',
                'doc_link' => 'https://example.com/docs/office_hour',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_portfolio',
                'label' => 'Portfolio',
                'desc' => 'Description for the "Portfolio" feature.',
                'value' => $SettingsArray['ata_portfolio'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/portfolio',
                'doc_link' => 'https://example.com/docs/portfolio',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_price_table',
                'label' => 'Price Table',
                'desc' => 'Description for the "Price Table" feature.',
                'value' => $SettingsArray['ata_price_table'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/price_table',
                'doc_link' => 'https://example.com/docs/price_table',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_section_header',
                'label' => 'Section Header',
                'desc' => 'Description for the "Section Header" feature.',
                'value' => $SettingsArray['ata_section_header'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/section_header',
                'doc_link' => 'https://example.com/docs/section_header',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_service_price',
                'label' => 'Service Price',
                'desc' => 'Description for the "Service Price" feature.',
                'value' => $SettingsArray['ata_service_price'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/service_price',
                'doc_link' => 'https://example.com/docs/service_price',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_team',
                'label' => 'Team',
                'desc' => 'Description for the "Team" feature.',
                'value' => $SettingsArray['ata_team'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/team',
                'doc_link' => 'https://example.com/docs/team',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_testimonial_slider',
                'label' => 'Testimonial Slider',
                'desc' => 'Description for the "Testimonial" feature.',
                'value' => $SettingsArray['ata_testimonial_slider'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/team',
                'doc_link' => 'https://example.com/docs/team',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_time_table',
                'label' => 'Time Table',
                'desc' => 'Description for the "Time Table" feature.',
                'value' => $SettingsArray['ata_time_table'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/time_table',
                'doc_link' => 'https://example.com/docs/time_table',
                'badge' => 'new',
                'element_type' => 'free'
            ),
            array(
                'name' => 'ata_trust_pilot',
                'label' => 'Trust Pilot',
                'desc' => 'Description for the "Trust Pilot" feature.',
                'value' => $SettingsArray['ata_trust_pilot'] ? true : false,
                'disabled' => true,
                'demo_link' => 'https://example.com/demo/trust_pilot',
                'doc_link' => 'https://example.com/docs/trust_pilot',
                'badge' => 'hot',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_video_banner',
                'label' => 'Video Banner',
                'desc' => 'Description for the "Video Banner" feature.',
                'value' => $SettingsArray['ata_video_banner'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/video_banner',
                'doc_link' => 'https://example.com/docs/video_banner',
                'badge' => 'popular',
                'element_type' => 'pro'
            ),
            array(
                'name' => 'ata_work_flow',
                'label' => 'Work Flow',
                'desc' => 'Description for the "Work Flow" feature.',
                'value' => $SettingsArray['ata_work_flow'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/work_flow',
                'doc_link' => 'https://example.com/docs/work_flow',
                'badge' => 'new',
                'element_type' => 'free'
            ),
        );
        
        
        
        
        ?>
        <div class="wrap ata-wrap">
            <h1><?php echo esc_html__( 'Elements', 'themes-assistant' ); ?></h1>
            <form id="ata_elements_form">
                <div class="form-header">
                    <div class="container">
                        <div class="form-header-inner">
                            <div class="title">
                                <h2><?php echo esc_html__( 'Global Controls', 'themes-assistant' ); ?></h2>
                                <p><?php echo esc_html__( 'Toggle various features of your theme/plugin below:', 'themes-assistant' ); ?></p>
                            </div>
                            <div class="switch-all">
                                <span id="disable-all"><?php echo esc_html__( 'Disable All', 'themes-assistant' ); ?></span>
                                <div class="switch">
                                    <input type="checkbox" id="switch-all-input">
                                    <label for="switch-all-input" class="slider round"></label>
                                </div>
                                <span id="enable-all"><?php echo esc_html__( 'Enable All', 'themes-assistant' ); ?></span>
                            </div>
                            <div class="header-action">
                                <button type="submit" id="ata_save_element" class="button-primary"><?php echo esc_html__( 'Save Settings', 'themes-assistant' ); ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="form-body">
                        <div class="form-section">
                            <!-- <div class="form-section__header">
                                <h3><?php // echo esc_html__( 'Elements', 'themes-assistant' ); ?>Theme Features</h3>
                                <p><?php // echo esc_html__( 'Elements', 'themes-assistant' ); ?></p>
                            </div> -->
                            <?php foreach($ata_elements_array as $field): ?>
                            <div class="form-container">
                                <div class="flag"></div>
                                <label for="option1">
                                    <?php 
                                        printf(
                                            esc_html__( '%s', 'themes-assistant' ),
                                            esc_html($field['label'])
                                        );
                                    ?>
                                </label>
                                <a class="switch-btn" href="<?php echo esc_attr($field['doc_link']) ?>" data-fancybox data-type="iframe">
                                    <span class="material-symbols-outlined">
                                        description
                                    </span>
                                </a>
                                <a class="switch-btn" href="<?php echo esc_attr($field['demo_link']) ?>" data-fancybox data-type="iframe">
                                    <span class="material-symbols-outlined">desktop_mac</span>
                                </a>
                                    <div class="switch">
                                        <input type="checkbox" class="option-switch" name="<?php echo esc_attr($field['name']) ?>" id="<?php echo esc_attr($field['name']) ?>" <?php echo $field['value'] ? esc_attr('checked') : ''; ?> <?php echo $field['disabled'] ? esc_attr('disabled') : ''; ?>>
                                        <label for="<?php echo esc_attr($field['name']) ?>" class="slider round"></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>                           
                        </div>
                    </div>
                </div>        
            </form>
        </div>
        <?php
    }


    /**
    * Get Setting Config darta function
    *
    * @return array
    */
    public function ata_elements_settings_config(){
        if($this->where['id'] != null){ }
        $rows = $this->query->ata_view_data($this->table_name, array('id' => $this->where['id']));
        $data = $rows[0]->elements_settings;
        $SettingsArray = json_decode($data, true);
        if(gettype($SettingsArray) == 'string') {
            $SettingsArray = json_decode($SettingsArray, true);
        }
        return $SettingsArray;           
    }


    /**
        * Function to update settings based on object elements
        *
        * @param [type] $pre
        * @param [type] $new
        * @return void
        */
        function ata_update_elements($pre, $new) {
            if(count($new) > 0) {
                foreach ($pre as $key => $value) {
                    if (array_key_exists($key, $new) && $new[$key] === "on") {
                        $pre[$key] = true;
                    }
                }
            }
            return $pre;
        }
}
<?php 

namespace AT_Assistant\Admin\Views\Panel;
use AT_Assistant\AtaQuery;

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
        $this->table_name = $wpdb->prefix . 'at_assistant_settings'; // Replace 't_assistant_settings' with your custom table name
        $this->query = new AtaQuery();
        $query = "SELECT * FROM %1s";
        // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
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

        // wp_send_json('Hello');
        
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

        
        // wp_send_json(array('success' => $this->existing_data));
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
            // wp_send_json(array('success' => $result));
            wp_send_json(array('success' => 'Settings have been updated!'));
        }
        
    }


    public function ata_elements_page(){
        // Default SettingsArray.
        $pre_defined_elements = array(
            'creative_button' => false,
            'responsive_grid' => false,
            'dynamic_grid' => false,
            'modal_windows' => false,
            'image_carousel' => false,
            'contact_form' => false,
            'lightbox_gallery' => false,
            'sticky_navigation' => false,
            'back_to_top_button' => false,
            'sidebar_widgets' => false,
            'social_media_icons' => false,
            'parallax_scrolling' => false,
            'breadcrumb_navigation' => false,
            'google_maps_integration' => false,
            'font_awesome_icons' => false,
            'blog_post_layouts' => false,
            'pricing_tables' => false,
            'testimonials' => false,
            'faq_section' => false,
            'newsletter_signup' => false,
            'video_background' => false,
            'animation_effects' => false,
            'countdown_timer' => false,
            'progress_bars' => false,
            'team_members_section' => false,
            'service_boxes' => false,
            'portfolio_showcase' => false,
            'client_logos' => false,
            'call_to_action' => false
        );
        

        // user's modified settingsArray
        $user_defined_elements = $this->ata_elements_settings_config();
        var_dump($user_defined_elements);

        // // Update the SettingsArray
        $SettingsArray = $this->at_assistant_update_elements($pre_defined_elements, $user_defined_elements);
        var_dump($SettingsArray);
        
        // var_dump($user_defined_elements);
        $ata_elements_array = array(
            array(
                'name' => 'creative_button',
                'label' => 'Creative Button 🎨',
                'desc' => 'The "Creative Button" in Form Builder lets users add stylish buttons to their forms.',
                'value' => $SettingsArray['creative_button'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/creative_button',
                'doc_link' => 'https://example.com/docs/creative_button'
            ),
            array(
                'name' => 'responsive_grid',
                'label' => 'Responsive Grid 🖥️',
                'desc' => 'The "Responsive Grid" allows for creating grid layouts that adjust to different screen sizes.',
                'value' => $SettingsArray['responsive_grid'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/responsive_grid',
                'doc_link' => 'https://example.com/docs/responsive_grid'
            ),
            array(
                'name' => 'dynamic_grid',
                'label' => 'Dynamic Grid 🔄',
                'desc' => 'The "Dynamic Grid" enables dynamic arrangement of elements based on user interaction.',
                'value' => $SettingsArray['dynamic_grid'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/dynamic_grid',
                'doc_link' => 'https://example.com/docs/dynamic_grid'
            ),
            array(
                'name' => 'modal_windows',
                'label' => 'Modal Windows 🗔',
                'desc' => 'The "Modal Windows" feature allows for displaying content in modal dialogs.',
                'value' => $SettingsArray['modal_windows'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/modal_windows',
                'doc_link' => 'https://example.com/docs/modal_windows'
            ),
            array(
                'name' => 'image_carousel',
                'label' => 'Image Carousel 🎠',
                'desc' => 'The "Image Carousel" feature lets users create rotating image galleries.',
                'value' => $SettingsArray['image_carousel'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/image_carousel',
                'doc_link' => 'https://example.com/docs/image_carousel'
            ),
            array(
                'name' => 'contact_form',
                'label' => 'Contact Form 📞',
                'desc' => 'The "Contact Form" allows users to create forms for collecting contact information.',
                'value' => $SettingsArray['contact_form'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/contact_form',
                'doc_link' => 'https://example.com/docs/contact_form'
            ),
            array(
                'name' => 'lightbox_gallery',
                'label' => 'Lightbox Gallery 🖼️',
                'desc' => 'The "Lightbox Gallery" enables viewing images in a lightbox overlay.',
                'value' => $SettingsArray['lightbox_gallery'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/lightbox_gallery',
                'doc_link' => 'https://example.com/docs/lightbox_gallery'
            ),
            array(
                'name' => 'sticky_navigation',
                'label' => 'Sticky Navigation 📌',
                'desc' => 'The "Sticky Navigation" keeps the navigation bar fixed at the top of the page.',
                'value' => $SettingsArray['sticky_navigation'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/sticky_navigation',
                'doc_link' => 'https://example.com/docs/sticky_navigation'
            ),
            array(
                'name' => 'back_to_top_button',
                'label' => 'Back to Top Button 🔝',
                'desc' => 'The "Back to Top Button" allows users to quickly return to the top of the page.',
                'value' => $SettingsArray['back_to_top_button'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/back_to_top_button',
                'doc_link' => 'https://example.com/docs/back_to_top_button'
            ),
            array(
                'name' => 'sidebar_widgets',
                'label' => 'Sidebar Widgets 🧩',
                'desc' => 'The "Sidebar Widgets" feature allows adding various widgets to the sidebar.',
                'value' => $SettingsArray['sidebar_widgets'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/sidebar_widgets',
                'doc_link' => 'https://example.com/docs/sidebar_widgets'
            ),
            array(
                'name' => 'social_media_icons',
                'label' => 'Social Media Icons 📱',
                'desc' => 'The "Social Media Icons" feature lets users add icons linking to their social media profiles.',
                'value' => $SettingsArray['social_media_icons'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/social_media_icons',
                'doc_link' => 'https://example.com/docs/social_media_icons'
            ),
            array(
                'name' => 'parallax_scrolling',
                'label' => 'Parallax Scrolling 🌌',
                'desc' => 'The "Parallax Scrolling" effect creates an illusion of depth by moving background content at a different speed than foreground content.',
                'value' => $SettingsArray['parallax_scrolling'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/parallax_scrolling',
                'doc_link' => 'https://example.com/docs/parallax_scrolling'
            ),
            array(
                'name' => 'breadcrumb_navigation',
                'label' => 'Breadcrumb Navigation 🍞',
                'desc' => 'The "Breadcrumb Navigation" feature provides a secondary navigation aid that helps users understand their location within a website.',
                'value' => $SettingsArray['breadcrumb_navigation'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/breadcrumb_navigation',
                'doc_link' => 'https://example.com/docs/breadcrumb_navigation'
            ),
            array(
                'name' => 'google_maps_integration',
                'label' => 'Google Maps Integration 🗺️',
                'desc' => 'The "Google Maps Integration" feature allows embedding Google Maps into your site.',
                'value' => $SettingsArray['google_maps_integration'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/google_maps_integration',
                'doc_link' => 'https://example.com/docs/google_maps_integration'
            ),
            array(
                'name' => 'font_awesome_icons',
                'label' => 'Font Awesome Icons 🌟',
                'desc' => 'The "Font Awesome Icons" feature allows adding vector icons and social logos to your site.',
                'value' => $SettingsArray['font_awesome_icons'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/font_awesome_icons',
                'doc_link' => 'https://example.com/docs/font_awesome_icons'
            ),
            array(
                'name' => 'blog_post_layouts',
                'label' => 'Blog Post Layouts 📝',
                'desc' => 'The "Blog Post Layouts" feature provides various layouts for displaying blog posts.',
                'value' => $SettingsArray['blog_post_layouts'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/blog_post_layouts',
                'doc_link' => 'https://example.com/docs/blog_post_layouts'
            ),
            array(
                'name' => 'pricing_tables',
                'label' => 'Pricing Tables 💲',
                'desc' => 'The "Pricing Tables" feature allows users to create tables to display pricing options.',
                'value' => $SettingsArray['pricing_tables'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/pricing_tables',
                'doc_link' => 'https://example.com/docs/pricing_tables'
            ),
            array(
                'name' => 'testimonials',
                'label' => 'Testimonials 🗣️',
                'desc' => 'The "Testimonials" feature allows users to add customer testimonials to their site.',
                'value' => $SettingsArray['testimonials'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/testimonials',
                'doc_link' => 'https://example.com/docs/testimonials'
            ),
            array(
                'name' => 'faq_section',
                'label' => 'FAQ Section ❓',
                'desc' => 'The "FAQ Section" feature allows users to create a section for frequently asked questions.',
                'value' => $SettingsArray['faq_section'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/faq_section',
                'doc_link' => 'https://example.com/docs/faq_section'
            ),
            array(
                'name' => 'newsletter_signup',
                'label' => 'Newsletter Signup 📨',
                'desc' => 'The "Newsletter Signup" feature allows users to create a form for newsletter subscription.',
                'value' => $SettingsArray['newsletter_signup'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/newsletter_signup',
                'doc_link' => 'https://example.com/docs/newsletter_signup'
            ),
            array(
                'name' => 'video_background',
                'label' => 'Video Background 📹',
                'desc' => 'The "Video Background" feature allows adding video backgrounds to sections of the site.',
                'value' => $SettingsArray['video_background'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/video_background',
                'doc_link' => 'https://example.com/docs/video_background'
            ),
            array(
                'name' => 'animation_effects',
                'label' => 'Animation Effects ✨',
                'desc' => 'The "Animation Effects" feature allows adding animations to elements on the site.',
                'value' => $SettingsArray['animation_effects'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/animation_effects',
                'doc_link' => 'https://example.com/docs/animation_effects'
            ),
            array(
                'name' => 'countdown_timer',
                'label' => 'Countdown Timer ⏳',
                'desc' => 'The "Countdown Timer" feature allows adding a countdown timer to the site.',
                'value' => $SettingsArray['countdown_timer'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/countdown_timer',
                'doc_link' => 'https://example.com/docs/countdown_timer'
            ),
            array(
                'name' => 'progress_bars',
                'label' => 'Progress Bars 📊',
                'desc' => 'The "Progress Bars" feature allows adding progress bars to the site.',
                'value' => $SettingsArray['progress_bars'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/progress_bars',
                'doc_link' => 'https://example.com/docs/progress_bars'
            ),
            array(
                'name' => 'team_members_section',
                'label' => 'Team Members Section 👥',
                'desc' => 'The "Team Members Section" feature allows displaying team members on the site.',
                'value' => $SettingsArray['team_members_section'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/team_members_section',
                'doc_link' => 'https://example.com/docs/team_members_section'
            ),
            array(
                'name' => 'service_boxes',
                'label' => 'Service Boxes 📦',
                'desc' => 'The "Service Boxes" feature allows adding service boxes to the site.',
                'value' => $SettingsArray['service_boxes'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/service_boxes',
                'doc_link' => 'https://example.com/docs/service_boxes'
            ),
            array(
                'name' => 'portfolio_showcase',
                'label' => 'Portfolio Showcase 🖼️',
                'desc' => 'The "Portfolio Showcase" feature allows displaying a portfolio of work on the site.',
                'value' => $SettingsArray['portfolio_showcase'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/portfolio_showcase',
                'doc_link' => 'https://example.com/docs/portfolio_showcase'
            ),
            array(
                'name' => 'client_logos',
                'label' => 'Client Logos 💼',
                'desc' => 'The "Client Logos" feature allows displaying logos of their clients.',
                'value' => $SettingsArray['client_logos'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/client_logos',
                'doc_link' => 'https://example.com/docs/client_logos'
            ),
            array(
                'name' => 'call_to_action',
                'label' => 'Call to Action 📢',
                'desc' => 'The "Call to Action" feature allows users to add call-to-action buttons to their site.',
                'value' => $SettingsArray['call_to_action'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/call_to_action',
                'doc_link' => 'https://example.com/docs/call_to_action'
            )
        );
        
        
        ?>
        <div class="wrap">
            <h1><?php _e( 'Elements', 'themes-assistant' ); ?></h1>
            <form id="ata_elements_form">
                <div class="form-header">
                    <div class="container">
                        <div class="form-header-inner">
                            <div class="title">
                            <h2>Global Controls</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime tempora saepe accusantium dolore.</p>
                            </div>
                            <div class="switch-all">
                            <span id="disable-all">Disable All</span>
                            <div class="switch">
                                <input type="checkbox" id="switch-all-input">
                                <label for="switch-all-input" class="slider round"></label>
                            </div>
                            <span id="enable-all">Enable All</span>
                            </div>
                            <div class="header-action">
                            <button type="submit" id="ata_save_element">Save Settings</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="form-body">
                        <div class="form-section">
                            <div class="form-section__header">
                                <h3>Theme Features</h3>
                                <p>Toggle various features of your theme/plugin below:</p>
                            </div>
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
        function at_assistant_update_elements($pre, $new) {
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
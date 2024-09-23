<?php 

namespace ATA\Admin\Views\Panel;
use ATA\AtaQuery;

class AtaExtensions {
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
        $query = "SELECT * FROM %1s"; // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
        $this->existing_data =  $this->wpdb->get_row($wpdb->prepare($query, $this->table_name));
        $this->where = array('id' => $this->existing_data->id);
        $this->data_format = array(
            '%s', // 'post_id' is a string
            '%s', // 'form_title' is a string
            '%s', // 'form_json' is a string
            '%s', // 'form_html' is an integer
        );

        add_action('wp_ajax_extensions_settings', [$this, 'ata_extensions_settings']);
        add_action('wp_ajax_nopriv_extensions_settings', [$this, 'ata_extensions_settings']); // For non-logged-in users
        
    }

    function ata_extensions_settings(){
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['nonce'] ) ) , 'ata-nonce' ) ){
            wp_send_json_error(array(
                'status' => '400',
                'message' => 'Nonce verification failed'
            ));
        }

        if (isset($_POST['ataExtentionsData'])) {
            // Retrieve and decode the data from $_POST
            $raw_data = wp_unslash(sanitize_textarea_field($_POST['ataExtentionsData']));

            // Sanitize and validate the data as needed
            $sanitized_data = sanitize_text_field($raw_data);

            // Encode the sanitized data as JSON
            $encoded_data = wp_json_encode($sanitized_data);

            // Now $encoded_data contains the sanitized and encoded data
        } else {
            // Handle the case where 'ataExtentionsData' is not set in $_POST
            $encoded_data = wp_json_encode(array('error' => 'ataExtentionsData not set.'));
        }

        parse_str(str_replace(array("'", "\""), '', $encoded_data), $formFields);
        
        // Define data to insert or update
        $data_to_insert = array(
            'extiontion_settings' => wp_json_encode($formFields),
            'addon_setting' => 'coming soon',
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql'),
        );
        $defaults = array(
            'extiontion_settings' => '',
            'addon_setting' => '',
            'created_at' => current_time('mysql'),
            'updated_at' => current_time('mysql'),
        );


        // Check if data exists in the database
        if (empty($this->existing_data)) {
            // Data does not exist, insert it
            $data_to_insert = array(
                'extiontion_settings' => wp_json_encode($formFields),
                'addon_setting' => 'coming soon',
                'created_at' => current_time('mysql'),
                'updated_at' => current_time('mysql'),
            );
        
            // Insert the data
            $this->query->ata_insert_data($this->table_name, $data_to_insert, $defaults);

        } else {
            // Data exists, update it
            $updated_data = array(
                'extiontion_settings' => wp_json_encode($formFields),
                'updated_at' => current_time('mysql'),
            );
            // Define the WHERE clause to identify the existing record (you might need to adjust this based on your table structure)
            $where = array('id' => $this->existing_data->id);
            // Update the data
            $result = $this->query->ata_update_data( $this->table_name, $updated_data, $where);
            wp_send_json(array('success' => 'Settings have been updated!'));
        }
        
    }


    public function ata_extensions_page(){
        // Default SettingsArray. 
        $pre_defined_extentions = array(
            'ata_example_extention' => false,
            'ata_video_galley' => false,
        );
        

        // user's modified settingsArray
        $user_defined_extentions = $this->ata_extentions_settings_config();


        // Update the SettingsArray
        $SettingsArray = $this->ata_update_extentions($pre_defined_extentions, $user_defined_extentions);

        $ata_extention_array = array(
            array(
                'name' => 'ata_example_extention',
                'label' => 'Example Extention',
                'desc' => 'Description for the Example Extention',
                'value' => $SettingsArray['ata_example_extention'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/about_box',
                'doc_link' => 'https://example.com/docs/about_box',
                'badge' => 'popular',
                'extention_type' => 'pro'
            ),
            array(
                'name' => 'ata_video_galley',
                'label' => 'Video Gallery',
                'desc' => 'Description for the Video Gallery',
                'value' => $SettingsArray['ata_video_galley'] ? true : false,
                'disabled' => false,
                'demo_link' => 'https://example.com/demo/about_box',
                'doc_link' => 'https://example.com/docs/about_box',
                'badge' => 'popular',
                'extention_type' => 'pro'
            ),
        );
        
        
        
        
        ?>
        <div class="wrap">
            <h1><?php _e( 'Extensions', 'themes-assistant' ); ?></h1>
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
                                <h3>Extentions</h3>
                                <p>Toggle various extention with your theme/plugin below:</p>
                            </div>
                            <?php foreach($ata_extention_array as $field): ?>
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
    public function ata_extentions_settings_config(){
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
        * Function to update settings based on object Extentions
        *
        * @param [type] $pre
        * @param [type] $new
        * @return void
        */
        function ata_update_extentions($pre, $new) {
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
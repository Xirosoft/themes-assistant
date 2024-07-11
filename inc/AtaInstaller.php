<?php 

namespace ATA;

if ( ! class_exists( 'AtAssistant_Installer' ) ) {

    class AtaInstaller{

        /**
        * run function
        * This funtion run when plugin active
        * @return void
        */
        function run(){
            $this->at_assistant_add_version();
            $this->at_assistant_config_table();
        }   
        
        /**
        * Manage version 
        *
        * @return void
        */
        public function at_assistant_add_version(){
            $installed = get_option('ata_installed');
            if(!$installed){
                update_option( 'ata_installed', time(), );	
            }
            update_option( 'ata_version', ATA_VERSION );
        }
        /**
        * DB table create for ATA settings function
        *
        * @return void
        */
        public function at_assistant_config_table(){
            global $wpdb;
            $at_assistant_submissions_table = $wpdb->prefix . 'at_assistant_settings';
        
            // Check if the table exists before creating it
            if (!$this->at_assistant_is_table_exists($at_assistant_submissions_table)) {
                $charset_collate = $wpdb->get_charset_collate();
                $sql = "CREATE TABLE $at_assistant_submissions_table (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    elements_settings TEXT NOT NULL,
                    addon_setting TEXT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
                ) $charset_collate;";

                if (!function_exists('dbDelta')) {
                    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                }

                dbDelta($sql);
                $query = "SELECT * FROM %1s";
                // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
                $existing_data = $wpdb->get_row( $wpdb->prepare($query, $at_assistant_submissions_table));
                // Insert data into the table after creating it
                $at_assistant_elements_settings_data = '{"form_option_checkbox":"on","form_option_date":"on","form_option_files":"on","form_option_header":"on","form_option_hidden":"on","form_option_number":"on","form_option_paragraph":"on","form_option_radio":"on","form_option_select":"on","form_option_text":"on","form_option_textarea":"on","form_attr_description":"on","form_attr_name":"on","form_attr_maxlength":"on","form_attr_style":"on","form_attr_class":"on","form_attr_label":"on","form_attr_placeholder":"on","form_attr_value":"on","form_attr_type":"on","form_attr_required":"on"}';

                if (!$existing_data) {
                    // Insert data if no existing data
                    $data = array(
                        'elements_settings' => wp_json_encode($at_assistant_elements_settings_data),
                        'addon_setting' => 'coming soon',
                    );
        
                    $wpdb->insert(
                        $at_assistant_submissions_table,
                        $data
                    );
                } else {
                    // Update data if existing data is found
                    $data = array(
                        'elements_settings' => wp_json_encode($at_assistant_elements_settings_data),
                        'addon_setting' => 'coming soon',
                    );
        
                    $wpdb->update(
                        $at_assistant_submissions_table,
                        $data,
                        array('id' => $existing_data->id)
                    );
                }
            } else {
                wp_die('Table Already exists!');
            }
        }

        /**
        * at_assistant_is_table_exists function just checking exists table.
        *
        * @param [string] $table_name
        * @return boolean
        */
        function at_assistant_is_table_exists($table_name) {
            global $wpdb;
            $get_table = $wpdb->prefix . $table_name;
            $query = "SHOW TABLES LIKE %1s";
            // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
            return $wpdb->get_var($wpdb->prepare($query, $get_table)) == $get_table;
        }
    }
}
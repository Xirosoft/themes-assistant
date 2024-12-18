<?php 
namespace ATA;

if ( ! class_exists( 'AtaQuery' ) ) {
    
    class AtaQuery {

        private $wpdb;
        private $table_name;
        private $data_format;
        
        // Constructor to initialize the $wpdb object
        public function __construct(){
            global $wpdb;
            $this->wpdb         = $wpdb;
            $this->table_name   = $this->wpdb->prefix . 'ata_settings'; // Replace 'ms_form_data' with your custom table name
            $this->data_format  = array(
                '%s', // 'post_id' is a string
                '%s', // 'form_title' is a string
                '%s', // 'form_json' is a string
                '%s', // 'form_html' is an integer
                '%d', // 'user_id' is a string
                '%s', // 'user_full_name' is a string
                '%s', // 'form_status_messages' is a string
                '%s', // 'form_configs' is a string (datetime)
                '%s', // 'updated_at' is a string (datetime)
                '%s', // 'updated_at' is a string (datetime)
            );

        }

        /**
        * Data Insert function
        *
        * @param [json] $data
        * @return void
        */
        public function ata_insert_data($table_name, $data, $defaults) {
            // global $wpdb;

            // Merge provided data with defaults
            $data = wp_parse_args($data, $defaults);
            
            // Ensure data format matches the expected format
            $this->wpdb->insert($table_name, $data, $this->data_format);
            // return $wpdb->insert_id; // Returns the ID of the inserted row
        }
        /**
        * Data Update Method function
        *
        * @param [json] $data
        * @param [intger] $where
        * @return void
        */
        public function ata_update_data($table_name, $data, $where) {
            // return $where;
            // global $wpdb;
            $this->wpdb->update($table_name, $data, $where, $this->data_format);
        }
        
        /**
        * View Data function
        *
        * @param [Integer] $where
        * @return void
        */
        public function ata_view_data($table_name, $where_conditions) {
            // Construct the WHERE clause based on the provided conditions
            $where_clause = '';
            foreach ($where_conditions as $column => $value) {
                $where_clause .= "$column = $value";
            }
            // Remove the trailing "AND" from the where clause
            $where_clause = rtrim($where_clause, ' AND ');
        
            // Prepare and execute the query
            $query = "SELECT * FROM %1s WHERE %2s" ;
            // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
            return $this->wpdb->get_results($this->wpdb->prepare($query, $table_name, $where_clause));
        }
        
        /**
        * Delete function
        *
        * @param [Integer] $where
        * @return void
        */
        public function ata_delete_data($where) {
            // global $wpdb;
            $this->table_name =$this->wpdb->prefix . 'ata_forms';
            //$this->wpdb->delete($table_name, $wheree);
        $this->wpdb->delete($this->table_name, $where);
        }


        // Constructor and other methods should go here if needed
        public function ata_count_form_entries($form_id) {
            // global $wpdb; // WordPress database access class
            $table_name = $this->wpdb->prefix . 'ata_submissions';
            $query = "SELECT COUNT(*) FROM %1s WHERE form_id = %d";
            // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
            $count = $this->wpdb->get_var($this->wpdb->prepare($query ,$table_name, $form_id)); 
            // Return the count
            return $count;
        }

        /**
        * Get Single Row function
        *
        * @param [string] $table_name
        * @param [string] $where
        * @return string
        */
        public function ata_get_single_row($table_name, $where){
            $query = "SELECT * FROM %1s WHERE post_id = %d";
            // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
            return $this->wpdb->get_row($this->wpdb->prepare($query, $table_name,  $where), ARRAY_A);
        }  

        /**
        * Get all form id function
        *
        * @param [string] $table_name
        * @param [string] $where
        */
        public function ata_get_all_form_id($table_name){
            
            $query = "SELECT * FROM %1s";
            // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
            $results = $this->wpdb->get_results($this->wpdb->prepare($query, $table_name));
            return $results;
        }   

        

        
    }
}
<?php

use ATA\Admin\Views\AtaAssetsManager;
/**
 * Global functions
 *
 * This function manage all globlal functions
 *
 * @package ATA
 */

/*------------------------------------------*
*				Excerpt Length              *
*-------------------------------------------*/
if(!function_exists('ata_excerpt')){
	function ata_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt);
		} else {
			$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		return $excerpt;
	}
}

/*------------------------------------------*
*				Global Function             *
*-------------------------------------------*/
function ata_assets_manager( $handle, $type = null, $deps = [], $ver = false, $in_footer_or_media = 'all' ) {
    $assets_manager = AtaAssetsManager::get_instance();
    $assets_manager->ata_enqueue_asset( $handle, $type, $deps, $ver, $in_footer_or_media );
}

/**
         * Get total elements count from ata_settings table.
         *
         * @return int Total elements count.
         */
        
         function get_total_elements_count() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'ata_settings'; // Update to your actual table name if different
            $query = "SELECT elements_settings FROM $table_name";
            $results = $wpdb->get_results($query, ARRAY_A);
            
            $total_count = 0;
            foreach ($results as $row) {
                $settings = json_decode($row['elements_settings'], true);
                if (is_array($settings)) {
                    $total_count += count($settings);
                }
            }
            return $total_count;
        }
        
        /**
         * Get active elements count from ata_settings table.
         *
         * @return int Active elements count.
         */
        function get_active_elements_count() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'ata_settings'; // Update to your actual table name if different
            $query = "SELECT elements_settings FROM $table_name";
            $results = $wpdb->get_results($query, ARRAY_A);
            
            $active_count = 0;
            foreach ($results as $row) {
                $settings = json_decode($row['elements_settings'], true);
                if (is_array($settings)) {
                    foreach ($settings as $key => $value) {
                        if ($value === 'on') {
                            $active_count++;
                        }
                    }
                }
            }
            return $active_count;
        }
        /**
         * Get inactive elements count from ata_settings table.
         *
         * @return int Inactive elements count.
         */
        function get_inactive_elements_count() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'ata_settings'; // Update to your actual table name if different
            $query = "SELECT elements_settings FROM $table_name";
            $results = $wpdb->get_results($query, ARRAY_A);
            
            $inactive_count = 0;
            foreach ($results as $row) {
                $settings = json_decode($row['elements_settings'], true);
                if (is_array($settings)) {
                    foreach ($settings as $key => $value) {
                        if ($value !== 'on') {
                            $inactive_count++;
                        }
                    }
                }
            }
            return $inactive_count;
        }
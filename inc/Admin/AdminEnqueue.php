<?php
namespace Xirosoft\ThemesAssistant\Admin;

class AdminEnqueue{
    function __construct(){
        add_action('admin_enqueue_scripts', [$this, 'enqueue_dashboard_scripts']);
        add_action('admin_enqueue_scripts', [$this, 'BuilderFormaData']);
        add_action('admin_enqueue_scripts', [$this, 'formit_ajax_localie']);
    }
    
    function enqueue_dashboard_scripts($hook) {

        $current_screen = get_current_screen();
        // Check if you're on the appropriate admin page(s) where you want to include your script       
        if ($current_screen && $current_screen->post_type == 'themes-assistant') {
            wp_enqueue_script( 'jquery-ui-widget' , 'jquery');
            wp_enqueue_script( 'jquery-ui-mouse' ,  'jquery');
            wp_enqueue_script( 'jquery-ui-accordion' ,  'jquery');
            wp_enqueue_script( 'jquery-ui-autocomplete' ,  'jquery');
            wp_enqueue_script( 'jquery-ui-slider' ,  'jquery');
            wp_enqueue_editor();
            wp_enqueue_script('themes-assistant-form-builder', THEMEASSISTANT_ASSETS_URL . 'admin/js/form-builder.min.js', array('jquery'), '1.0', true);
            wp_enqueue_script('form-render', THEMEASSISTANT_ASSETS_URL . 'admin/js/form-render.min.js', array('jquery'), time(), true);
            wp_enqueue_script('themes-assistant-admin-scripts', THEMEASSISTANT_ASSETS_URL . 'admin/js/themes-assistant-admin-scripts.js', array('jquery'), time(), true);
            wp_enqueue_style('themes-assistant-admin-style', THEMEASSISTANT_ASSETS_URL . 'admin/css/themes-assistant-admin-style.css?', array(), time(), 'all' );
        }
        
    }

    /**
     * JS peramiter localize function
     *
     * @param [type] $json_localize
     * @return void
     */
    function BuilderFormaData($json_localize){

        /**
         * Object data send send script
         * Retrieve the API token and pass it to the script
         * @themes-assistant-admin-scripts
         */

        wp_localize_script('themes-assistant-admin-scripts', 'formit_scripts_localize', array(
            'GetBuilderJson' => json_decode($json_localize),
      
        ));
        
    }

    /**
     * Ajax Data localize function
     * Retrieve the API token and pass it to the script 
     * @return void
     */
    function formit_ajax_localie(){
        wp_localize_script('themes-assistant-admin-scripts', 'themes_assistant_ajax_localize', array(
            'site_url'  => site_url(),
            'plugin_url'=> THEMEASSISTANT_URL,
            'ajax_url'  => admin_url('admin-ajax.php'),
            'nonce'     => wp_create_nonce('themes-assistant-nonce')
        ));
        
    }
}




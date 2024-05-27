<?php
// Enqueue assets
namespace AT_Assistant\Frontend;
class FrontendEnqueue{
    function __construct(){
        /**
         * This Enquee method for script and style 
         * @load_ms_form_assets
         */
        add_action('wp_enqueue_scripts', [$this, 'load_ms_form_assets']);
    }

    /**
     * All Front-end Script and style enquee method.
     *
     * @return void
     */
    function load_ms_form_assets() {
        /**
         * Enquee All Scripts
         */
        wp_enqueue_script('jquery');
        wp_enqueue_script('themes-assistant-fontend-script', AT_ASSISTANT_ASSETS_URL . 'frontend/js/themes-assistant-fontend-script.js', array('jquery'), time(), true);
        wp_localize_script('themes-assistant-fontend-script', 'formit_ajax_object', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('themes-assistant-nonce')
            ));
        
        /**
         * Enquee All Styles
         */
        wp_enqueue_style('themes-assistant-frontend-style', AT_ASSISTANT_ASSETS_URL . 'frontend/css/themes-assistant-frontend-style.css', array(), time(), 'all' );
    }



}

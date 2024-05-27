<?php

namespace AT_Assistant\Admin;


/**
 * Custom post Hander calass class
 */
class CustomPost
{
    function __construct(){
        add_action('init', [$this, 'custom_formit_builder_post_type']);
    }

    /**
     * Custom post callback function
     *
     * @return void
     */
    function custom_formit_builder_post_type() {
           }

    
}

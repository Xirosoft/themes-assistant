<?php 
namespace Xirosoft\ThemesAssistant;

class API{
    
    function __construct(){
        add_action('rest_api_init', [$this, 'register_api']);
    }

    function register_api(){
        
    }
}

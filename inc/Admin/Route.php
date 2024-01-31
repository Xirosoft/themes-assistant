<?php
namespace Xirosoft\ThemesAssistant\Admin;
use Xirosoft\ThemesAssistant\Query;

final class Route
{
    public function __construct(){
        // add_action('admin_init', array($this, 'add_rewrite_rules'));
    }
 
    function page_slug($url_slug){
        $page_slug = '/wp-admin/edit.php?post_type=themes-assistant&page='.$url_slug;
        return $page_slug;
    }
    public function page_url($url_slug){
        $page_url =  home_url('/wp-admin/edit.php?post_type=themes-assistant&page='.$url_slug);
        return $page_url;
    }
    public function current_url(){
        $current_url = home_url(add_query_arg(array(), sanitize_text_field($_SERVER['REQUEST_URI'])));
        return $current_url;
    }
    public function create_url(){
        $new_from_slug =  home_url('/wp-admin/post-new.php?post_type=themes-assistant');
        return $new_from_slug;
    }
    public function settings_url(){
        $settings = $this->page_url('settings');
        return $settings;
    }
    public function entreies_url(){
        $docs = $this->page_url('docs');
        return $docs;
    }
    public function docs_url(){
        $submission = $this->page_url('submission');
        return $submission;
    }

    public function add_rewrite_rules() {
        // add_rewrite_rule('^wp-admin/themes-assistant/forms/?$', 'index.php?post_type=themes-assistant', 'top');
        // add_rewrite_rule('^wp-admin/themes-assistant/create/?$', 'wp-admin/post-new.php?post_type=themes-assistant', 'top');
        // add_rewrite_rule('^wp-admin/themes-assistant/settings/?$', 'index.php?post_type=themes-assistant&page=themes-assistant-settings', 'top');
        // add_rewrite_rule('^wp-admin/themes-assistant/submission/?$', 'index.php?post_type=themes-assistant&page=themes-assistant-submissions', 'top');
        // add_rewrite_rule('^wp-admin/themes-assistant/docs/?$', 'index.php?post_type=themes-assistant&page=themes-assistant-docs', 'top');
    }

    
    
}

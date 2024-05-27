<?php
namespace AT_Assistant;
use AT_Assistant\Admin\Popup\HeaderProfileInfo;
use AT_Assistant\Admin\Route;
use is_plugin_active;

/**
 * This class using for manage all Admin raleted class 
 * @GlobalFunctions
 */
class GlobalFunctions {

    /**
     * Construct function for Gloabal
     */
    function __construct(){
         /**
         * Custom Header action 
         * callback @formit_custom_dashboard_header
         */
        add_action('admin_head', [$this,'formit_custom_dashboard_header']);

        /**
         * Elementor addon will be active if Elementor active
         */
		if (did_action( 'elementor/loaded' ) ) {
            add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);	
		}
        new Admin\views\ElementorWidgets();
    }

   

    /**
     * MSFROM Custom Header function
     *
     * @return void
     */
    function formit_custom_dashboard_header() {
        global $post_type;
        $route = new Route;

        // Get the admin page title
        $page_title = get_admin_page_title();

        // Check if the current screen is for the 'themes-assistant' custom post type
        if ($post_type === 'themes-assistant' || strpos($route->current_url(), $route->page_slug('submission')) !== false  || strpos($route->current_url(), $route->page_slug('settings')) !== false   || strpos($route->current_url(), $route->page_slug('docs')) !== false ) {
 
          ?>
            <div id="wpheader">
                <div class="wpheader__title">
                    <a class="wpheader__logo" href="<?php echo esc_url( FORMIT_URL ) ?>">
                        <img src="<?php echo esc_url( AT_ASSISTANT_ASSETS_URL.'/img/logo-icon.svg') ?>" alt="themes-assistant-logo" />  
                    </a>
                    <div class="wpheader__name">
                        <small class="wpheader_title_version"><?php echo esc_html( 'AT_Assistant-v1.0.0' ) ?> <span class="version-beta"><?php echo esc_html__('Beta', 'themes-assistant'); ?></span></small>  
                        <h2>
                            <?php 
                                // Check if it's the "Add New" page for the "themes-assistant" post type
                                if (isset($_GET['post_type']) && sanitize_text_field($_GET['post_type']) === 'themes-assistant' && strpos(esc_url_raw($_SERVER['REQUEST_URI']), 'post-new.php') !== false) {
                                    echo esc_html__('Create New Form', 'themes-assistant');
                                } else {
                                    printf(
                                        esc_html__( '%s', 'themes-assistant' ),
                                        esc_html($page_title)
                                    );
                                }
                            ?>
                        </h2>
                    </div>
                </div>
                <div class="wpheader__meta">
                    <a href="<?php echo esc_url($route->create_url()); ?>" class="wpheader__meta__icon wpheader__meta__add_new" title="<?php echo esc_attr__( 'Create New Form', 'themes-assistant' ) ?>"><i class="formbuilder-icon-add"></i></a>
                    <a href="<?php echo esc_url($route->page_url('docs')); ?>" class="wpheader__meta__icon wpheader__meta__docs" title="<?php echo esc_attr__( 'Documentation', 'themes-assistant' ) ?>"><i class="formbuilder-icon-docs"></i></a>
                    <a href="<?php echo esc_url($route->page_url('settings')); ?>" class="wpheader__meta__icon wpheader__meta__addon" title="<?php echo esc_attr__( 'Settings', 'themes-assistant' ) ?>"><i class="formbuilder-icon-settings"></i></a>
                    <button class="wpheader__meta__icon wpheader__meta__info" title="<?php echo esc_attr__( 'Info', 'themes-assistant' ) ?>" data-popup="#info-popup"><i class="formbuilder-icon-info"></i></button>
                </div>
            </div>
            <?php
            $header_profile = new HeaderProfileInfo;
            $header_profile->profile_info_popup();
        }
    }


    public function register_widgets($widgets_manager) {
		// Its is now safe to include Widgets files
	}

   
    
   

}


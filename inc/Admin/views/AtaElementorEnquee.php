<?php

namespace ATA\Admin\Views;
use ATA\AtaQuery;

class AtaElementorEnquee {

    protected $widget_name;

    public function __construct($widget_name) {
        $this->widget_name = $widget_name;
        add_action('admin_enqueue_scripts', array($this, 'conditionally_enqueue_scripts'));
        add_action('elementor/frontend/after_enqueue_scripts', array($this, 'conditionally_enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'conditionally_enqueue_scripts'));
    }

    /**
     * Enqueue scripts and styles for this widget.
     */
    public function ata_el_enqueue_scripts() {
        $js_path = ATA_ASSETS_PATH . 'frontend/js/widget/' . $this->widget_name . '.js';
        $css_path = ATA_ASSETS_PATH . 'frontend/css/widget/' . $this->widget_name . '.css';

        // Check if JS file exists and enqueue it.
        if (file_exists($js_path)) {
            wp_register_script($this->widget_name . '-script', ATA_ASSETS_URL . 'frontend/js/widget/' . $this->widget_name . '.js', array('jquery'), ATA_VERSION, true);
            wp_enqueue_script($this->widget_name . '-script');
            
            // Localize the script after it's been enqueued
            $this->ata_widget_localize();
        }

        // Check if CSS file exists and enqueue it.
        if (file_exists($css_path)) {
            wp_register_style($this->widget_name . '-style', ATA_ASSETS_URL . 'frontend/css/widget/' . $this->widget_name . '.css', array(), ATA_VERSION);
            wp_enqueue_style($this->widget_name . '-style');
        }
    }

    /**
     * Conditionally checking script
     */
    public function conditionally_enqueue_scripts() {
        if ($this->is_elementor_edit_mode() || $this->is_widget_present()) {
            $this->ata_el_enqueue_scripts();
        }
    }

    /**
     * Check if we are in Elementor editor mode.
     */
    protected function is_elementor_edit_mode() {
        // Check if we are in Elementor editor mode.
        if (\Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() || wp_doing_ajax()) {
            return true;
        }
        return false;
    }

    /**
     * Check if the widget is present on the page.
     */
    protected function is_widget_present() {
        if (!did_action('elementor/loaded')) {
            return false;
        }

        $document = \Elementor\Plugin::instance()->documents->get(get_the_ID());
        if (!$document) {
            return false;
        }

        $elements_data = $document->get_elements_data();
        return $this->is_widget_in_element_data($elements_data);
    }

    /**
     * Check if the widget is present in the Elementor data.
     *
     * @param array $elements_data The Elementor elements data to check.
     * @return bool True if the widget is found, false otherwise.
     */
    protected function is_widget_in_element_data($elements_data) {
        foreach ($elements_data as $element_data) {
            if ('widget' === $element_data['elType'] && $this->widget_name === $element_data['widgetType']) {
                return true;
            }

            if (!empty($element_data['elements'])) {
                if ($this->is_widget_in_element_data($element_data['elements'])) {
                    return true;
                }
            }
        }
        return false;
    }

    public function ata_widget_localize() {
        wp_localize_script(
            $this->widget_name . '-script',
            'ata_widget_localize',
            array(
                'widget_name' => $this->widget_name,
                'site_url' => site_url(),
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('ata-nonce'),
            )
        );
    }
}

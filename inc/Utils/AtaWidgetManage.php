<?php 
namespace ATA\Utils;

class AtaWidgetManage{
    protected $widget_name;
    protected $style;
    protected $widget_instance;

    public function __construct($widget_name, $settings, $style, $widget_instance = null) {
        $this->widget_name  = $widget_name;
        $this->style        = $style;
        $clean_widget_name  = str_replace('ata-', '', $this->widget_name);
        $ata_file_path      = ATA_WIDGET_DIR . $clean_widget_name . '/style-' . $style . '.php';
        $this->widget_instance = $widget_instance;
        // echo $ata_file_path;
        // Check if the file exists before requiring it.
        if (file_exists($ata_file_path)) {
            require $ata_file_path;
        } else {
            echo "Widget does not exist: $ata_file_path"; // Handle the case where the file doesn't exist, perhaps log an error or throw an exception.
        }
    }
    
}
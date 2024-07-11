<?php 

namespace ATA\Utils;

class AtaGoPro{
    
    function __construct(){
        $options = get_option('borax_license_settings');
        if (is_array($options) && isset($options['license_type_id'])) {
            $license_type_id = $options['license_type_id'];
            if($license_type_id){
                define( 'LICFY_TYPE', $license_type_id);
                define( 'ATA_BASE_URL', esc_url('#'));
            }else{
                define( 'LICFY_TYPE', 1);
                define( 'ATA_BASE_URL', esc_url('#'));
            }
        }else{
            define( 'LICFY_TYPE', 1);
        }

    }

    public function ata_gopro($widget_title){

        if (LICFY_TYPE == 1 || LICFY_TYPE === null || LICFY_TYPE === 'undefined') {
            ?>
                <div class="pro-widget">
                    <h3 class="borax_pro_title"><?php echo esc_html__($widget_title. ' Widget', 'borax'); ?></h3>
                    <div class="dialog-message"><?php echo esc_html__('Leverage this feature, along with numerous other premium features, to expand your Website, enabling faster and superior website development.', 'borax'); ?> </div>
                    <a href="<?php echo WPBORAX; ?>" target="_blank" class="dialog-button button-success"><?php echo esc_html__('Go Pro', 'borax') ?></a> 
                </div>
            <?php
            return false; 
        }
        require BORAX_WIDGET_DIR .'banner/style-'.$style.'.php';
    }

}
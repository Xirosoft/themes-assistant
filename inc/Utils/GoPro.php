<?php 

namespace ATA\Utils;

class GoPro{
    
    function __construct(){
        
    }

    public function ata_gopro($widget_title){
        ?>
			<div class="pro-widget">
				<h3 class="borax_pro_title"><?php echo esc_html__($widget_title. ' Widget', 'borax'); ?></h3>
				<div class="dialog-message"><?php echo esc_html__('Leverage this feature, along with numerous other premium features, to expand your Website, enabling faster and superior website development.', 'borax'); ?> </div>
				<a href="<?php echo WPBORAX; ?>" target="_blank" class="dialog-button button-success"><?php echo esc_html__('Go Pro', 'borax') ?></a> 
			</div>
		<?php
        return false;
    }

}
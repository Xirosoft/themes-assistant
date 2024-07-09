<?php 

namespace AT_Assistant\Admin\Views\Panel;

class AtaPremium{
    public function __construct() {
        
    }

    public function ata_premium_page(){
        ?>
            <div class="wrap">
                <h1><?php _e( 'Go Premium', 'themes-assistant' ); ?></h1>
                <p><?php _e( 'Upgrade to the premium version to unlock more features!', 'themes-assistant' ); ?></p>
                <a href="#" class="button-primary"><?php _e( 'Upgrade Now', 'themes-assistant' ); ?></a>
            </div>
        <?php
    }
}
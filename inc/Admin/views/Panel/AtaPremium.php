<?php 

namespace ATA\Admin\Views\Panel;

class AtaPremium {
    public function __construct() {
        
    }

    public function ata_premium_page(){
        ?>
        <div class="wrap">
            <h1><?php _e( 'Go Premium', 'themes-assistant' ); ?></h1>
            <div class="form-header">
                <div class="container">
                    <div class="form-header-inner">
                        <div class="title">
                            <h2><?php _e( 'Go Premium', 'themes-assistant' ); ?></h2>
                            <p><?php _e( 'Upgrade to the premium version to unlock more features!', 'themes-assistant' ); ?></p>
                        </div>
                        <div class="header-action">
                            <a href="#" target="_blank" class="button-primary"><?php _e( 'Upgrade Now', 'themes-assistant' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h3>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus, voluptate.</h3>
            </div>
        </div>
    <?php
    }
}
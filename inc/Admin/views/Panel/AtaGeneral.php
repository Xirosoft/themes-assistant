<?php 

namespace ATA\Admin\Views\Panel;

class AtaGeneral{
    public function __construct() {
        
    }

    public function ata_general_page(){
        ?>
         <div class="wrap ata-wrap">
            <h1><?php _e( 'General', 'themes-assistant' ); ?></h1>
            <div class="form-header">
                <div class="container">
                    <div class="form-header-inner">
                        <div class="title empty"></div>
                        <div class="title text-center">
                            <h2><?php _e( 'Elemenets Details', 'themes-assistant' ); ?></h2>
                            <p><?php _e( 'Themes Assistance General Settings and Informations.', 'themes-assistant' ); ?></p>
                        </div>
                        <div class="title empty"></div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="genarel-widget ata-widget-1">
                            <h3><?php echo esc_html( 33 ); ?></h3>
                            <p><?php _e( 'Total Elements', 'themes-assistant' ); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="genarel-widget ata-widget-2">
                            <h3><?php echo esc_html( get_active_elements_count() ); ?></h3>
                            <p><?php _e( 'Active Elements', 'themes-assistant' ); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="genarel-widget ata-widget-3">
                            <h3><?php echo esc_html( 33 - get_active_elements_count() ); ?></h3>
                            <p><?php _e( 'Inactive Elements', 'themes-assistant' ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
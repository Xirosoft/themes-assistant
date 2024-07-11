<?php 

namespace ATA\Admin\Views\Panel;

class AtaGeneral{
    public function __construct() {
        
    }

    public function ata_general_page(){
        ?>
         <div class="wrap">
            <h1><?php _e( 'General', 'themes-assistant' ); ?></h1>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e( 'Total Elements', 'themes-assistant' ); ?></th>
                    <td><?php echo esc_html( get_option( 'ata_total_elements', 0 ) ); ?></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e( 'Active Elements', 'themes-assistant' ); ?></th>
                    <td><?php echo esc_html( get_option( 'ata_active_elements', 0 ) ); ?></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e( 'Inactive Elements', 'themes-assistant' ); ?></th>
                    <td><?php echo esc_html( get_option( 'ata_inactive_elements', 0 ) ); ?></td>
                </tr>
            </table>
        </div>
        <?php
    }
}
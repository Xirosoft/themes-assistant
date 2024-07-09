<?php 

namespace AT_Assistant\Admin\Views\Panel;

class AtaIntegrations{
    public function __construct() {
        
    }

    public function ata_integrations_page(){
        ?>
            <div class="wrap">
                <h1><?php _e( 'Integrations', 'themes-assistant' ); ?></h1>
                <table class="form-table">
                    <!-- Example of an integration -->
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Google Analytics', 'themes-assistant' ); ?></th>
                        <td>
                            <p><?php _e( 'Description of Google Analytics integration', 'themes-assistant' ); ?></p>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
    }
}
<?php 

namespace ATA\Admin\Views\Panel;

class AtaExtensions{
    public function __construct() {
        
    }

    public function ata_extensions_page(){
        ?>
            <div class="wrap">
                <h1><?php _e( 'Extensions', 'themes-assistant' ); ?></h1>
                <table class="form-table">
                    <!-- Example of an extension -->
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Extension 1', 'themes-assistant' ); ?></th>
                        <td>
                            <p><?php _e( 'Description of Extension 1', 'themes-assistant' ); ?></p>
                            <a href="#" class="button"><?php _e( 'Docs', 'themes-assistant' ); ?></a>
                            <a href="#" class="button"><?php _e( 'Live Demo', 'themes-assistant' ); ?></a>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                            <span class="badge"><?php _e( 'Popular', 'themes-assistant' ); ?></span>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
    }
}
<?php 

namespace AT_Assistant\Admin\Views\Panel;

class AtaTools{
    public function __construct() {
        
    }

    public function ata_tools_page(){
        ?>
            <div class="wrap">
                <h1><?php _e( 'Tools', 'themes-assistant' ); ?></h1>
                <table class="form-table">
                    <!-- Example of a tool -->
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Image Compress', 'themes-assistant' ); ?></th>
                        <td>
                            <p><?php _e( 'Description of Image Compress tool', 'themes-assistant' ); ?></p>
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
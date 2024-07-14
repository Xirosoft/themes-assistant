<div class="service-widget">
    <h3><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['title'] ) ); ?></h3>
    <?php 
        if ( $settings['list'] ) { ?>
        <ul class="serviceList"> 
            <?php
            foreach (  $settings['list'] as $item ) { ?>
                <li class="<?php echo esc_attr($item['active']); ?>">
                    <a href="<?php echo esc_url($item['link']['url']); ?>">
                        <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['service_a'] ) ); ?>
                    </a>
                </li> 
                <?php
            } ?>
    </ul>
    <?php } ?>
</div>
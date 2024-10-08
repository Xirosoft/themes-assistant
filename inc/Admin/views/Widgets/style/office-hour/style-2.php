<?php use Elementor\Icons_Manager; ?>
<div class="service-widget open_hours">
    <?php 
        if ( 'yes' === $settings['show_border'] ) {
            echo '<span class="open_border"></span>';
        }
    ?>
    
    <?php if( $settings['icon_type'] == 'icon'):?>
    <span class="icon">
        <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
    </span>
    <?php elseif( $settings['icon_type'] == 'iconclass'):?>
    <span class="icon">
        <i class="<?php echo esc_attr($settings['iconclass']); ?>"></i>
    </span>
    <?php elseif( $settings['icon_type'] == 'image'):?>
    <span class="icon">
        <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="" class="img-icon" width="40" height="40">
    </span>
    <?php endif;?>

    <h3><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['heading'] ) ); ?></h3>
    <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['sub_heading'] ) ); ?></p>
    <div class="sp-wrapper">
        <?php if ( $settings['open_hours'] ): 
            foreach (  $settings['open_hours'] as $item ): ?>
                <div class="pricing-list-item <?php if($item['closed'] == 'no'){echo esc_attr('closeday'); } ?>">
                    <div class="d-flex justify-content-between">
                        <div class="content">
                            <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['day_name'] ) ); ?></p>
                        </div>
                        <div class="content">
                            <?php if($item['closed'] == 'no'): ?>
                            <span><?php echo esc_html__('Closed', 'themes-assistant'); ?></span>
                            <?php else: ?>
                                <span><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['start_time_value'] ) ); ?></span>
                                <span><?php echo esc_html__('---', 'themes-assistant'); ?></span>
                                <span><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['end_time_value'] ) ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>	
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
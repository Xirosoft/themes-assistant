<?php 
    use Elementor\Icons_Manager; 
    $btn_class    = $settings['button_class'] . ' btn-secondary';
    $icon_align   = $settings['icon_align'];
    $btn_link     = (! empty( $settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';    
    $btn_target   = ( $settings['btn_link']['is_external']) ? '_blank' : '_self';
?>
<a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_attr( $btn_target ); ?>" class="btn <?php echo esc_attr( $btn_class ); ?>">
    <?php if($icon_align == 'right'): ?>
        <span class="button-text">
            <?php
                printf(
                    esc_html__( '%s', 'themes-assistant' ),
                    esc_html( $settings['btn_text'] )
                );
            ?>
        </span>
    <?php endif; ?>
    <?php if( $settings['icon_type'] == 'icon'):?>
        <span class="icon">
            <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </span>
        <?php elseif( $settings['icon_type'] == 'iconclass'):?>
        <span class="icon">
            <i class="<?php echo esc_attr($settings['iconclass']); ?>"></i>
        </span>
        <?php elseif( $settings['icon_type'] == 'image'): ?>
        <span class="icon">
            <img 
            src="<?php echo esc_url($settings['image']['url']); ?>" 
            alt="
                <?php
                    printf(
                        esc_html__( '%s', 'themes-assistant' ),
                        esc_html( $settings['btn_text'] )
                    );
                ?>
            " 
            class="img-icon" 
            width="40" 
            height="40" 
            style="max-width:20px"
            >
    </span>
    <?php endif;?>
    <?php if($icon_align == 'left'): ?>
        <span class="button-text">
            <?php
                printf(
                    esc_html__( '%s', 'themes-assistant' ),
                    esc_html( $settings['btn_text'] )
                );
            ?>
        </span>
    <?php endif; ?>
</a>
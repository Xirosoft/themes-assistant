<div class="comporision-slider" data-offset="<?php echo esc_attr($settings['Image_offset']['size']); ?>" data-orient="<?php echo esc_attr($settings['comparison_orientation']); ?>" data-belabel="<?php echo esc_attr($settings['before_title']); ?>" data-aflabel="<?php echo esc_attr($settings['after_title']); ?>" data-overl="<?php echo esc_attr($settings['no_overlay']); ?>" data-click="<?php echo esc_attr($settings['click_to_move']); ?>">
    <div class="imageDiff ata-image-diff">
        <img src="<?php echo esc_url($settings['before_image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['before_title'] ) ); ?>" width="442" height="571">
        <img src="<?php echo esc_url($settings['after_image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['after_title'] ) ); ?>" width="442" height="571">
    </div>
    <?php if($settings['overlay_swicher'] == 'yes'): ?>
        <img src="<?php echo esc_url($settings['overlay_image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['after_title'] ) ); ?>" class="overlay" width="442" height="571">
    <?php endif; ?>
</div> 
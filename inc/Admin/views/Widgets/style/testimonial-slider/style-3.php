<?php use Elementor\Icons_Manager; ?>
<div class="testimonial testimonial-style-2">
        <div class="test-caro owl-carousel" data-slider-id="1">
            <?php foreach (  $settings['list'] as $item ): ?>
            <div class="single-test">
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
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?>" class="img-icon"  width="50" height="50">
            </span>
                <?php endif;?>
                <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( wp_kses_post($item['content'] )) ); ?></p>                <div class="client-info">                
                    <p>
                        <b><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?></b>, 
                        <span><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['position'] ) ); ?></span>
                </p>
            </div>
        </div>
            <?php endforeach; ?> 
    </div>

        <div class="client-thumb owl-thumbs" data-slider-id="1">
            <?php foreach (  $settings['list'] as $item ): ?>
                <a href="javascript:void(0)" class="owl-thumb-item">
                    <div class="<?php if ( 'yes' === $settings['image_shadow'] ) {echo 'ImgShadow'; }  ?>">
                        <div class="<?php echo $settings['image_shape']; ?>">
                            <img src="<?php echo esc_url($item['t_image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?>" width="80" height="80">
                    </div>
                </div>
            </a>
            <?php endforeach; ?> 
    </div>
</div>

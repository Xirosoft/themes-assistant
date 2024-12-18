<?php use Elementor\Icons_Manager; ?>
<div class="testimonial version-2">
            <div class="test-caro owl-carousel" 
            data-nav="<?php echo esc_attr($settings['nav']); ?>" 
            data-control="<?php echo esc_attr($settings['control']); ?>" 
            data-autoplay="<?php echo esc_attr($settings['autoplay']); ?>"
            data-loop="<?php echo esc_attr($settings['loop']); ?>"
            data-rtl="<?php echo esc_attr($settings['testi_rtl']); ?>"  
            data-slider-id="1"
        > 
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
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?>" class="img-icon" width="50" height="50">
            </span>
                <?php endif;?>
                <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( wp_kses_post($item['content'] )) ); ?></p>                    <div class="testi-info">
                        <p class="name"><b><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?></b></p>
                        <span class="desigration"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['position'] ) ); ?></span>
                </div>

            </div> 
                <?php endforeach; ?> 
        </div>
            <div id="carousel-custom-dots"  class="owl-thumbs"  data-slider-id="1">
                <?php foreach (  $settings['list'] as $item ): ?>    
                    <div class="thumb"><img src="<?php echo esc_url($item['t_image']['url']); ?>" class="avatar" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?>" width="80" height="80"></div>
                <?php endforeach; ?>                                 
        </div>
    </div>
<?php 
use Elementor\Icons_Manager; 
$settings['list']
?>
<div class="testimonial version-1">
        <div class="test-caro owl-carousel" 
        data-nav="<?php echo esc_attr($settings['nav']); ?>" 
        data-control="<?php echo esc_attr($settings['control']); ?>" 
        data-autoplay="<?php echo esc_attr($settings['autoplay']); ?>"
        data-loop="<?php echo esc_attr($settings['loop']); ?>"
        data-rtl="<?php echo esc_attr($settings['testi_rtl']); ?>"
    > 
        <?php foreach (  $settings['list'] as $item ): ?>
            <div class="single-test">
                <div class="testimonial-img-box">
                    <div class="<?php if ( 'yes' === $settings['image_shadow'] ) {echo 'ImgShadow'; }  ?>">
                        <div class="<?php echo esc_attr($settings['image_shape']); ?>">
                            <img src="<?php echo esc_url($item['t_image']['url']); ?>" class="avatar" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?>" width="80" height="80">
                    </div>
                </div>
            </div>
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
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="" class="img-icon" width="50" height="50">
            </span>
                <?php endif;?>
                <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( wp_kses_post($item['content'] )) ); ?></p>
                <div class="testi-info">
                    <p class="name"><b><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?></b></p>
                    <span class="desigration"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['position'] ) ); ?></span>
            </div>
        </div> 
            <?php endforeach; ?> 
    </div>
    <div class="owlControl">
        <div class="owl-nav">
            <button class="owl-prev" type="button" aria-label="Prev Button"><i class="ti-arrow-left"></i></button>
            <button class="owl-next" type="button" aria-label="Next Button"><i class="ti-arrow-right"></i></button>
        </div>
    </div>
</div>
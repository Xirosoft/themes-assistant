<?php use Elementor\Icons_Manager; ?>
<div class="testimonial testimonial-style-5">
        <div class="row align-items-center">
            <div class="col-md-5">
                <!-- <div class="row"> -->
                    <div class="client-thumb owl-thumbs row" data-slider-id="2">
                        <?php foreach (  $settings['list'] as $item ): ?>
                            <a href="javascript:void(0)" class="owl-thumb-item col-md-4 p-2">
                                <div class="<?php if ( 'yes' === $settings['image_shadow'] ) {echo 'ImgShadow'; }  ?>">
                                    <div class="<?php echo $settings['image_shape']; ?>">
                                        <span>
                                            <img src="<?php echo esc_url($item['t_image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?>" width="50" height="50">
                                    </span>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?> 
                </div>
                <!-- </div> -->
        </div>
            <div class="col-md-7">
                <div class="testimonial-area">
                <?php if( $settings['icon_type'] == 'icon'):?>
                <span class="icon">
                    <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
                <?php elseif( $settings['icon_type'] == 'iconclass'):?>
                <span class="icon">
                    <i class="<?php echo esc_html__($settings['iconclass'], 'themes-assistant'); ?>"></i>
            </span>
                <?php elseif( $settings['icon_type'] == 'image'):?>
                <span class="icon">
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?>" class="img-icon" width="50" height="50">
            </span>
                <?php endif;?>
                    <div class="test-caro owl-carousel" data-slider-id="2">
                        <?php foreach (  $settings['list'] as $item ): 
                            
                        //    var_dump($item);
                            ?>
                            <div class="single-tst">
                            <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( wp_kses_post($item['content'] )) ); ?></p>                                
                            <div class="client-info">                
                                <p><b><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['name'] ) ); ?></b>, <span><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['position'] ) ); ?></span></p>
                            </div>
                        </div>
                        <?php endforeach; ?> 
                </div>  
            </div>
        </div>
    </div>


</div>